@extends('layouts.adminUser', ['navButtons' => true])
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.css"
        integrity="sha512-C4k/QrN4udgZnXStNFS5osxdhVECWyhMsK1pnlk+LkC7yJGCqoYxW4mH3/ZXLweODyzolwdWSqmmadudSHMRLA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .container {
            margin: 20px auto;
            max-width: 640px;
        }

        img {
            max-width: 100%;
        }

        .cropper-view-box,
        .cropper-face {
            border-radius: 50%;
        }

        /* The css styles for `outline` do not follow `border-radius` on iOS/Safari (#979). */
        .cropper-view-box {
            outline: 0;
            box-shadow: 0 0 0 1px #39f;
        }
    </style>
@endsection
@section('title', 'Creating Restaurant')

@section('sideTitle', 'All Restaurants')

@section('sideContent')
    @foreach ($restaurants as $restaurant)
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
    @endforeach
    <div onclick="window.location.href='{{ route('restaurant.create') }}'"
        class="py-[10px] px-[17px] bg-white shadow-[0_2px_12px_0_rgb(32,32,32,18%)] rounded-xl cursor-pointer flex items-center justify-center hover:bg-[#F5F5F5]">
        <h2 class="text-[21px] text-[#4E4E4E]">
            ADD RESTAURANT +
        </h2>
    </div>

@endsection

@section('mainContent')
    <form action="{{ route('restaurant.store') }}" method="POST" enctype="multipart/form-data"
        class="px-[60px] flex flex-col flex-grow">
        @csrf
        <div class="grid grid-cols-8 gap-12">
            <div class="col-span-4 space-y-6">
                <h2 class="text-base text-[#707070] ">CREATING A RESTAURANT</h2>
                <p class="text-[13px] text-[#909090] w-[70%] m-auto">Please fill in the required fields to provide the
                    necessary
                    information for your restaurant. </p>
                <div class="flex justify-center items-center" x-data="imageModal()">
                    <label for="inputImage" id="labelInputImage"
                        class="z-10 w-[172px] h-[38px] opacity-[0.71] overflow-hidden rounded-xl text-center text-[#4e4e4e] bg-[#FFFFFF] shadow-[0_2px_12px_0_rgba(32,32,32,18%)] text-[25px] absolute uppercase">add
                        logo +</label>
                    <div class="w-[198px] h-[198px]">
                        <label for="inputImage">
                            <img id="selectedImg" class="w-[100%] h-[100%] opacity-[.25]"
                                src="https://ik.imagekit.io/NEXTMenu/noImage.png">
                        </label>
                    </div>
                    <input x-on:change="open()" type="file" id="inputImage" name="logoName" accept="image/*"
                        style="display:none" />
                    <input type="hidden" id="hiddenLogoInput" name="logo" value="">
                    <div x-show="show" x-transition x-cloak
                        class="fixed h-screen w-screen z-[1000] bg-slate-400/50 top-0 left-0 grid content-center">
                        <div class="mx-auto">
                            <div class="relative w-full max-w-md max-h-full p-4 ">
                                <div class="relative bg-white rounded-lg shadow p-4 dark:bg-gray-700">
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
                                    <div class="p-6 text-center">
                                        <div id="preview" class="flex justify-center flex-col items-center relative">
                                            <div class="w-[198px] h-[198px]">
                                                <img id="img" class="w-[100%] h-[100%] opacity-[.25]"
                                                    src="https://ik.imagekit.io/NEXTMenu/noImage.png">
                                            </div>
                                        </div>
                                        <button x-on:click="close()" type="button"
                                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                                            cancel</button>
                                        <button x-on:click="close()" type="button" id="cropButton"
                                            class="w-[172px] h-[38px] relative opacity-[0.71] overflow-hidden rounded-xl text-center text-[#4e4e4e] bg-[#F5F5F5] shadow-[0_2px_12px_0_rgba(32,32,32,18%)] place-self-center mt-[24px]">Save
                                            Image</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <x-input-field icon="fa-solid fa-utensils" id="restaurantName" name="name" type="text"
                    placeholder="Name" value="{{ old('name') }}" />
                @error('name')
                    {{ $message }}
                @enderror
                <x-input-field icon="fa-solid fa-envelope" id="restaurantEmail" name="email" type="email"
                    placeholder="Email" value="{{ old('email') }}" />
                <x-input-field icon="fa-solid fa-phone" id="restaurantPhone" name="phone" type="number"
                    placeholder="Phone" value="{{ old('phone') }}" />
                <x-input-field icon="fa-solid fa-location-dot" id="restaurantAddress" name="address" type="text"
                    placeholder="Address" value="{{ old('address') }}" />
            </div>
            <div class="col-span-4 flex flex-col">
                <div class="px-4 pt-3 bg-white pb-12 shadow-[0_2px_12px_0_rgba(32,32,32,18%)] rounded-xl">
                    <div class="text-[#909090] text-[22px] flex items-center gap-3 mb-8">
                        <i class="fa-solid fa-earth-europe"></i>
                        <h1>Social Media Links</h1>
                    </div>
                    <div class="mx-[10px] space-y-6">
                        <x-input-field icon="fa-brands fa-facebook" id="restaurantFacebook" name="facebook"
                            type="text" placeholder="Facebook" value="{{ old('facebook') }}" />
                        <x-input-field icon="fa-brands fa-instagram" id="restaurantInstagram" name="instagram"
                            type="text" placeholder="Instagram" value="{{ old('instagram') }}" />
                        <x-input-field icon="fa-solid fa-globe" id="restaurantWeb" name="website" type="text"
                            placeholder="Web" value="{{ old('website') }}" />
                    </div>
                </div>
                <div class="self-end mt-auto" x-data="{ loading: false }" x-init="loading = false">
                    <button type="submit" x-on:click="loading = true"
                        class="ml-4 px-5 py-2 text-[#707070] rounded-xl text-[14px] bg-white  shadow-[0_2px_12px_0_rgb(32,32,32,18%)] hover:bg-[#EAEAEA]">
                        <span x-show="!loading" x-cloak>Save</span>
                        <span x-show="loading" x-cloak>
                            <svg aria-hidden="true" role="status"
                                class="inline w-4 h-4 mr-3 text-gray-200 animate-spin dark:text-gray-600"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="#1C64F2" />
                            </svg>
                            Loading...
                        </span>

                    </button>
                </div>
            </div>
        </div>

    </form>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"
        integrity="sha512-6lplKUSl86rUVprDIjiW8DuOniNX8UDoRATqZSds/7t6zCQZfaCe3e5zcGaQwxa8Kpn5RTM9Fvl3X2lLV4grPQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="module" src="{{ URL::asset('js/cropper.js') }}"></script>
@endsection
