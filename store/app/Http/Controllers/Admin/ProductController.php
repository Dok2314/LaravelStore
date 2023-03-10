<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10);

        return view('auth.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $properties = Property::get();

        return view('auth.products.form', compact('categories', 'properties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $path = null;

        if($request->has('image')) {
            $path = $request->file('image')->store('products');
        }

        $product = Product::create([
            'name'             => $request->name,
            'name_en'          => $request->name_en,
            'slug'             => $request->slug,
            'description'      => $request->description,
            'description_en'   => $request->description_en,
            'category_id'      => $request->category_id,
            'image'            => $path,
            'hit'              => $request->hit,
            'new'              => $request->new,
            'recommend'        => $request->recommend,
        ]);

        $product->properties()->sync($request->property_id);

        session()->flash('success', 'Товар успешно добавлен: ' . $product->name);
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  $productId
     * @return \Illuminate\Http\Response
     */
    public function show($productId)
    {
        $product = Product::withTrashed()->find($productId);

        return view('auth.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::get();
        $properties = Property::get();

        return view('auth.products.form', compact('product','categories','properties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProductRequest  $request
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $path = $product->image ?? null;

        if($request->has('image')) {
            if(isset($path)) {
                Storage::delete($product->image);
            }

            $path = $request->file('image')->store('products');
        }

        $product->properties()->sync($request->property_id);

        $product->update([
            'name'             => $request->name,
            'name_en'          => $request->name_en,
            'slug'             => $request->slug,
            'description'      => $request->description,
            'description_en'   => $request->description_en,
            'category_id'      => $request->category_id,
            'image'            => $path,
            'hit'              => $request->hit,
            'new'              => $request->new,
            'recommend'        => $request->recommend,
        ]);

        session()->flash('success', 'Товар успешно обновлен: ' . $product->name);
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        session()->flash('success', 'Товар успешно удалён: ' . $product->name);
        $product->delete();
        return redirect()->route('products.index');
    }
}
