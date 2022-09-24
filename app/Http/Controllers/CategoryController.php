<?php

namespace App\Http\Controllers;

class CategoryController
{
    public function show($product, $slug)
    {
        return view('categories.show');
    }
}
