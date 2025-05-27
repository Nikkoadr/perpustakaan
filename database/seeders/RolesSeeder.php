<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roles;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Roles::create([
            'nama' => 'admin',
            'description' => 'Administrator',
        ]);
        Roles::create([
            'nama' => 'Petugas',
            'description' => 'Petugas Perpustakaan',
        ]);
        Roles::create([
            'nama' => 'anggota',
            'description' => 'Anggota Perpustakaan',
        ]);
    }
}
