

<?php $__env->startSection('title','Checkout page'); ?>

<?php $__env->startSection('main-content'); ?>
<div class="container py-5">
    <div class="row">
        <div class="text-center">
            <h1 class="display-4 lh-lg">Thanks for your order!</h1>
            <p class="lead mb-3">
                We appreciate your order! If you have any questions, please email.
                <a href="<?php echo e(route('product-grids')); ?>" style="color:blue;">Continue shopping</a>
            </p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\NL\Documents\Applications\isure\resources\views\frontend\pages\thank-you.blade.php ENDPATH**/ ?>