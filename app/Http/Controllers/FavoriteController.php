<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (session()->has('favorites')) {
            $products = Product::whereIn('id', session('favorites'))->get();
        } else {
            $products = [];
        }
        // $menuId = $products->first()->category()->menu;
        // dd($menuId);
        return view('guest.favorites', ['favorites' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($id)
    {
        $favorites = [];
        if (session()->has('favorites')) {
            $favorites = [...session('favorites')];
            if (in_array($id, $favorites)) {
                $key = array_search($id, $favorites);
                unset($favorites[$key]);
            } else {
                $favorites[] = $id;
            }
        } else {
            $favorites = [$id];
        }
        session(['favorites' => $favorites]);

        Session::save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
