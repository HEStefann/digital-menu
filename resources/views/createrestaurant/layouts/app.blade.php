<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Digital Menu</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-no-repeat bg-cover bg-[#EAEAEA] h-screen bg-center flex flex-col justify-center bg-[url('../../public/img/fp.png')] lg:bg-[url('../../public/img/fplg.png')]">
    <x-background :top="$top ?? false" :bottom="$bottom ?? false"/>
    <div class="self-center z-10">
        @yield('content')
    </div>
</body>

</html>
