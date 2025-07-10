<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer = auth('customer')->user();

        $cart = Cart::with([
            'items.product',
            'items.variant',
            'items.size',
        ])->where('customer_id', $customer->id)->first();

        return view('pages.account.cart', compact('cart'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $customer = auth('customer')->user();

        if (empty($customer->phone) || empty($customer->address)) {
            return redirect()->route('setting')->with('notification', 'Harap isi Alamat dan No Telpon terlebih dahulu');
        }

        $validated = $request->validate([
            'product_id'       => 'required|exists:products,id',
            'variant_id'       => 'required|exists:product_variants,id',
            'size_id'          => 'nullable|exists:product_sizes,id',
            'quantity'         => 'required|integer|min:1',
            'custom_size_note' => 'nullable|string',
            'notes'            => 'nullable|string',

            // Custom size values (optional)
            'chest'            => 'nullable|numeric|min:0',
            'waist'            => 'nullable|numeric|min:0',
            'hip'              => 'nullable|numeric|min:0',
            'body_length'      => 'nullable|numeric|min:0',
            'sleeve_length'    => 'nullable|numeric|min:0',
        ]);

        $cart = Cart::firstOrCreate(
            ['customer_id' => $customer->id],
            ['created_at' => now()]
        );

        $variant = ProductVariant::findOrFail($validated['variant_id']);
        $customSizeNote = $validated['custom_size_note'] ?? null;
        $customSizeHash = $customSizeNote ? hash('sha256', $customSizeNote) : null;

        // Hitung requested meter
        $requestedMeter = 1; // default fallback

        if (empty($validated['size_id']) && $customSizeNote) {
            $chest        = floatval($validated['chest'] ?? 0);
            $hip          = floatval($validated['hip'] ?? 0);
            $bodyLength   = floatval($validated['body_length'] ?? 0);
            $sleeveLength = floatval($validated['sleeve_length'] ?? 0);

            if ($chest && $hip && $bodyLength && $sleeveLength) {
                $requestedMeter = round(($bodyLength * 0.015) + (($chest + $hip + $sleeveLength) * 0.003), 2);
            } else {
                return back()->with('error', 'Ukuran custom tidak lengkap. Mohon lengkapi semua ukuran.');
            }
        } elseif (!empty($validated['size_id'])) {
            $size = ProductSize::findOrFail($validated['size_id']);
            $requestedMeter = $size->estimated_meter ?? 1;
        }

        // Hitung total kebutuhan kain
        $totalUsedMeter = $requestedMeter * $validated['quantity'];

        if ($variant->stock_in_meter < $totalUsedMeter) {
            return back()->with('error', 'Stok kain tidak mencukupi. Silakan kurangi jumlah atau pilih ukuran lain.');
        }

        // Cek apakah item sudah ada di keranjang
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('variant_id', $validated['variant_id'])
            ->where('size_id', $validated['size_id'])
            ->where('custom_size_hash', $customSizeHash)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $validated['quantity']);
            $cartItem->requested_meter += $requestedMeter;
            $cartItem->notes = $validated['notes'] ?? null;
            $cartItem->custom_size_note = $customSizeNote;
            $cartItem->save();
        } else {
            $cart->items()->create([
                'product_id'         => $validated['product_id'],
                'variant_id'         => $validated['variant_id'],
                'size_id'            => $validated['size_id'],
                'quantity'           => $validated['quantity'],
                'requested_meter'    => $requestedMeter,
                'custom_size_note'   => $customSizeNote,
                'custom_size_hash'   => $customSizeHash,
                'notes'              => $validated['notes'] ?? null,
            ]);
        }

        $variant->decrement('stock_in_meter', $totalUsedMeter);

        return redirect()
            ->route('product.detail', ['slug' => $variant->product->slug])
            ->with('success', 'Item berhasil ditambahkan ke keranjang.');
    }




    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cartItem = CartItem::findOrFail($id);

        if ($cartItem->cart->customer_id !== auth('customer')->id()) {
            abort(403); // forbidden
        }

        $variant = $cartItem->variant;
        $variant->stock_in_meter += $cartItem->requested_meter; // diasumsikan stok dikurangi saat item masuk cart
        $variant->save();

        $cartItem->delete();

        return back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }
}
