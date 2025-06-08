<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
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
        // Logic to retrieve user profile data
        $user = User::find(auth()->id());

        // Return the profile view with user data
        return view('admin.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        // Ambil user yang sedang login
        $user = User::find(auth()->id());

        if (!$user) {
            abort(403, 'Tidak diizinkan.');
        }

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'nomor_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Ambil data input
        $data = $request->only(['name', 'email', 'nomor_hp', 'alamat']);

        // Jika ada file foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto && file_exists(storage_path('app/public/foto/' . $user->foto))) {
                unlink(storage_path('app/public/foto/' . $user->foto));
            }

            // Ambil file foto dari request
            $file = $request->file('foto');

            // Generate nama file unik
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Simpan file ke folder 'foto' dalam storage public
            $file->storeAs('public/foto', $filename);

            // Simpan nama file ke data update
            $data['foto'] = $filename;
        }

        // Update user
        $user->update($data);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
