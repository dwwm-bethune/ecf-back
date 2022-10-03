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
                    // WHERE blabla and (id = 1 or id = 2 or id = 3)
                    $query->whereIn('id', request('colors'));
                    /* $query->where(function ($query) {
                        foreach (request('colors', []) as $color) {
                            $query->orWhere('id', $color);
                        }
                    }); */
                });
            })->where('name', 'like', '%'.request('q').'%')->paginate(6)->withQueryString(),
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
