@extends('guest/layouts/app', ['id' => $id])
@section('content')
    <div class="flex items-center justify-between mb-[12px]">
        <p class="text-[#3C3C3C] text-[29px] inline-flex pl-[33px]">{{ $restaurantName }}</p>
        <x-globe></x-globe>
    </div>
    <div class="flex justify-between">
        <div class="inline-flex w-[262px]">
            <x-search></x-search>
        </div>
        <div class="flex items-center grow ml-[18px]">
            <x-call-waiter></x-call-waiter>
        </div>
    </div>
    <div class="mt-[42px] grid gap-y-[19px]">
        @foreach ($categories as $category)
        <a href=" {{ route('guest.products', ['menu' => $id, 'category' => $category->id]) }}" class="relative rounded-lg bg-[#f3f3f3] h-[110px] flex justify-center items-center" style="box-shadow: 0px 2px 12px 0 rgba(32,32,32,0.18);">
            <div class=" absolute bottom-0 right-0">
                <img src="https://ik.imagekit.io/NEXTMenu/categories/{{ $category->type }}/bottomRight.png">
            </div>
            <div class=" absolute bottom-0 left-0">
                <img src="https://ik.imagekit.io/NEXTMenu/categories/{{ $category->type }}/bottomLeft.png">
            </div>
            <div class=" absolute top-0 right-0">
                <img src="https://ik.imagekit.io/NEXTMenu/categories/{{ $category->type }}/topRight.png">
            </div>
            <div class=" absolute top-0 left-0">
                <img src="https://ik.imagekit.io/NEXTMenu/categories/{{ $category->type }}/topLeft.png">
            </div>
                <p class="text-[41px] text-[#4e4e4e]">
                    {{ $category->name }}
                </p>
            </a>
        @endforeach
    </div>
@endsection
