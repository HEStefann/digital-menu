@extends('layouts.adminUser', ['navButtons' => false, 'backRoute' => route('menus.show', ['menu' => $menu]), 'continueActions' => ['route' => route('menus.index', ['restaurant' => $menu->restaurant_id]), 'formId' => 'noForm']])

@section('title', 'Products Creation')

@section('sideTitle', 'PRODUCTS FOR ' . strtoupper($category->name))

@section('selectedCategory')
    <div
        class="text-[35px] text-[#4E4E4E] bg-[#F3F3F3] h-24 flex items-center justify-center shadow-[0_2px_12px_0_rgb(32,32,32,18%)] rounded-xl mb-6 relative">
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

    <div class="flex overflow-x-auto gap-5 mt-1 mb-[46px] whitespace-nowrap p-2" id="categoriesCarasoul">
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
    <div x-data="deleteModal()">
        <form action="{{ route('product.update', ['product' => $openedProduct]) }}" method="post">
            @csrf
            <div class="grid grid-cols-8 gap-12 px-14">
                <div class="col-span-4 space-y-6">
                    {{-- Ako e podobro ova togas ova neka ostane --}}
                    <h1 class="text-[24px] text-[#707070]">EDIT {{ strtoupper($openedProduct->name) }}</h1>
                    {{-- <h1 class="text-[24px] text-[#707070]">ADD PRODUCT FOR {{ strtoupper($category->name) }}</h1> --}}
                    <p class="text-[#909090] text-[14px] w-4/5 mx-auto text-center">
                        It would be best for the design if the product
                        photo taken from above and is in the shape of a circle
                    </p>
                    <div class="flex justify-center items-center" x-data="imageModal()">
                        <label for="inputImage" id="labelInputImage"
                            class="z-10 w-[172px] h-[38px] opacity-[0.71] overflow-hidden rounded-xl text-center text-[#4e4e4e] bg-[#FFFFFF] shadow-[0_2px_12px_0_rgba(32,32,32,18%)] text-[25px] absolute uppercase">{{ $openedProduct->image ? 'CHANGE' : 'ADD IMAGE' }}</label>
                        <div class="w-[198px] h-[198px]">
                            <label for="inputImage">
                                <img id="selectedImg" class="w-[100%] h-[100%] opacity-[.25]"
                                    src={{ $openedProduct->image ?? "https://ik.imagekit.io/NEXTMenu/noImage.png" }}>
                            </label>
                        </div>
                        <input x-on:change="open()" type="file" id="inputImage" name="logoName" accept="image/*"
                            style="display:none" />
                        <input type="hidden" id="hiddenLogoInput" name="logo" value="">
                        <div x-show="show" x-transition x-cloak
                            class="fixed h-screen w-screen z-[1000] bg-slate-400/50 top-0 left-0 grid content-center">
                            <div class="mx-auto">
                                <div class="relative w-full max-w-md max-h-full p-4 ">
                                    <div class="relative bg-white rounded-lg shadow p-4 dark:bg-gray-700">
                                        <button type="button"
                                            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                                            x-on:click="close()">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-6 text-center">
                                            <div id="preview" class="flex justify-center flex-col items-center relative">
                                                <div class="w-[198px] h-[198px]">
                                                    <img id="img" class="w-[100%] h-[100%] opacity-[.25]"
                                                        src="https://ik.imagekit.io/NEXTMenu/noImage.png">
                                                </div>
                                            </div>
                                            <button x-on:click="close()" type="button"
                                                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                                                cancel</button>
                                            <button x-on:click="close()" type="button" id="cropButton"
                                                class="w-[172px] h-[38px] relative opacity-[0.71] overflow-hidden rounded-xl text-center text-[#4e4e4e] bg-[#F5F5F5] shadow-[0_2px_12px_0_rgba(32,32,32,18%)] place-self-center mt-[24px]">Save
                                                Image</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <x-input-field icon="fa-solid fa-utensils" name="name" id="name" type="text"
                            placeholder="Name" value="{{ $openedProduct->name }}" />
                        @error('name')
                            <div class="text-red-500 mt-1 mb-0 ml-9 text-start text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <x-input-field icon="fa-solid fa-euro-sign" name="price" id="price" type="text"
                            inputmode="number" placeholder="Price" value="{{ $openedProduct->price }}" />
                        @error('price')
                            <div class="text-red-500 mt-1 mb-0 ml-9 text-start text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-span-4 space-y-6">
                    <div>
                        <x-input-field icon="fa-regular fa-clock" name="preparation_time" id="prep_time" type="text"
                            inputmode="number" placeholder="Cooking Time (minutes)"
                            value="{{ $openedProduct->preparation_time }}" />
                        @error('preparation_time')
                            <div class="text-red-500 mt-1 mb-0 ml-9 text-start text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="w-[48%]">
                            <x-input-field name="weight" id="grams" type="text" placeholder="Grams"
                                inputmode="numeric" value="{{ $openedProduct->weight }}" />
                            @error('weight')
                                <div class="text-red-500 mt-1 mb-0 ml-9 text-start text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="w-[48%]">
                            <x-input-field name="callories" id="cal" type="text" placeholder="Callories"
                                inputmode="numeric" value="{{ $openedProduct->callories }}" />
                            @error('callories')
                                <div class="text-red-500 mt-1 mb-0 ml-9 text-start text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <textarea
                            class="px-5 w-full text-[#909090] rounded-xl shadow-[0_2px_12px_0_rgb(32,32,32,18%)] border-0 bg-[#F5F5F5] resize-none focus:outline-none focus:ring-0"
                            name="ingredients" id="ingredients" rows="5" placeholder="Ingredients">{{ $openedProduct->ingredients }}</textarea>
                        @error('ingredients')
                            <div class="text-red-500 mt-1 mb-0 ml-9 text-start text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div
                        class="px-5 py-2 w-full text-start text-[#909090] h-[151px] rounded-xl shadow-[0_2px_12px_0_rgb(32,32,32,18%)] bg-[#F5F5F5]">
                        <h1>Allergens</h1>
                        <div class="grid grid-cols-4">
                            @foreach ($allergens as $allergen)
                                <div class="flex items-center gap-2">
                                    <input class="border-0 shadow-[0_2px_12px_0_rgb(32,32,32,18%)] rounded-md focus:ring-0"
                                        type="checkbox"
                                        {{ in_array($allergen->id, array_map(fn($allergen) => $allergen->id, [...$openedProduct->allergens])) ? 'checked' : '' }}
                                        id="{{ $allergen->id }}" name="allergens[]" value="{{ $allergen->id }}">
                                    <label for="{{ $allergen->id }}">{{ $allergen->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="button"
                            x-on:click="open('product', '{{ route('product.destroy', ['menu' => $menu, 'category' => $category->id, 'product' => $openedProduct]) }}')"
                            class="bg-white px-5 py-2 flex items-center justify-center  text-[#707070] rounded-xl shadow-[0_2px_12px_0_rgb(32,32,32,18%)] hover:bg-[#F5F5F5] cursor-pointer">DELETE</button>
                        <button type="submit"
                            class="bg-white px-5 py-2 flex items-center justify-center text-[#707070] rounded-xl shadow-[0_2px_12px_0_rgb(32,32,32,18%)] hover:bg-[#F5F5F5] cursor-pointer">SAVE</button>
                    </div>
                </div>
            </div>

        </form>
        <div x-show="show" x-transition x-cloak
            class="fixed h-screen w-screen z-[1000] bg-slate-400/50 top-0 left-0 grid content-center">
            <div class="mx-auto">
                <div class="relative w-full max-w-md max-h-full p-4 ">
                    <div class="relative bg-white rounded-lg shadow p-4 dark:bg-gray-700">
                        <button type="button"
                            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                            x-on:click="close()">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <form :action="route" method="GET" class="p-6 text-center" id="delete-form">
                            <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want
                                to
                                delete
                                this <span x-text="type"></span>?</h3>
                            <button x-on:click="close()" form="delete-form"
                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                Yes, I'm sure
                            </button>
                            <button x-on:click="close()" type="button"
                                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                                cancel</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection


@if (session()->has('success'))
    <div x-data="{ showError: true, timer: null }" x-init="timer = setTimeout(() => showError = false, 3000)" x-show="showError"
        class="absolute bottom-8 left-1/2 -translate-x-1/2 mx-auto bg-green-300 text-xl text-white rounded-xl z-40 px-6 py-2 my-6 flex items-center gap-2">
        <h1>{{ session('success') }}</h1>
        <i class="fa-solid fa-circle-xmark cursor-pointer" @click="clearTimeout(timer); showError = false;"></i>
    </div>
@endif
