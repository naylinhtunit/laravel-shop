
<?php $__env->startSection('title','Wishlist Page'); ?>
<?php $__env->startSection('main-content'); ?>
	<!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="<?php echo e(('home')); ?>">Home<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="javascript:void(0);">Wishlist</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->
			
	<!-- Shopping Cart -->
	<div class="shopping-cart section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<!-- Shopping Summery -->
					<table class="table shopping-summery">
						<thead>
							<tr class="main-hading">
								<th>PRODUCT</th>
								<th>NAME</th>
								<th class="text-center">TOTAL</th> 
								<th class="text-center">ADD TO CART</th> 
								<th class="text-center"><i class="ti-trash remove-icon"></i></th>
							</tr>
						</thead>
						<tbody>
							<?php if(count(Helper::getAllProductFromWishlist()) > 0): ?>
								<?php $__currentLoopData = Helper::getAllProductFromWishlist(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$wishlist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr class="wishlist-content">
										<?php 
											$photo=explode(',',$wishlist->product['photo']);
											?>
										<td class="image" data-title="No"><img src="<?php echo e($photo[0]); ?>" alt="<?php echo e($photo[0]); ?>"></td>
										<td class="product-des" data-title="Description">
											<p class="product-name"><a href="<?php echo e(route('product-detail',$wishlist->product['slug'])); ?>"><?php echo e($wishlist->product['title']); ?></a></p>
											<p class="product-des"><?php echo ($wishlist['summary']); ?></p>
										</td>
										<td class="total-amount" data-title="Total"><span><?php echo e($wishlist['amount']); ?> MMK</span></td>
										<td><a href="<?php echo e(route('add-to-cart',$wishlist->product['slug'])); ?>" class='btn text-white'>Add To Cart</a></td>
										<td class="action" data-title="Remove">
											<input type="hidden" class="wishlist_id" value="<?php echo e($wishlist->id); ?>">
											<a href="<?php echo e(route('wishlist-delete', $wishlist->id)); ?>" class="remove-from-wishlist"><i class="ti-trash remove-icon"></i></a>
										</td>
									</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php else: ?> 
								<tr>
									<td class="text-center">
										There are no any wishlist available. <a href="<?php echo e(route('product-grids')); ?>" style="color:blue;">Continue shopping</a>

									</td>
								</tr>
							<?php endif; ?>


						</tbody>
					</table>
					<!--/ End Shopping Summery -->
				</div>
			</div>
		</div>
	</div>
	<!--/ End Shopping Cart -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
	
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\NL\Documents\Applications\isure\resources\views\frontend\pages\wishlist.blade.php ENDPATH**/ ?>