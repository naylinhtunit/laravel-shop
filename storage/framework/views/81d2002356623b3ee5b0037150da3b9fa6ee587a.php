<?php if(isset($category_lists)): ?>
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <?php $__currentLoopData = $category_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    
<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#hello" role="tab"><?php echo e($category->title); ?></a></li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<?php endif; ?><?php /**PATH C:\Users\NL\Documents\Applications\isure\resources\views\frontend\layouts\_filter.blade.php ENDPATH**/ ?>