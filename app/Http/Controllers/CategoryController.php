<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('category.index', ["category" => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //store category
        $category = Category::create($request->all());
        return redirect('category');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //show category
        return view('category.show', ["category" => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //edit category
        return view('category.edit', ["category" => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category->update($request->all());
        return redirect('category');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect('category');
    }

    public function save(Request $request, Menu $menu)
    {
        $request->validate(
            [
                'categories' => ['required', 'array', 'min:2']
            ],
            [
                'categories.required' => 'Please select at least two categories',
                'categories.min' => 'Please select at least two categories'
            ]
        );
        $menu->categories()->sync($request->get('categories'));
        $categoryProducts = $menu->categories[0]->products()->where('menu_id', $menu->id)->get();

        return redirect()->route('product.index', ['menu' => $menu, 'categories' => $menu->categories(), 'category' => $menu->categories[0]->id, 'categoryProducts' => $categoryProducts]);
    }
}
