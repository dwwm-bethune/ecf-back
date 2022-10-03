<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Product;

class CartController
{
    public function index()
    {
        $subtotal = collect(session('cart'))->sum(function ($item) {
            $promo = round($item->product->price - $item->product->price * $item->product->discount / 100, 2);

            return $item->quantity * $promo;
        });

        // $subtotal = 0;
        // foreach (session('cart') as $item) {
        //     $promo = round($item->product->price - $item->product->price * $item->product->discount / 100, 2);
        //     $subtotal += $item->quantity * $promo;
        // }

        return view('cart', [
            'subtotal' => $this->formatPrice($subtotal),
            'delivery' => $this->formatPrice($delivery = 6.90),
            'total' => $this->formatPrice($subtotal + $delivery),
        ]);
    }

    private function formatPrice($price)
    {
        return number_format($price, 2, ',', '').' €';
    }

    public function store(Product $product)
    {
        $color = Color::find(request('color')) ?? $product->colors->first();
        // Trouver le produit s'il existe
        $key = collect(session('cart'))->where('product.id', $product->id)
            ->where('color.id', optional($color)->id)->keys()->first();

        if (! is_null($key)) {
            $item = session('cart.'.$key);
            $item->quantity += request('quantity', 1);
            session()->put('cart.'.$key, $item);
        } else {
            session()->push('cart', (object) [
                'product' => $product,
                'quantity' => request('quantity', 1),
                'color' => $color,
            ]);
        }

        return redirect()->route('cart');
    }

    public function destroy(Product $product)
    {
        /* $cart = session('cart');
        $newCart = [];

        foreach ($cart as $item) {
            if ($item->product->id !== $product->id) {
                $newCart[] = $item;
            }
        }

        session()->put('cart', $newCart); */

        session()->pull(
            'cart.'.collect(session('cart'))->where('product.id', $product->id)
                ->where('color.id', request('color'))->keys()->first()
        );

        return redirect()->route('cart');
    }
}
