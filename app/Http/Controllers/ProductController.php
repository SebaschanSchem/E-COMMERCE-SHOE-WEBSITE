<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search'));
        $category = trim((string) $request->query('category'));

        $products = Product::query()
            ->when($search !== '', fn ($query) => $query->where('name', 'like', "%{$search}%"))
            ->when($category !== '', fn ($query) => $query->where('category', $category))
            ->latest()
            ->get();

        $categories = Product::query()
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('product', compact('products', 'categories', 'search', 'category'));
    }

    public function adminIndex()
    {
        $products = Product::latest()->get();

        return view('adminproduct', compact('products'));
    }

    public function store(Request $request)
    {
        $data = $this->validatedProduct($request);
        $data['image'] = $this->storeUploadedImage($request);

        Product::create($data);

        return redirect('/admin/products')->with('status', 'Product added.');
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validatedProduct($request, imageRequired: false);

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeUploadedImage($request);
        }

        $product->update($data);

        return redirect('/admin/products')->with('status', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect('/admin/products')->with('status', 'Product deleted.');
    }

    private function validatedProduct(Request $request, bool $imageRequired = true): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'category' => ['required', 'string', 'max:255'],
            'stock' => ['required', 'integer', 'min:0'],
            'image' => [$imageRequired ? 'required' : 'nullable', 'image', 'max:4096'],
        ]);
    }

    private function storeUploadedImage(Request $request): string
    {
        $file = $request->file('image');
        $directory = public_path('uploads/products');

        if (! File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
            . '-' . now()->format('YmdHis')
            . '.' . $file->getClientOriginalExtension();

        $file->move($directory, $filename);

        return 'uploads/products/' . $filename;
    }
}
