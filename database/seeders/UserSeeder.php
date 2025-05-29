<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'role_id' => '1',
            'email' => 'admin@example.com',
            'password' => Hash::make('secret123'),
            'name' => 'Nikko Adrian',
        ]);
        User::create([
            'role_id' => '2',
            'email' => 'petugas@example.com',
            'password' => Hash::make('secret123'),
            'name' => 'Petugas Perpustakaan',
        ]);
        User::create([
            'role_id' => '3',
            'email' => 'anggota@example.com',
            'password' => Hash::make('secret123'),
            'name' => 'Anggota Perpustakaan',
        ]);
    }
}
