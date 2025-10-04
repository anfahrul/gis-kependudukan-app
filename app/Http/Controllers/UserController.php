<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.admin-profile', [
            "title" => "Admin - Profile",
        ]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'min:6', 'confirmed'],
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Password lama tidak sesuai.',
            ])->withInput();
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Password berhasil diperbarui.');
    }

    public function indexAccManage()
    {
        $list_admin =  User::all();
        return view('admin.admin-acc-manage', [
            "title" => "Admin - Account Management",
            "admins" => $list_admin,
        ]);
    }

    public function createAcc()
    {
        return view('admin.admin-add-account', [
            "title" => "Admin - Add Admin Account"
        ]);
    }

    public function storeAcc(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:administrator,staff',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin-acc-manage.index')
            ->with('success', 'Akun staff baru berhasil ditambahkan!');
    }

    public function destroyAcc(User $user)
    {
        $user->delete();

        return redirect()->route('admin-acc-manage.index')
            ->with('success', 'Akun Staff berhasil dihapus!');
    }
}
