@extends('layouts.adminUser', ['navButtons' => true])

@section('title', $restaurant->name)

@section('sideTitle', 'All Restaurants')

@section('sideContent')
    @foreach ($restaurants as $rest)
        <div>
            <div onclick="window.location.href='{{ route('menus.index', ['restaurant' => $rest]) }}'"
                class="py-[10px] px-[17px] bg-[#F5F5F5] shadow-[0_2px_12px_0_rgb(32,32,32,18%)] rounded-xl cursor-pointer flex justify-between items-center">
                <h2 class="text-[21px] text-[#4E4E4E]">
                    {{ $rest->name }}
                </h2>
                <div>
                    <a class="bg-white shadow-[0_2px_12px_0_rgb(32,32,32,18%)] py-1 px-4 rounded-xl text-[#909090]"
                        href="{{ route('restaurant.show', ['restaurant' => $rest]) }}">Edit</a>
                </div>
            </div>
        </div>
    @endforeach
    <div onclick="window.location.href='{{ route('restaurant.create') }}'"
        class="py-[10px] px-[17px] bg-white shadow-[0_2px_12px_0_rgb(32,32,32,18%)] rounded-xl cursor-pointer flex items-center justify-center hover:bg-[#F5F5F5]">
        <h2 class="text-[21px] text-[#4E4E4E]">
            ADD RESTAURANT +
        </h2>
    </div>
@endsection

@section('mainContent')
<img src=" {{ asset('/images/bgIndex/bottomRight.png')  }}" class="absolute bottom-0 right-0 scale-[0.8] origin-bottom-right">
<img src=" {{ asset('/images/bgIndex/bottomLeft.png')  }}" class="absolute bottom-0 left-0 scale-[0.8] origin-bottom-left">
    <div class="px-[60px] flex flex-col flex-grow z-10" x-data="deleteModal()">
        <div class="px-32">
            <h1 class="m-auto mb-5">MENUS FOR {{ strtoupper($restaurant->name) }}</h1>
            <div>
                @forelse ($menus as $menu)
                    <div
                        class="py-[10px] px-[17px] my-[30px] bg-[#F5F5F5] shadow-[0_2px_12px_0_rgb(32,32,32,18%)] rounded-xl cursor-pointer flex justify-between items-center">
                        <div>
                            <h2 class="text-[21px] text-[#4E4E4E]">
                                {{ $menu->name }}
                            </h2>
                        </div>
                        <div class="flex items-center gap-1" x-data="{ showQR: false }">
                            <button x-on:click="showQR = true"
                                class="bg-white px-3 py-[2.3px] mr-4 text-[17px] text-[#909090] rounded-xl shadow-[0_2px_12px_0_rgb(32,32,32,18%)] hover:bg-[#EAEAEA]">GET
                                <i class="fa-solid fa-qrcode"></i></button>
                            <a href="{{ route('menus.show', ['menu' => $menu]) }}"
                                class="px-[21px] py-1 text-[#909090] rounded-xl text-[14px] bg-white  shadow-[0_2px_12px_0_rgb(32,32,32,18%)] hover:bg-[#EAEAEA]">EDIT</a>
                            <a x-on:click="open('menu', '{{ route('menus.destroy', ['menu' => $menu]) }}')"
                                class="ml-4 px-[21px] py-1 text-[#AAAAAA] rounded-xl text-[14px] bg-[#F5F5F5]  shadow-[0_2px_12px_0_rgb(32,32,32,18%)] hover:bg-[#EAEAEA] cursor-pointer">
                                DELETE
                            </a>
                            <div x-show="showQR" x-transition x-cloak
                                class="fixed h-screen w-screen z-[1000] bg-slate-400/50 top-0 left-0 grid content-center">
                                <div class="mx-auto">
                                    <div class="relative w-[400px] max-h-full">
                                        <div class="relative bg-white p-4 rounded-lg shadow dark:bg-gray-700">
                                            <button type="button"
                                                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                                                x-on:click="showQR = false">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <h1>Download the QR code</h1>
                                            <div class="mt-4">
                                                <div class="flex justify-center">
                                                    <div class="flex flex-col items-center">
                                                        <div class="flex flex-col items-center">
                                                            <img src="{{ $menu->qr }}" alt="">
                                                            <div class="mt-4 ml-auto">
                                                                <button x-on:click="showQR = false"
                                                                    class="mr-4 px-[21px] py-1 text-[#AAAAAA] rounded-xl text-[14px] bg-[#EAEAEA]  shadow-[0_2px_12px_0_rgb(32,32,32,18%)] hover:bg-[#F5F5F5] cursor-pointer">CANCEL</button>
                                                                <a href="{{ route('download', ['menu' => $menu->id]) }}"
                                                                    class="px-[21px] py-1 text-[#AAAAAA] rounded-xl text-[14px] bg-white  shadow-[0_2px_12px_0_rgb(32,32,32,18%)] hover:bg-[#EAEAEA] cursor-pointer">
                                                                    DOWNLOAD
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                @empty
                    <h1>Create menus to showcase your delicious offerings.</h1>
                @endforelse
                <div x-data="createResource()">
                    <div x-show="!show" x-on:click="open()"
                        class="py-[10px] px-[17px] my-5 bg-white shadow-[0_2px_12px_0_rgb(32,32,32,18%)] rounded-xl cursor-pointer flex items-center justify-center hover:bg-[#F5F5F5]">
                        <h2 class="text-[21px] text-[#4E4E4E]">
                            CREATE MENU +
                        </h2>

                    </div>
                    <form action="{{ route('menus.store', ['restaurant' => $restaurant]) }}" method="POST" x-show="show"
                        x-cloak class="py-6 px-7 mt-5 bg-white shadow-[0_2px_12px_0_rgb(32,32,32,18%)] rounded-xl">
                        @csrf
                        <input type="hidden" name="restaurant_id" value={{ $restaurant->id }}>
                        <h1 class="text-center text-[#4E4E4E] text-[21px]">CREATING A MENU</h1>
                        <p class="text-center text-[#909090] text-[11px] mb-7">Enter the name and continue with the creation
                            process</p>
                        <div class="flex justify-between items-center gap-20">
                            <div class="grow">
                                <div
                                    class="flex items-center text-[#909090] bg-[#F5F5F5] shadow-[0_2px_12px_0_rgb(32,32,32,18%)] rounded-xl">
                                    <div class="flex items-center pl-3 pointer-events-none">
                                        <i class="fa-solid fa-utensils"></i>
                                    </div>
                                    <input class="border-0 bg-inherit focus:outline-none focus:ring-0 flex-grow"
                                        type='text' id="menuName" name="name" placeholder="Name" x-model="value">
                                </div>

                            </div>
                            <div>
                                <button type="button" x-on:click="close()"
                                    class="bg-[#F5F5F5] shadow-[0_2px_12px_0_rgb(32,32,32,18%)] rounded-xl py-2 px-4 text-[#909090] hover:bg-white">CANCEL</button>
                                <button type="submit" x-bind:disabled="!value"
                                    x-bind:class="{
                                        'bg-[#F5F5F5] opacity-40': !
                                            value,
                                        'bg-white shadow-[0_2px_12px_0_rgb(32,32,32,18%)]': value
                                    }"
                                    class="rounded-xl py-2 px-4 ml-4 text-[#909090] hover:bg-[#F5F5F5]">CONTINUE</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <div x-show="show" x-transition x-cloak
                class="fixed h-screen w-screen z-[1000] bg-slate-400/50 top-0 left-0 grid content-center">
                <div class="mx-auto">
                    <div class="relative w-full max-w-md max-h-full">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
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
                            <form :action="route" method="GET" class="p-6 text-center">
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
                                <button x-on:click="close()" type="submit"
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
