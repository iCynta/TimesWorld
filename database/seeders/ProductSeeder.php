<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'title'=>'Shirt One',
            'description'=>' Shirt One description. This will give a holistic idea about the product',
            'image'=>'sample-image.png',
            'color'=>'Red',
            'size'=>'Shirt One size'
        ]);
        Product::create([
            'title'=>'Shirt Two',
            'description'=>' Shirt Two description. This will give a holistic idea about the product',
            'image'=>'sample-image.png',
            'color'=>'Black',
            'size'=>'Shirt Two size'
        ]);
        Product::create([
            'title'=>'Shirt One',
            'description'=>' Shirt One description. This will give a holistic idea about the product',
            'image'=>'sample-image.png',
            'color'=>'Green',
            'size'=>'Shirt One size'
        ]);
        Product::create([
            'title'=>'Shirt One',
            'description'=>' Shirt One description. This will give a holistic idea about the product',
            'image'=>'sample-image.png',
            'color'=>'Yellow',
            'size'=>'Shirt One size'
        ]);
        Product::create([
            'title'=>'Shirt One',
            'description'=>' Shirt One description. This will give a holistic idea about the product',
            'image'=>'sample-image.png',
            'color'=>'Lavender',
            'size'=>'Shirt One size'
        ]);
    }
}
