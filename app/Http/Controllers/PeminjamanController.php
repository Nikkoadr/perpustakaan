<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        // Logic to display peminjaman data
        return view('admin.peminjaman.index');
    }
}
