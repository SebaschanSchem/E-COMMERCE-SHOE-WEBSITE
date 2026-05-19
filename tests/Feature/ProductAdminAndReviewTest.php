<?php

use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

test('admin can add a product with an uploaded image', function () {
    if (! in_array('sqlite', PDO::getAvailableDrivers(), true)) {
        $this->markTestSkipped('The pdo_sqlite extension is not installed.');
    }

    $this->artisan('migrate:fresh');
    Storage::fake('public');

    $image = UploadedFile::fake()->createWithContent(
        'shoe.gif',
        base64_decode('R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==')
    );

    $this->post('/admin/products', [
        'name' => 'Test Runner',
        'price' => 2499.99,
        'category' => 'running',
        'stock' => 7,
        'image' => $image,
    ])->assertRedirect('/admin/products');

    $product = Product::query()->where('name', 'Test Runner')->firstOrFail();

    expect($product->image)->toStartWith('storage/products/');
    Storage::disk('public')->assertExists(Str::after($product->image, 'storage/'));
});

test('purchase page only shows reviews for the selected product', function () {
    if (! in_array('sqlite', PDO::getAvailableDrivers(), true)) {
        $this->markTestSkipped('The pdo_sqlite extension is not installed.');
    }

    $this->artisan('migrate:fresh');

    $firstProduct = Product::query()->create([
        'name' => 'Review Shoe One',
        'price' => 1000,
        'category' => 'casual',
        'image' => 'https://example.com/one.jpg',
        'stock' => 4,
    ]);

    $secondProduct = Product::query()->create([
        'name' => 'Review Shoe Two',
        'price' => 2000,
        'category' => 'running',
        'image' => 'https://example.com/two.jpg',
        'stock' => 4,
    ]);

    ProductReview::query()->create([
        'product_id' => $firstProduct->id,
        'reviewer_name' => 'First Customer',
        'rating' => 5,
        'body' => 'This belongs to the first shoe.',
    ]);

    ProductReview::query()->create([
        'product_id' => $secondProduct->id,
        'reviewer_name' => 'Second Customer',
        'rating' => 5,
        'body' => 'This belongs to the second shoe.',
    ]);

    $this->get('/purchase/'.$firstProduct->id)
        ->assertOk()
        ->assertSee('This belongs to the first shoe.')
        ->assertDontSee('This belongs to the second shoe.');
});
