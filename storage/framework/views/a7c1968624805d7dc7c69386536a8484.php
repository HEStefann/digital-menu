<div class="fixed w-screen h-screen">
    <?php if($top): ?>
    <img src=" <?php echo e(asset('/images/bgIndex/topLeft.png')); ?>" class="absolute top-0 left-0">
    <img src=" <?php echo e(asset('/images/bgIndex/topRight.png')); ?>" class="absolute top-0 right-0">
    <?php endif; ?>
    <?php if($bottom): ?>
    <img src=" <?php echo e(asset('/images/bgIndex/bottomRight.png')); ?>" class="absolute bottom-0 right-0">
    <img src=" <?php echo e(asset('/images/bgIndex/bottomLeft.png')); ?>" class="absolute bottom-0 left-0">
    <?php endif; ?>
</div><?php /**PATH /home/cakizy/Documents/github/digital-menu/resources/views/components/background.blade.php ENDPATH**/ ?>