

<?php $__env->startSection('title','Isure || PRODUCT PAGE'); ?>

<?php $__env->startSection('main-content'); ?>
	
		<!-- Breadcrumbs -->
		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="bread-inner">
							<ul class="bread-list">
								<li><a href="<?php echo e(route('home')); ?>">Home<i class="ti-arrow-right"></i></a></li>
								<li class="active"><a href="javascript:void(0);">Shop List</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
		<form action="<?php echo e(route('shop.filter')); ?>" method="POST">
		<?php echo csrf_field(); ?>
			<!-- Product Style 1 -->
			<section class="product-area shop-sidebar shop-list shop section">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-md-4 col-12">
							<div class="shop-sidebar">
                                <!-- Single Widget -->
                                <div class="single-widget category">
                                    <h3 class="title">Categories</h3>
                                    <ul class="categor-list">
										<?php
											// $category = new Category();
											$menu=App\Models\Category::getAllParentWithChild();
										?>
										<?php if($menu): ?>
										<li>
											<?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat_info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<?php if($cat_info->child_cat->count()>0): ?>
														<li><a href="<?php echo e(route('product-cat',$cat_info->slug)); ?>"><?php echo e($cat_info->title); ?></a>
															<ul>
																<?php $__currentLoopData = $cat_info->child_cat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																	<li><a href="<?php echo e(route('product-sub-cat',[$cat_info->slug,$sub_menu->slug])); ?>"><?php echo e($sub_menu->title); ?></a></li>
																<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															</ul>
														</li>
													<?php else: ?>
														<li><a href="<?php echo e(route('product-cat',$cat_info->slug)); ?>"><?php echo e($cat_info->title); ?></a></li>
													<?php endif; ?>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</li>
										<?php endif; ?>
                                    </ul>
                                </div>
                                <!--/ End Single Widget -->
                                <!-- Shop By Price -->
								<div class="single-widget range">
									<h3 class="title">Shop by Price</h3>
									<div class="price-filter">
										<div class="price-filter-inner">
											<?php
												$max=DB::table('products')->max('price');
												// dd($max);
											?>
											<div id="slider-range" data-min="0" data-max="<?php echo e($max); ?>"></div>
											<div class="product_filter">
											<button type="submit" class="filter_button">Filter</button>
											<div class="label-input">
												<span>Range:</span>
												<input style="" type="text" id="amount" readonly/>
												<input type="hidden" name="price_range" id="price_range" value="<?php if(!empty($_GET['price'])): ?><?php echo e($_GET['price']); ?><?php endif; ?>"/>
											</div>
											</div>
										</div>
									</div>
								</div>
								<!--/ End Shop By Price -->
                                <!-- Single Widget -->
                                <div class="single-widget recent-post">
                                    <h3 class="title">Recent post</h3>
                                    
                                    <?php $__currentLoopData = $recent_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <!-- Single Post -->
                                        <?php 
                                            $photo=explode(',',$product->photo);
                                        ?>
                                        <div class="single-post first">
                                            <div class="image">
                                                <img src="<?php echo e($photo[0]); ?>" alt="<?php echo e($photo[0]); ?>">
                                            </div>
                                            <div class="content">
                                                <h5><a href="<?php echo e(route('product-detail',$product->slug)); ?>"><?php echo e($product->title); ?></a></h5>
                                                <?php
                                                    $org=($product->price-($product->price*$product->discount)/100);
                                                ?>
                                                <p class="price"><del class="text-muted"><?php echo e(number_format($product->price,2)); ?> MMK</del>   <?php echo e(number_format($org,2)); ?> MMK  </p>                                                
                                            </div>
                                        </div>
                                        <!-- End Single Post -->
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <!--/ End Single Widget -->
                                <!-- Single Widget -->
                                <div class="single-widget category">
                                    <h3 class="title">Brands</h3>
                                    <ul class="categor-list">
                                        <?php
                                            $brands=DB::table('brands')->orderBy('title','ASC')->where('status','active')->get();
                                        ?>
                                        <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><a href="<?php echo e(route('product-brand',$brand->slug)); ?>"><?php echo e($brand->title); ?></a></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                                <!--/ End Single Widget -->
                        	</div>
						</div>
						<div class="col-lg-9 col-md-8 col-12">
							<div class="row">
								<div class="col-12">
									<!-- Shop Top -->
									<div class="shop-top">
										<div class="shop-shorter">
											<div class="single-shorter">
												<label>Show :</label>
												<select class="show" name="show" onchange="this.form.submit();">
													<option value="">Default</option>
													<option value="9" <?php if(!empty($_GET['show']) && $_GET['show']=='9'): ?> selected <?php endif; ?>>09</option>
													<option value="15" <?php if(!empty($_GET['show']) && $_GET['show']=='15'): ?> selected <?php endif; ?>>15</option>
													<option value="21" <?php if(!empty($_GET['show']) && $_GET['show']=='21'): ?> selected <?php endif; ?>>21</option>
													<option value="30" <?php if(!empty($_GET['show']) && $_GET['show']=='30'): ?> selected <?php endif; ?>>30</option>
												</select>
											</div>
											<div class="single-shorter">
												<label>Sort By :</label>
												<select class='sortBy' name='sortBy' onchange="this.form.submit();">
													<option value="">Default</option>
													<option value="title" <?php if(!empty($_GET['sortBy']) && $_GET['sortBy']=='title'): ?> selected <?php endif; ?>>Name</option>
													<option value="price" <?php if(!empty($_GET['sortBy']) && $_GET['sortBy']=='price'): ?> selected <?php endif; ?>>Price</option>
													<option value="category" <?php if(!empty($_GET['sortBy']) && $_GET['sortBy']=='category'): ?> selected <?php endif; ?>>Category</option>
													<option value="brand" <?php if(!empty($_GET['sortBy']) && $_GET['sortBy']=='brand'): ?> selected <?php endif; ?>>Brand</option>
												</select>
											</div>
										</div>
										<ul class="view-mode">
											<li><a href="<?php echo e(route('product-grids')); ?>"><i class="fa fa-th-large"></i></a></li>
											<li class="active"><a href="javascript:void(0)"><i class="fa fa-th-list"></i></a></li>
										</ul>
									</div>
									<!--/ End Shop Top -->
								</div>
							</div>
							<div class="row">
								<?php if(count($products)): ?>
									<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									 	
										<!-- Start Single List -->
										<div class="col-12">
											<div class="row">
												<div class="col-lg-4 col-md-6 col-sm-6">
													<div class="single-product">
														<div class="product-img">
															<a href="<?php echo e(route('product-detail',$product->slug)); ?>">
															<?php 
																$photo=explode(',',$product->photo);
															?>
															<img class="default-img" src="<?php echo e($photo[0]); ?>" alt="<?php echo e($photo[0]); ?>">
															<img class="hover-img" src="<?php echo e($photo[0]); ?>" alt="<?php echo e($photo[0]); ?>">
															</a>
															<div class="button-head">
																<div class="product-action">
																	<a title="Add to cart" href="<?php echo e(route('add-to-cart',$product->slug)); ?>"><i class="fa fa-shopping-basket"></i><span>Add to cart</span></a>
																	<a data-bs-toggle="modal" data-bs-target="#modal<?php echo e($product->id); ?>" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
																	<a title="Wishlist" href="<?php echo e(route('add-to-wishlist',$product->slug)); ?>" class="wishlist" data-id="<?php echo e($product->id); ?>"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-8 col-md-6 col-12">
													<div class="list-content">
														<div class="product-content">
															<div class="product-price">
																<?php
																	$after_discount=($product->price-($product->price*$product->discount)/100);
																?>
																<span><?php echo e(number_format($after_discount,2)); ?> MMK</span>
																<del><?php echo e(number_format($product->price,2)); ?> MMK</del>
															</div>
															<h3 class="title"><a href="<?php echo e(route('product-detail',$product->slug)); ?>"><?php echo e($product->title); ?></a></h3>
														</div>
														<p class="des pt-2"><?php echo html_entity_decode($product->summary); ?></p>
														<a class="btn cart" href="<?php echo e(route('add-to-cart',$product->slug)); ?>">Buy Now!</a>
													</div>
												</div>
											</div>
										</div>
										<!-- End Single List -->
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php else: ?>
									<h4 class="text-muted" style="margin:100px auto;">There are no products.</h4>
								<?php endif; ?>
							</div>
							 <div class="row">
                            <div class="col-md-12 justify-content-center d-flex">
                            </div>
                          </div>
						</div>
					</div>
				</div>
			</section>
			<!--/ End Product Style 1  -->	
		</form>
		<!-- Modal -->
		<?php if($products): ?>
			<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="modal fade" id="modal<?php echo e($product->id); ?>" tabindex="-1" role="dialog">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
								</div>
								<div class="modal-body">
									<div class="row no-gutters">
										<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
											<!-- Product Slider -->
												<div class="product-gallery">
													<div class="quickview-slider-active">
														<?php 
															$photo=explode(',',$product->photo);
														// dd($photo);
														?>
														<?php $__currentLoopData = $photo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<div class="single-slider">
																<img src="<?php echo e($data); ?>" alt="<?php echo e($data); ?>">
															</div>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													</div>
												</div>
											<!-- End Product slider -->
										</div>
										<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
											<div class="quickview-content">
												<h2><?php echo e($product->title); ?></h2>
												<div class="quickview-ratting-review">
													<div class="quickview-ratting-wrap">
														<div class="quickview-ratting">
															<?php
																$rate=DB::table('product_reviews')->where('product_id',$product->id)->avg('rate');
																$rate_count=DB::table('product_reviews')->where('product_id',$product->id)->count();
															?>
															<?php for($i=1; $i<=5; $i++): ?>
																<?php if($rate>=$i): ?>
																	<i class="yellow fa fa-star"></i>
																<?php else: ?> 
																<i class="fa fa-star"></i>
																<?php endif; ?>
															<?php endfor; ?>
														</div>
														<a href="#"> (<?php echo e($rate_count); ?> customer review)</a>
													</div>
													<div class="quickview-stock">
														<?php if($product->stock >0): ?>
														<span><i class="fa fa-check-circle-o"></i> <?php echo e($product->stock); ?> in stock</span>
														<?php else: ?> 
														<span><i class="fa fa-times-circle-o text-danger"></i> <?php echo e($product->stock); ?> out stock</span>
														<?php endif; ?>
													</div>
												</div>
												<?php
													$after_discount=($product->price-($product->price*$product->discount)/100);
												?>
												<h3><small><del class="text-muted"><?php echo e(number_format($product->price,2)); ?> MMK</del></small>    <?php echo e(number_format($after_discount,2)); ?> MMK  </h3>
												<div class="quickview-peragraph">
													<p><?php echo html_entity_decode($product->summary); ?></p>
												</div>
												<?php if($product->size): ?>
													<div class="size">
														<h4>Size</h4>
														<ul>
															<?php 
																$sizes=explode(',',$product->size);
																// dd($sizes);
															?>
															<?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<li><a href="#" class="one"><?php echo e($size); ?></a></li>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
														</ul>
													</div>
												<?php endif; ?>
												<form action="<?php echo e(route('single-add-to-cart')); ?>" method="POST">
													<?php echo csrf_field(); ?> 
													<div class="quantity">
														<!-- Input Order -->
														<div class="input-group">
															<div class="button minus">
																<button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
																	<i class="ti-minus"></i>
																</button>
															</div>
															<input type="hidden" name="slug" value="<?php echo e($product->slug); ?>">
															<input type="text" name="quant[1]" class="qty-input input-number"  data-min="1" data-max="1000" value="1">
															<div class="button plus">
																<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
																	<i class="ti-plus"></i>
																</button>
															</div>
														</div>
														<!--/ End Input Order -->
													</div>
													<div class="add-to-cart">
														<button type="submit" class="btn">Add to cart</button>
														<a href="<?php echo e(route('add-to-wishlist',$product->slug)); ?>" class="btn min"><i class="ti-heart"></i></a>
													</div>
												</form>
												<div class="default-social">
												<!-- ShareThis BEGIN --><div class="sharethis-inline-share-buttons"></div><!-- ShareThis END -->
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php endif; ?>
			<!-- Modal end -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('styles'); ?>
<style>
	 .pagination{
        display:inline-flex;
    }
	.filter_button{
        /* height:20px; */
        text-align: center;
        background:#fa314a;
        padding:8px 16px;
        margin-top:10px;
        color: white;
    }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('scripts'); ?>
	<script>
		$(document).ready(function () {

			$('.plus').click(function (e) {
				e.preventDefault();
				var incre_value = $(this).parents('.quantity').find('.qty-input').val();
				var value = parseInt(incre_value, 10);
				value = isNaN(value) ? 0 : value;
				if(value<10){
					value++;
					$(this).parents('.quantity').find('.qty-input').val(value);
				}
			});

			$('.minus').click(function (e) {
				e.preventDefault();
				var decre_value = $(this).parents('.quantity').find('.qty-input').val();
				var value = parseInt(decre_value, 10);
				value = isNaN(value) ? 0 : value;
				if(value>1){
					value--;
					$(this).parents('.quantity').find('.qty-input').val(value);
				}
			});

		});
	</script>
	<script>
        $(document).ready(function(){
        /*----------------------------------------------------*/
        /*  Jquery Ui slider js
        /*----------------------------------------------------*/
        if ($("#slider-range").length > 0) {
            const max_value = parseInt( $("#slider-range").data('max') ) || 500;
            const min_value = parseInt($("#slider-range").data('min')) || 0;
            const currency = $("#slider-range").data('currency') || '';
            let price_range = min_value+'-'+max_value;
            if($("#price_range").length > 0 && $("#price_range").val()){
                price_range = $("#price_range").val().trim();
            }
            
            let price = price_range.split('-');
            $("#slider-range").slider({
                range: true,
                min: min_value,
                max: max_value,
                values: price,
                slide: function (event, ui) {
                    $("#amount").val(currency + ui.values[0] + " -  "+currency+ ui.values[1]);
                    $("#price_range").val(ui.values[0] + "-" + ui.values[1]);
                }
            });
            }
        if ($("#amount").length > 0) {
            const m_currency = $("#slider-range").data('currency') || '';
            $("#amount").val(m_currency + $("#slider-range").slider("values", 0) +
                "  -  "+m_currency + $("#slider-range").slider("values", 1));
            }
        })
    </script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\NL\Documents\Applications\isure\resources\views\frontend\pages\product-lists.blade.php ENDPATH**/ ?>