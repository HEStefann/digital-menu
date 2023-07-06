<div onclick="window.location.href='{{ route('product.show', [($product = $attributes['product'])]) }}'"
    class="bg-white rounded-lg overflow-hidden mb-[20px] text-[27px] w-full py-[10px] pl-[12px] grid grid-cols-[minmax(auto,60%)_min-content_30%] h-[111px] cursor-pointer"
    style="box-shadow: 0px 2px 12px 0 rgba(32,32,32,0.18);">
    <div class="overflow-hidden">
        <h2 class="text-[27px] text-[#4E4E4E] leading-none">{{ $attributes['product']['name'] }}</h2>
        <p class="text-[11px] text-[#707070] text-ellipsis overflow-hidden line-clamp-3 hover:line-clamp-none">
            {{ $attributes['product']['ingredients'] }}</p>
    </div>
    <div class="inline-flex items-end gap-x-[4px]">
        <p class=" inline-flex px-[8px] py-[2px] rounded-xl text-[#707070] text-[13px] text-center h-fit"
            style="box-shadow: 0px 2px 12px 0 rgba(32,32,32,0.18);">MORE</p>
        <a href="{{ route('guest.addFavorite', ['id' => $attributes['product']['id']]) }}"
            class="inline-flex w-[24px] h-[24px] rounded-xl p-[4px]"
            style="box-shadow: 0px 2px 12px 0 rgba(32,32,32,0.18);">

            @php
                if (session()->has('favorites')) {
                    $favorites = [...session('favorites')];
                    $inFavorites = in_array($attributes['product']['id'], $favorites);
                } else {
                    $inFavorites = false;
                }
            @endphp
            <svg class="stroke-[#AAAAAA] stroke-[20px] {{ $inFavorites ? 'fill-[#AAAAAA]' : 'fill-[#FFF]' }}"
                xmlns="http://www.w3.org/2000/svg" viewBox="140.889 149.089 221.949 199.586">
                <path
                    d="M 251.868 337.478 C 249.208 337.487 246.659 336.404 244.768 334.455 L 167.079 253.364 C 146.792 231.996 146.792 197.59 167.079 176.233 C 187.526 154.97 220.622 154.97 241.069 176.233 L 251.868 187.49 L 262.665 176.233 C 283.113 154.97 316.209 154.97 336.656 176.233 C 356.933 197.59 356.933 231.996 336.656 253.364 L 258.966 334.455 C 257.075 336.404 254.528 337.487 251.868 337.478 Z" />
            </svg>
        </a>
    </div>
    <div class="inline-flex relative">
        <img class=" ml-auto absolute top-[-95%] right-[5%] scale-[1.5]" src="{{ $attributes['product']['image'] }}"
            alt="">
        <p class="self-end overflow-visible ml-auto min-w-[70px] px-[12px] py-[2px] mr-4 rounded-xl text-[#707070] text-[13px] text-center h-fit"
            style="box-shadow: 0px 2px 12px 0 rgba(32,32,32,0.18);">{{ $attributes['product']['price'] }}&euro;</p>
    </div>
</div>
