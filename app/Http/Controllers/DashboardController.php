<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Buku;
use App\Models\User;
use App\Models\Peminjaman;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        if (Gate::allows('admin')) {
            $jumlah_buku = Buku::count();
            $jumlah_anggota = User::where('role_id', '3')->count();
            $peminjaman_aktif = Peminjaman::where('status', 'dipinjam')->count();

            return view('admin.dashboard.admin', compact(
                'jumlah_buku',
                'jumlah_anggota',
                'peminjaman_aktif',
            ));
        }

        if (Gate::allows('petugas')) {
            $peminjaman_aktif = Peminjaman::where('status', 'dipinjam')->count();

            return view('admin.dashboard.petugas', compact(
                'peminjaman_aktif',
            ));
        }

        if (Gate::allows('anggota')) {
            $userId = Auth::id();

            $pinjam_aktif = Peminjaman::where('user_id', $userId)
                ->where('status', 'dipinjam')->get();

            $riwayat = Peminjaman::where('user_id', $userId)
                ->where('status', 'dikembalikan')->get();

            return view('admin.dashboard.anggota', compact(
                'pinjam_aktif',
                'riwayat',
            ));
        }

        abort(403, 'Unauthorized');
    }
}
