@extends('layouts.adminUser', ['navButtons' => true])

@section('title', 'Restaurants')

@section('sideTitle', 'All Restaurants')

@section('sideContent')
    @forelse ($restaurants as $restaurant)
        <div>
            <div onclick="window.location.href='{{ route('menus.index', ['restaurant' => $restaurant]) }}'"
                class="py-[10px] px-[17px] bg-[#F5F5F5] shadow-[0_2px_12px_0_rgb(32,32,32,18%)] rounded-xl cursor-pointer flex justify-between items-center">
                <h2 class="text-[21px] text-[#4E4E4E]">
                    {{ $restaurant->name }}
                </h2>
                <div>
                    <a class="bg-white shadow-[0_2px_12px_0_rgb(32,32,32,18%)] py-1 px-4 rounded-xl text-[#909090]"
                        href="{{ route('restaurant.show', ['restaurant' => $restaurant]) }}">Edit</a>
                </div>
            </div>
        </div>

    @empty
        <h1>Create a restaurant to start showcasing your culinary options.</h1>
    @endforelse
    <div onclick="window.location.href='{{ route('restaurant.create') }}'"
        class="py-[10px] px-[17px] bg-white shadow-[0_2px_12px_0_rgb(32,32,32,18%)] rounded-xl cursor-pointer flex items-center justify-center hover:bg-[#F5F5F5]">
        <h2 class="text-[21px] text-[#4E4E4E]">
            ADD RESTAURANT +
        </h2>
    </div>
@endsection


@section('mainContent')
    <div>
        <h3 class="text-2xl text-[#707070]">Please select a restaurant from your created options.</h3>
    </div>
        <img src=" {{ asset('/images/bgIndex/bottomRight.png')  }}" class="absolute bottom-0 right-0 scale-[0.8] origin-bottom-right">
        <img src=" {{ asset('/images/bgIndex/bottomLeft.png')  }}" class="absolute bottom-0 left-0 scale-[0.8] origin-bottom-left">
@endsection
