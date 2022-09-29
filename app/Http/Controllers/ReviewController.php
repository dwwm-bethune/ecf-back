<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ReviewController extends Controller
{
    public function store(Product $product)
    {
        request()->validate([
            'name' => 'required|min:3',
            'message' => 'required|min:3',
            'note' => 'required|between:0,5',
        ]);

        $product->reviews()->create([
            'name' => request('name'),
            'message' => request('message'),
            'note' => request('note'),
        ]);

        return redirect()->route('products.show', [$product, $product->slug]);
    }
}
