@extends('layouts.adminUser', ['navButtons' => false, 'backRoute' => route('menus.show', ['menu' => $menu]), 'continueActions' => ['route' => route('menus.index', ['restaurant' => $menu->restaurant_id]), 'formId' => 'noForm']])

@section('title', 'Products Creation')

@section('sideTitle', 'PRODUCTS FOR ' . strtoupper($category->name))

@section('selectedCategory')
    <div x-data
        class="text-[35px] text-[#4E4E4E] bg-[#F3F3F3] overflow-hidden h-24 flex items-center justify-center shadow-[0_2px_12px_0_rgb(32,32,32,18%)] rounded-xl mb-6 relative"
        x-bind:style="">
        <div class=" absolute bottom-0 right-0 origin-bottom-right scale-[.8]">
            <img src="https://ik.imagekit.io/NEXTMenu/categories/{{ $category->type }}/bottomRight.png">
        </div>
        <div class=" absolute bottom-0 left-0 origin-bottom-left scale-[.8]">
            <img src="https://ik.imagekit.io/NEXTMenu/categories/{{ $category->type }}/bottomLeft.png">
        </div>
        <div class=" absolute top-0 right-0 origin-top-right scale-[.8]">
            <img src="https://ik.imagekit.io/NEXTMenu/categories/{{ $category->type }}/topRight.png">
        </div>
        <div class=" absolute top-0 left-0 origin-top-left scale-[.8]">
            <img src="https://ik.imagekit.io/NEXTMenu/categories/{{ $category->type }}/topLeft.png">
        </div>
        <p class="z-10">
            {{ $category->name }}
        </p>
    </div>
@endsection

@section('categoriesCarasoul')

    <div class="flex overflow-x-auto gap-5 mt-1 mb-[46px] whitespace-nowrap p-2 categoriesCarasoul">
        @foreach ($categories as $cat)
            @php
                if ($cat->id == $category->id) {
                    continue;
                }
            @endphp
            <div onclick="window.location.href='{{ route('product.index', ['menu' => $menu, 'category' => $cat->id]) }}'"
                class="bg-white px-5 py-3 flex items-center justify-center text-2xl text-[#707070] rounded-xl shadow-[0_2px_12px_0_rgb(32,32,32,18%)] hover:bg-[#F5F5F5] cursor-pointer">
                {{ $cat->name }}
            </div>
        @endforeach

    </div>

@endsection

@section('sideContent')

    <div class="space-y-4">
        @forelse ($categoryProducts as $product)
            <div>
                <div
                    class="py-[10px] px-[17px] bg-[#F5F5F5] shadow-[0_2px_12px_0_rgb(32,32,32,18%)] rounded-xl cursor-pointer flex justify-between items-center">
                    <h2 class="text-[21px] text-[#4E4E4E]">
                        {{ $product->name }}
                    </h2>
                    <div>
                        <a href="{{ route('product.edit', ['menu' => $menu, 'category' => $category->id, 'product' => $product->id]) }}"
                            class="bg-white shadow-[0_2px_12px_0_rgb(32,32,32,18%)] py-1 px-4 rounded-xl text-[#909090]">Edit</a>
                    </div>
                </div>
            </div>

        @empty
            <div class="text-center text-base text-[#909090]">
                No products created yet...
            </div>
        @endforelse
        <div onclick="window.location.href='{{ route('product.create', ['menu' => $menu, 'category' => $category->id]) }}'"
            class="py-[10px] px-[17px] bg-white shadow-[0_2px_12px_0_rgb(32,32,32,18%)] rounded-xl cursor-pointer flex items-center justify-center hover:bg-[#F5F5F5]">
            <h2 class="text-[21px] text-[#4E4E4E]">
                ADD PRODUCT +
            </h2>
        </div>
    </div>

@endsection


@section('mainContent')
    <div class="text-center text-base text-[#909090]">
        Please select a product from the side menu
    </div>
@endsection


@if (session()->has('removed'))
    <div x-data="{ showError: true, timer: null }" x-init="timer = setTimeout(() => showError = false, 3000)" x-show="showError"
        class="absolute bottom-8 left-1/2 -translate-x-1/2 mx-auto bg-red-400 text-xl text-white rounded-xl z-40 px-6 py-2 my-6 flex items-center gap-2">
        <h1>{{ session('removed') }}</h1>
        <i class="fa-solid fa-circle-xmark cursor-pointer" @click="clearTimeout(timer); showError = false;"></i>
    </div>
@endif
