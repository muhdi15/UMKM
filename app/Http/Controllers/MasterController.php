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
use Illuminate\Support\Facades\Auth;

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

    public function sellerVerifikasi()
    {
        $sellers = Seller::with('user')
            ->where('status', 'nonaktif')
            ->latest()
            ->paginate(10);

        return view('admin.seller.verifikasi', compact('sellers'));
    }


    public function produkSeller(Request $request)
    {
        $query = Product::with(['seller.user'])->latest();

        // Filter berdasarkan seller
        if ($request->filled('seller_id')) {
            $query->where('seller_id', $request->seller_id);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $query = Product::with(['seller.user'])->latest();

        if ($request->filled('seller_id')) {
            $query->where('seller_id', $request->seller_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        $produk = $query->paginate(10);
        $sellers = Seller::with('user')->get();

        return view('admin.seller.produk', compact('produk', 'sellers'));
    }

    public function destroyProdukSeller($id)
    {
        $produk = Product::findOrFail($id);
        $produk->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus.');
    }




    public function sellerMap(Request $request)
    {
        $query = Seller::with('user')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude');

        // Filter berdasarkan status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Filter jika ada nama seller
        if ($request->seller) {
            $query->where('nama_toko', 'like', "%{$request->seller}%")
                ->orWhereHas('user', function ($q) use ($request) {
                    $q->where('name', 'like', "%{$request->seller}%");
                });
        }

        $sellers = $query->latest()->get();

        return view('admin.seller.map', compact('sellers'));
    }

    public function searchSeller(Request $request)
    {
        $keyword = $request->get('q');

        $sellers = Seller::with('user')
            ->where('nama_toko', 'like', "%{$keyword}%")
            ->orWhereHas('user', function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%");
            })
            ->take(10)
            ->get(['id', 'nama_toko', 'latitude', 'longitude']);

        return response()->json($sellers);
    }







































    //=========Route for User =========

    public function userDashboard()
    {
        return Auth::user()->name;
    }
}
