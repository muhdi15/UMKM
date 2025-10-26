<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view("auth.login");
    }

    public function loginPost(Request $request){
        $data = $request->validate([
            'email' => 'string',
            'password' => 'string'
        ]);

        $credential = [
            $request->email,
            $request->password,
        ];

        if(Auth::attempt($credential)){
            return view('profile');
        }

        else{
            return "email dan password salah";
        }
    }


    public function profile(){
        return view("user.profile");
    }
}
