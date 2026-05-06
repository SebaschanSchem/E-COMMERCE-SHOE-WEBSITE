<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Product::query()->firstOrCreate([
            'name' => 'Adizero EVO SL Shoes',
        ], [
            'price' => 7100,
            'category' => 'running',
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQiabWsiBrKUNecgrx24xT6O957rXzPSlKJDA&s',
            'stock' => 14,
        ]);

        Product::query()->firstOrCreate([
            'name' => 'Air Jordan 1 Mid SE',
        ], [
            'price' => 5527,
            'category' => 'sneakers',
            'image' => 'https://www.slamdunk.gr/2960984-product_large/jordan-air-1-mid-se.jpg',
            'stock' => 9,
        ]);

        Product::query()->firstOrCreate([
            'name' => 'Tokuten Classic',
        ], [
            'price' => 9720,
            'category' => 'casual',
            'image' => 'https://asics.scene7.com/is/image/asics/1183C430_020_SR_RT_GLB?$otmag_zoom$&qlt=99,1',
            'stock' => 6,
        ]);

        Product::query()->firstOrCreate([
            'name' => 'Sapatosan Court Runner',
        ], [
            'price' => 4800,
            'category' => 'basketball',
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTldU2qEuHP-kuO_ufDLpZQmhY-ikI5KDaBzg&s',
            'stock' => 18,
        ]);
    }
}
