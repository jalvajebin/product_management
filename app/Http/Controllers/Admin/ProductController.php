<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;

class ProductController extends Controller
{

    public function index(Builder $builder, Request $request)
    {
        if ($request->ajax()) {
            $query = Product::query();

            if ($request->filled('filter.search')) {
                $query->where(function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%' . $request->input('filter.search') . '%')
                        ->orWhere('code', 'LIKE', '%' . $request->input('filter.search') . '%');
                });
            }

            return DataTables::of($query)
                ->addColumn('is_active','admin.pages.products.is-active')
                ->addColumn('action', 'admin.pages.products.action')
                ->rawColumns(['is_active','action'])
                ->toJson();
        }

        $html = $builder->columns([
            ['name' => 'name', 'data' => 'name', 'title' => 'Name', 'orderable' => false],
            ['name' => 'code', 'data' => 'code', 'title' => 'Code', 'orderable' => false],
            ['name' => 'price', 'data' => 'price', 'title' => 'Price', 'orderable' => false],
            ['name' => 'special_price', 'data' => 'special_price', 'title' => 'Special price', 'orderable' => false],
            ['name' => 'stock', 'data' => 'stock', 'title' => 'Stock', 'orderable' => false],
            ['name' => 'is_active', 'data' => 'is_active', 'title' => 'Active?', 'orderable' => false],
            ['name' => 'action', 'data' => 'action', 'title' => '', 'orderable' => false],
        ]);

        return view('admin.pages.products.index', compact('html'));
    }

    public function create()
    {
        return view('admin.pages.products.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|max:255|unique:products',
            'price' => 'required|numeric',
            'special_price' => 'nullable|numeric',
            'stock' => 'required|integer|min:0',
            'description' => 'required',
            'variants.*.size' => 'required|string',
            'variants.*.color' => 'required|string',
            'variants.*.price' => 'required|numeric',
            'variants.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif',        ],
            [
                'variants.*.size.required' => 'The size field is mandatory for each variant.',
                'variants.*.size.string' => 'Each variant size must be a valid string.',
                'variants.*.color.required' => 'The color field is mandatory for each variant.',
                'variants.*.color.string' => 'Each variant color must be a valid string.',
                'variants.*.price.required' => 'Each variant must have a price.',
                'variants.*.price.numeric' => 'The price must be a valid number.',
                'variants.*.image.required' => 'Each variant must have an image.',
                'variants.*.image.image' => 'The image field must be a valid image.',
        ]);

        $product = new Product();
        $product->name = $request->input('name');
        $product->handle = Str::slug($request->input('name')) . '-' . Str::slug($request->input('code'));
        $product->code = $request->input('code');
        $product->price = $request->input('price');
        $product->special_price = $request->input('special_price');
        $product->stock = $request->input('stock');
        $product->description = $request->input('description');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/products/images', $imageName);
            $product->image_name = $imageName;
        }

        $product->save();

        if ($request->has('variants')) {
            foreach ($request->input('variants') as $index => $variant) {
                if ($request->hasFile("variants.$index.image")) {
                    $image = $request->file("variants.$index.image");
                    $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('public/products/images', $imageName);

                    $productVariant = new ProductVariant();
                    $productVariant->product_id = $product->id;
                    $productVariant->size = $variant['size'];
                    $productVariant->color = $variant['color'];
                    $productVariant->price = $variant['price'];
                    $productVariant->image_name = $imageName;
                    $productVariant->save();
                }
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }


    public function edit(Product $product)
    {

        $ProductVariants = $product->variants; // Use Eloquent relationship
        return view('admin.pages.products.edit', compact('product', 'ProductVariants'));
    }

    public function update(Product $product, Request $request)
    {
        if ($request->has('is_active')) {
            $product->is_active ? $product->is_active = false : $product->is_active = true;
            $product->save();

            return redirect(route('admin.products.index', $product->id))->with('success', 'Product status successfully updated.');
        }

        $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|max:255|unique:products,code,' . $product->id,
            'price' => 'required|numeric',
            'special_price' => 'nullable|numeric',
            'stock' => 'required|integer|min:0',
            'description' => 'required',
            'variants.*.size' => 'required|string',
            'variants.*.color' => 'required|string',
            'variants.*.price' => 'required|numeric',
            'variants.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif',        ],
            [
                'variants.*.size.required' => 'The size field is mandatory for each variant.',
                'variants.*.size.string' => 'Each variant size must be a valid string.',
                'variants.*.color.required' => 'The color field is mandatory for each variant.',
                'variants.*.color.string' => 'Each variant color must be a valid string.',
                'variants.*.price.required' => 'Each variant must have a price.',
                'variants.*.price.numeric' => 'The price must be a valid number.',
                'variants.*.image.required' => 'Each variant must have an image.',
                'variants.*.image.image' => 'The image field must be a valid image.',
        ]);

        $product->name = $request->input('name');
        $product->handle = Str::slug($request->input('name')) . '-' . Str::slug($request->input('code'));
        $product->code = $request->input('code');
        $product->price = $request->input('price');
        $product->special_price = $request->input('special_price');
        $product->stock = $request->input('stock');
        $product->description = $request->input('description');

        if ($request->hasFile('image')) {
            Storage::delete("public/products/images/$product->image_name");
            $image = $request->file('image');
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/products/images', $imageName);
            $product->image_name = $imageName;

        }

        $product->save();

        $existingVariantIds = $product->variants->pluck('id')->toArray();
        $formVariantIds = array_filter(array_column($request->input('variants', []), 'id'));
        $idsToDelete = array_diff($existingVariantIds, $formVariantIds);

        // Delete removed variants
        ProductVariant::whereIn('id', $idsToDelete)->delete();

        foreach ($request->input('variants', []) as $index => $variant) {
            // Check if variant exists or create new
            $productVariant = isset($variant['id']) && !empty($variant['id'])
                ? ProductVariant::find($variant['id'])
                : new ProductVariant();

            // Update or assign new image for the variant
            if ($request->hasFile('variants.' . $index . '.image')) {
                if (!empty($productVariant->image_name)) {
                    Storage::delete("public/products/images/{$productVariant->image_name}");
                }
                $image = $request->file('variants.' . $index . '.image');
                $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/products/images', $imageName);
                $productVariant->image_name = $imageName;
            }

            // Associate variant with the current product
            $productVariant->product_id = $product->id;
            $productVariant->size = $variant['size'];
            $productVariant->color = $variant['color'];
            $productVariant->price = $variant['price'];
            $productVariant->save();
        }


        return redirect(route('admin.products.index', $product->id))->with('success', 'Product successfully updated.');
    }

    public function destroy(Product $product, ProductVariant $productVariant)
    {

        foreach ($product->variants as $variant) {
            Storage::delete("public/products/images/$variant->image_name");
            $variant->delete();
        }

        $product->delete();
        $productVariant->delete();

        return redirect(route('admin.products.index'))->with('success', 'Product successfully deleted.');
    }
}
