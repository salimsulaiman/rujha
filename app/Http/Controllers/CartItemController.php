<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function updateQuantity(Request $request, $id)
    {
        $item = CartItem::findOrFail($id);

        if ($item->cart->customer_id !== auth('customer')->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'quantity' => 'required|integer|min:0'
        ]);

        $newQuantity = $validated['quantity'];
        $variant = $item->variant;
        $requestedMeter = $item->requested_meter;

        // Hitung stok yang dipakai sebelumnya
        $oldTotalMeter = $item->quantity * $requestedMeter;

        // Jika quantity = 0 → hapus item dan kembalikan stok
        if ($newQuantity === 0) {
            // Tambahkan kembali stok lama
            $variant->stock_in_meter += $oldTotalMeter;
            $variant->save();

            $item->delete();
            return response()->json(['success' => true, 'deleted' => true]);
        }

        // Hitung stok baru yang akan digunakan
        $newTotalMeter = $newQuantity * $requestedMeter;

        // Hitung selisih pemakaian stok
        $stockDifference = $oldTotalMeter - $newTotalMeter;

        // Update stok (kembalikan atau kurangi)
        $variant->stock_in_meter += $stockDifference;

        // Cegah stok negatif
        if ($variant->stock_in_meter < 0) {
            return response()->json([
                'success' => false,
                'message' => 'Stok tidak mencukupi untuk update ini.'
            ], 422);
        }

        $variant->save();

        // Simpan perubahan item
        $item->quantity = $newQuantity;
        $item->save();

        return response()->json(['success' => true]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CartItem $cartItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CartItem $cartItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CartItem $cartItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartItem $cartItem)
    {
        //
    }
}
