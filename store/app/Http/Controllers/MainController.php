<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFilterRequest;
use App\Models\Category;
use App\Models\Product;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Log;

class MainController extends Controller
{
    public function index(ProductFilterRequest $request)
    {
        $productsQuery = Product::with('category');

        if($request->filled('price_from')) {
            $productsQuery->where('price', '>=', $request->price_from);
        }

        if($request->filled('price_to')) {
            $productsQuery->where('price', '<=', $request->price_to);
        }

        foreach (['hit', 'recommend', 'new'] as $fieldName) {
            if($request->has($fieldName)) {
                $productsQuery->$fieldName();
            }
        }

        $products = $productsQuery->paginate(6);

        return view('index', compact('products'));
    }

    public function categories()
    {
        $categories = Category::get();

        return view('categories', compact('categories'));
    }

    public function product(Category $category, Product $product)
    {
        dd('test');

        return view('product', compact('category', 'product'));
    }

    public function category(Category $category)
    {
        return view('category', compact('category'));
    }
}
