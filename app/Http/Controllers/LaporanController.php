<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;

class LaporanController extends Controller
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


    public function index(Request $request)
    {
        $this->authorize('admin-dan-petugas');
        $filter = $request->get('filter');
        $query = Peminjaman::with(['user', 'buku']);

        if ($filter === 'harian' && $request->tanggal) {
            $query->whereDate('tanggal_pinjam', $request->tanggal);
        } elseif ($filter === 'bulanan' && $request->bulan) {
            $bulan = explode('-', $request->bulan);
            $query->whereMonth('tanggal_pinjam', $bulan[1])
                ->whereYear('tanggal_pinjam', $bulan[0]);
        }

        $laporan = $query->orderBy('tanggal_pinjam', 'desc')->get();

        return view('admin.laporan.index', compact('laporan'));
    }
}
