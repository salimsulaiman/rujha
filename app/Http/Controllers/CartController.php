<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
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

        if ($customer->phone === null && $customer->address === null) {
            return redirect()->route('setting')->with('notification', 'Harap isi Alamat dan No Telpon terlebih dahulu');
        }
        $request->validate([
            'product_id'       => 'required|exists:products,id',
            'variant_id'       => 'required|exists:product_variants,id',
            'size_id'          => 'nullable|exists:product_sizes,id',
            'quantity'         => 'required|integer|min:1',
            'requested_meter'  => 'nullable|numeric|min:0.01', // nullable karena akan dihitung jika custom
            'custom_size_note' => 'nullable|string',
            'notes'            => 'nullable|string',

            // Validasi untuk input custom size (opsional, tergantung kebutuhan)
            'chest'           => 'nullable|numeric|min:0',
            'waist'           => 'nullable|numeric|min:0',
            'hip'             => 'nullable|numeric|min:0',
            'body_length'     => 'nullable|numeric|min:0',
            'sleeve_length'   => 'nullable|numeric|min:0',
        ]);

        $cart = Cart::firstOrCreate(
            ['customer_id' => $customer->id],
            ['created_at' => now()]
        );

        $customSizeNote = $request->custom_size_note;
        $customSizeHash = $customSizeNote ? hash('sha256', $customSizeNote) : null;

        // ✅ Hitung requested_meter jika custom size
        $requestedMeter = $request->requested_meter;
        if (empty($request->size_id) && $customSizeNote) {
            $chest        = floatval($request->chest);
            $waist        = floatval($request->waist);
            $hip          = floatval($request->hip);
            $bodyLength   = floatval($request->body_length);
            $sleeveLength = floatval($request->sleeve_length);

            // ✅ Logika perhitungan — kamu bisa sesuaikan
            $requestedMeter = round(($bodyLength * 0.015) + (($chest + $hip + $sleeveLength) * 0.003), 2);

            // ✅ Tetapkan minimal meter
            $requestedMeter = max($requestedMeter, 1); // minimal 1 meter
        }

        // Cek apakah item sudah ada di keranjang
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('variant_id', $request->variant_id)
            ->where('size_id', $request->size_id)
            ->where('custom_size_hash', $customSizeHash)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $request->quantity);
            $cartItem->requested_meter += $requestedMeter;
            $cartItem->notes = $request->notes;
            $cartItem->custom_size_note = $customSizeNote;
            $cartItem->save();
        } else {
            $cart->items()->create([
                'product_id'         => $request->product_id,
                'variant_id'         => $request->variant_id,
                'size_id'            => $request->size_id,
                'quantity'           => $request->quantity,
                'requested_meter'    => $requestedMeter,
                'custom_size_note'   => $customSizeNote,
                'custom_size_hash'   => $customSizeHash,
                'notes'              => $request->notes,
            ]);
        }

        $variant = ProductVariant::find($request->variant_id);
        if ($variant) {
            $totalUsedMeter = $requestedMeter * $request->quantity;

            // Cegah nilai negatif
            if ($variant->stock_in_meter < $totalUsedMeter) {
                return back()->with('error', 'Stok kain tidak mencukupi.');
            }

            $variant->decrement('stock_in_meter', $totalUsedMeter);
        }

        $product = Product::findOrFail($request->product_id);

        return redirect()->route('product.detail', ['slug' => $product->slug])
            ->with('success', 'Item baru ditambahkan. Silahkan cek keranjang anda.');
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
