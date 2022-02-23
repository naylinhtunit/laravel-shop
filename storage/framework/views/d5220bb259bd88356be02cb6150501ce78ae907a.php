

<?php $__env->startSection('title','Review Edit'); ?>

<?php $__env->startSection('main-content'); ?>
<div class="card">
  <h5 class="card-header">Review Edit</h5>
  <div class="card-body">
    <form action="<?php echo e(route('user.productreview.update',$review->id)); ?>" method="POST">
      <?php echo csrf_field(); ?>
      <?php echo method_field('PATCH'); ?>
      <div class="form-group">
        <label for="name">Review By:</label>
        <input type="text" disabled class="form-control" value="<?php echo e($review->user_info->name); ?>">
      </div>
      <div class="form-group">
        <label for="review">Review</label>
      <textarea name="review" id="" cols="20" rows="10" class="form-control"><?php echo e($review->review); ?></textarea>
      </div>
      <div class="form-group">
        <label for="status">Status :</label>
        <select name="status" id="" class="form-control">
          <option value="">--Select Status--</option>
          <option value="active" <?php echo e((($review->status=='active')? 'selected' : '')); ?>>Active</option>
          <option value="inactive" <?php echo e((($review->status=='inactive')? 'selected' : '')); ?>>Inactive</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .order-info,.shipping-info{
        background:#ECECEC;
        padding:20px;
    }
    .order-info h4,.shipping-info h4{
        text-decoration: underline;
    }
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('user.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\NL\Documents\Applications\isure\resources\views\user\review\edit.blade.php ENDPATH**/ ?>