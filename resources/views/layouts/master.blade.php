<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div class="flex justify-between items-center bg-gray-100 dark:bg-gray-800 py-5 px-12">
        <div class="flex items-center">
            <a href=@yield('back')
                class=" border-2 border-gray-500 rounded-md flex items-center justify-center mr-3 w-8 h-8"><i
                    class="fa-solid fa-chevron-left"></i></a>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">@yield('name')</h1>
        </div>
    </div>
    <div class=" px-10 ">
        @yield('content')
    </div>
</body>

</html>
