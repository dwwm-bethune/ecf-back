<?php

namespace App\Http\Controllers;

class ProductController
{
    public function index()
    {
        return view('products.index');
    }

    public function show($product, $slug)
    {
        return view('products.show');
    }
}
