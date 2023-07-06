<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use ImageKit\ImageKit;

use function PHPUnit\Framework\isNull;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Restaurant $restaurant)
    {
        $restaurants = Restaurant::where('user_id', auth()->user()->id)->get();
        $menus = Menu::where('restaurant_id', $restaurant->id)->get();
        return view('menus.index', ["menus" => $menus, "restaurant" => $restaurant, "restaurants" => $restaurants]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Restaurant $restaurant)
    {
        $restaurants = Restaurant::where('user_id', auth()->user()->id)->get();
        $menus = Menu::where('restaurant_id', $restaurant->id)->get();
        return view('menus.create', ["restaurant" => $restaurant, "restaurants" => $restaurants, "menus" => $menus]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $restaurant = Restaurant::find($request->restaurant_id);
        $menu = Menu::create($request->all());
        if ($restaurant->logo != null) {
            $qr = (new QrController)->generateQR($restaurant->logo, route('guest.index', ['id' => $menu->id]));
        } else {
            $qr = (new QrController)->generateQR('', route('guest.index', ['id' => $menu->id]));
        }

        $tmpFile = tempnam(sys_get_temp_dir(), 'qr_');
        file_put_contents($tmpFile, $qr);

        $imageKit = new ImageKit(
            "public_BmM2TKgdN3VDc0ZhDfMsBo9ogLM=",
            "private_d9lzLL/t1D38wlhvhGfDBHUXn0k=",
            "https://ik.imagekit.io/NEXTMenu"
        );
        $image = $imageKit->upload([
            'file' => fopen($tmpFile, 'r'),
            "fileName" => $menu->name . $menu->id . ".png",
        ]);

        $menu->qr = $image->result->url;
        $menu->save();

        unlink($tmpFile);

        return redirect('restaurant/menu/' . $menu->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        $restaurant = Restaurant::find($menu->restaurant_id);
        $selectedCategories = $menu->categories()->get()->toArray();
        $categories = Category::where('user_id', auth()->user()->id)->orWhere('user_id', null)->get()->toArray();
        $categories = array_merge($selectedCategories, $categories);

        $filtered = [];
        $uniqueNames = [];

        foreach ($categories as $item) {
            $name = $item['name'];
            if (!in_array($name, $uniqueNames)) {
                $uniqueNames[] = $name;
                $filtered[] = $item;
            }
        }

        return view('menus.categories', ["menu" => $menu, 'restaurant' => $restaurant, 'categories' => $filtered, 'selectedCategories' => $selectedCategories]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect('restaurant/' . $menu->restaurant_id . '/menus');
    }
}
