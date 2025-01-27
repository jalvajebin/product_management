<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index(Request $request)
    {

        $cartedProductItems = $request->session()->get('cartItems') ?? [];
        $cartItems = [];
        $subTotal = 0;

        foreach(array_reverse($cartedProductItems, true) as $productId => $cartedProductItem) {
            $product = Product::query()->find($productId);

            if (! $product) {
                continue;
            }

            $quantity = $cartedProductItem['quantity'];
            $price = $product->special_price ?? $product->price;
            $totalPrice = $price * $quantity;

            $cartItems[] = [
                'productId' => $product->id,
                'productName' => $product->name,
                'productImage' => url('storage/products/images/' . optional($product)->image_name),
                'quantity' => $quantity,
                'productPrice' => number_format($price, 2),
                'productTotalPrice' => number_format($totalPrice, 2),
            ];

            $subTotal += $totalPrice;
        }

        $shippingCharge = ($subTotal <= 500) ? 30 : 0;
        $grandTotal = $subTotal + $shippingCharge;
        $subTotal = number_format($subTotal, 2);
        $shippingCharge = number_format($shippingCharge, 2);
        $grandTotal = number_format($grandTotal, 2);

        return view('web.pages.cart.index', compact('cartItems', 'subTotal', 'grandTotal','shippingCharge'));
    }

    public function remove(Request $request, $productId)
    {
        $cartItems = $request->session()->get('cartItems') ?? [];

        if (isset($cartItems[$productId])) {
            unset($cartItems[$productId]);
            $request->session()->put('cartItems', $cartItems);
        }

        return redirect()->route('cart.index');
    }

}
