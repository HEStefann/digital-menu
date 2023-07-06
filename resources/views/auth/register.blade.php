@extends('createrestaurant.layouts.app', ['top' => true, 'bottom' => true])
@section('content')
    <div>
        <div class="uppercase text-center">
            <p class="text-[39px] text-[#707070]">CREATE ACCOUNT</p>
            <p class="text-[17px] text-[#909090]">please enter your personal info</p>
        </div>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="py-[37px] text-center space-y-[5%]">
                <label class="relative block">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg stroke="#909090" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </span>
                    <input value="{{ old('name') }}" placeholder="NAME" name="name" type="text"
                        class="text-[17px] pl-10 text-[#909090] rounded-xl bg-white w-full h-[47px]"
                        style="box-shadow: 0px 2px 12px 0 rgba(32,32,32,0.18);">
                </label>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                <label class="relative block">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg stroke="#909090" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                    </span>
                    <input value="{{ old('email') }}" placeholder="EMAIL" name="email" type="text"
                        class="text-[17px] pl-10 text-[#909090] rounded-xl bg-white w-full h-[47px]"
                        style="box-shadow: 0px 2px 12px 0 rgba(32,32,32,0.18);">
                </label>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                <label class="relative block">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg stroke="#909090" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2">
                            </rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                    </span>
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <svg stroke="#909090" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path
                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                            <path
                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                        </svg>
                    </span>
                    <input placeholder="PASSWORD" name="password" type="password"
                        class="text-[17px] pl-10 text-[#909090] rounded-xl bg-white w-full h-[47px]"
                        style="box-shadow: 0px 2px 12px 0 rgba(32,32,32,0.18);">
                </label>
                <label class="relative block">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg stroke="#909090" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2">
                            </rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                    </span>
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <svg stroke="#909090" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path
                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                            <path
                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                        </svg>
                    </span>
                    <input placeholder="CONFIRM PASSWORD" name="password_confirmation" type="password"
                        class="text-[17px] pl-10 text-[#909090] rounded-xl bg-white w-full h-[47px]"
                        style="box-shadow: 0px 2px 12px 0 rgba(32,32,32,0.18);">
                </label>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <button type="submit" class="text-[33px] text-[#909090] bg-[#F5F5F5] rounded-xl text-center mb-[37px] w-full"
                style="box-shadow: 0px 2px 12px 0 rgba(32,32,32,0.18);">
                REGISTER
            </button>
        </form>
        <p class="text-center">
            <span class="text-[11px] text-center text-[#909090]"> ALREADY HAVE AN ACCOUNT? </span>
            <a href="{{ route('login') }}" class="text-[13px] text-center text-[#707070]"> SIGN IN </a>
        </p>
    </div>
@endsection
