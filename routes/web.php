<?php

use Illuminate\Support\Facades\Route;


// Auth::routes(['register' => false]);
Auth::routes();

Route::get('user/login','FrontendController@login')->name('login.form');
Route::post('user/login','FrontendController@loginSubmit')->name('login.submit');
Route::get('user/logout','FrontendController@logout')->name('user.logout');
// user
Route::get('user/register','FrontendController@register')->name('register.form');
Route::post('user/register','FrontendController@registerSubmit')->name('register.submit');
// Reset password
Route::get('password-reset', 'FrontendController@showResetForm')->name('password.reset'); 
// Socialite 
Route::get('login/{provider}/', 'Auth\LoginController@redirect')->name('login.redirect');
Route::get('login/{provider}/callback/', 'Auth\LoginController@Callback')->name('login.callback');

Route::get('/','FrontendController@home')->name('home');

// Frontend Routes
Route::get('/home', 'FrontendController@index');
Route::get('/about-us','FrontendController@aboutUs')->name('about-us');
Route::get('/contact','FrontendController@contact')->name('contact');
Route::post('/contact/message','MessageController@store')->name('contact.store');
Route::get('product-detail/{slug}','FrontendController@productDetail')->name('product-detail');
Route::post('/product/search','FrontendController@productSearch')->name('product.search');
Route::get('/product-cat/{slug}','FrontendController@productCat')->name('product-cat');
Route::get('/product-brand/{slug}','FrontendController@productBrand')->name('product-brand');

// Cart section
Route::get('/cart',function(){
    return view('frontend.pages.cart');
})->name('cart')->middleware('user');
Route::get('/add-to-cart/{slug}','CartController@addToCart')->name('add-to-cart')->middleware('user');
Route::post('/add-to-cart','CartController@singleAddToCart')->name('single-add-to-cart')->middleware('user');
Route::get('cart-delete/{id}','CartController@cartDelete')->name('cart-delete');
Route::post('cart-update','CartController@cartUpdate')->name('cart.update');

Route::get('/checkout','CartController@checkout')->name('checkout')->middleware('user');
// Wishlist
Route::get('/wishlist',function(){
    return view('frontend.pages.wishlist');
})->name('wishlist')->middleware('user');
Route::get('/wishlist/{slug}','WishlistController@wishlist')->name('add-to-wishlist')->middleware('user');
Route::get('wishlist-delete/{id}','WishlistController@wishlistDelete')->name('wishlist-delete');
Route::post('cart/order','OrderController@store')->name('cart.order');
Route::get('order/pdf/{id}','OrderController@pdf')->name('order.pdf');
Route::get('/income','OrderController@incomeChart')->name('product.order.income');
Route::get('/product-grids','FrontendController@productGrids')->name('product-grids');
Route::get('/product-lists','FrontendController@productLists')->name('product-lists');
Route::match(['get','post'],'/filter','FrontendController@productFilter')->name('shop.filter');
// Order Track
Route::get('/product/track','OrderController@orderTrack')->name('order.track')->middleware('user');
Route::post('product/track/order','OrderController@productTrackOrder')->name('product.track.order');
// Blog
Route::get('/blog','FrontendController@blog')->name('blog');
Route::get('/blog-detail/{slug}','FrontendController@blogDetail')->name('blog.detail');
Route::get('/blog/search','FrontendController@blogSearch')->name('blog.search');
Route::post('/blog/filter','FrontendController@blogFilter')->name('blog.filter');
Route::get('blog-cat/{slug}','FrontendController@blogByCategory')->name('blog.category');
Route::get('blog-tag/{slug}','FrontendController@blogByTag')->name('blog.tag');

// Product Review
Route::resource('/review','ProductReviewController');
Route::post('product/{slug}/review','ProductReviewController@store')->name('review.store');

// Post Comment 
Route::post('post/{slug}/comment','PostCommentController@store')->name('post-comment.store');
Route::resource('/comment','PostCommentController');
// Coupon
Route::post('/coupon-store','CouponController@couponStore')->name('coupon-store');

// Backend Admin section start
Route::group(['prefix'=>'/admin','middleware'=>['auth','admin']],function(){
    Route::get('/','AdminController@index')->name('admin');
    Route::get('/file-manager',function(){
        return view('backend.layouts.file-manager');
    })->name('file-manager');
    // Banner
    Route::resource('banner','BannerController');
    Route::get('banner','BannerController@index')->name('admin-banner.index');
    Route::post('banner/create','BannerController@create')->name('admin-banner.create');
    Route::post('banner','BannerController@store')->name('admin-banner.store');
    Route::get('banner/{id}', 'BannerController@edit')->name('admin-banner.edit');
    Route::post('banner/{id}', 'BannerController@update')->name('admin-banner.update');
    Route::delete('banner/{id}', 'BannerController@destroy')->name('admin-banner.destroy');
    // Brand
    Route::resource('brand','BrandController');
    Route::get('brand', 'BrandController@index')->name('admin-brand.index');
    Route::post('brand/create', 'BrandController@create')->name('admin-brand.create');
    Route::post('brand', 'BrandController@store')->name('admin-brand.store');
    Route::get('brand/{id}', 'BrandController@edit')->name('admin-brand.edit');
    Route::post('brand/{id}', 'BrandController@update')->name('admin-brand.update');
    Route::delete('brand/{id}', 'BrandController@destroy')->name('admin-brand.destroy');
    // Category
    Route::resource('/category','CategoryController');
    Route::get('category', 'CategoryController@index')->name('admin-category.index');
    Route::post('category/create', 'CategoryController@create')->name('admin-category.create');
    Route::post('category', 'CategoryController@store')->name('admin-category.store');
    Route::get('category/{id}', 'CategoryController@edit')->name('admin-category.edit');
    Route::post('category/{id}', 'CategoryController@update')->name('admin-category.update');
    Route::delete('category/{id}', 'CategoryController@destroy')->name('admin-category.destroy');
    Route::post('category/{id}/child','CategoryController@getChildByParent');
    // Product
    Route::resource('/product','ProductController');
    Route::get('product', 'ProductController@index')->name('admin-product.index');
    Route::post('product/create', 'ProductController@create')->name('admin-product.create');
    Route::post('product', 'ProductController@store')->name('admin-product.store');
    Route::get('product/{id}', 'ProductController@edit')->name('admin-product.edit');
    Route::post('product/{id}', 'ProductController@update')->name('admin-product.update');
    Route::delete('product/{id}', 'ProductController@destroy')->name('admin-product.destroy');
    // Shipping
    Route::resource('/shipping','ShippingController');
    Route::get('shipping', 'ShippingController@index')->name('admin-shipping.index');
    Route::post('shipping/create', 'ShippingController@create')->name('admin-shipping.create');
    Route::post('shipping', 'ShippingController@store')->name('admin-shipping.store');
    Route::get('shipping/{id}', 'ShippingController@edit')->name('admin-shipping.edit');
    Route::post('shipping/{id}', 'ShippingController@update')->name('admin-shipping.update');
    Route::delete('shipping/{id}', 'ShippingController@destroy')->name('admin-shipping.destroy');
    // Order
    Route::resource('/order','OrderController');
    // Message
    Route::resource('/message','MessageController');
    Route::get('/message/five','MessageController@messageFive')->name('messages.five');
    // POST category
    Route::resource('/post-category','PostCategoryController');
    // Post tag
    Route::resource('/post-tag','PostTagController');
    // Post
    Route::resource('/post','PostController');
    // Notification
    Route::get('/notification/{id}','NotificationController@show')->name('admin.notification');
    Route::get('/notifications','NotificationController@index')->name('all.notification');
    Route::delete('/notification/{id}','NotificationController@delete')->name('notification.delete');
    // Coupon
    Route::resource('/coupon','CouponController');
    // user route
    Route::resource('users','UsersController');
    // Profile
    Route::get('/profile','AdminController@profile')->name('admin-profile');
    Route::post('/profile/{id}','AdminController@profileUpdate')->name('profile-update');
    // Settings
    Route::get('settings','AdminController@settings')->name('settings');
    Route::post('setting/update','AdminController@settingsUpdate')->name('settings.update');
    // Password Change
    Route::get('change-password', 'AdminController@changePassword')->name('admin.password.form');
    Route::post('change-password', 'AdminController@changPasswordStore')->name('change.password');
});

// Backend Manager section start
Route::group(['prefix'=>'/manager','middleware'=>['auth','manager']],function(){
    Route::get('/','ManagerController@index')->name('manager');
    // Banner
    Route::resource('banner','BannerController');
    Route::get('banner','BannerController@index')->name('manager-banner.index');
    Route::post('banner/create','BannerController@create')->name('manager-banner.create');
    Route::post('banner','BannerController@store')->name('manager-banner.store');
    Route::get('banner/{id}', 'BannerController@edit')->name('manager-banner.edit');
    Route::post('banner/{id}', 'BannerController@update')->name('manager-banner.update');
    Route::delete('banner/{id}', 'BannerController@destroy')->name('manager-banner.destroy');
    // Brand
    Route::resource('brand','BrandController');
    Route::get('brand', 'BrandController@index')->name('manager-brand.index');
    Route::post('brand/create', 'BrandController@create')->name('manager-brand.create');
    Route::post('brand', 'BrandController@store')->name('manager-brand.store');
    Route::get('brand/{id}', 'BrandController@edit')->name('manager-brand.edit');
    Route::post('brand/{id}', 'BrandController@update')->name('manager-brand.update');
    Route::delete('brand/{id}', 'BrandController@destroy')->name('manager-brand.destroy');
    // Category
    Route::resource('category','CategoryController');
    Route::get('category', 'CategoryController@index')->name('manager-category.index');
    Route::post('category/create', 'CategoryController@create')->name('manager-category.create');
    Route::post('category', 'CategoryController@store')->name('manager-category.store');
    Route::get('category/{id}', 'CategoryController@edit')->name('manager-category.edit');
    Route::post('category/{id}', 'CategoryController@update')->name('manager-category.update');
    Route::delete('category/{id}', 'CategoryController@destroy')->name('manager-category.destroy');
    Route::post('category/{id}/child','CategoryController@getChildByParent');
    // Product
    Route::resource('/product','ProductController');
    Route::get('product', 'ProductController@index')->name('manager-product.index');
    Route::post('product/create', 'ProductController@create')->name('manager-product.create');
    Route::post('product', 'ProductController@store')->name('manager-product.store');
    Route::get('product/{id}', 'ProductController@edit')->name('manager-product.edit');
    Route::post('product/{id}', 'ProductController@update')->name('manager-product.update');
    Route::delete('product/{id}', 'ProductController@destroy')->name('manager-product.destroy');
    // Shipping
    Route::resource('/shipping','ShippingController');
    Route::get('shipping', 'ShippingController@index')->name('manager-shipping.index');
    Route::post('shipping/create', 'ShippingController@create')->name('manager-shipping.create');
    Route::post('shipping', 'ShippingController@store')->name('manager-shipping.store');
    Route::get('shipping/{id}', 'ShippingController@edit')->name('manager-shipping.edit');
    Route::post('shipping/{id}', 'ShippingController@update')->name('manager-shipping.update');
    Route::delete('shipping/{id}', 'ShippingController@destroy')->name('manager-shipping.destroy');
    // Order
    Route::resource('/order','OrderController');
    // Message
    Route::resource('/message','MessageController');
    Route::get('/message/five','MessageController@messageFive')->name('messages.five');
    // POST category
    Route::resource('/post-category','PostCategoryController');
    // Post tag
    Route::resource('/post-tag','PostTagController');
    // Post
    Route::resource('/post','PostController');
    // Notification
    Route::get('/notification/{id}','NotificationController@show')->name('manager.notification');
    Route::get('/notifications','NotificationController@index')->name('all.notification');
    Route::delete('/notification/{id}','NotificationController@delete')->name('notification.delete');
    // Profile
    Route::get('/profile','ManagerController@profile')->name('manager-profile');
    Route::post('/profile/{id}','ManagerController@profileUpdate')->name('profile-update');
    // Password Change
    Route::get('change-password', 'ManagerController@changePassword')->name('manager.password.form');
    Route::post('change-password', 'ManagerController@changPasswordStore')->name('change.password');
});


// User section start
Route::group(['prefix'=>'/user','middleware'=>['user']],function(){
    Route::get('/','HomeController@index')->name('user');
     // Profile
     Route::get('/profile','HomeController@profile')->name('user-profile');
     Route::post('/profile/{id}','HomeController@profileUpdate')->name('user-profile-update');
    //  Order
    Route::get('/order',"HomeController@orderIndex")->name('user.order.index');
    Route::get('/order/show/{id}',"HomeController@orderShow")->name('user.order.show');
    Route::delete('/order/delete/{id}','HomeController@userOrderDelete')->name('user.order.delete');
    // Product Review
    Route::get('/user-review','HomeController@productReviewIndex')->name('user.productreview.index');
    Route::delete('/user-review/delete/{id}','HomeController@productReviewDelete')->name('user.productreview.delete');
    Route::get('/user-review/edit/{id}','HomeController@productReviewEdit')->name('user.productreview.edit');
    Route::patch('/user-review/update/{id}','HomeController@productReviewUpdate')->name('user.productreview.update');
    
    // Post comment
    Route::get('user-post/comment','HomeController@userComment')->name('user.post-comment.index');
    Route::delete('user-post/comment/delete/{id}','HomeController@userCommentDelete')->name('user.post-comment.delete');
    Route::get('user-post/comment/edit/{id}','HomeController@userCommentEdit')->name('user.post-comment.edit');
    Route::patch('user-post/comment/udpate/{id}','HomeController@userCommentUpdate')->name('user.post-comment.update');
    
    // Password Change
    Route::get('change-password', 'HomeController@changePassword')->name('user.change.password.form');
    Route::post('change-password', 'HomeController@changPasswordStore')->name('change.password');

});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});