<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;

class CategoryController
{
    public function show(Category $category)
    {
        return view('categories.show', [
            'category' => $category,
            'products' => $category->products()->paginate(6),
            'lastProduct' => $category->products()->latest()->first(),
            'categories' => Category::limit(5)->get(),
            'colors' => Color::all(),
        ]);
    }
}
