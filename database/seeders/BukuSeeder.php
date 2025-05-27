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
            'penulis' => 'John Doe',
            'penerbit' => 'Penerbit A',
            'tahun_terbit' => 2021,
            'gambar_sampul' => 'default.png',
            'stok' => 10,
            'kategori_id' => 1,
        ]);
        Buku::create([
            'judul' => 'Pemrograman PHP',
            'penulis' => 'Jane Smith',
            'penerbit' => 'Penerbit B',
            'tahun_terbit' => 2020,
            'gambar_sampul' => 'default.png',
            'stok' => 5,
            'kategori_id' => 2,
        ]);
        Buku::create([
            'judul' => 'Dasar-dasar JavaScript',
            'penulis' => 'Alice Johnson',
            'penerbit' => 'Penerbit C',
            'tahun_terbit' => 2019,
            'gambar_sampul' => 'default.png',
            'stok' => 8,
            'kategori_id' => 3,
        ]);
        Buku::create([
            'judul' => 'Pengantar Python',
            'penulis' => 'Bob Brown',
            'penerbit' => 'Penerbit D',
            'tahun_terbit' => 2022,
            'gambar_sampul' => 'default.png',
            'stok' => 12,
            'kategori_id' => 4,
        ]);
        Buku::create([
            'judul' => 'Database MySQL',
            'penulis' => 'Charlie Green',
            'penerbit' => 'Penerbit E',
            'tahun_terbit' => 2023,
            'gambar_sampul' => 'default.png',
            'stok' => 7,
            'kategori_id' => 5,
        ]);
        Buku::create([
            'judul' => 'Framework CodeIgniter',
            'penulis' => 'David White',
            'penerbit' => 'Penerbit F',
            'tahun_terbit' => 2021,
            'gambar_sampul' => 'default.png',
            'stok' => 6,
            'kategori_id' => 6,
        ]);
        Buku::create([
            'judul' => 'Belajar React',
            'penulis' => 'Eve Black',
            'penerbit' => 'Penerbit G',
            'tahun_terbit' => 2020,
            'gambar_sampul' => 'default.png',
            'stok' => 9,
            'kategori_id' => 7,
        ]);
        Buku::create([
            'judul' => 'Pengembangan Aplikasi Mobile',
            'penulis' => 'Frank Blue',
            'penerbit' => 'Penerbit H',
            'tahun_terbit' => 2022,
            'gambar_sampul' => 'default.png',
            'stok' => 11,
            'kategori_id' => 8,
        ]);
        Buku::create([
            'judul' => 'Cloud Computing',
            'penulis' => 'Grace Yellow',
            'penerbit' => 'Penerbit I',
            'tahun_terbit' => 2023,
            'gambar_sampul' => 'default.png',
            'stok' => 4,
            'kategori_id' => 8,
        ]);
        Buku::create([
            'judul' => 'Machine Learning',
            'penulis' => 'Hank Purple',
            'penerbit' => 'Penerbit J',
            'tahun_terbit' => 2021,
            'gambar_sampul' => 'default.png',
            'stok' => 3,
            'kategori_id' => 8,
        ]);
        Buku::create([
            'judul' => 'Artificial Intelligence',
            'penulis' => 'Ivy Orange',
            'penerbit' => 'Penerbit K',
            'tahun_terbit' => 2022,
            'gambar_sampul' => 'default.png',
            'stok' => 15,
            'kategori_id' => 8,
        ]);
        Buku::create([
            'judul' => 'Data Science',
            'penulis' => 'Jack Pink',
            'penerbit' => 'Penerbit L',
            'tahun_terbit' => 2023,
            'gambar_sampul' => 'default.png',
            'stok' => 20,
            'kategori_id' => 8,
        ]);
    }
}
