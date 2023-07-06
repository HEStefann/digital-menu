<div class="fixed w-screen h-screen">
    @if ($top)
    <img src=" {{ asset('/images/bgIndex/topLeft.png')  }}" class="absolute top-0 left-0">
    <img src=" {{ asset('/images/bgIndex/topRight.png')  }}" class="absolute top-0 right-0">
    @endif
    @if ($bottom)
    <img src=" {{ asset('/images/bgIndex/bottomRight.png')  }}" class="absolute bottom-0 right-0">
    <img src=" {{ asset('/images/bgIndex/bottomLeft.png')  }}" class="absolute bottom-0 left-0">
    @endif
</div>