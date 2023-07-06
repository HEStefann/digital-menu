<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/sass/app.scss', 'resources/js/app.js'])
    @yield('css')
</head>

<body
    class="font-msc w-screen overflow-hidden h-screen max-h-screen grid grid-cols-12 gap-[54px] px-[148px] pt-12 pb-[67px] bg-[#EAEAEA]">

    <div class="col-span-3 text-center flex flex-col ">
        <h1 class="text-[41px] text-[#707070] {{ isset($categoryProducts) ? 'mb-9' : 'mb-16' }} h-16">neXtmenu</h1>
        @yield('selectedCategory')
        <div class="bg-white rounded-xl flex-grow max-h-[calc(100vh-240px)] shadow-[0_2px_12px_0_rgba(32,32,32,18%)]">
            <h3 class="text-2xl text-[#707070] m-auto mt-[52px] mb-9">@yield('sideTitle')</h3>
            <div class="px-7 py-3 space-y-5 w-full h-5/6 max-h-[100%] overflow-y-auto">
                @yield('sideContent')
            </div>
        </div>
    </div>
    <div class="col-span-9 flex flex-col" x-data>
        @if ($navButtons)
            <div class="ml-auto {{ isset($categoryProducts) ? 'mb-9' : 'mb-16' }} h-16 flex items-center">
                <form action="{{ route('profile.edit') }}" method="GET">
                    <button type="submit"
                        class="py-[6px] px-[19px] text-base text-[#909090] bg-[#F5F5F5] rounded-xl shadow-[0_2px_12px_0_rgba(32,32,32,18%)] hover:bg-[#EAEAEA]">MY
                        PROFILE</button>
                </form>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="ml-[18px] py-[6px] px-[19px] text-base text-[#909090] bg-[#F5F5F5] rounded-xl shadow-[0_2px_12px_0_rgba(32,32,32,18%)] hover:bg-[#EAEAEA]">LOG
                        OUT</button>
                </form>
            </div>
        @else
            <div class="{{ isset($categoryProducts) ? 'mb-9' : 'mb-16' }} h-16 flex justify-between items-center">
                <a href="{{ $backRoute }}"
                    class="py-[6px] px-[19px] flex items-center gap-2 text-base text-[#909090] bg-[#F5F5F5] rounded-xl shadow-[0_2px_12px_0_rgba(32,32,32,18%)] hover:bg-[#EAEAEA]"><i
                        class="fa-regular fa-circle-left"></i> <span>Back</span></a>
                <div>
                    @if ($continueActions['formId'] === 'noForm')
                        <form action="{{ $continueActions['route'] }}">
                            <button type="submit"
                                class="ml-[18px] py-[6px] px-[19px] flex items-center gap-2 text-base text-[#909090] bg-[#F5F5F5] rounded-xl shadow-[0_2px_12px_0_rgba(32,32,32,18%)] hover:bg-[#EAEAEA]""><span>Finish</span>
                                <i class="fa-regular fa-circle-check"></i>
                            </button>
                        </form>
                    @else
                        <button type="submit" form="{{ $continueActions['formId'] }}"
                            class="ml-[18px] py-[6px] px-[19px] flex items-center gap-2 text-base text-[#909090] bg-[#F5F5F5] rounded-xl shadow-[0_2px_12px_0_rgba(32,32,32,18%)] hover:bg-[#EAEAEA]""><span>Continue</span>
                            <i class="fa-regular fa-circle-right"></i>
                        </button>
                    @endif
                </div>
            </div>
        @endif
        @yield('categoriesCarasoul')
        <div
            class="bg-white flex flex-col py-[52px] flex-grow max-h-[calc(100vh-240px)] rounded-xl shadow-[0_2px_12px_0_rgba(32,32,32,18%)] text-center relative overflow-hidden">
            @isset($showImages)
                <img src="{{ Storage::url('images/restaurant_menu_left.png') }}" class="absolute -left-3 -bottom-10" />
                <img src="{{ Storage::url('images/restaurant_menu_right.png') }}" class="absolute -right-3 -bottom-8" />
            @endisset

            @yield('mainContent')
        </div>
    </div>
    @yield('js')
</body>

</html>
