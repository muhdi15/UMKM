<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use Illuminate\Support\Facades\Auth;

class Pembeli extends Controller
{
    public function userDashboard()
    {
        return view('pembeli.home');
    }
    
    public function kategori()
    {
        $data = Seller::all();
        return view('pembeli.umkm', compact('data'));
    }
    public function about()
    {
        return view('pembeli.about');
    }
    public function contact()
    {
        return view('pembeli.contact');
    }
}
