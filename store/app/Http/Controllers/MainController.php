<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $products = Product::get();

        return view('index', compact('products'));
    }

    public function categories()
    {
        $categories = Category::get();

        return view('categories', compact('categories'));
    }

    public function product(Category $category, Product $product)
    {
        return view('product', compact('category', 'product'));
    }

    public function category(Category $category)
    {
        return view('category', compact('category'));
    }
}
