<?php $__env->startSection('title'); ?>

Cryptocompare dashboard

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
               
<style type="text/css">
    #chartdiv {
      width: 80%;
      height: 500px;
    }
</style>                       

<div id="wrap">
<div class="wrapper">
<div id="content" class="bg-container">


<?php if($ads->status == 1): ?>
<img src="<?php echo e(url('/')); ?>/public/ad.jpg" style="margin-top: 25px;max-width: 950px;margin-left: 186px;">
<?php endif; ?>

<div class="outer">
                <div class="inner bg-light lter bg-container">
                    <div class="row">

                        <div class="col-lg-12">

                            <div class="card">
                                <div class="card-header bg-white">
                                    ICO
                                </div>
                                <div class="card-block m-t-35">
                                    <div>
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs">
                                                <li class="nav-item" style="min-width: 300px;text-align: center;">
                                                    <a href="#tab_2" class="nav-link active" data-toggle="tab">Upcoming</a>
                                                </li>
                                                <li class="nav-item" style="min-width: 300px;text-align: center;">
                                                    <a href="#tab_1" class="nav-link" data-toggle="tab">On going</a>
                                                </li>
                                                <li class="nav-item" style="min-width: 300px;text-align: center;">
                                                    <a href="#tab_3" class="nav-link" data-toggle="tab">Ended</a>
                                                </li>
                                                
                                            </ul>
                                            <div class="tab-content">
                                                
                                                <div class="tab-pane active gallery-padding" id="tab_2">
                                                    <div class="row no-gutters">
                                                        <table class="table table-bordered table-striped flip-content"> 
                                                          <thead class="flip-content">
                                                            <tr> 
                                                              <th>ICO</th> 
                                                              <th>Image</th> 
                                                              <th>category</th> 
                                                              <th>description</th> 
                                                              <th>start_date</th> 
                                                              <th>end_date</th> 
                                                              <th>Timeline</th> 
                                                              <th>Link</th> 
                                                            </tr>
                                                          </thead> 
                                                          <tbody>
                                                            <?php $__currentLoopData = $upcoming; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                              <td><?php echo e($data->title); ?></td>
                                                              <td>
                                                                <img src="<?php echo e(IMAGE_BASE_URL); ?><?php echo e($data->image_url); ?>" height="100" width="100">
                                                              </td>
                                                              <td><?php echo e($data->category); ?></td>
                                                              <td style="max-width: 168px;min-width: 290px;"><?php echo e($data->description); ?></td>
                                                              <td><?php echo e($data->start_date); ?></td>
                                                              <td><?php echo e($data->end_date); ?></td>
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
                                            </div>
                                                              </td>
                                                              <td>
                                                <a href="<?php echo e($data->website); ?>">
                                              <i class="fa fa-2x fa-globe"></i>
                                            </a>
                                            <a href="<?php echo e($data->whitepaper); ?>">
                                              <i class="fa fa-2x fa-file"></i>
                                            </a>
                                            <a href="<?php echo e($data->twitter); ?>">
                                              <i class="fa fa-2x fa-twitter" aria-hidden="true"></i>
                                            </a>
                                            <a href="<?php echo e($data->youtube); ?>">
                                              <i class="fa fa-2x fa-youtube" aria-hidden="true"></i>
                                            </a>
                                            <a href="<?php echo e($data->facebook); ?>">
                                              <i class="fa fa-2x fa-facebook-square" aria-hidden="true"></i>
                                            </a>
                                            <a href="<?php echo e($data->slack); ?>">
                                              <i class="fa fa-2x fa-slack" aria-hidden="true"></i>
                                            </a>
                                            <a href="<?php echo e($data->linkedin); ?>">
                                              <i class="fa fa-2x fa-linkedin" aria-hidden="true"></i>
                                            </a>
                                            <a href="<?php echo e($data->github); ?>">
                                              <i class="fa fa-2x fa-github" aria-hidden="true"></i>
                                            </a>
                                            <a href="<?php echo e($data->telegram); ?>">
                                              <i class="fa fa-2x fa-telegram" aria-hidden="true"></i>
                                            </a>
                                            <a href="<?php echo e($data->reddit); ?>">
                                              <i class="fa fa-2x fa-reddit" aria-hidden="true"></i>
                                            </a>
                                                              </td>
                                                            </tr>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                          </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="tab-pane gallery2-padding" id="tab_1">
                                                    <table class="table table-bordered table-striped flip-content"> 
                                                          <thead class="flip-content">
                                                            <tr> 
                                                              <th>ICO</th> 
                                                              <th>Image</th> 
                                                              <th>category</th> 
                                                              <th>description</th> 
                                                              <th>start_date</th> 
                                                              <th>end_date</th> 
                                                              <th>Timeline</th> 
                                                              <th>Link</th> 
                                                            </tr>
                                                          </thead> 
                                                          <tbody>
                                                            <?php $__currentLoopData = $current; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                              <td><?php echo e($data->title); ?></td>
                                                              <td>
                                                                <img src="<?php echo e(IMAGE_BASE_URL); ?><?php echo e($data->image_url); ?>" height="100" width="100">
                                                              </td>
                                                              <td><?php echo e($data->category); ?></td>
                                                              <td style="max-width: 168px;min-width: 290px;"><?php echo e($data->description); ?></td>
                                                              <td><?php echo e($data->start_date); ?></td>
                                                              <td><?php echo e($data->end_date); ?></td>
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
                                            </div>
                                                              </td>
                                                              <td>
                                                                <a href="<?php echo e($data->website); ?>">
                                              <i class="fa fa-2x fa-globe"></i>
                                            </a>
                                            <a href="<?php echo e($data->whitepaper); ?>">
                                              <i class="fa fa-2x fa-file"></i>
                                            </a>
                                            <a href="<?php echo e($data->twitter); ?>">
                                              <i class="fa fa-2x fa-twitter" aria-hidden="true"></i>
                                            </a>
                                            <a href="<?php echo e($data->youtube); ?>">
                                              <i class="fa fa-2x fa-youtube" aria-hidden="true"></i>
                                            </a>
                                            <a href="<?php echo e($data->facebook); ?>">
                                              <i class="fa fa-2x fa-facebook-square" aria-hidden="true"></i>
                                            </a>
                                            <a href="<?php echo e($data->slack); ?>">
                                              <i class="fa fa-2x fa-slack" aria-hidden="true"></i>
                                            </a>
                                            <a href="<?php echo e($data->linkedin); ?>">
                                              <i class="fa fa-2x fa-linkedin" aria-hidden="true"></i>
                                            </a>
                                            <a href="<?php echo e($data->github); ?>">
                                              <i class="fa fa-2x fa-github" aria-hidden="true"></i>
                                            </a>
                                            <a href="<?php echo e($data->telegram); ?>">
                                              <i class="fa fa-2x fa-telegram" aria-hidden="true"></i>
                                            </a>
                                            <a href="<?php echo e($data->reddit); ?>">
                                              <i class="fa fa-2x fa-reddit" aria-hidden="true"></i>
                                            </a>
                                                              </td>
                                                            </tr>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                          </tbody>
                                                        </table>
                                                </div>

                                                <!-- /standard gallery -->
                                                <div class="tab-pane gallery-padding" id="tab_3">
                                                    <table class="table table-bordered table-striped flip-content"> 
                                                          <thead class="flip-content">
                                                            <tr> 
                                                              <th>ICO</th> 
                                                              <th>Image</th> 
                                                              <th>category</th> 
                                                              <th>description</th> 
                                                              <th>start_date</th> 
                                                              <th>end_date</th> 
                                                              <th>Timeline</th> 
                                                            </tr>
                                                          </thead> 
                                                          <tbody>
                                                            <?php $__currentLoopData = $ended; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                              <td><?php echo e($data->title); ?></td>
                                                              <td>
                                                                <img src="<?php echo e(IMAGE_BASE_URL); ?><?php echo e($data->image_url); ?>" height="100" width="100">
                                                              </td>
                                                              <td><?php echo e($data->category); ?></td>
                                                              <td style="max-width: 168px;min-width: 290px;"><?php echo e($data->description); ?></td>
                                                              <td><?php echo e($data->start_date); ?></td>
                                                              <td><?php echo e($data->end_date); ?></td>
                                                              <td>Completed</td>
                                                            </tr>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                          </tbody>
                                                        </table>
                                                </div>
                                              
                                            </div>
    <div id="right">
        <div class="right_content">
            <div class="well-small dark m-t-15">
                <div class="row m-0">
                    <div class="col-lg-12 p-d-0">
                        <div class="skinmulti_btn" onclick="javascript:loadjscssfile('blue_black_skin.css','css')">
                            <div class="skin_blue skin_size b_t_r"></div>
                            <div class="skin_blue_border skin_shaddow skin_size b_b_r"></div>
                        </div>
                        <div class="skinmulti_btn" onclick="javascript:loadjscssfile('green_black_skin.css','css')">
                            <div class="skin_green skin_size b_t_r"></div>
                            <div class="skin_green_border skin_shaddow skin_size b_b_r"></div>
                        </div>
                        <div class="skinmulti_btn" onclick="javascript:loadjscssfile('purple_black_skin.css','css')">
                            <div class="skin_purple skin_size b_t_r"></div>
                            <div class="skin_purple_border skin_shaddow skin_size b_b_r"></div>
                        </div>
                        <div class="skinmulti_btn" onclick="javascript:loadjscssfile('orange_black_skin.css','css')">
                            <div class="skin_orange skin_size b_t_r"></div>
                            <div class="skin_orange_border skin_shaddow skin_size b_b_r"></div>
                        </div>
                        <div class="skinmulti_btn" onclick="javascript:loadjscssfile('red_black_skin.css','css')">
                            <div class="skin_red skin_size b_t_r"></div>
                            <div class="skin_red_border skin_shaddow skin_size b_b_r"></div>
                        </div>
                        <div class="skinmulti_btn" onclick="javascript:loadjscssfile('mint_black_skin.css','css')">
                            <div class="skin_mint skin_size b_t_r"></div>
                            <div class="skin_mint_border skin_shaddow skin_size b_b_r"></div>
                        </div>
                        <!--</div>-->
                        <div class="skin_btn skinsingle_btn skin_blue b_r height_40 skin_shaddow"
                             onclick="javascript:loadjscssfile('blue_skin.css','css')"></div>
                        <div class="skin_btn skinsingle_btn skin_green b_r height_40 skin_shaddow"
                             onclick="javascript:loadjscssfile('green_skin.css','css')"></div>
                        <div class="skin_btn skinsingle_btn skin_purple b_r height_40 skin_shaddow"
                             onclick="javascript:loadjscssfile('purple_skin.css','css')"></div>
                        <div class="skin_btn  skinsingle_btn skin_orange b_r height_40 skin_shaddow"
                             onclick="javascript:loadjscssfile('orange_skin.css','css')"></div>
                        <div class="skin_btn skinsingle_btn skin_red b_r height_40 skin_shaddow"
                             onclick="javascript:loadjscssfile('red_skin.css','css')"></div>
                        <div class="skin_btn skinsingle_btn skin_mint b_r height_40 skin_shaddow"
                             onclick="javascript:loadjscssfile('mint_skin.css','css')"></div>
                    </div>
                    <div class="col-lg-12 text-center m-t-15">
                        <button class="btn btn-dark button-rounded"
                                onclick="javascript:loadjscssfile('black_skin.css','css')">Dark
                        </button>
                        <button class="btn btn-secondary button-rounded default_skin"
                                onclick="javascript:loadjscssfile('default_skin.css','css')">Default
                        </button>
                    </div>
                </div>
            </div>
        </div>
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
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>