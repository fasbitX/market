

<?php $__env->startSection('title'); ?>


Initial Coin Offering ( ICO ) list and Calendar

<?php $__env->stopSection(); ?>

<?php $__env->startSection('meta'); ?>

<meta name="title" content=" Initial Coin Offering ( ICO ) list and Calender">
<meta name="description" content=" ICO ( Initial Coin Offering ) companies list and calendar with all related investment details">
<meta name="keywords" content=" ICO list, Initial Coin Offering, Details, Upcoming, Invest">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  
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
        max-width: 100%;
}
td {
    font-size: 14px !important;
}
th {
    font-size: 14px !important;
}
a.nav-link {
    font-size: 14px !important;
    font-weight: 600;
}
</style>                       

<div id="">
<div class="">
<div id="" class="container">
<div class="row">
                <div class="col-md-10 col-sm-10 col-xs-12">


<div class="outer">
                <div class="r">
                    <div class="row">

                        <div class="col-lg-12">

                            <div class="">
                                <div class="">
                                    <br>

                                    <h5><strong>ICO</strong></h5>
                                    <br>
                                </div>
                                <div class="">
                                    <div>
                                        <div class="nav-tabs-custom tabs-single ico-table">
                                            <ul class="nav nav-tabs">
                                                <li class="nav-item">
                                                    <a href="#tab_1" class="nav-link active" data-toggle="tab">Upcoming</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#tab_2" class="nav-link" data-toggle="tab">Ongoing</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#tab_3" class="nav-link" data-toggle="tab">Ended</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">

                                                <div class="tab-pane active" id="tab_1">
                                                    <div class="row no-gutters">
                                                      
                                                        <div class="full-width">
                                                        <div class="m-t-35 table-responsive">
                                                          <table class="table table-bordered table-striped">
                                                              <thead class="flip-content">
                                                            <tr> 
                                                              <th>ICO</th> 
                                                              <th>Image</th> 
                                                              <th>Category</th> 
                                                              <th>Short Description</th>  
                                                              <th>Timeline</th> 
                                                              <th>
                                                                <i class="fa fa-2x fa-telegram" aria-hidden="true"></i></th>
                                                              <th>
                                                                <i class="fa fa-2x fa-reddit" aria-hidden="true"></i>
                                                              </th>
                                                              <th><i class="fa fa-2x fa-twitter" aria-hidden="true"></i>
                                                              </th>
                                                              <th>
                                                                <i class="fa fa-2x fa-youtube" aria-hidden="true"></i>
                                                              </th>
                                                              <th>
                                                                <i class="fa fa-2x fa-linkedin" aria-hidden="true"></i>
                                                              </th>
                                                              <th width="200">Social Links</th> 
                                                            </tr>
                                                          </thead> 
                                                          <tbody>
                                                            <?php $__currentLoopData = $upcoming; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                              <td><a href="<?php echo e(url('/')); ?>/ico_view/<?php echo e($data->id); ?>"><?php echo e($data->title); ?></a>
                                                                <br>
                                                                <?php if($data->rating == 5): ?>
                                                               <span class="col-12 ion_icon">
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                 </span>
                                                                 <?php elseif($data->rating == 4): ?>
                                                               <span class="col-12 ion_icon">
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 12px"></i>
                                                                 </span>
                                                                 <?php elseif($data->rating == 3): ?>
                                                               <span class="col-12 ion_icon">
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 12px"></i>
                                                                 </span>
                                                                 <?php elseif($data->rating == 2): ?>
                                                               <span class="col-12 ion_icon">
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 12px"></i>
                                                                 </span>
                                                                 <?php elseif($data->rating == 1): ?>
                                                               <span class="col-12 ion_icon">
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 12px;"></i>
                                                                 </span>
                                                                 <?php endif; ?>
                                                                
                                                                  </td>
                                                              <td>
                                                                <img src="<?php echo e(IMAGE_BASE_URL); ?><?php echo e($data->image_url); ?>" height="50" width="50">
                                                              </td>
                                                              <td><?php echo e($data->category); ?></td>
                                                              <td style="max-width: 168px;min-width: 180px;"><?php echo e($data->short_description); ?></td>
                                                              <td>

                                                               <?php 
                                                              $cur_date = date("Y-m-d");
                                                              $date1=date_create($cur_date);
                                                              $date2=date_create($data->start_date);
                                                              $diff=date_diff($date1,$date2);
                                                              //echo $diff->format("%R%a days");
                                                              ?> 
                                          <div id="progress-bar">
                                            <div class="progress">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 52%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100">
                                                  
                                                <?php echo $diff->format("%R%a days"); ?> to start.
                                                </div>
                                            </div><?php echo e($data->start_date); ?> to <?php echo e($data->end_date); ?>

                                                              </td>
                                                              <td> <?php if($data->telegram_follow != "" ): ?>
                                                                <?php echo e($data->telegram_follow); ?>

                                                                 <?php else: ?>
                                                                    --
                                                               <?php endif; ?>
                                                              </td>
                                                              <td><?php if($data->reddit_follow != "" ): ?> <?php echo e($data->reddit_follow); ?> <?php else: ?> -- <?php endif; ?> </td>
                                                              <td><?php if($data->twitter_follow != "" ): ?> <?php echo e($data->twitter_follow); ?> <?php else: ?> --
                                                              <?php endif; ?></td>
                                                              <td><?php if($data->youtube_follow != "" ): ?> <?php echo e($data->youtube_follow); ?> <?php else: ?> -- <?php endif; ?> </td>
                                                              <td><?php if($data->linkedin_follow != "" ): ?> <?php echo e($data->linkedin_follow); ?> <?php else: ?> -- <?php endif; ?> </td> 
                                                              <td>
                                                <a href="<?php echo e($data->website); ?>">
                                              <i class="fa fa-2x fa-globe"  style="font-size: 1.4em;margin-bottom: 10px;margin-right:10px;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->whitepaper); ?>">
                                              <i class="fa fa-2x fa-file"  style="font-size: 1.4em;margin-bottom: 10px;margin-right:10px;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->twitter); ?>">
                                              <i class="fa fa-2x fa-twitter" aria-hidden="true"  style="font-size: 1.4em;margin-bottom: 10px;margin-right:10px;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->youtube); ?>">
                                              <i class="fa fa-2x fa-youtube" aria-hidden="true" style="font-size: 1.4em;margin-bottom: 10px;margin-right:10px;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->facebook); ?>">
                                              <i class="fa fa-2x fa-facebook-square" aria-hidden="true" style="font-size: 1.4em;margin-bottom: 10px;margin-right:10px;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->slack); ?>">
                                              <i class="fa fa-2x fa-slack" aria-hidden="true" style="font-size: 1.4em;margin-bottom: 10px;margin-right:10px;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->linkedin); ?>">
                                              <i class="fa fa-2x fa-linkedin" aria-hidden="true"  style="font-size: 1.4em;margin-bottom: 10px;margin-right:10px;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->github); ?>">
                                              <i class="fa fa-2x fa-github" aria-hidden="true"  style="font-size: 1.4em;margin-bottom: 10px;margin-right:10px;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->telegram); ?>">
                                              <i class="fa fa-2x fa-telegram" aria-hidden="true"  style="font-size: 1.4em;margin-bottom: 10px;margin-right:10px;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->reddit); ?>">
                                              <i class="fa fa-2x fa-reddit" aria-hidden="true"  style="font-size: 1.4em;margin-bottom: 10px;margin-right:10px;color: #8dc647;"></i>
                                            </a>
                                                              </td>
                                                            </tr>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                          </tbody>
                                                        </table>
                                                    </div>
                                                    </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane" id="tab_2">
                                                    <div class="row no-gutters">
                                                        
                                                      <div class="full-width">
                                                        <div class="m-t-35 table-responsive">
                                                          <table class="table table-bordered table-striped flip-content">
                                                              <thead class="flip-content">
                                                            <tr> 
                                                              <th>ICO</th> 
                                                              <th>Image</th> 
                                                              <th>Category</th> 
                                                              <th>Short Description</th>  
                                                              <th>Timeline</th> 
                                                              <th><i class="fa fa-2x fa-telegram" aria-hidden="true"></i></th>
                                                              <th><i class="fa fa-2x fa-reddit" aria-hidden="true"></i></th>
                                                              <th><i class="fa fa-2x fa-twitter" aria-hidden="true"></i></th>
                                                              <th><i class="fa fa-2x fa-youtube" aria-hidden="true"></i></th>
                                                              <th><i class="fa fa-2x fa-linkedin" aria-hidden="true"></i></th>
                                                              <th width="200">Social Links</th> 
                                                            </tr>
                                                          </thead> 
                                                          <tbody>
                                                            <?php $__currentLoopData = $current; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                                
                                                              <td><a href="<?php echo e(url('/')); ?>/ico_view/<?php echo e($data->id); ?>"><?php echo e($data->title); ?></a>
                                                               <br>
                                                                <?php if($data->rating == 5): ?>
                                                               <span class="col-12 ion_icon">
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                 </span>
                                                                 <?php elseif($data->rating == 4): ?>
                                                               <span class="col-12 ion_icon">
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 12px"></i>
                                                                 </span>
                                                                 <?php elseif($data->rating == 3): ?>
                                                               <span class="col-12 ion_icon">
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 12px"></i>
                                                                 </span>
                                                                 <?php elseif($data->rating == 2): ?>
                                                               <span class="col-12 ion_icon">
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 12px"></i>
                                                                 </span>
                                                                 <?php elseif($data->rating == 1): ?>
                                                               <span class="col-12 ion_icon">
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 12px;"></i>
                                                                 </span>
                                                                 <?php endif; ?>
                                                                 </td>
                                                              <td>
                                                                <img src="<?php echo e(IMAGE_BASE_URL); ?><?php echo e($data->image_url); ?>" height="50" width="50">
                                                              </td>
                                                              <td><?php echo e($data->category); ?></td>
                                                              <td style="max-width: 168px;min-width: 180px;"><?php echo e($data->short_description); ?></td>
                                                              <td>
                                                                <?php 
                                            $cur_date = date("Y-m-d");
                                            $date1=date_create($cur_date);
                                            $date2=date_create($data->end_date);
                                            $diff=date_diff($date1,$date2);
                                            
                                            ?>
                                            <div id="progress-bar">
                                            <div class="progress">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 52%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100">
                                                  
                                                <?php echo $diff->format("%R%a days"); ?> to end.
                                                </div>
                                            </div><?php echo e($data->start_date); ?> - <?php echo e($data->end_date); ?>

                                                              </td>
                                                              <td> <?php if($data->telegram_follow != "" ): ?>
                                                                <?php echo e($data->telegram_follow); ?>

                                                                 <?php else: ?>
                                                                    --
                                                               <?php endif; ?>
                                                              </td>
                                                              <td><?php if($data->reddit_follow != "" ): ?> <?php echo e($data->reddit_follow); ?> <?php else: ?> -- <?php endif; ?> </td>
                                                              <td><?php if($data->twitter_follow != "" ): ?> <?php echo e($data->twitter_follow); ?> <?php else: ?> --
                                                              <?php endif; ?></td>
                                                              <td><?php if($data->youtube_follow != "" ): ?> <?php echo e($data->youtube_follow); ?> <?php else: ?> -- <?php endif; ?> </td>
                                                              <td><?php if($data->linkedin_follow != "" ): ?> <?php echo e($data->linkedin_follow); ?> <?php else: ?> -- <?php endif; ?> </td> 
                                                              <td>
                                                                <a href="<?php echo e($data->website); ?>">
                                              <i class="fa fa-2x fa-globe"  style="font-size: 1.4em;margin-bottom: 10px;margin-right:10px;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->whitepaper); ?>">
                                              <i class="fa fa-2x fa-file"  style="font-size: 1.4em;margin-bottom: 10px;margin-right:10px;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->twitter); ?>">
                                              <i class="fa fa-2x fa-twitter" aria-hidden="true"  style="font-size: 1.4em;margin-bottom: 10px;margin-right:10px;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->youtube); ?>">
                                              <i class="fa fa-2x fa-youtube" aria-hidden="true"  style="font-size: 1.4em;margin-bottom: 10px;margin-right:10px;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->facebook); ?>">
                                              <i class="fa fa-2x fa-facebook-square" aria-hidden="true"  style="font-size: 1.4em;margin-bottom: 10px;margin-right:10px;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->slack); ?>">
                                              <i class="fa fa-2x fa-slack" aria-hidden="true" style="font-size: 1.4em;margin-bottom: 10px;margin-right:10px;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->linkedin); ?>">
                                              <i class="fa fa-2x fa-linkedin" aria-hidden="true"  style="font-size: 1.4em;margin-bottom: 10px;margin-right:10px;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->github); ?>">
                                              <i class="fa fa-2x fa-github" aria-hidden="true"  style="font-size: 1.4em;margin-bottom: 10px;margin-right:10px;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->telegram); ?>">
                                              <i class="fa fa-2x fa-telegram" aria-hidden="true"  style="font-size: 1.4em;margin-bottom: 10px;margin-right:10px;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->reddit); ?>">
                                              <i class="fa fa-2x fa-reddit" aria-hidden="true"  style="font-size: 1.4em;margin-bottom: 10px;margin-right:10px;color: #8dc647;"></i>
                                            </a>
                                                              </td>
                                                            </tr>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                          </tbody>
                                                        </table>
                                                </div>
                                              </div>
                                                    </div>
                                                    <!-- /thumnail helper gallery -->
                                                </div>

                                                <!-- /standard gallery -->
                                                <div class="tab-pane" id="tab_3">
                                                    <div class="row no-gutters">
                                                         
                                                     <div class="full-width">
                                                        <div class="m-t-35 table-responsive">
                                                          <table class="table table-bordered table-striped flip-content">
                                                              <thead class="flip-content">
                                                            <tr>  
                                                              <th>ICO</th> 
                                                              <th>Image</th> 
                                                              <th>Category</th> 
                                                              <th>Short Description</th>  
                                                              <th>Timeline</th>
                                                              <th><i class="fa fa-2x fa-telegram" aria-hidden="true"></i></th>
                                                              <th><i class="fa fa-2x fa-reddit" aria-hidden="true"></i></th>
                                                              <th><i class="fa fa-2x fa-twitter" aria-hidden="true"></i></th>
                                                              <th><i class="fa fa-2x fa-youtube" aria-hidden="true"></i></th>
                                                              <th><i class="fa fa-2x fa-linkedin" aria-hidden="true"></i></th> 
                                                              <th width="200">Social Links</th>
                                                            </tr>
                                                          </thead> 
                                                          <tbody>
                                                            <?php $__currentLoopData = $ended; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                              <td><a href="<?php echo e(url('/')); ?>/ico_view/<?php echo e($data->id); ?>"><?php echo e($data->title); ?></a>
                                                                <br>
                                                                <?php if($data->rating == 5): ?>
                                                               <span class="col-12 ion_icon">
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                 </span>
                                                                 <?php elseif($data->rating == 4): ?>
                                                               <span class="col-12 ion_icon">
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 12px"></i>
                                                                 </span>
                                                                 <?php elseif($data->rating == 3): ?>
                                                               <span class="col-12 ion_icon">
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 12px"></i>
                                                                 </span>
                                                                 <?php elseif($data->rating == 2): ?>
                                                               <span class="col-12 ion_icon">
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 12px"></i>
                                                                 </span>
                                                                 <?php elseif($data->rating == 1): ?>
                                                               <span class="col-12 ion_icon">
                                                                <i class="ion-star " style="color:#f39c12;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 12px"></i>
                                                                <i class="ion-star " style="color:#5f635f8f;font-size: 12px;"></i>
                                                                 </span>
                                                                 <?php endif; ?></td>
                                                              <td>
                                                                <img src="<?php echo e(IMAGE_BASE_URL); ?><?php echo e($data->image_url); ?>" height="50" width="50">
                                                              </td>
                                                              <td><?php echo e($data->category); ?></td>
                                                              <td style="max-width: 168px;min-width: 180px;"><?php echo e($data->short_description); ?></td>
                                                              <td>Completed</td>
                                                              <td> <?php if($data->telegram_follow != "" ): ?>
                                                                <?php echo e($data->telegram_follow); ?>

                                                                 <?php else: ?>
                                                                    --
                                                               <?php endif; ?>
                                                              </td>
                                                              <td><?php if($data->reddit_follow != "" ): ?> <?php echo e($data->reddit_follow); ?> <?php else: ?> -- <?php endif; ?> </td>
                                                              <td><?php if($data->twitter_follow != "" ): ?> <?php echo e($data->twitter_follow); ?> <?php else: ?> --
                                                              <?php endif; ?></td>
                                                              <td><?php if($data->youtube_follow != "" ): ?> <?php echo e($data->youtube_follow); ?> <?php else: ?> -- <?php endif; ?> </td>
                                                              <td><?php if($data->linkedin_follow != "" ): ?> <?php echo e($data->linkedin_follow); ?> <?php else: ?> -- <?php endif; ?> </td> <td>
                                                                <a href="<?php echo e($data->website); ?>">
                                              <i class="fa fa-2x fa-globe"  style="font-size: 1.4em;margin-bottom: 10px;margin-right:10px;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->whitepaper); ?>">
                                              <i class="fa fa-2x fa-file"  style="font-size: 1.4em;margin-bottom: 10px;margin-right:10px;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->twitter); ?>">
                                              <i class="fa fa-2x fa-twitter" aria-hidden="true"  style="font-size: 1.4em;margin-bottom: 10px;margin-right:10px;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->youtube); ?>">
                                              <i class="fa fa-2x fa-youtube" aria-hidden="true"  style="font-size: 1.4em;margin-bottom: 10px;margin-right:10px;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->facebook); ?>">
                                              <i class="fa fa-2x fa-facebook-square" aria-hidden="true"  style="font-size: 1.4em;margin-bottom: 10px;margin-right:10px;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->slack); ?>">
                                              <i class="fa fa-2x fa-slack" aria-hidden="true" style="font-size: 1.4em;margin-bottom: 10px;margin-right:10px;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->linkedin); ?>">
                                              <i class="fa fa-2x fa-linkedin" aria-hidden="true"  style="font-size: 1.4em;margin-bottom: 10px;margin-right:10px;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->github); ?>">
                                              <i class="fa fa-2x fa-github" aria-hidden="true"  style="font-size: 1.4em;margin-bottom: 10px;margin-right:10px;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->telegram); ?>">
                                              <i class="fa fa-2x fa-telegram" aria-hidden="true"  style="font-size: 1.4em;margin-bottom: 10px;margin-right:10px;color: #8dc647;"></i>
                                            </a>
                                            <a href="<?php echo e($data->reddit); ?>">
                                              <i class="fa fa-2x fa-reddit" aria-hidden="true"  style="font-size: 1.4em;margin-bottom: 10px;margin-right:10px;color: #8dc647;"></i>
                                            </a>
                                                              </td>
                                                            </tr>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                          </tbody>
                                                        </table>
                                                </div>
                                                </div>
                                                    </div>
                                                </div>
                                                <!-- /thumnail helper gallery -->
                                            </div>
                                            <!-- /.tab-content -->
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

<div class="col-md-2 col-sm-2 col-xs-12 text-center">
                <!-- <img src="https://tpc.googlesyndication.com/simgad/9530178552289300702" class="single-img-pro"> -->
                <img src="<?php echo e(url('/')); ?>/public/add-bg.jpg" class="single-img-pro"> 
            </div>
        </div>
    </div>
</div>
<script src="<?php echo e(URL::asset("public/pages/icons.js")); ?>"></script>
<?php $__env->stopSection(); ?>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5afec5426d44f1e2"></script>
<?php echo $__env->make('Layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>