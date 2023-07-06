@extends('createrestaurant.layouts.app', ['top' => true, 'bottom' => true])
@section('content')
    <div class="uppercase text-center">
        <p class="text-[39px] text-[#707070]">WELCOME BACK</p>
        <p class="text-[22px] uppercase text-[#909090]">please sign in to continue</p>
    </div>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="py-[37px] text-center space-y-[5%]">
            <label class="relative block">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                </span>
                <input placeholder="EMAIL" name="email" type="text" value="{{ old('email') }}"
                    class="text-[17px] pl-10 text-[#909090] rounded-xl bg-white w-full h-[47px]"
                    style="box-shadow: 0px 2px 12px 0 rgba(32,32,32,0.18);">
            </label>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <label class="relative block">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2">
                        </rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                </span>
                <input placeholder="PASSWORD" name="password" type="password"
                    class="text-[17px] pl-10 text-[#909090] rounded-xl bg-white w-full h-[47px]"
                    style="box-shadow: 0px 2px 12px 0 rgba(32,32,32,0.18);">
            </label>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <button type="submit" class="text-[33px] text-[#909090] bg-[#F5F5F5] rounded-xl text-center mb-[37px] w-full"
            style="box-shadow: 0px 2px 12px 0 rgba(32,32,32,0.18);">
            LOGIN
        </button>
    </form>
    <p class="text-center">
        <span class="text-[11px] text-center text-[#909090]"> DON’T HAVE AN ACCOUNT? </span>
        <a href="{{ route('register') }}" class="text-[13px] text-center text-[#707070]"> REGISTER </a>
    </p>
@endsection
