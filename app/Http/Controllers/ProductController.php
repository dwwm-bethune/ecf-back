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
            'products' => Product::when(request('colors'), function ($query) {
                $query->whereHas('colors', function ($query) {
                    $query->where(function ($query) {
                        foreach (request('colors', []) as $color) {
                            $query->orWhere('id', $color);
                        }
                    });
                });
            })->paginate(6)->withQueryString(),
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
