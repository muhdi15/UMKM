<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Seller;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }



    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password salah.']);
        }

        // Cek status untuk seller
        if ($user->role->name === 'seller' && $user->status === 'pending') {
            return back()->with('info', 'Akun anda masih menunggu verifikasi admin.');
        }

        if ($user->role->name === 'seller' && $user->status === 'denied') {
            return back()->with('error', 'Akun anda ditolak oleh admin.');
        }

        if ($user->role->name === 'user' && $user->status === 'pending') {
            return back()->with('error', 'Akun anda ditolak oleh admin.');
        }

        if ($user->role->name === 'user' && $user->status === 'denied') {
            return back()->with('error', 'Akun anda ditolak oleh admin.');
        }

        Auth::login($user);

        // 🔥 Arahkan ke dashboard sesuai role
        switch ($user->role->name) {
            case 'admin':
                return redirect()->route('admin.dashboard')->with('success', 'Selamat datang kembali, ' . $user->name);
            case 'seller':
                return redirect()->route('seller.dashboard')->with('success', 'Selamat datang kembali, ' . $user->name);
            case 'user':
                return redirect()->route('user.dashboard')->with('success', 'Selamat datang kembali, ' . $user->name);
            default:
                Auth::logout();
                return redirect()->route('login')->with('error', 'Role tidak dikenali.');
        }
    }

    

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // 🔹 Proses Register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:user,seller',
        ]);

        // Ambil role_id dari tabel roles
        $role = Role::where('name', $request->role)->first();

        if (!$role) {
            return back()->with('error', 'Role tidak ditemukan!');
        }

        // Buat user baru dengan status default 'pending' untuk seller
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role->id,
            'status' => $request->role === 'seller' ? 'pending' : 'accepted',
        ]);

        // Jika role seller, buat data toko default (akan divalidasi admin)
        if ($request->role === 'seller') {
            Seller::create([
                'user_id' => $user->id,
                'nama_toko' => 'Toko Baru ' . $user->name,
                'deskripsi' => 'Menunggu verifikasi admin.',
                'alamat' => 'Belum diatur',
                'no_telp' => '-',
                'status' => 'nonaktif',
            ]);
        }

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! ' .
            ($request->role === 'seller' ? 'Akun seller Anda menunggu verifikasi admin.' : 'Silakan login.'));
    }



    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }
}
