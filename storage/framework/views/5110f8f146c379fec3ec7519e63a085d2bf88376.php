

<?php $__env->startSection('main-content'); ?>

<div class="card">
    <h5 class="card-header">Edit Shipping</h5>
    <div class="card-body">
      <form method="post" action="<?php echo e(route('shipping.update',$shipping->id)); ?>">
        <?php echo csrf_field(); ?> 
        <?php echo method_field('PATCH'); ?>
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Type <span class="text-danger">*</span></label>
        <input id="inputTitle" type="text" name="type" placeholder="Enter type"  value="<?php echo e($shipping->type); ?>" class="form-control">
        <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="text-danger"><?php echo e($message); ?></span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>     
        <div class="form-group">
          <label for="price" class="col-form-label">Price <span class="text-danger">*</span></label>
        <input id="price" type="number" name="price" placeholder="Enter price"  value="<?php echo e($shipping->price); ?>" class="form-control">
        <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="text-danger"><?php echo e($message); ?></span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>        
        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
            <option value="active" <?php echo e((($shipping->status=='active') ? 'selected' : '')); ?>>Active</option>
            <option value="inactive" <?php echo e((($shipping->status=='inactive') ? 'selected' : '')); ?>>Inactive</option>
          </select>
          <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <span class="text-danger"><?php echo e($message); ?></span>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group mb-3">
           <button class="btn btn-success" type="submit">Update</button>
        </div>
      </form>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('backend/summernote/summernote.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="<?php echo e(asset('backend/summernote/summernote.min.js')); ?>"></script>
<script>
    $('#lfm').filemanager('image');

    $(document).ready(function() {
    $('#description').summernote({
      placeholder: "Write short description.....",
        tabsize: 2,
        height: 150
    });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('manager.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\NL\Documents\Applications\isure\resources\views\manager\shipping\edit.blade.php ENDPATH**/ ?>