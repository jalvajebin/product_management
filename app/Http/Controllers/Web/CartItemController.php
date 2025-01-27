<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    public function store(Request $request)
    {
        $productId = $request->input('productId');
        $type = $request->input('type');
        $method = $request->input('method');
        $location = $request->input('location');
        $size = $request->input('size');
        $color = $request->input('color');

        if ($method == 'CLEAR') {
            if ($request->session()->has('cartItems')) {
                $request->session()->forget('cartItems');

                return back()->with('success', 'Cart cleared.');
            }
        }

        if ($method == 'DELETE') {
            if ($request->session()->has('cartItems.' . $productId)) {
                $request->session()->forget('cartItems.' . $productId);

                return back()->with('success', 'Cart updated.');
            } else {
                return back()->with('error', 'Item not found.');
            }
        }

        $product = Product::query()
            ->where('id', $productId)
            ->where('is_active', true)
            ->first();

        if (! $product) {
            return back()->with('error', 'The selected product does not exist.');
        }

        if ($product->stock == 0) {
            return back()->with('error', 'Sorry, the selected product is currently out of stock.');
        }

        $cartItemQuantity = $request->session()->get('cartItems.' . $productId . '.quantity');

        if ($type == 'INCREASE') {
            if ($cartItemQuantity >= $product->stock) {
                return back()->with('error', 'Maximum quantity for this product has been reached.');
            }
        }

        if ($type == 'DECREASE') {
            if ($cartItemQuantity <= 1) {
                return back()->with('error', 'Minimum quantity for this product is 1.');
            }
        }

        if ($request->session()->has('cartItems.' . $productId)) {
            if ($type == 'INCREASE') {
                $request->session()->increment('cartItems.' . $productId . '.quantity');
            }

            if ($type == 'DECREASE') {
                $request->session()->decrement('cartItems.' . $productId . '.quantity');
            }
        } else {
            $cartItems = $request->session()->get('cartItems', []);

            $cartItems[$productId] = [
                'quantity' => 1,
            ];

            $request->session()->put('cartItems', $cartItems);
        }

        if ($location == 'PRODUCT') {
            return back()->with('success', 'Cart updated.');
        }

        return back();
    }

}
