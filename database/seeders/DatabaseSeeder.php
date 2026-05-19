<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductReview;
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
        $adizero = Product::query()->firstOrCreate([
            'name' => 'Adizero EVO SL Shoes',
        ], [
            'price' => 7100,
            'category' => 'running',
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQiabWsiBrKUNecgrx24xT6O957rXzPSlKJDA&s',
            'stock' => 14,
        ]);

        $jordan = Product::query()->firstOrCreate([
            'name' => 'Air Jordan 1 Mid SE',
        ], [
            'price' => 5527,
            'category' => 'sneakers',
            'image' => 'https://www.slamdunk.gr/2960984-product_large/jordan-air-1-mid-se.jpg',
            'stock' => 9,
        ]);

        $tokuten = Product::query()->firstOrCreate([
            'name' => 'Tokuten Classic',
        ], [
            'price' => 9720,
            'category' => 'casual',
            'image' => 'https://asics.scene7.com/is/image/asics/1183C430_020_SR_RT_GLB?$otmag_zoom$&qlt=99,1',
            'stock' => 6,
        ]);

        $courtRunner = Product::query()->firstOrCreate([
            'name' => 'Sapatosan Court Runner',
        ], [
            'price' => 4800,
            'category' => 'basketball',
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTldU2qEuHP-kuO_ufDLpZQmhY-ikI5KDaBzg&s',
            'stock' => 18,
        ]);

        $reviews = [
            $adizero->id => [
                ['reviewer_name' => 'Mika', 'body' => 'Lightweight feel and great grip for daily runs.'],
                ['reviewer_name' => 'Jonas', 'body' => 'The fit is snug and fast without feeling stiff.'],
            ],
            $jordan->id => [
                ['reviewer_name' => 'Rae', 'body' => 'Clean colorway and comfortable enough for long walks.'],
                ['reviewer_name' => 'Nico', 'body' => 'Looks premium in person and matches everything.'],
            ],
            $tokuten->id => [
                ['reviewer_name' => 'Lia', 'body' => 'Classic shape with soft materials. Good casual pair.'],
                ['reviewer_name' => 'Arvin', 'body' => 'Feels sturdy and the retro style is sharp.'],
            ],
            $courtRunner->id => [
                ['reviewer_name' => 'Karlo', 'body' => 'Supportive on court and still comfortable after play.'],
                ['reviewer_name' => 'Tess', 'body' => 'Good traction and the cushioning feels reliable.'],
            ],
        ];

        foreach ($reviews as $productId => $productReviews) {
            foreach ($productReviews as $review) {
                ProductReview::query()->firstOrCreate([
                    'product_id' => $productId,
                    'reviewer_name' => $review['reviewer_name'],
                ], [
                    'rating' => 5,
                    'body' => $review['body'],
                ]);
            }
        }
    }
}
