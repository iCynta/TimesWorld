<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Colors;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Colors::create([
            'color'=>'Purple',
        ]);
        Colors::create([
            'color'=>'Red',
        ]);
        Colors::create([
            'color'=>'Green',
        ]);
        Colors::create([
            'color'=>'Yellow',
        ]); 
        Colors::create([
            'color'=>'White',
        ]);
    }
}
