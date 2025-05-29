<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;

class Data_bukuController extends Controller
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
        $this->authorize('admin');
        $buku = Buku::with('kategori')->get();
        return view('admin.data_buku.index', compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('admin');
        $kategori = Kategori::all();
        return view('admin.data_buku.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('admin');
        $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer',
            'gambar_sampul' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stok' => 'required|integer|min:0',
        ]);

        $data = $request->only(['judul', 'penulis', 'penerbit', 'tahun_terbit', 'stok', 'kategori_id']);

        if ($request->hasFile('gambar_sampul')) {
            $file = $request->file('gambar_sampul');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/sampul', $filename);
            $data['gambar_sampul'] = $filename;
        }
        Buku::create($data);
        return redirect()->route('data_buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('admin');
        $buku = Buku::findOrFail($id);
        return view('admin.data_buku.show', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('admin');
        $buku = Buku::findOrFail($id);
        $kategori = Kategori::all();
        return view('admin.data_buku.edit', compact('buku', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        $this->authorize('admin');
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategori,id',
            'gambar_sampul' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $buku = Buku::findOrFail($id);

        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->penerbit = $request->penerbit;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->stok = $request->stok;
        $buku->kategori_id = $request->kategori_id;

        // Jika ada file gambar baru di-upload
        if ($request->hasFile('gambar_sampul')) {
            // Hapus gambar lama jika ada
            if ($buku->gambar_sampul && Storage::exists('public/sampul/' . $buku->gambar_sampul)) {
                Storage::delete('public/sampul/' . $buku->gambar_sampul);
            }

            // Simpan gambar baru
            $file = $request->file('gambar_sampul');
            $namaFile = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/sampul', $namaFile);

            $buku->gambar_sampul = $namaFile;
        }

        $buku->save();

        return redirect()->route('data_buku.index')->with('success', 'Buku berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('admin');
        $buku = Buku::findOrFail($id);

        // Hapus file gambar sampul jika ada
        if ($buku->gambar_sampul && Storage::exists('public/sampul/' . $buku->gambar_sampul)) {
            Storage::delete('public/sampul/' . $buku->gambar_sampul);
        }

        $buku->delete();

        return redirect()->route('data_buku.index')->with('success', 'Buku berhasil dihapus.');
    }
}
