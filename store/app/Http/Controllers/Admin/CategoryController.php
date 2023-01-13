<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(10);

        return view('auth.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.categories.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $path = null;

        if($request->has('image')) {
            $path = $request->file('image')->store('categories');
        }

        $category = Category::create([
            'name'           => $request->name,
            'name_en'        => $request->name_en,
            'slug'           => $request->slug,
            'description_en' => $request->description_en,
            'image'          => $path,
        ]);

        session()->flash('success', 'Категория успешно добавлена: ' . $category->name);
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('auth.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('auth.categories.form', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $path = $category->image ?? null;

        if($request->has('image')) {
            if(isset($path)) {
                Storage::delete($category->image);
            }

            $path = $request->file('image')->store('categories');
        }

        $category->update([
            'name'           => $request->name,
            'name_en'        => $request->name_en,
            'slug'           => $request->slug,
            'description_en' => $request->description_en,
            'image'          => $path,
        ]);

        session()->flash('success', 'Категория успешно обновлена: ' . $category->name);
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        session()->flash('success', 'Категория успешно удалена: ' . $category->name);

        $category->delete();

        return redirect()->route('categories.index');
    }
}
