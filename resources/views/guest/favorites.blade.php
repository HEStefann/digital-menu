@extends('guest/layouts/app')
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
    <div class="rounded-xl bg-white my-[32px] inline-flex px-[21px] py-[11px]"
        style="box-shadow: 0px 2px 12px 0 rgba(32,32,32,0.18);">
        <p class="text-[25px] text-center text-[#909090]">Favourites</p>
    </div>
    @forelse ($favorites as $product)
        <x-product-card :product="$product"></x-product-card>
    @empty
        <p class="text-[18px] text-center text-[#909090]">No favourites yet</p>
    @endforelse
@endsection
