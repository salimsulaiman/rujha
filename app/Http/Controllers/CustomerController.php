<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.account.setting');
    }

    public function transaction()
    {
        return view('pages.account.transaction');
    }

    public function updateDetail(Request $request)
    {
        $user = Customer::find(auth('customer')->id());

        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $user->name    = $validated['name'];
        $user->phone   = $validated['phone'] ?? null;
        $user->address = $validated['address'] ?? null;

        $user->save();

        return back()->with('success', 'Data profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {

        $user = Customer::find(auth('customer')->id());

        $request->validate([
            'oldPassword' => 'required|string',
            'password' => 'required|string|min:6|confirmed', // gunakan `confirmed` jika pakai konfirmasi password
        ]);

        if (!Hash::check($request->oldPassword, $user->password)) {
            return back()->withErrors(['oldPassword' => 'Password lama tidak sesuai.'])->withInput();
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password berhasil diperbarui.');
    }

    public function updateProfile(Request $request)
    {
        $user = Customer::find(auth('customer')->id());

        $request->validate([
            'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
        ]);

        if ($user->profile && Storage::disk('public')->exists($user->profile)) {
            Storage::disk('public')->delete($user->profile);
        }

        $path = $request->file('profile')->store('profile', 'public');

        $user->profile = $path;
        $user->save();

        return back()->with('success', 'Foto profil berhasil diperbarui.');
    }

    public function deleteProfile()
    {
        $user = Customer::find(auth('customer')->id());

        if ($user->profile && Storage::disk('public')->exists($user->profile)) {
            Storage::disk('public')->delete($user->profile);
        }

        $user->profile = null;
        $user->save();

        return back()->with('success', 'Avatar berhasil dihapus.');
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

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
