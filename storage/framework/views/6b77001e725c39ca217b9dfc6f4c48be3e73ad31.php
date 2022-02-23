

<?php $__env->startSection('title','Order Detail'); ?>

<?php $__env->startSection('main-content'); ?>
<div class="card">
  <h5 class="card-header">Order Edit</h5>
  <div class="card-body">
    <form action="<?php echo e(route('order.update',$order->id)); ?>" method="POST">
      <?php echo csrf_field(); ?>
      <?php echo method_field('PATCH'); ?>
      <div class="form-group">
        <label for="status">Status :</label>
        <select name="status" id="" class="form-control">
          <option value="">--Select Status--</option>
          <option value="new" <?php echo e((($order->status=='new')? 'selected' : '')); ?>>New</option>
          <option value="process" <?php echo e((($order->status=='process')? 'selected' : '')); ?>>process</option>
          <option value="delivered" <?php echo e((($order->status=='delivered')? 'selected' : '')); ?>>Delivered</option>
          <option value="cancel" <?php echo e((($order->status=='cancel')? 'selected' : '')); ?>>Cancel</option>
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
<?php echo $__env->make('manager.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\NL\Documents\Applications\isure\resources\views\manager\order\edit.blade.php ENDPATH**/ ?>