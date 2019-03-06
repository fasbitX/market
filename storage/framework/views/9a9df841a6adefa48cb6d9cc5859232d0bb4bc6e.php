<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="img/logo1.ico"/>
    <!-- global styles-->
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset("public/css/components.css")); ?>" />
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!--End of page level styles-->

</head>

<style>
th{
  background: #e7e7e7;
  height: 60px;
  font-weight: bold;
  color:#2f5da8;
  font-size: 20px;
}
table{
  font-size: 15px;
}
td:hover{
    font-weight: bold;
  color:#2f5da8;
}
  .hignlight_fst
  {
     font-weight: bold;
  color:#2f5da8;font-size: 20px;
   
  }
     .newsDiv {
   
    height: 7em;       /* height is 2x line-height, so two lines will display */
    overflow: hidden;  /* prevents extra lines from being visible */
}
th{
  color:rgb(66, 139, 202);
}
.highlgt{
   color:rgb(66, 139, 202);
   font-weight: bold;
  }
  
td:hover{
   color:rgb(66, 139, 202);
   font-weight: bold;

}
tr:hover {
    background: #F8F9F8;
}
   </style>

<body>
<div class="preloader" style=" position: fixed;
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
</div>
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

<script type="text/javascript" src="<?php echo e(URL::asset("public/js/components.js")); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset("public/js/custom.js")); ?>"></script>

<!-- end of global scripts-->
<!-- plugin scripts -->
<script type="text/javascript" src="<?php echo e(URL::asset("public/vendors/select2/js/select2.js")); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset("public/vendors/datatables/js/jquery.dataTables.min.js")); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset("public/vendors/datatables/js/dataTables.bootstrap.min.js")); ?>"></script>
<!-- end plugin scripts -->

</body>
<?php echo $__env->make('Includes.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</html>