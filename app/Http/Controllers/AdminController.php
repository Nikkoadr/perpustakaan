<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\User;
use App\Models\Peminjaman;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {

        $jumlah_buku = Buku::count();
        $jumlah_anggota = User::where('role_id', '3')->count();
        $peminjaman_aktif = Peminjaman::where('status', 'dipinjam')->count();
        $peminjaman_selesai = Peminjaman::where('status', 'dikembalikan')->count();
        return view('admin.dashboard', compact('jumlah_buku', 'jumlah_anggota', 'peminjaman_aktif', 'peminjaman_selesai'));
    }
}
