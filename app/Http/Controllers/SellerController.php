<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\Review;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    /**
     * Dashboard Seller
     */
    public function dashboard()
    {
        $sellerId = Auth::user()->seller->id;

        return view('seller.dashboard', [
            'totalProduk'   => Product::where('seller_id', $sellerId)->count(),
            'totalPesanan'  => Order::where('seller_id', $sellerId)->count(),
            'pesananBaru'   => Order::where('seller_id', $sellerId)->where('status_order', 'diproses')->count(),
            'totalPendapatan' => Order::where('seller_id', $sellerId)
                ->where('status_pembayaran', 'dibayar')
                ->sum('total_harga'),
        ]);
    }


    public function profile()
    {
        $seller = Auth::user()->seller;

        return view('seller.profile', compact('seller'));
    }

    /**
     * Update Profil Toko
     */
    public function updateProfile(Request $request)
    {
        $seller = Auth::user()->seller;

        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:1000',
            'alamat' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'foto_toko' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload foto
        if ($request->hasFile('foto_toko')) {
            $file = $request->file('foto_toko');
            $filename = 'toko_' . time() . '.' . $file->getClientOriginalExtension();

            // MENYIMPAN KE DISK PUBLIC DENGAN BENAR
            $file->storeAs('foto_toko', $filename, 'public');

            // SIMPAN PATH YANG BISA DI AKSES OLEH BLADE
            $seller->foto_toko = 'storage/foto_toko/' . $filename;
        }

        $seller->nama_toko = $request->nama_toko;
        $seller->deskripsi = $request->deskripsi;
        $seller->alamat = $request->alamat;
        $seller->no_telp = $request->telepon;
        $seller->save();

        return redirect()->route('seller.profile')->with('success', 'Profil toko berhasil diperbarui!');
    }


    public function products()
    {
        $sellerId = Auth::user()->seller->id;
        $produk = Product::with('category')
            ->where('seller_id', $sellerId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('seller.products.index', compact('produk'));
    }

    // Form tambah produk
    public function createProduct()
    {
        $categories = Category::orderBy('nama_kategori')->get();
        return view('seller.products.create', compact('categories'));
    }

    // Simpan produk baru
    public function storeProduct(Request $request)
    {
        $sellerId = Auth::user()->seller->id;

        $request->validate([
            'nama_produk' => 'required|string|max:150',
            'deskripsi'   => 'required|string',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'berat'       => 'nullable|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status'      => 'required|in:aktif,nonaktif',
        ]);

        $data = $request->only(['nama_produk', 'deskripsi', 'harga', 'stok', 'berat', 'category_id', 'status']);
        $data['seller_id'] = $sellerId;

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = 'produk_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/foto_produk', $filename);
            $data['foto'] = 'storage/foto_produk/' . $filename;
        }

        Product::create($data);

        return redirect()->route('seller.products')->with('success', 'Produk berhasil ditambahkan.');
    }

    // Form edit produk
    public function editProduct($id)
    {
        $sellerId = Auth::user()->seller->id;
        $product = Product::where('seller_id', $sellerId)->findOrFail($id);
        $categories = Category::orderBy('nama_kategori')->get();

        return view('seller.products.edit', compact('product', 'categories'));
    }

    // Update produk
    public function updateProduct(Request $request, $id)
    {
        $sellerId = Auth::user()->seller->id;
        $product = Product::where('seller_id', $sellerId)->findOrFail($id);

        $request->validate([
            'nama_produk' => 'required|string|max:150',
            'deskripsi'   => 'required|string',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'berat'       => 'nullable|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status'      => 'required|in:aktif,nonaktif',
        ]);

        $data = $request->only(['nama_produk', 'deskripsi', 'harga', 'stok', 'berat', 'category_id', 'status']);

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = 'produk_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/foto_produk', $filename);
            $data['foto'] = 'storage/foto_produk/' . $filename;
        }

        $product->update($data);

        return redirect()->route('seller.products')->with('success', 'Produk berhasil diperbarui.');
    }

    // Hapus produk
    public function deleteProduct($id)
    {
        $sellerId = Auth::user()->seller->id;
        $product = Product::where('seller_id', $sellerId)->findOrFail($id);
        $product->delete();

        return redirect()->route('seller.products')->with('success', 'Produk berhasil dihapus.');
    }

    public function orders()
    {
        $sellerId = Auth::user()->seller->id;

        $orders = Order::with('details.product', 'user')
            ->where('seller_id', $sellerId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('seller.orders.index', compact('orders'));
    }

    // Detail pesanan
    public function orderDetail($id)
    {
        $sellerId = Auth::user()->seller->id;

        $order = Order::with('details.product', 'user')
            ->where('seller_id', $sellerId)
            ->findOrFail($id);

        return view('seller.orders.detail', compact('order'));
    }

    // Update status pesanan
    public function updateOrderStatus(Request $request, $id)
    {
        $sellerId = Auth::user()->seller->id;

        $request->validate([
            'status_order' => 'required|in:diproses,dikirim,selesai,dibatalkan'
        ]);

        $order = Order::where('seller_id', $sellerId)->findOrFail($id);
        $order->status_order = $request->status_order;
        $order->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }


    public function reviews()
    {
        $sellerId = Auth::user()->seller->id;

        // Ambil semua review untuk produk seller
        $reviews = Review::with('product', 'user')
            ->whereHas('product', function ($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('seller.reviews.index', compact('reviews'));
    }


    public function reports()
    {
        $sellerId = Auth::user()->seller->id;

        $totalPendapatan = Order::where('seller_id', $sellerId)
            ->where('status_pembayaran', 'dibayar')
            ->sum('total_harga');

        $totalPesanan = Order::where('seller_id', $sellerId)->count();

        $topProducts = DB::table('order_details')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->select('products.nama_produk', DB::raw('SUM(order_details.quantity) as total_terjual'))
            ->where('products.seller_id', $sellerId)
            ->groupBy('products.id', 'products.nama_produk')
            ->orderByDesc('total_terjual')
            ->limit(5)
            ->get();

        // Labels 6 bulan terakhir
        $monthlyLabels = [];
        $monthlySales = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i)->format('Y-m');
            $monthlyLabels[] = now()->subMonths($i)->format('M Y');
            $monthlySales[] = Order::where('seller_id', $sellerId)
                ->where('status_pembayaran', 'dibayar')
                ->whereYear('created_at', now()->subMonths($i)->year)
                ->whereMonth('created_at', now()->subMonths($i)->month)
                ->sum('total_harga');
        }

        // Hitung produk stok rendah
        $lowStockCount = Product::where('seller_id', $sellerId)->where('stok', '<=', 5)->count();

        return view('seller.reports.index', compact('totalPendapatan', 'totalPesanan', 'topProducts', 'monthlyLabels', 'monthlySales', 'lowStockCount'));


        return view('seller.reports.index', compact('totalPendapatan', 'totalPesanan', 'topProducts'));
    }

    // Laporan Penjualan Bulanan
    public function reportSales(Request $request)
    {
        $sellerId = Auth::user()->seller->id;

        $month = $request->get('month', date('m'));
        $year = $request->get('year', date('Y'));

        $sales = Order::where('seller_id', $sellerId)
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();

        $totalPendapatan = $sales->where('status_pembayaran', 'dibayar')->sum('total_harga');
        $totalPesanan = $sales->count();

        return view('seller.reports.sales', compact('sales', 'totalPendapatan', 'totalPesanan', 'month', 'year'));
    }

    // Laporan Stok Produk
    public function reportStock()
    {
        $sellerId = Auth::user()->seller->id;

        $products = Product::where('seller_id', $sellerId)->orderBy('nama_produk')->get();

        return view('seller.reports.stock', compact('products'));
    }

    // Laporan Pembayaran
    public function reportPayments()
    {
        $sellerId = Auth::user()->seller->id;

        $payments = Payment::whereHas('order', function ($q) use ($sellerId) {
            $q->where('seller_id', $sellerId);
        })->orderBy('created_at', 'desc')->get();

        return view('seller.reports.payments', compact('payments'));
    }
}
