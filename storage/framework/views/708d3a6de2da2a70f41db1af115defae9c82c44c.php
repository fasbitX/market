<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo e(asset('resources/assets/logo.png')); ?>"/>
    <?php echo $__env->yieldContent('meta'); ?>
    <!-- global styles-->
    <!-- <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset("public/css/components.css")); ?>" /> -->
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset("public/css/bootstrap.min.css")); ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset("public/css/original.css")); ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset("public/css/newcustom.css")); ?>" />
    <!--end of global styles-->
    <!--plugin styles-->
    <!--link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset("public/vendors/select2/css/select2.min.css")); ?>"/-->
    <!--link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset("public/vendors/datatables/css/dataTables.bootstrap.min.css")); ?>"/-->
    <!-- link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset("public/css/pages/dataTables.bootstrap.css")); ?>"/ -->

    <!-- end of plugin styles -->
    <!--Page level styles-->
    <!--link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset("public/css/pages/tables.css")); ?>"/-->
    <!--link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset("public/css/pages/form_elements.css")); ?>"/-->
    <!-- <link type="text/css" rel="stylesheet" href="#" id="skin_change"/>
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset('public/vendors/bootstrapvalidator/css/bootstrapValidator.min.css')); ?>"/>
    
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset('public/vendors/c3/css/c3.min.css')); ?>"/>
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset('public/vendors/toastr/css/toastr.min.css')); ?>"/>
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset('public/vendors/switchery/css/switchery.min.css')); ?>"/>
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset('public/css/pages/new_dashboard.css')); ?>"/> -->
    <script src="<?php echo e(URL::asset('public/js/jquery.min.js')); ?>" ></script>
    <!--End of page level styles-->
</head>

<body>
<!-- <div class="preloader" style=" position: fixed;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  z-index: 100000;
  backface-visibility: hidden;
  background: #ffffff;">
    <div class="preloader_img" style="width: 200px;
  height: 200px;
  position: absolute;
  left: 48%;
  top: 48%;

  background-position: center;
z-index: 999999">
        <img src="<?php echo e(url('/')); ?>/public/img/loader.gif" style=" width: 40px;" alt="loading...">
    </div>
</div> -->
<div id="wrap">
    <div id="top">
        <!-- .navbar -->
        <?php echo $__env->make('Includes.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <!-- /.navbar -->
        <!-- /.head -->
    </div>

    
    <?php echo $__env->yieldContent('content'); ?>
  <div class="bottom">
    <?php echo $__env->make('Includes.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </div>
</div>

<script type="text/javascript" src="<?php echo e(URL::asset("public/js/components.js")); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset("public/js/custom.js")); ?>"></script>
<!-- global scripts end-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.js"></script>
<script type="text/javascript">
  $('#example1').data();
  $("a.grouped_elements").fancybox();
</script>
<!--end of plugin scripts-->
<?php echo $__env->yieldContent('scripts'); ?>
</body>


<script type="text/javascript">
  $(".histoTitleConverter").hide();
</script>
</html>
