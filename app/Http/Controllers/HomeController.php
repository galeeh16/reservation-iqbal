<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        if (session()->get('id') != null && session()->get('username') != null) {
            if (session()->get('role') == 1) { // Requester
                return view('requester.index');
            } else if (session()->get('role') == 2) { // Approval
                return view('approval.index');
            } else if (session()->get('role') == 3) { // Warehouse
                return view('warehouse.index'); 
            } else { // role ngaco
                return 'Role tidak ditemukan';
            }
        }
        return redirect('/logout');
    }
}
