<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminProductController
{
    public function index()
    {
        return view('admin.products.index', [
            'products' => Product::latest('id')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.products.create', [
            'colors' => Color::all(),
            'categories' => Category::all(),
        ]);
    }

    public function store()
    {
        request()->validate([
            'name' => 'required|min:3',
            'description' => 'required|min:10',
            'price' => 'required|numeric|between:99,1000',
            'favorite' => 'boolean',
            'image' => 'required|image|max:4096',
            'discount' => 'required|numeric|between:0,100',
            'category' => 'required|exists:categories,id',
            'colors' => 'array',
            'colors.*' => 'exists:colors,id',
        ]);

        $product = Product::create([
            'name' => $name = request('name'),
            'slug' => Str::slug($name),
            'description' => request('description'),
            'price' => request('price'),
            'favorite' => request()->filled('favorite'),
            'image' => '/storage/'.request()->file('image')->store('products'),
            'discount' => request('discount'),
            'category_id' => request('category'),
        ]);

        $product->colors()->sync(request('colors'));

        return redirect()->route('admin.products');
    }

    public function destroy(Product $product)
    {
        Storage::delete(str($product->image)->remove('/storage'));

        $product->delete();

        return redirect()->route('admin.products');
    }
}
