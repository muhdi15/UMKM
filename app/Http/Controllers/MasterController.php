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
        $user = $seller->user; // ambil user terkait seller

        // Validasi status seller
        $validStatuses = ['aktif', 'nonaktif', 'ditolak'];
        if (!in_array($status, $validStatuses)) {
            return redirect()->back()->with('error', 'Status tidak valid.');
        }

        // update status seller
        $seller->status = $status;
        $seller->save();

        // --- Tambahan: Update status user sesuai status seller ---
        if ($user) {
            // mapping status seller -> status user
            $mappedStatus = match ($status) {
                'aktif'     => 'accepted',
                'nonaktif'  => 'pending',
                'ditolak'   => 'denied',
            };

            $user->status = $mappedStatus;
            $user->save();
        }

        // pesan sukses
        $msg = match ($status) {
            'aktif'     => 'Seller berhasil diaktifkan.',
            'nonaktif'  => 'Seller telah dinonaktifkan.',
            'ditolak'   => 'Pendaftaran seller ditolak.',
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


    public function profile()
    {
        $user = auth()->user(); // User yang login
        return view('admin.profile.index', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto && file_exists(storage_path('app/public/' . $user->foto))) {
                unlink(storage_path('app/public/' . $user->foto));
            }
            $path = $request->file('foto')->store('foto_admin', 'public');
            $user->foto = $path;
        }

        $user->save();

        return redirect()->route('admin.profile')->with('success', 'Profil berhasil diperbarui.');
    }


    //Kategori

    public function kategoriIndex(Request $request)
    {
        $query = Category::query();

        if ($request->filled('search')) {
            $query->where('nama_kategori', 'like', '%' . $request->search . '%');
        }

        $kategori = $query->latest()->paginate(10)->withQueryString();

        return view('admin.kategori.index', compact('kategori'));
    }

    /**
     * Simpan kategori baru
     */
    public function kategoriStore(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:categories,nama_kategori',
            'deskripsi' => 'nullable|string|max:255',
        ]);

        Category::create([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Update kategori
     */
    public function kategoriUpdate(Request $request, $id)
    {
        $kategori = Category::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:categories,nama_kategori,' . $kategori->id,
            'deskripsi' => 'nullable|string|max:255',
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Hapus kategori
     */
    public function kategoriDestroy($id)
    {
        $kategori = Category::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }

    public function konsumen(Request $request)
    {
        $query = User::where('role_id', 3)->withCount(['orders', 'reviews']);

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $customers = $query->latest()->paginate(10);

        return view('admin.manajemen.konsumen', compact('customers'));
    }








































    //=========Route for User =========

    public function userDashboard()
    {
        return Auth::user()->name;
    }
}
