<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Buku;
use App\Models\Peminjaman;

class PeminjamanController extends Controller
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
    public function index()
    {
        $peminjamanAktif = Peminjaman::with(['user', 'buku'])
            ->where('status', 'dipinjam')
            ->get();

        return view('admin.peminjaman.index', compact('peminjamanAktif'));
    }

    public function autocompletePengguna(Request $request)
    {
        $term = $request->get('term');

        $users = User::where('role_id', 3)
            ->where('name', 'LIKE', "%$term%")
            ->get();

        return response()->json($users->map(function ($user) {
            return ['id' => $user->id, 'label' => $user->name];
        }));
    }


    public function autocompleteBuku(Request $request)
    {
        $term = $request->get('term');
        $books = Buku::where('judul', 'LIKE', "%$term%")->get();

        return response()->json($books->map(function ($book) {
            return ['id' => $book->id, 'label' => $book->judul];
        }));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'buku_id' => 'required|exists:buku,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date|after:tanggal_pinjam',
        ]);

        $book = Buku::find($validated['buku_id']);

        if (!$book) {
            return back()->withErrors(['buku_id' => 'Buku tidak ditemukan.'])->withInput();
        }

        if ($book->stok < 1) {
            return back()->withErrors(['buku_id' => 'Stok buku habis, tidak bisa dipinjam.'])->withInput();
        }

        $sudahPinjam = Peminjaman::where('user_id', $validated['user_id'])
            ->where('buku_id', $validated['buku_id'])
            ->where('status', 'dipinjam')
            ->exists();

        if ($sudahPinjam) {
            return back()->withErrors(['buku_id' => 'Pengguna ini masih meminjam buku yang sama.'])->withInput();
        }

        $peminjaman = new Peminjaman();
        $peminjaman->user_id = $validated['user_id'];
        $peminjaman->buku_id = $validated['buku_id'];
        $peminjaman->tanggal_pinjam = $validated['tanggal_pinjam'];
        $peminjaman->tanggal_jatuh_tempo = $validated['tanggal_jatuh_tempo'];
        $peminjaman->status = 'dipinjam';
        $peminjaman->save();

        $book->stok -= 1;
        $book->save();

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil ditambahkan.');
    }

    public function kembalikan($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->status = 'dikembalikan';
        $peminjaman->save();

        $buku = $peminjaman->buku;
        if ($buku) {
            $buku->stok += 1;
            $buku->save();
        }

        return redirect()->route('peminjaman.index')->with('success', 'Buku berhasil dikembalikan.');
    }

    public function perpanjang($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->tanggal_jatuh_tempo = \Carbon\Carbon::parse($peminjaman->tanggal_jatuh_tempo)->addDays(7);
        $peminjaman->save();

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil diperpanjang.');
    }
}
