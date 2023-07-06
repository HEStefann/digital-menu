@extends('layouts.master')

@section('title', $menu->name)

@section('back', route('restaurant.show', ['restaurant' => $restaurant]))

@section('name', $menu->name)

@section('content')
    <h1>Choose categories:</h1>
    <form method="POST" action="{{ route('category.save', ['menu' => $menu]) }}">
        @csrf
        <div class="my-6">
            @foreach ($categories as $category)
                <label for="cat-{{ str_replace(' ', '', $category['name']) }}"
                    class=" flex justify-center items-center p-4 border-2 border-black rounded-md my-5 cursor-pointer">
                    <input type="checkbox" id="cat-{{ str_replace(' ', '', $category['name']) }}" name="categories[]"
                        value="{{ $category['id'] }}" {{ in_array($category, $selectedCategories) ? 'checked' : '' }} />
                    <h1>{{ $category['name'] }}</h1>
                </label>
            @endforeach
        </div>
        <button class=" w-full p-4 rounded-md bg-green-400 text-white">Next step</button>
    </form>



@endsection
