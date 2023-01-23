<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFilterRequest;
use App\Http\Requests\SubscriptionRequest;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Product;
use App\Models\Sku;
use App\Models\Subscription;
use Illuminate\Support\Facades\App;

class MainController extends Controller
{
    public function index(ProductFilterRequest $request)
    {
        $skusQuery = Sku::with(['product', 'product.category']);

        if($request->filled('price_from')) {
            $skusQuery->where('price', '>=', $request->price_from);
        }

        if($request->filled('price_to')) {
            $skusQuery->where('price', '<=', $request->price_to);
        }

        foreach (['hit', 'recommend', 'new'] as $fieldName) {
            if($request->has($fieldName)) {
                $skusQuery->whereHas('product', function($query) use ($fieldName) {
                    $query->$fieldName();
                });
            }
        }

        $skus = $skusQuery->paginate(6);

        return view('index', compact('skus'));
    }

    public function categories()
    {
        return view('categories');
    }

    public function sku(Category $category, Product $product, Sku $sku)
    {
        if($sku->product->slug != $product->slug) {
            abort(404, 'Product not found!');
        }

        if($sku->product->category->slug != $category->slug) {
            abort(404, 'Category not found!');
        }

        return view('sku', compact('sku'));
    }

    public function category(Category $category)
    {
        return view('category', compact('category'));
    }

    public function subscribe(SubscriptionRequest $request, Sku $sku)
    {
        Subscription::create([
            'email' => $request->email,
            'sku_id' => $sku->id,
        ]);

        return redirect()->back()->with('success', 'Спасибо, мы сообщим вам о поступлении товара!');
    }

    public function changeLocale($locale)
    {
        session(['locale' => $locale]);
        App::setLocale($locale);

        return redirect()->back()->with('success', __('main.language_was_changed'));
    }

    public function changeCurrency(Currency $currency)
    {
        session(['currency_slug' => $currency->slug]);

        return redirect()->back();
    }
}
