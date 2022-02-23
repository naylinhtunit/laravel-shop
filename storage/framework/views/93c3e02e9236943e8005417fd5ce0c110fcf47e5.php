<!-- Meta Tag -->
<?php echo $__env->yieldContent('meta'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<!-- Title Tag  -->
<title><?php echo $__env->yieldContent('title'); ?></title>
<!-- Favicon -->
<link rel="icon" type="image/ico" href="<?php echo e(asset('images/favicon.ico')); ?>">
<!-- Web Font -->
<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

<!-- StyleSheet -->
<link rel="manifest" href="/manifest.json">
<!-- Bootstrap -->
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/bootstrap.min.css')); ?>">
<!-- Magnific Popup -->
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/magnific-popup.min.css')); ?>">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/font-awesome.css')); ?>">



<!-- Fancybox -->
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/jquery.fancybox.min.css')); ?>">
<!-- Themify Icons -->
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/themify-icons.css')); ?>">
<!-- Animate CSS -->
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/animate.css')); ?>">
<!-- Flex Slider CSS -->
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/flex-slider.min.css')); ?>">
<!-- Owl Carousel -->
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/owl-carousel.css')); ?>">
<!-- Slicknav -->
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/slicknav.min.css')); ?>">
<!-- Jquery Ui -->
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/jquery-ui.css')); ?>">
<!-- Select 2 -->
<link rel="stylesheet" href="<?php echo e(asset('frontend/js/select2/css/select2.css')); ?>">

<!-- Eshop StyleSheet -->
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/reset.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/style.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/responsive.css')); ?>">
<style>
    /* Multilevel dropdown */
    .dropdown-submenu {
    position: relative;
    }

    .dropdown-submenu>a:after {
    content: "\f0da";
    float: right;
    border: none;
    font-family: 'FontAwesome';
    }

    .dropdown-submenu>.dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: 0px;
    margin-left: 0px;
    }

    /*
</style>
<?php echo $__env->yieldPushContent('styles'); ?>
<?php /**PATH C:\Users\NL\Documents\Applications\laravel-shop\resources\views/frontend/layouts/head.blade.php ENDPATH**/ ?>