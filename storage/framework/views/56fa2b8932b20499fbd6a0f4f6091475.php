<?php $__env->startSection('content'); ?>
    <div class="flex justify-center pb-[9px]">
        <img class="bg-[#F5F5F5] rounded-[12px] p-[8px]" src="<?php echo e(asset('/images/fp_logo.png')); ?>"
            style="box-shadow: 0px 2px 12px 0 rgba(32,32,32,0.18);">
    </div>
    <p class="text-center uppercase text-[13px] pb-[10%]">made by the students of <br> <span class="text-[17px]">
            brainster next college </span></p>
    <div class="bg-[#F5F5F5] uppercase mx-[10%] text-[#707070] text-center rounded-[12px] py-[30px]"
        style="box-shadow: 0px 2px 12px 0 rgba(32,32,32,0.18)">
        <p class="text-[37px] leading-[30px] pb-[22px]">make the menu <br> you want</p>
        <p class="text-[13px] leading-[17px] px-[22px]">nextmenu is a menu creation platform that allows restaurants
            and
            bars to make their own customizable and contactless menu.</p>
        <p class="pt-[12px] text-[22px]">try for free!</p>
    </div>
    <div class="flex text-center text-[#909090] justify-between mx-[10%] pt-[35px] text-[30px]">
        <a href="<?php echo e(route('login')); ?>" class="w-[152px] h-[57px] rounded-xl hover:bg-neutral-100 bg-white flex items-center justify-center" style="box-shadow: 0px 2px 12px 0 rgba(32,32,32,0.18);">SIGN IN</a>
        <a href="<?php echo e(route('register')); ?>" class="w-[152px] h-[57px] rounded-xl hover:bg-neutral-100 bg-white flex items-center justify-center" style="box-shadow: 0px 2px 12px 0 rgba(32,32,32,0.18);">REGISTER</a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('createrestaurant.layouts.app', ['top' => true, 'bottom' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cakizy/Documents/github/digital-menu/resources/views/welcome.blade.php ENDPATH**/ ?>