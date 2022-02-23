<header class="header shop">
    <!-- Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                    <!-- Top Left -->
                    <div class="top-left">
                        <ul class="list-main">
                            <?php
                                $settings=DB::table('settings')->get();
                                
                            ?>
                            <li><i class="ti-headphone-alt"></i><?php $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($data->phone); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></li>
                            <li><i class="ti-email"></i> <?php $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($data->email); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></li>
                        </ul>
                    </div>
                    <!--/ End Top Left -->
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <!-- Top Right -->
                    <div class="right-content">
                        <ul class="list-main">
                        <li><i class="ti-location-pin"></i> <a href="<?php echo e(route('order.track')); ?>">Track Order</a></li>
                            <?php if(auth()->guard()->check()): ?> 
                                <?php if(Auth::check() && Auth::user()->role->id == 1): ?>
                                    <li><i class="ti-user"></i> <a href="<?php echo e(route('admin')); ?>"  target="_blank">Dashboard</a></li>
                                <?php elseif(Auth::check() && Auth::user()->role->id == 2): ?>
                                    <li><i class="ti-user"></i> <a href="<?php echo e(route('manager')); ?>"  target="_blank">Dashboard</a></li>
                                <?php else: ?> 
                                    <li><i class="ti-user"></i> <a href="<?php echo e(route('user')); ?>"  target="_blank">Dashboard</a></li>
                                <?php endif; ?>
                                <li><i class="ti-power-off"></i> <a href="<?php echo e(route('user.logout')); ?>">Logout</a></li>

                            <?php else: ?>
                                <li><i class="ti-power-off"></i><a href="<?php echo e(route('login.form')); ?>">Login /</a> <a href="<?php echo e(route('register.form')); ?>">Register</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <!-- End Top Right -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->
    <!-- Header Inner -->
    <div class="header-inner">
        <div class="container">
            <div class="cat-nav-head">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-6">
                        <div class="menu-area">
                            <!-- Main Menu -->
                            <nav class="navbar navbar-expand-lg">
                                <div class="navbar-collapse">	
                                    <div class="nav-inner">	
                                        <ul class="nav main-menu menu navbar-nav">
                                            <li class="<?php echo e(Request::path()=='/' ? 'active' : ''); ?>"><a href="<?php echo e(route('home')); ?>">Isure</a></li>
                                            <li class="<?php if(Request::path()=='product-grids'||Request::path()=='product-lists'): ?>  active  <?php endif; ?>"><a href="<?php echo e(route('product-grids')); ?>">Products</a><span class="new">New</span></li>												
                                            <?php echo e(Helper::getHeaderCategory()); ?>

                                            <li class="<?php echo e(Request::path()=='blog' ? 'active' : ''); ?>"><a href="<?php echo e(route('blog')); ?>">Blog</a></li>
                                            <li class="<?php echo e(Request::path()=='blog' ? 'active' : ''); ?>"><a href="<?php echo e(route('about-us')); ?>">About</a></li>	
                                            <li class="<?php echo e(Request::path()=='contact' ? 'active' : ''); ?>"><a href="<?php echo e(route('contact')); ?>">Contact Us</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                            <!--/ End Main Menu -->	
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-7 col-6 d-flex justify-content-end gap-4">
                        <div class="search-bar-top">
                            
                                <form method="POST" action="<?php echo e(route('product.search')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <div class="input-group">
                                        <input type="search" class="form-control p-2"  name="search" placeholder="Search Products Here">
                                        <button type="submit" value="submit" class="input-group-text"><i class="ti-search"></i></button>
                                    </div>
                                </form>
                            
                        </div>
                        <div class="right-bar">
                            <!-- Search Form -->
                            <div class="sinlge-bar shopping">
                                <?php 
                                    $total_prod=0;
                                    $total_amount=0;
                                ?>
                            <?php if(session('wishlist')): ?>
                                    <?php $__currentLoopData = session('wishlist'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wishlist_items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $total_prod+=$wishlist_items['quantity'];
                                            $total_amount+=$wishlist_items['amount'];
                                        ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                                <a href="<?php echo e(route('wishlist')); ?>" class="single-icon"><i class="fa fa-heart-o"></i> <span class="total-count"><?php echo e(Helper::wishlistCount()); ?></span></a>
                                <!-- Shopping Item -->
                                <?php if(auth()->guard()->check()): ?>
                                    <div class="shopping-item">
                                        <div class="dropdown-cart-header">
                                            <span><?php echo e(count(Helper::getAllProductFromWishlist())); ?> Items</span>
                                            <a href="<?php echo e(route('wishlist')); ?>">View Wishlist</a>
                                        </div>
                                        <ul class="shopping-list">
                                            
                                                <?php $__currentLoopData = Helper::getAllProductFromWishlist(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                            $photo=explode(',',$data->product['photo']);
                                                        ?>
                                                        <li>
                                                            <a href="<?php echo e(route('wishlist-delete',$data->id)); ?>" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
                                                            <a class="cart-img" href="#"><img src="<?php echo e($photo[0]); ?>" alt="<?php echo e($photo[0]); ?>"></a>
                                                            <h4><a href="<?php echo e(route('product-detail',$data->product['slug'])); ?>" target="_blank"><?php echo e($data->product['title']); ?></a></h4>
                                                            <p class="quantity"><?php echo e($data->quantity); ?> x - <span class="amount"><?php echo e(number_format($data->price,2)); ?> MMK</span></p>
                                                        </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                        <div class="bottom">
                                            <div class="total">
                                                <span>Total</span>
                                                <span class="total-amount"><?php echo e(number_format(Helper::totalWishlistPrice(),2)); ?> MMK</span>
                                            </div>
                                            <a href="<?php echo e(route('cart')); ?>" class="btn animate">Cart</a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <!--/ End Shopping Item -->
                            </div>

                            <div class="sinlge-bar shopping">
                                <a href="<?php echo e(route('cart')); ?>" class="single-icon"><i class="fa fa-shopping-basket"></i> <span class="total-count"><?php echo e(Helper::cartCount()); ?></span></a>
                                <!-- Shopping Item -->
                                <?php if(auth()->guard()->check()): ?>
                                    <div class="shopping-item">
                                        <div class="dropdown-cart-header">
                                            <span><?php echo e(count(Helper::getAllProductFromCart())); ?> Items</span>
                                            <a href="<?php echo e(route('cart')); ?>">View Cart</a>
                                        </div>
                                        <ul class="shopping-list">
                                            
                                                <?php $__currentLoopData = Helper::getAllProductFromCart(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                            $photo=explode(',',$data->product['photo']);
                                                        ?>
                                                        <li>
                                                            <a href="<?php echo e(route('cart-delete',$data->id)); ?>" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
                                                            <a class="cart-img" href="#"><img src="<?php echo e($photo[0]); ?>" alt="<?php echo e($photo[0]); ?>"></a>
                                                            <h4><a href="<?php echo e(route('product-detail',$data->product['slug'])); ?>" target="_blank"><?php echo e($data->product['title']); ?></a></h4>
                                                            <p class="quantity"><?php echo e($data->quantity); ?> x - <span class="amount"><?php echo e(number_format($data->price,2)); ?> MMK</span></p>
                                                        </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                        <div class="bottom">
                                            <div class="total">
                                                <span>Total</span>
                                                <span class="total-amount"><?php echo e(number_format(Helper::totalCartPrice(),2)); ?> MMK</span>
                                            </div>
                                            <a href="<?php echo e(route('checkout')); ?>" class="btn animate">Checkout</a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <!--/ End Shopping Item -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header><?php /**PATH C:\Users\NL\Documents\Applications\laravel-shop\resources\views/frontend/layouts/header.blade.php ENDPATH**/ ?>