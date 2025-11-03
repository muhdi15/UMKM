<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Pembeli extends Controller
{
    public function userDashboard()
    {
        return view('pembeli.index');
    }
    public function kategori()
    {
        return view('pembeli.umkm');
    }
}
