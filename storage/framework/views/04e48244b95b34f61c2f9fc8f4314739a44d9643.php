<?php $__env->startSection('title'); ?>

Coins

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
                      

<div id="wrap">
<div class="wrapper">
<div id="content" class="bg-container">



<div class="outer">
                <div class="inner bg-light lter bg-container">
                    <div class="row">

                        <div class="col-lg-12">

                            <div class="card">
                                <div class="card-header bg-white">
                                  Coins
                                </div>
                                <div class="card-block m-t-35">
                                    <table  id="example1" class="display table table-stripped table-bordered"> 
                                      <thead>
                                        <tr> 
                                          <th>Name</th> 
                                          <th>Price</th> 
                                          <th>% change 24th</th> 
                                          <th>Volume 24th</th> 
                                          <th>Market Cap</th> 
                                          <th>Image</th> 
                                          <th>Chart</th> 
                                          <th>Action</th> 
                                        </tr>
                                      </thead> 
                                      <tbody>
                                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                          <td><?php echo e($d->name); ?></td>
                                          <td><?php echo e($d->price); ?></td>
                                          <td><?php echo e($d->percent_change_24h); ?></td>
                                          <td><?php echo e($d->volume_24h); ?></td>
                                          <td><?php echo e($d->market_cap); ?></td>
                                          <td><img src="<?php echo e($d->image_url); ?>" height="100" width="100"></td>
                                          <td><img src="<?php echo e($d->chart_image); ?>" height="100" width="100"></td>
                                          <?php if($d->status==1): ?>
                                          <td>
                                            <button type="button" class="btn btn-info " data-toggle="modal" data-target="#<?php echo e($d->id); ?>">
                                             <i class="fa  fa-times" aria-hidden="true"></i>
                                            </button>
                                          </td>
                                          <?php endif; ?>
                                          <?php if($d->status==0): ?>
                                          <td>
                                            <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#d<?php echo e($d->id); ?>">
                                           <i class="fa  fa-check-square" aria-hidden="true"></i>
                                            </button>
                                          </td>
                                          <?php endif; ?>
                                        </tr>

                                         <div id="<?php echo e($d->id); ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Are you sure to deactivate <?php echo e($d->name); ?> ? </h4>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <a href="<?php echo e(url('/')); ?>/admin/coins/deactivate/<?php echo e($d->id); ?>" class="btn btn-danger" >Yes</a>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div id="d<?php echo e($d->id); ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Are you sure to activate <?php echo e($d->name); ?> ? </h4>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <a href="<?php echo e(url('/')); ?>/admin/coins/activate/<?php echo e($d->id); ?>" class="btn btn-danger" >Yes</a>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
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
    <!-- # right side -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>