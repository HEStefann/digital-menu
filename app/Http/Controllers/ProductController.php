<?php

namespace App\Http\Controllers;

use App\Models\Allergen;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;
use ImageKit\ImageKit;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Menu $menu, Category $category)
    {
        $categories = $menu->categories()->get();
        $categoryProducts = $category->products()->where('menu_id', $menu->id)->get();
        return view('products.index', ['menu' => $menu, 'categories' => $categories, 'category' => $category, 'categoryProducts' => $categoryProducts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Menu $menu, Category $category)
    {
        $allergens = Allergen::all();
        $categories = $menu->categories()->get();
        $categoryProducts = $category->products()->where('menu_id', $menu->id)->get();
        return view('products.create', ['menu' => $menu, 'categories' => $categories, 'category' => $category, 'categoryProducts' => $categoryProducts, 'allergens' => $allergens]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'logoName' => ['required', 'file', 'mimes:jpeg,png'],
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'preparation_time' => ['nullable', 'numeric'],
            'weight' => ['nullable', 'numeric'],
            'callories' => ['nullable', 'numeric'],
            'ingredients' => ['nullable', 'string'],
        ]);

        $serializedData = [...array_filter($request->except('allergens', 'menu', 'category'), fn ($value) => !is_null($value))];
        $serializedData['menu_id'] = $request->menu;
        $serializedData['category_id'] = $request->category;

        $imageKit = new ImageKit(
            "public_BmM2TKgdN3VDc0ZhDfMsBo9ogLM=",
            "private_d9lzLL/t1D38wlhvhGfDBHUXn0k=",
            "https://ik.imagekit.io/NEXTMenu"
        );
        $dataURL = $request->input('logo');
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $dataURL));
        function generateUniqueId()
        {
            return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10 / strlen($x)))), 1, 10);
        }
        $uniqueId = generateUniqueId();
        $tempFilePath = sys_get_temp_dir() . '/' . $uniqueId . '.png';

        // Save the image to the temporary storage
        file_put_contents($tempFilePath, $imageData);

        // Upload the image to ImageKit
        $image = $imageKit->upload([
            'file' => fopen($tempFilePath, 'r'),
            'fileName' => $uniqueId . '.png',
        ]);
        // Delete the temporary file
        unlink($tempFilePath);
        $serializedData['image'] = $image->result->url;
        $product = Product::create($serializedData);

        if ($request->has('allergens')) {
            $product->allergens()->attach($request->allergens);
        }

        session()->flash('success', 'Product created successfully');

        return redirect('restaurant/' . $product->menu_id . '/' . $product->category_id . '/product/' . $product->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product = $product->with('allergens')->find($product)->first();
        return view('guest/product', ["product" => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu, Category $category, Product $product)
    {
        $allergens = Allergen::all();
        $categories = $menu->categories()->get();
        $categoryProducts = $category->products()->where('menu_id', $menu->id)->get();
        return view('products.edit', ['menu' => $menu, 'categories' => $categories, 'category' => $category, 'categoryProducts' => $categoryProducts, 'allergens' => $allergens, 'openedProduct' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'image' => ['required', 'file', 'mimes:jpeg,png'],
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'preparation_time' => ['nullable', 'numeric'],
            'weight' => ['nullable', 'numeric'],
            'callories' => ['nullable', 'numeric'],
            'ingredients' => ['nullable', 'string'],
        ]);
        $serializedData = [...array_filter($request->except('allergens', 'menu', 'category'), fn ($value) => !is_null($value))];
        $serializedData['menu_id'] = $product->menu_id;
        $serializedData['category_id'] = $product->category_id;

        $imageKit = new ImageKit(
            "public_BmM2TKgdN3VDc0ZhDfMsBo9ogLM=",
            "private_d9lzLL/t1D38wlhvhGfDBHUXn0k=",
            "https://ik.imagekit.io/NEXTMenu"
        );
        $dataURL = $request->input('logo');
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $dataURL));
        function generateUniqueId()
        {
            return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10 / strlen($x)))), 1, 10);
        }
        $uniqueId = generateUniqueId();
        $tempFilePath = sys_get_temp_dir() . '/' . $uniqueId . '.png';

        // Save the image to the temporary storage
        file_put_contents($tempFilePath, $imageData);

        // Upload the image to ImageKit
        $image = $imageKit->upload([
            'file' => fopen($tempFilePath, 'r'),
            'fileName' => $uniqueId . '.png',
        ]);

        // Delete the temporary file
        unlink($tempFilePath);
        $serializedData['image'] = $image->result->url;
        $product->update($serializedData);

        $product->allergens()->sync($request->allergens);

        session()->flash('success', 'Product updated successfully');

        return redirect('restaurant/' . $product->menu_id . '/' . $product->category_id . '/product/' . $product->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu, Category $category, Product $product)
    {
        $categories = $menu->categories()->get();
        $categoryProducts = $category->products()->where('menu_id', $menu->id)->get();
        $product->delete();

        session()->flash('removed', 'Product removed');

        return redirect()->route('product.index', ['menu' => $menu, 'categories' => $categories, 'category' => $category, 'categoryProducts' => $categoryProducts]);
    }
}
