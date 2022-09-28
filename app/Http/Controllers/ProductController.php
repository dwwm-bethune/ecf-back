<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;

class ProductController
{
    public function index()
    {
        return view('products.index', [
            'products' => Product::paginate(6),
            'colors' => Color::all(),
            'lastProduct' => Product::latest()->first(),
            'categories' => Category::limit(5)->get(),
        ]);
    }

    public function show(Product $product)
    {
        return view('products.show', [
            'product' => $product,
        ]);
    }
}
