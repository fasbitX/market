

<?php $__env->startSection('title'); ?>

<?php echo e($title->value); ?> | Mining

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset("public/css/pages/icon.css")); ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset("public/vendors/themify/css/themify-icons.css")); ?>" />
    <!-- Plugin styles-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset("public/vendors/ionicons/css/ionicons.min.css")); ?>" />
             
<style type="text/css">
    #chartdiv {
      width: 80%;
      height: 500px;
    }
       div.fluid-container {
    padding-left: 50px;
    padding-right: 42px;
}
img.single-img-pro {
    /*margin-top: -560px;*/
        padding-top: 25px;
}
img.single-img-pro {
        padding-top: 50px;
}
@media  only screen and (max-width: 766px) {
.hide-add-div {
    display: none !important;
}
div.fluid-container {
    padding-left: 30px;
    padding-right: 30px;
}
div.min-add-div {
    width: 100% !important;
}
}
</style>                       

<div id="" class="container">
 <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 min-add-div" style="display: inline-block;width: auto;">   

<?php if($ads->status == 1): ?>
<img class="banner-img" src="<?php echo e(url('/')); ?>/public/ad.jpg">
<?php endif; ?>

<div class="outer">
                <div class="r">
                    <div class="row">

                        <div class="col-lg-12">

                            <div class="">
                                <div class="">
                                    <h5><strong>Mining</strong></h5>
                                    <br>
                                </div>
                                <div class="">
                                    <div class="table-responsive mining-table">
                                        <table class="table" id="sample_1">
                                                              <thead class="flip-content" style="background-color: #eeeeee;">
                                                            <tr> 
                                                              <th>Image</th> 
                                                              <th>Name</th> 
                                                              <th>Company</th> 
                                                              <th>Recommended</th> 
                                                              <th>Algorithm</th>  
                                                              <th>HashesPerSecond</th> 
                                                              <th>Cost</th> 
                                                              <th>Currency</th> 
                                                              
                                                            </tr>
                                                          </thead> 
                                                          <tbody>
                                                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                              <td>
                                                                <img src="https://www.cryptocompare.com<?php echo e($d->LogoUrl); ?>" height="50" width="50">
                                                              </td>
                                                              <td><?php echo e($d->Name); ?></td>
                                                              <td><?php echo e($d->Company); ?></td>
                                                              <td>
                                                                <?php if($d->Recommended): ?>
                                                                <div style="width: 55px;max-width: 55px;background-color:#57bd0f!important;color: #fff;border-radius: 30px; font-size: 0.8em;padding:5px 5px;display: inline-block;text-align:center;padding-bottom:3px;"><span>Yes</span></div>
                                                                <?php else: ?>
                                                                <div style="width: 55px;max-width: 55px;background-color:#ed5565!important;color: #fff;border-radius: 30px; font-size: 0.8em;padding:5px 5px;display: inline-block;text-align:center;padding-bottom:3px;"><span>No</span></div>
                                                                <?php endif; ?>
       
                                                              </td>
                                                              
                                                              <td><?php echo e($d->Algorithm); ?></td>
                                                              <td><?php echo e($d->HashesPerSecond); ?></td>
                                                              <td><?php echo e($d->Cost); ?></td>
                                                              <td><?php echo e($d->Currency); ?></td>
                                                            </tr>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                          </tbody>
                                                        </table>

                                                        <div style="float: right;">

                    <button class="btn pagination-btn" onclick="window.location.href='?start=1'">
                      First
                    </button>
                    <?php $pre = ($current - 1) * 10; if($current != 1){ ?>
                    <button class="btn pagination-btn" onclick="window.location.href='?start=<?php echo $pre; ?>'">
                      Previous
                    </button>
                  <?php } ?>

                          <?php for($i = $current+1; $i <= $end; $i++ ){ $j = $i - 1;  ?>
                            
                            <?php if($i <= $count){ ?>
                            <button class="btn pagination-btn" onclick="window.location.href='?start=<?php echo $i*10; ?>'">
                            <?php echo $i; ?>
                          </button>
                        <?php } ?>
                            <?php } ?>

                          <?php $nex = ($current+1)*10; if($current <= $count){?>
                          <button class="btn pagination-btn" onclick="window.location.href='?start=<?php echo $nex; ?>'">
                            Next
                          </button>
                        <?php } ?>
                          <button class="btn pagination-btn" onclick="window.location.href='?start=<?php echo 160; ?>'">
                            Last
                          </button>
                                                        </div>
                                        <!-- nav-tabs-custom -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.inner -->
            </div>
          </div>
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 hide-add-div" style="display: inline-block;width: auto;">
                
                <img src="<?php echo e(url('/')); ?>/public/add-bg.jpg" class="single-img-pro"> 
                <img src="<?php echo e(url('/')); ?>/public/add-bg1.jpg" class="single-img-pro"> 
            </div>
          </div>
        </div>
    
<script src="<?php echo e(URL::asset("public/pages/icons.js")); ?>"></script>


<?php $__env->stopSection(); ?>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5afec5426d44f1e2"></script>
<?php echo $__env->make('Layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>