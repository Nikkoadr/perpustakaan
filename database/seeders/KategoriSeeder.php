<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kategori::create([
            'nama' => 'Fiksi',
        ]);
        Kategori::create([
            'nama' => 'Non-Fiksi',
        ]);
        Kategori::create([
            'nama' => 'Sains',
        ]);
        Kategori::create([
            'nama' => 'Teknologi',
        ]);
        Kategori::create([
            'nama' => 'Sejarah',
        ]);
        Kategori::create([
            'nama' => 'Biografi',
        ]);
        Kategori::create([
            'nama' => 'Kesehatan',
        ]);
        Kategori::create([
            'nama' => 'Seni',
        ]);
    }
}
