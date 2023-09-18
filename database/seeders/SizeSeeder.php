<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sizes;

class SizeSeeder extends Seeder
{
    protected $table ='size';
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sizes::create([
            'size'=>'S',
        ]);
        Sizes::create([
            'size'=>'M',
        ]);
        Sizes::create([
            'size'=>'L',
        ]);
        Sizes::create([
            'size'=>'XL',
        ]); 
        Sizes::create([
            'size'=>'XXL',
        ]);
    }
}
