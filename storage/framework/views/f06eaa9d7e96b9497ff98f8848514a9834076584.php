<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissable fade show text-center">
        
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>


<?php if(session('error')): ?>
    <div class="alert alert-danger alert-dismissable fade show text-center">
        
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?><?php /**PATH C:\Users\NL\Documents\Applications\isure\resources\views/frontend/layouts/notification.blade.php ENDPATH**/ ?>