<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        if (session()->get('id') != null && session()->get('username') != null) {
            return redirect('/home');
        }
        return view('auth.login');
    }

    public function prosesLogin(Request $request)
    {
        // tampung data input username kedalam variable $username  
        $username = $request->input('username');
        // tampung data input password kedalam variable $password  
        $password = $request->input('password');

        // ambil data user dari database berdasarkan username (dari inputan depan)
        $user = User::where('username', $username)->first();

        // cek jika user exists, jika user tidak ditemukan kasih tau user kalo username tidak ditemukan / tidak valid
        if (!$user) {
            return response()->json(['message' => 'Username tidak ditemukan'], 401);
        }

        // jika user ditemukan
        // cek passwordnya bener apa nggak
        if (!Hash::check($password, $user->password)) {
            return response()->json(['message' => 'Password anda tidak valid'], 401);
        }

        session()->put('id', $user->id);
        session()->put('username', $user->username);
        session()->put('name', $user->name);

        return response()->json([
            'message' => 'Berhasil login',
            'data' => $user
        ], 200);

    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }
}
