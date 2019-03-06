<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="img/logo1.ico"/>
    <?php echo $__env->yieldContent('meta'); ?>
    <!-- global styles-->
    <!-- <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset("public/css/components.css")); ?>" /> -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset("public/css/custom.css")); ?>" />
    <!--end of global styles-->
    <!--plugin styles-->
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset("public/vendors/select2/css/select2.min.css")); ?>"/>
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset("public/vendors/datatables/css/dataTables.bootstrap.min.css")); ?>"/>
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset("public/css/pages/dataTables.bootstrap.css")); ?>"/>

    <!-- end of plugin styles -->
    <!--Page level styles-->
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset("public/css/pages/tables.css")); ?>"/>
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset("public/css/pages/form_elements.css")); ?>"/>
    <link type="text/css" rel="stylesheet" href="#" id="skin_change"/>
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset('public/vendors/bootstrapvalidator/css/bootstrapValidator.min.css')); ?>"/>
     <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.css"/>
    
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset('public/vendors/c3/css/c3.min.css')); ?>"/>
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset('public/vendors/toastr/css/toastr.min.css')); ?>"/>
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset('public/vendors/switchery/css/switchery.min.css')); ?>"/>
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset('public/css/pages/new_dashboard.css')); ?>"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js") }}"></script>
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
    </div>
</div>
<!-- /#wrap -->


<!-- global scripts-->

<!-- <script type="text/javascript" src="<?php echo e(URL::asset("public/js/components.js")); ?>"></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->

<!-- <script type="text/javascript" src="<?php echo e(URL::asset("public/js/custom.js")); ?>"></script> -->

<!-- end of global scripts-->
<!-- plugin scripts -->
<script type="text/javascript" src="<?php echo e(URL::asset("public/vendors/select2/js/select2.js")); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset("public/vendors/datatables/js/jquery.dataTables.min.js")); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset("public/vendors/datatables/js/dataTables.bootstrap.min.js")); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('public/vendors/bootstrapvalidator/js/bootstrapValidator.min.js')); ?>"></script>
<!-- end plugin scripts -->

<!-- global scripts-->
<script type="text/javascript" src="<?php echo e(URL::asset("public/js/components.js")); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset("public/js/custom.js")); ?>"></script>
<!-- global scripts end-->
<script type="text/javascript" src="<?php echo e(URL::asset("public/vendors/slimscroll/js/jquery.slimscroll.min.js")); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset("public/vendors/raphael/js/raphael-min.js")); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset("public/vendors/d3/js/d3.min.js")); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset("public/vendors/c3/js/c3.min.js")); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset("public/vendors/toastr/js/toastr.min.js")); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset("public/vendors/switchery/js/switchery.min.js")); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset("public/vendors/flotchart/js/jquery.flot.js")); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset("public/vendors/flotchart/js/jquery.flot.resize.js")); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset("public/vendors/flotchart/js/jquery.flot.stack.js")); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset("public/vendors/flotchart/js/jquery.flot.time.js")); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset("public/vendors/flotspline/js/jquery.flot.spline.min.js")); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset("public/vendors/flotchart/js/jquery.flot.categories.js")); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset("public/vendors/flotchart/js/jquery.flot.pie.js")); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset("public/vendors/flot.tooltip/js/jquery.flot.tooltip.min.js")); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset("public/vendors/jquery_newsTicker/js/newsTicker.js")); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset("public/vendors/countUp.js/js/countUp.min.js")); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset("public/js/pages/datatable.js")); ?>"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.js"></script>
<script type="text/javascript">
  $('#example1').data();
  $("a.grouped_elements").fancybox();
</script>
<!--end of plugin scripts-->
<?php echo $__env->yieldContent('scripts'); ?>
</body>
<?php echo $__env->make('Includes.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script type="text/javascript">
  $(".histoTitleConverter").hide();
</script>
</html>