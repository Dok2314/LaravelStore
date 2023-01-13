<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFilterRequest;
use App\Http\Requests\SubscriptionRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subscription;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
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
        return view('product', compact('category', 'product'));
    }

    public function category(Category $category)
    {
        return view('category', compact('category'));
    }

    public function subscribe(SubscriptionRequest $request, Product $product)
    {
        Subscription::create([
            'email' => $request->email,
            'product_id' => $product->id,
        ]);

        return redirect()->back()->with('success', 'Спасибо, мы сообщим вам о поступлении товара!');
    }
}
