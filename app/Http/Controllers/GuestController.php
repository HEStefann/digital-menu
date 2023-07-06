<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $menu = Menu::with('categories')->find($id);
        return view('guest.index', ['restaurantName' => $menu->restaurant->name, 'categories' => $menu->categories, "id" => $id]);
    }

    public function products(Menu $menu, Category $category)
    {
        $categoryProducts = $category->products()->where('menu_id', $menu->id)->get();
        $menuCategories = $menu->categories()->get();
        return view('guest.products', ['products' => $categoryProducts, 'categories' => $menuCategories, 'menu' => $menu]);
    }

    public function about(Menu $menu)
    {
        $restaurant = Restaurant::find($menu->restaurant_id);
        $socials = [];
        if ($restaurant->facebook != '') {
            $socials['facebook'] = $restaurant->facebook;
        }
        if ($restaurant->instagram != '') {
            $socials['instagram'] = $restaurant->instagram;
        }
        if ($restaurant->website != '') {
            $socials['website'] = $restaurant->website;
        }

        return view('/guest/about', compact('restaurant', 'socials'));
    }
}
