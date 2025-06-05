<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Buku::create([
            'judul' => 'Belajar Laravel',
            'penulis' => 'Nikko Adrian',
            'penerbit' => 'Gramedia',
            'tahun_terbit' => 2021,
            'stok' => 10,
            'kategori_id' => 1,
        ]);
    }
}
