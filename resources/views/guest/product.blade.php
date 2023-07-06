@extends('guest/layouts/app')
@section('content')
    <div class="flex justify-between h-[37px] space-x-[13px]">
        <div class="h-[37px] w-[51px]">
            <x-back></x-back>
        </div>
        <div class="flex items-center h-[37px]">
            <x-call-waiter></x-call-waiter>
        </div>
    </div>
    <div class="overflow-y-auto h-[calc(100vh-140px)]">

        <div class="w-full h-[400px]">
            <div class="scale-[.9] origin-center">
                <img class="mx-auto" src="{{ $product->image }}" alt="">
            </div>
        </div>
        <div>
            <div>
                <div class=" mb-[16px]">
                    <h1 class="text-[37px] text-left text-[#4e4e4e]">{{ $product->name }}</h1>
                </div>
            </div>
            <div class=" flex">
                <div class=" h-[32px] rounded-xl px-2 bg-white flex items-center justify-center mr-[10px]"
                    style="box-shadow: 0px 2px 12px 0 rgba(32,32,32,0.18);">
                    <p class="text-sm text-[#c39898] p-[5px]">{{ $product->preparation_time }} min</p>
                </div>
                <div class=" h-[32px] rounded-xl px-2 bg-white flex items-center justify-center mr-[10px]"
                    style="box-shadow: 0px 2px 12px 0 rgba(32,32,32,0.18);">
                    <p class="text-sm text-[#707070] p-[5px]">{{ $product->weight }} gr</p>
                </div>
                <div class=" h-[32px] rounded-xl px-2 bg-white flex items-center justify-center mr-[10px]"
                    style="box-shadow: 0px 2px 12px 0 rgba(32,32,32,0.18);">
                    <p class="text-sm text-[#707070] p-[5px]">{{ $product->callories }} cal</p>
                </div>
            </div>

            <div class="mt-[22px] mb-[12px]">
                <p class=" text-[22px] text-left text-[#4e4e4e]">Ingredients</p>
            </div>
            <div class="mb-[12px]">
                <p class=" text-[21px] text-left text-[#707070]">
                    @if ($product->ingredients == null)
                        No ingredients found.
                    @else
                        {{ $product->ingredients }}
                    @endif
                </p>
            </div>
            <div class="mb-[15px]">
                <p class=" text-[22px] text-left text-[#4e4e4e]">Allergens</p>
            </div>

            <div class="flex justify-between">

                <div>
                    <p class=" text-[19px] text-left text-[#707070]">
                        @forelse($product->allergens as $allergen)
                            {{ $allergen->name . ', ' }}
                        @empty
                            No allergens found.
                        @endforelse
                    </p>
                </div>

                <div class=" flex justify-between">
                    <div class="w-[43px] h-[43px] overflow-hidden rounded-xl bg-white flex justify-center items-center"
                        style="box-shadow: 0px 2px 12px 0 rgba(32,32,32,0.18);">
                        <svg class="w-[30px] h-[30px] stroke-[#AAAAAA] stroke-[20px] fill-transparent {{ route('guest.addFavorite', ['id' => $product->id]) }}"
                            xmlns="http://www.w3.org/2000/svg" viewBox="140.889 149.089 221.949 199.586">
                            <path
                                d="M 251.868 337.478 C 249.208 337.487 246.659 336.404 244.768 334.455 L 167.079 253.364 C 146.792 231.996 146.792 197.59 167.079 176.233 C 187.526 154.97 220.622 154.97 241.069 176.233 L 251.868 187.49 L 262.665 176.233 C 283.113 154.97 316.209 154.97 336.656 176.233 C 356.933 197.59 356.933 231.996 336.656 253.364 L 258.966 334.455 C 257.075 336.404 254.528 337.487 251.868 337.478 Z" />
                        </svg>
                    </div>
                    <div class="h-[43px] ml-[8px] rounded-xl bg-white flex items-center justify-center"
                        style="box-shadow: 0px 2px 12px 0 rgba(32,32,32,0.18);">
                        <p class=" text-[22px] px-2 text-center text-[#4e4e4e] ">{{ $product->price }}€</p>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
