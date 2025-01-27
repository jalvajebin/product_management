<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('web.pages.products.index', compact('products'));
    }

    public function show(string $handle)
    {
        $product = Product::query()
            ->with('variants')
            ->where('handle', $handle)
            ->where('is_active', true)
            ->firstOrFail();

       return view('web.pages.products.show', compact('product'));
    }

}
