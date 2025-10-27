<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use App\Models\Seller;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function adminDashboard()
    {
        // Jumlah user per role (menggunakan relasi role)
        $totalAdmin = User::whereHas('role', fn($q) => $q->where('name', 'admin'))->count();
        $totalSeller = User::whereHas('role', fn($q) => $q->where('name', 'seller'))->count();
        $totalUser = User::whereHas('role', fn($q) => $q->where('name', 'user'))->count();

        // Data utama
        $totalProduk = Product::count();
        $totalPesanan = Order::count();
        $totalKategori = Category::count();

        // Data baru
        $recentSellers = User::whereHas('role', fn($q) => $q->where('name', 'seller'))
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $recentOrders = Order::orderBy('created_at', 'desc')
            ->take(5)
            ->with('user')
            ->get();

        return view('admin.dashboard', compact(
            'totalAdmin',
            'totalSeller',
            'totalUser',
            'totalProduk',
            'totalPesanan',
            'totalKategori',
            'recentSellers',
            'recentOrders'
        ));
    }

    // === SELLER MANAGEMENT ===
    public function sellerIndex()
    {
        $sellers = Seller::with('user')->latest()->paginate(10);
        return view('admin.seller.index', compact('sellers'));
    }

    public function sellerShow($id)
    {
        $seller = Seller::with(['user', 'products'])->findOrFail($id);
        return view('admin.seller.show', compact('seller'));
    }

    public function sellerUpdateStatus($id, $status)
    {
        $seller = Seller::findOrFail($id);

        $validStatuses = ['aktif', 'nonaktif', 'ditolak'];
        if (!in_array($status, $validStatuses)) {
            return redirect()->back()->with('error', 'Status tidak valid.');
        }

        $seller->status = $status;
        $seller->save();

        $msg = match ($status) {
            'aktif' => 'Seller berhasil diaktifkan.',
            'nonaktif' => 'Seller telah dinonaktifkan.',
            'ditolak' => 'Pendaftaran seller ditolak.',
        };

        return redirect()->route('admin.seller.show', $seller->id)
            ->with('success', $msg);
    }


    public function sellerDestroy($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->delete();

        return redirect()->route('admin.seller.index')
            ->with('success', 'Data seller berhasil dihapus.');
    }
}
