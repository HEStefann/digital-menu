<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use ImageKit\ImageKit;

use function PHPUnit\Framework\isNull;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $showImages = true;
        $restaurants = Restaurant::where('user_id', auth()->user()->id)->get();
        return view('restaurants.index', ["restaurants" => $restaurants, "showImages" => $showImages]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $restaurants = Restaurant::where('user_id', auth()->user()->id)->get();
        return view('restaurants.create', ["restaurants" => $restaurants]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'logoName' => ['file', 'mimes:jpeg,png'],
            'name' => ['required', 'string', 'max:255']
        ]);

        $serializedData = [...array_filter($request->all(), fn ($value) => !is_null($value)), 'user_id' => auth()->user()->id];
        if ($request->has('logo')) {
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
            $serializedData['logo'] = $image->result->url;
        }
        $restaurant = Restaurant::create($serializedData);
        return redirect('restaurant/' . $restaurant->id . '/menus');
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        $restaurants = Restaurant::where('user_id', auth()->user()->id)->get();
        return view('restaurants.show', ["openRestaurant" => $restaurant, "restaurants" => $restaurants]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        return view('restaurants.edit', ["restaurant" => $restaurant]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'logoName' => ['file', 'mimes:jpeg,png'],
            'name' => ['required', 'string', 'max:255']
        ]);
        $serializedData = [...array_filter($request->all(), fn ($value) => !is_null($value)), 'user_id' => auth()->user()->id];
        if ($request->get('logo') != null) {
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

            $menus = Menu::where('restaurant_id', $restaurant->id)->get();
            foreach ($menus as $menu) {
                $qr = (new QrController)->generateQR($restaurant->logo, route('guest.index', ['id' => $menu->id]));
                $tmpFile = tempnam(sys_get_temp_dir(), 'qr_');
                file_put_contents($tmpFile, $qr);
                $qrImage = $imageKit->upload([
                    'file' => fopen($tmpFile, 'r'),
                    "fileName" => $menu->name . $menu->id . ".png",
                ]);

                $menu->qr = $qrImage->result->url;
                $menu->save();
                unlink($tmpFile);
            }

            // Delete the temporary file
            unlink($tempFilePath);
            $serializedData['logo'] = $image->result->url;
        }
        $restaurant->update($serializedData);
        return redirect('restaurant/' . $restaurant->id . '/menus');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return redirect('restaurant');
    }
}
