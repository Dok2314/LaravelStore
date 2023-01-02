<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function categories()
    {
        $categories = Category::all();

        return view('categories', compact('categories'));
    }

    public function product($product)
    {
        return view('product', compact('product'));
    }

    public function category(Category $category)
    {
        return view('category', compact('category'));
    }

    public function basket()
    {
        return view('basket');
    }

    public function basketPlace()
    {
        return view('order');
    }
}
