<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\TailoringProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function transaction()
    {
        $customer = auth('customer')->user();
        $orders = Order::with('items')->where('customer_id', $customer->id)->orderBy('created_at', 'desc')->get();

        return view('pages.account.transaction', compact('orders'));
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
        //
    }

    public function placeOrder(Request $request)
    {
        $customer = auth('customer')->user();

        if ($customer->phone === null && $customer->address === null) {
            return redirect()->route('setting')->with('notification', 'Harap isi Alamat dan No Telpon terlebih dahulu');
        }

        $request->validate([
            'subtotal_amount' => 'required|numeric|min:0',
            'tax' => 'required|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
        ]);

        $cart = Cart::with('items.variant', 'items.size')
            ->where('customer_id', $customer->id)
            ->firstOrFail();


        if ($cart->items->isEmpty()) {
            return back()->with('error', 'Keranjang kosong.');
        }

        DB::beginTransaction();

        try {
            $order = Order::create([
                'customer_id' => $customer->id,
                'address' => $customer->address,
                'phone' => $customer->phone,
                'code' => 'ORD-' . strtoupper(uniqid()),
                'subtotal_amount' => $request->subtotal_amount,
                'tax' => $request->tax,
                'total_amount' => $request->total_amount,
                'status' => 'pending',
            ]);

            foreach ($cart->items as $item) {
                $subtotal = $item->quantity * $item->requested_meter * $item->variant->price_per_meter;

                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'variant_id' => $item->variant_id,
                    'size_id' => $item->size_id,
                    'custom_size_note' => $item->custom_size_note,
                    'quantity' => $item->quantity,
                    'requested_meter' => $item->requested_meter,
                    'subtotal_price' => $subtotal,
                    'notes' => $item->notes,
                ]);

                TailoringProgress::create([
                    'order_item_id' => $orderItem->id,
                    'status' => 'waiting',
                ]);
            }

            $cart->items()->delete();
            $cart->delete();

            DB::commit();

            return redirect()->route('cart', $order)->with('successOrder', 'Pesanan berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function detail($code)
    {
        $order = Order::with('items.product', 'items.variant', 'items.size')->where('code', $code)->firstOrFail();

        return view('pages.account.transaction-detail', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
