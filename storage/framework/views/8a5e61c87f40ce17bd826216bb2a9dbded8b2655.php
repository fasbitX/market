

<?php $__env->startSection('title'); ?>

<?php echo e($title->value); ?> dashboard

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset("public/css/pages/icon.css")); ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset("public/vendors/themify/css/themify-icons.css")); ?>" />
    <!-- Plugin styles-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset("public/vendors/ionicons/css/ionicons.min.css")); ?>" />

  <style type="text/css">
    h6{
      color:#446220;
    }
  </style>                    

<div id="wrap">
<div class="wrapper">
<div id="content" class="bg-container">
<div class="outer">
                <div class="inner bg-light lter bg-container">
                    <div class="row">

                        <div class="col-lg-12">

                            <div class="card">
                                <div class="card-header bg-white">
                                    ICO
                                    <button type="button" 
                                    class="btn btn-labeled btn-secondary right_btn_padding_left" style="float: right;border: 1px solid #3c6708">
                                                <span class="btn-label btn_angle_left">
                                                    <i class="fa fa-plus"></i>
                                                </span>
                                                     <a href="<?php echo e(url('/')); ?>/admin/new_ico">  Add new <a>
                                                   </button>
                                </div>
                                <div class="card-block m-t-35">
                                    <table class="table table-bordered table-striped flip-content"> 
                                      <thead class="flip-content">
                                        <tr> 
                                          <th>ICO</th> 
                                          <th>Image</th> 
                                          <th>Category</th> 
                                          <th>Short Description</th> 
                                          <th>Link</th> 
                                          <th>Start_date</th> 
                                          <th>End_date</th> 
                                          <!-- <th>Action</th>  -->
                                        </tr>
                                      </thead> 
                                      <tbody>
                                        <?php $__currentLoopData = $ico; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                          <td style="width:150px;">
                                            <span>
                                              <?php echo e($data->title); ?>

                                            </span>
                                            <br>
                                            <?php if($data->rating == 5 ): ?>

                                                               <span class="col-12 ion_icon">
                                                                <i class="ion-star " style="color:#f39c12;font-size: 22px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 22px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 22px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 22px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 22px"></i>
                                                                 </span>
                                                                 <?php elseif($data->rating == 4): ?>
                                                               <span class="col-12 ion_icon">
                                                                <i class="ion-star " style="color:#f39c12;font-size: 22px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 22px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 22px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 22px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 22px"></i>
                                                                 </span>
                                                                 <?php elseif($data->rating == 3): ?>
                                                               <span class="col-12 ion_icon">
                                                                <i class="ion-star " style="color:#f39c12;font-size: 22px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 22px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 22px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 22px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 22px"></i>
                                                                 </span>
                                                                 <?php elseif($data->rating == 2): ?>
                                                               <span class="col-12 ion_icon">
                                                                <i class="ion-star " style="color:#f39c12;font-size: 22px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 22px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 22px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 22px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 22px"></i>
                                                                 </span>
                                                                 <?php elseif($data->rating == 1): ?>
                                                               <span class="col-12 ion_icon">
                                                                <i class="ion-star " style="color:#f39c12;font-size: 22px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 22px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 22px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 22px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 22px;"></i>
                                                                 </span>
                                                               <?php endif; ?>
                                                             </td>
                                          <td>
                                            <img src="<?php echo e(IMAGE_BASE_URL); ?><?php echo e($data->image_url); ?>" height="70" width="70">
                                          </td>
                                          <td><?php echo e($data->category); ?></td>
                                          <td style="width:150px;">
                                            <?php echo e($data->short_description); ?></td>
                                          <td >
                                            <a href="<?php echo e($data->website); ?>">
                                              <i class="fa fa-2x fa-globe" style="font-size: 1em;color: #8dc647;" ></i>
                                            </a>
                                            <a href="<?php echo e($data->whitepaper); ?>" >
                                              <i class="fa fa-2x fa-file" style="font-size: 1em;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->twitter); ?>" >
                                              <i class="fa fa-2x fa-twitter" aria-hidden="true" style="font-size: 1em;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->youtube); ?>">
                                              <i class="fa fa-2x fa-youtube" aria-hidden="true" style="font-size: 1em;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->facebook); ?>" >
                                              <i class="fa fa-2x fa-facebook-square" aria-hidden="true" style="font-size: 1em;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->slack); ?> ">
                                              <i class="fa fa-2x fa-slack" aria-hidden="true" style="font-size: 1em;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->linkedin); ?>">
                                              <i class="fa fa-2x fa-linkedin" aria-hidden="true" style="font-size: 1em;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->github); ?>" >
                                              <i class="fa fa-2x fa-github" aria-hidden="true" style="font-size: 1em;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->telegram); ?>">
                                              <i class="fa fa-2x fa-telegram" aria-hidden="true" style="font-size: 1em;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->reddit); ?>">
                                              <i class="fa fa-2x fa-reddit" aria-hidden="true" style="font-size: 1em;color: #8dc647;"></i>
                                            </a>
                                          </td>
                                          <td><?php echo e($data->start_date); ?></td>
                                          <td>
                                            <?php 
                                            $cur_date = date("Y-m-d");
                                            $date1=date_create($cur_date);
                                            $date2=date_create($data->end_date);
                                            $diff=date_diff($date1,$date2);
                                            echo $diff->format("%R%a days");
                                            ?>
                                            
                                          </td>
                                          <!-- <td><a href="<?php echo e(url('/')); ?>/delete_ico/<?php echo e($data->id); ?>">DELETE</a></td> -->
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.inner -->
            </div>
        </div>
    </div>
</div>


<script src="<?php echo e(URL::asset("public/pages/icons.js")); ?>"></script>
<!-- Modal -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>