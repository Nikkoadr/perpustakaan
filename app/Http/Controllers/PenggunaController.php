<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;

class PenggunaController extends Controller
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
        $pengguna = User::with('role')->get();

        return view('admin.pengguna.index', compact('pengguna'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('admin');
        $roles = Roles::all();
        return view('admin.pengguna.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('admin');
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'nomor_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'role_id' => 'required|exists:roles,id'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->nomor_hp = $request->nomor_hp;
        $user->alamat = $request->alamat;
        $user->role_id = $request->role_id;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('admin');
        $user = User::findOrFail($id);
        $roles = Roles::all();
        return view('admin.pengguna.show', compact('user', 'roles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->authorize('admin');
        $user = User::findOrFail($id);
        $roles = Roles::all();
        return view('admin.pengguna.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('admin');
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,$id",
            'password' => 'nullable|string|min:6|confirmed',
            'nomor_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'role_id' => 'required|exists:roles,id'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->nomor_hp = $request->nomor_hp;
        $user->alamat = $request->alamat;
        $user->role_id = $request->role_id;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();
        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('admin');
        $pengguna = User::findOrFail($id);
        $pengguna->delete();
        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
