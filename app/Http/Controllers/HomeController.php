<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        if (session()->get('id') != null && session()->get('username') != null) {
            return view('home');
        }
        return redirect('/logout');
    }
}
