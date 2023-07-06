<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="h-screen bg-[#EAEAEA] font-msc">
    <div class="pt-[6%] md:pt-[3%] px-[20px] pb-[85px]">
        @yield('content')
    </div>
    <x-footer :id={{ $id }}></x-footer>
</body>

</html>
