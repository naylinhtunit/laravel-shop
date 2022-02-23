<!DOCTYPE html>
<html>
<head>
  <title>Order <?php if($order): ?>- <?php echo e($order->cart_id); ?> <?php endif; ?></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<?php if($order): ?>
<style type="text/css">
  .invoice-header {
    background: #f7f7f7;
    padding: 10px 20px 10px 20px;
    border-bottom: 1px solid gray;
  }
  .site-logo {
    margin-top: 20px;
  }
  .invoice-right-top h3 {
    padding-right: 20px;
    margin-top: 20px;
    color: green;
    font-size: 30px!important;
    font-family: serif;
  }
  .invoice-left-top {
    border-left: 4px solid green;
    padding-left: 20px;
    padding-top: 20px;
  }
  .invoice-left-top p {
    margin: 0;
    line-height: 20px;
    font-size: 16px;
    margin-bottom: 3px;
  }
  thead {
    background: green;
    color: #FFF;
  }
  .authority h5 {
    margin-top: -10px;
    color: green;
  }
  .thanks h4 {
    color: green;
    font-size: 25px;
    font-weight: normal;
    font-family: serif;
    margin-top: 20px;
  }
  .site-address p {
    line-height: 6px;
    font-weight: 300;
  }
  .table tfoot .empty {
    border: none;
  }
  .table-bordered {
    border: none;
  }
  .table-header {
    padding: .75rem 1.25rem;
    margin-bottom: 0;
    background-color: rgba(0,0,0,.03);
    border-bottom: 1px solid rgba(0,0,0,.125);
  }
  .table td, .table th {
    padding: .30rem;
  }
</style>
  <div class="invoice-header">
    <div class="float-left site-logo">
      <img src="<?php echo e(asset('backend/img/logo.png')); ?>" alt="">
    </div>
    <div class="float-right site-address">
      <h4><?php echo e(env('APP_NAME')); ?></h4>
      <p><?php echo e(env('APP_ADDRESS')); ?></p>
      <p>Phone: <a href="tel:<?php echo e(env('APP_PHONE')); ?>"><?php echo e(env('APP_PHONE')); ?></a></p>
      <p>Email: <a href="mailto:<?php echo e(env('APP_EMAIL')); ?>"><?php echo e(env('APP_EMAIL')); ?></a></p>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="invoice-description">
    <div class="invoice-left-top float-left">
      <h6>Invoice to</h6>
       <h3><?php echo e($order->first_name); ?> <?php echo e($order->last_name); ?></h3>
       <div class="address">
        <p>
          <strong>Country: </strong>
          <?php echo e($order->country); ?>

        </p>
        <p>
          <strong>Address: </strong>
          <?php echo e($order->address1); ?> OR <?php echo e($order->address2); ?>

        </p>
         <p><strong>Phone:</strong> <?php echo e($order->phone); ?></p>
         <p><strong>Email:</strong> <?php echo e($order->email); ?></p>
       </div>
    </div>
    <div class="invoice-right-top float-right" class="text-right">
      <h3>Invoice #<?php echo e($order->cart_id); ?></h3>
      <p><?php echo e($order->created_at->format('D d m Y')); ?></p>
      
    </div>
    <div class="clearfix"></div>
  </div>
  <section class="order_details pt-3">
    <div class="table-header">
      <h5>Order Details</h5>
    </div>
    <table class="table table-bordered table-stripe">
      <thead>
        <tr>
          <th scope="col" class="col-6">Product</th>
          <th scope="col" class="col-3">Quantity</th>
          <th scope="col" class="col-3">Total</th>
        </tr>
      </thead>
      <tbody>
      <?php $__currentLoopData = $order->cart_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php 
        $product=DB::table('products')->select('title')->where('id',$cart->product_id)->get();
      ?>
        <tr>
          <td><span>
              <?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo e($pro->title); ?>

              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </span></td>
          <td>x<?php echo e($cart->quantity); ?></td>
          <td><span><?php echo e(number_format($cart->price,2)); ?> MMK</span></td>
        </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
      <tfoot>
        <tr>
          <th scope="col" class="empty"></th>
          <th scope="col" class="text-right">Subtotal:</th>
          <th scope="col"> <span><?php echo e(number_format($order->sub_total,2)); ?> MMK</span></th>
        </tr>
      
        <tr>
          <th scope="col" class="empty"></th>
          <th scope="col" class="text-right ">Shipping:</th>
          <th><span><?php echo e(number_format($order->delivery_charge,2)); ?> MMK</span></th>
        </tr>
        <tr>
          <th scope="col" class="empty"></th>
          <th scope="col" class="text-right">Total:</th>
          <th>
            <span>
                <?php echo e(number_format($order->total_amount,2)); ?> MMK
            </span>
          </th>
        </tr>
      </tfoot>
    </table>
  </section>
  <div class="thanks mt-3">
    <h4>Thank you for your order!!</h4>
  </div>
  <div class="authority float-right mt-5">
    <p>-----------------------------------</p>
    <h5>Authority Signature:</h5>
  </div>
  <div class="clearfix"></div>
<?php else: ?>
  <h5 class="text-danger">Invalid</h5>
<?php endif; ?>
</body>
</html><?php /**PATH C:\Users\NL\Documents\Applications\isure\resources\views\user\order\pdf.blade.php ENDPATH**/ ?>