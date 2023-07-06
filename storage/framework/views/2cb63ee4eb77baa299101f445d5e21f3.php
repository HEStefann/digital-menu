<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Digital Menu</title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
</head>

<body class="bg-no-repeat bg-cover bg-[#EAEAEA] h-screen bg-center flex flex-col justify-center bg-[url('../../public/img/fp.png')] lg:bg-[url('../../public/img/fplg.png')]">
    <?php if (isset($component)) { $__componentOriginal1321ad4f8a3a9dd97307f677db401c14 = $component; } ?>
<?php $component = App\View\Components\Background::resolve(['top' => $top ?? false,'bottom' => $bottom ?? false] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('background'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Background::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1321ad4f8a3a9dd97307f677db401c14)): ?>
<?php $component = $__componentOriginal1321ad4f8a3a9dd97307f677db401c14; ?>
<?php unset($__componentOriginal1321ad4f8a3a9dd97307f677db401c14); ?>
<?php endif; ?>
    <div class="self-center z-10">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</body>

</html>
<?php /**PATH /home/cakizy/Documents/github/digital-menu/resources/views/createrestaurant/layouts/app.blade.php ENDPATH**/ ?>