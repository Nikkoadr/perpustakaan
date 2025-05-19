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
            'id_role' => '1',
            'email' => 'nikkoadrian02@gmail.com',
            'password' => Hash::make('secret123'),
            'name' => 'Nikko Adrian',
        ]);
    }
}
