@extends('layouts.adminUser', ['navButtons' => false, 'backRoute' => route('menus.index', ['restaurant' => $menu->restaurant_id]), 'continueActions' => ['route' => route('category.save', ['menu' => $menu]), 'formId' => 'categoriesForm']])

@section('title', 'Categories Creation')

@section('sideTitle', 'MY CATEGORIES')

@section('sideContent')

    <div class="space-y-4">
        @forelse ($selectedCategories as $category)
            <div
                class=" flex justify-center items-center p-4 rounded-lg text-[#4E4E4E] shadow-[0_2px_12px_0_rgb(32,32,32,18%)] text-4xl bg-[#F3F3F3] relative h-[67px]">
                    <div class=" absolute bottom-0 right-0 origin-bottom-right scale-[0.6]">
                        <img src="https://ik.imagekit.io/NEXTMenu/categories/{{ $category['type'] }}/bottomRight.png">
                    </div>
                    <div class=" absolute bottom-0 left-0 origin-bottom-left scale-[0.6]">
                        <img src="https://ik.imagekit.io/NEXTMenu/categories/{{ $category['type'] }}/bottomLeft.png">
                    </div>
                    <div class=" absolute top-0 right-0 origin-top-right scale-[0.6]">
                        <img src="https://ik.imagekit.io/NEXTMenu/categories/{{ $category['type'] }}/topRight.png">
                    </div>
                    <div class=" absolute top-0 left-0 origin-top-left scale-[0.6]">
                        <img src="https://ik.imagekit.io/NEXTMenu/categories/{{ $category['type'] }}/topLeft.png">
                    </div>
                    <p class="z-10">
                        {{ $category["name"] }}
                    </p>
            </div>

        @empty
            <div class="text-center text-base text-[#909090]">
                No categories selected
            </div>
        @endforelse
    </div>

@endsection


@section('mainContent')
    <h1 class="mx-auto mb-5 text-base text-[#909090]">CHOOSE CATEGORIES</h1>
    <div class="overflow-y-auto">
        <form method="POST" action="{{ route('category.save', ['menu' => $menu]) }}" id="categoriesForm"
            x-data="categoryManipulation()" x-init="checkedCategories = {{ json_encode(array_map(fn($cat) => strval($cat['id']), $selectedCategories)) }}">
            @csrf
            <div class="my-6 grid grid-cols-2 gap-x-12 gap-y-9 px-12">
                @foreach ($categories as $category)
                    <label for="cat-{{ str_replace(' ', '', $category['name']) }}"
                        :class="isChecked({{ json_encode($category['id']) }}) ? 'opacity-100' : 'opacity-50'"
                        class=" flex justify-center items-center p-4 rounded-lg text-[#4E4E4E] shadow-[0_2px_12px_0_rgb(32,32,32,18%)] text-4xl h-[85px] bg-[#F3F3F3] relative cursor-pointer">
                        <input x-on:click="console.log(checkedCategories)" x-model="checkedCategories" type="checkbox"
                            id="cat-{{ str_replace(' ', '', $category['name']) }}" name="categories[]" class="invisible"
                            value="{{ $category['id'] }}" {{ in_array($category, $selectedCategories) ? 'checked' : '' }} />
                            <div class=" absolute bottom-0 right-0 origin-bottom-right scale-75">
                                <img src="https://ik.imagekit.io/NEXTMenu/categories/{{ $category['type'] }}/bottomRight.png">
                            </div>
                            <div class=" absolute bottom-0 left-0 origin-bottom-left scale-75">
                                <img src="https://ik.imagekit.io/NEXTMenu/categories/{{ $category['type'] }}/bottomLeft.png">
                            </div>
                            <div class=" absolute top-0 right-0 origin-top-right scale-75">
                                <img src="https://ik.imagekit.io/NEXTMenu/categories/{{ $category['type'] }}/topRight.png">
                            </div>
                            <div class=" absolute top-0 left-0 origin-top-left scale-75">
                                <img src="https://ik.imagekit.io/NEXTMenu/categories/{{ $category['type'] }}/topLeft.png">
                            </div>
                        <h1 class="z-10">{{ $category['name'] }}</h1>
                    </label>
                @endforeach
            </div>
        </form>

    </div>

@endsection

@error('categories')
    <div x-data="{ showError: true, timer: null }" x-init="timer = setTimeout(() => showError = false, 3000)" x-show="showError"
        class="absolute bottom-10 left-1/2 -translate-x-1/2 mx-auto bg-red-400 text-xl text-white rounded-xl z-40 px-6 py-2 my-6 flex items-center gap-2">
        <h1>{{ $message }}</h1>
        <i class="fa-solid fa-circle-xmark cursor-pointer" @click="clearTimeout(timer); showError = false;"></i>
    </div>
@enderror
