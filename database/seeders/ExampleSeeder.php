<?php

namespace Database\Seeders;

use App\Models\Example;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Example::create([
            'data_string' => 'Example String',
            'data_int' => 123,
            'data_text' => 'This is an example text.',
            'date' => now(),
        ]);
        Example::create([
            'data_string' => 'Another String',
            'data_int' => 456,
            'data_text' => 'This is another example text.',
            'date' => now()->addDays(1),
        ]);
        Example::create([
            'data_string' => 'Third String',
            'data_int' => 789,
            'data_text' => 'This is the third example text.',
            'date' => now()->addDays(2),
        ]);
        Example::create([
            'data_string' => 'Fourth String',
            'data_int' => 101112,
            'data_text' => 'This is the fourth example text.',
            'date' => now()->addDays(3),
        ]);
    }
}
