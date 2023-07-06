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
    <div>
        {{-- Tuka --}}

        <div class="p-[10px] overflow-hidden rounded-xl bg-white mt-[134px] mb-[24px] inline-block px[5px]"
            style="box-shadow: 0px 2px 12px 0 rgba(32,32,32,0.18);">
            <p class="text-[25px] text-center text-[#909090]">About Us</p>
        </div>


        <div class="grid grid-rows-2 grid-flow-col gap-4 auto-cols-auto" style="gap: 24px;">
            {{-- <div class="p-[10px] overflow-hidden rounded-lg bg-white"
                style="box-shadow: 0px 2px 12px 0 rgba(32,32,32,0.18);">
                <p class=" text-[19px] text-left text-[#707070] mb-[14px]">
                    Opening Hours
                </p>
                <p class=" text-xs text-left text-[#707070]">
                    <span class="text-xs text-left text-[#707070]">MON - THU : 9am - 12am </span><br /><span
                        class="text-xs text-left text-[#707070]">FRI - SUN : 9am - 1am</span>
                </p>
            </div> --}}
            <div class="p-[10px] col-span-2 overflow-hidden rounded-lg bg-white"
                style="box-shadow: 0px 2px 12px 0 rgba(32,32,32,0.18);">
                <p class=" text-[19px] text-left text-[#707070] mb-[14px]">
                    Reservations
                </p>
                <p class=" left-[15px] top-[47px] text-xs text-left text-[#707070]">
                    <span class=" text-xs text-left text-[#707070]">Phone:
                        {{ $restaurant->phone ? $restaurant->phone : 'N/A' }}</span><br /><span
                        class=" text-xs text-left text-[#707070]">Email:
                        {{ $restaurant->email ? $restaurant->email : 'N/A' }}</span>
                </p>
            </div>
            <div class="p-[10px] overflow-hidden rounded-lg bg-white"
                style="box-shadow: 0px 2px 12px 0 rgba(32,32,32,0.18);">
                <p class=" text-[19px] text-left text-[#707070] mb-[14px]">
                    Address
                </p>
                <p class=" left-4 top-[47px] text-xs text-left text-[#707070]">
                    <span
                        class=" text-xs text-left text-[#707070]">{{ $restaurant->address ? $restaurant->address : 'N/A' }}</span>
                </p>
            </div>
            <div class="p-[10px] overflow-hidden rounded-lg bg-white"
                style="box-shadow: 0px 2px 12px 0 rgba(32,32,32,0.18);">
                <p class="text-[19px] text-left text-[#707070] mb-[14px]">Follow Us</p>
                <div class="w-[132px] h-6">
                    @forelse($socials as $key => $social)
                        <i class="fa-brands fa-{{ $key }} text-[24px] mr-3"
                            onclick="window.open('{{ $social }}')"></i>
                    @empty
                        <p>No socials found</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="p-[10px] overflow-hidden rounded-lg bg-white mt-[24px]"
            style="box-shadow: 0px 2px 12px 0 rgba(32,32,32,0.18);">
            <p class="text-[19px] text-left text-[#707070] mb-[14px]">
                <span class="text-[19px] text-left text-[#707070]">Work With Us?</span><br />
            </p>
            <div class="flex">
                <p class="text-xs text-left text-[#707070] w-3/4">
                    <span class="text-xs text-left text-[#707070]">If you are interested in employment in our
                        company, please send your CV below.</span><br />
                </p>
                <button class="overflow-hidden rounded-xl bg-neutral-100 border border-[#c7c7c7]/50 ml[35px]"
                    style="box-shadow: 0px 2px 12px 0 rgba(32,32,32,0.12);"><span
                        class="text-[15px] text-center text-[#4e4e4e] p-[5px]">Send CV</span></button>
            </div>
        </div>
    </div>
    
    <img src=" {{ asset('/images/bgIndex/bottomRight.png')  }}" class="absolute bottom-0 right-0 scale-[0.5] origin-bottom-right z-[-1] pb-[140px]">
    <img src=" {{ asset('/images/bgIndex/bottomLeft.png')  }}" class="absolute bottom-0 left-0 scale-[0.5] origin-bottom-left z-[-1] pb-[140px]">
@endsection
