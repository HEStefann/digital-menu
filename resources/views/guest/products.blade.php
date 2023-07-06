@extends('guest/layouts/app', ['id' => $menu->id])
@section('content')
    <div class="flex justify-between h-[37px] space-x-[13px]">
        <div class="h-[37px] w-[51px]">
            <x-back></x-back>
        </div>
        <div class="inline-flex grow w-[262px] h-[37px]">
            <x-search></x-search>
        </div>
        <div class="flex items-center h-[37px]">
            <x-call-waiter></x-call-waiter>
        </div>
    </div>
    <div class="py-[29px] px-[20px] -mx-[20px] space-x-[12px] overflow-x-auto flex categoriesCarasoul">
        @foreach ($categories as $category)
            <a href="{{ route('guest.products', ['menu' => $menu, 'category' => $category]) }}"
                class="px-[15px] py-[11px] rounded-xl inline-flex bg-[#efefef] h-fit"
                style="box-shadow: 0px 2px 12px 0 rgba(32,32,32,0.18);">
                <p class="text-[18px]">{{ $category->name }}</p>
            </a>
        @endforeach
    </div>
    <div class="space-y-[28px] h-[calc(100vh-200px)] overflow-y-auto -mr-5">
        <div class="mr-5">
            @foreach ($products as $product)
                <x-product-card :product="$product"></x-product-card>
            @endforeach
        </div>
    </div>
@endsection
