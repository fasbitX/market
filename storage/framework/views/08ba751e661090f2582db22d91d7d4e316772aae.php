<?php $__env->startSection('title'); ?>

Cryptocompare dashboard

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
                                    ICO
                                    <button type="button" 
                                    class="btn btn-labeled btn-secondary right_btn_padding_left" style="float: right;" data-toggle="modal" data-target="#myModal">
                                                <span class="btn-label btn_angle_left">
                                                    <i class="fa fa-plus"></i>
                                                </span>
                                                       Add new
                                                   </button>
                                </div>
                                <div class="card-block m-t-35">
                                    <table class="table table-bordered table-striped flip-content"> 
                                      <thead class="flip-content">
                                        <tr> 
                                          <th>ICO</th> 
                                          <th>Image</th> 
                                          <th>category</th> 
                                          <th>description</th> 
                                          <th>Link</th> 
                                          <th>start_date</th> 
                                          <th>end_date</th> 
                                        </tr>
                                      </thead> 
                                      <tbody>
                                        <?php $__currentLoopData = $ico; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                          <td><?php echo e($data->title); ?></td>
                                          <td>
                                            <img src="<?php echo e(IMAGE_BASE_URL); ?><?php echo e($data->image_url); ?>" height="70" width="70">
                                          </td>
                                          <td><?php echo e($data->category); ?></td>
                                          <td>
                                            <?php echo e($data->description); ?></td>
                                          <td >
                                            <a href="<?php echo e($data->website); ?>">
                                              <i class="fa fa-2x fa-globe" style="font-size: 1em;" ></i>
                                            </a>
                                            <a href="<?php echo e($data->whitepaper); ?>" >
                                              <i class="fa fa-2x fa-file" style="font-size: 1em;"></i>
                                            </a>
                                            <a href="<?php echo e($data->twitter); ?>" >
                                              <i class="fa fa-2x fa-twitter" aria-hidden="true" style="font-size: 1em;"></i>
                                            </a>
                                            <a href="<?php echo e($data->youtube); ?>">
                                              <i class="fa fa-2x fa-youtube" aria-hidden="true" style="font-size: 1em;"></i>
                                            </a>
                                            <a href="<?php echo e($data->facebook); ?>" >
                                              <i class="fa fa-2x fa-facebook-square" aria-hidden="true" style="font-size: 1em;"></i>
                                            </a>
                                            <a href="<?php echo e($data->slack); ?> ">
                                              <i class="fa fa-2x fa-slack" aria-hidden="true" style="font-size: 1em;"></i>
                                            </a>
                                            <a href="<?php echo e($data->linkedin); ?>">
                                              <i class="fa fa-2x fa-linkedin" aria-hidden="true" style="font-size: 1em;"></i>
                                            </a>
                                            <a href="<?php echo e($data->github); ?>" >
                                              <i class="fa fa-2x fa-github" aria-hidden="true" style="font-size: 1em;"></i>
                                            </a>
                                            <a href="<?php echo e($data->telegram); ?>">
                                              <i class="fa fa-2x fa-telegram" aria-hidden="true" style="font-size: 1em;"></i>
                                            </a>
                                            <a href="<?php echo e($data->reddit); ?>">
                                              <i class="fa fa-2x fa-reddit" aria-hidden="true" style="font-size: 1em;"></i>
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


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add new ICO</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div style="margin-left: 20px;margin-top: 15px;">
              <h5>ICO Name</h5>
              <input type="text" class="form-control" name="title" placeholder="Enter ICO Name">
          </div>
          <div style="margin-left: 20px;margin-top: 15px;">
              <h5>ICO Image</h5>
              <input type="file" name="image" class="form-control" style="max-width: 210px;">
          </div>
          <div style="margin-left: 20px;margin-top: 15px;">
              <h5>Category</h5>
              <input type="text" name="category" class="form-control" placeholder="Enter category">
          </div>
          <div style="margin-left: 20px;margin-top: 15px;">
              <h5>Description</h5>
              <textarea name="description" class="form-control"></textarea>
          </div>
          <div style="margin-left: 20px;margin-top: 15px;">
              <h5>Start Date</h5>
              <input type="date" name="start_date" class="form-control">
          </div>
          <div style="margin-left: 20px;margin-top: 15px;">
              <h5>End Date</h5>
              <input type="date" name="end_date" class="form-control">
          </div>
          <div style="margin-left: 20px;margin-top: 15px;">
              <h5>Rating</h5>
              <input type="text" placeholder="1 to 5 Rating" name="rating" class="form-control">
          </div>

        <div style="margin-left: 20px;margin-top: 15px;">
            <h5>Website</h5>
            <input type="text" name="website" class="form-control">
        </div>

        <div style="margin-left: 20px;margin-top: 15px;">
            <h5>Whitepaper</h5>
            <input type="text" name="whitepaper" class="form-control">
        </div>

        <div style="margin-left: 20px;margin-top: 15px;">
            <h5>Twitter</h5>
            <input type="text" name="twitter" class="form-control">
        </div>

        <div style="margin-left: 20px;margin-top: 15px;">
            <h5>Youtube</h5>
            <input type="text" name="youtube" class="form-control">
        </div>

        <div style="margin-left: 20px;margin-top: 15px;">
            <h5>Facebook</h5>
            <input type="text" name="facebook" class="form-control">
        </div>

        <div style="margin-left: 20px;margin-top: 15px;">
            <h5>Slack</h5>
            <input type="text" name="slack" class="form-control">
        </div>

        <div style="margin-left: 20px;margin-top: 15px;">
            <h5>Linkedin</h5>
            <input type="text" name="linkedin" class="form-control">
        </div>

        <div style="margin-left: 20px;margin-top: 15px;">
            <h5>Github</h5>
            <input type="text" name="github" class="form-control">
        </div>

        <div style="margin-left: 20px;margin-top: 15px;">
            <h5>Telegram</h5>
            <input type="text" name="telegram" class="form-control">
        </div>

        <div style="margin-left: 20px;margin-top: 15px;">
            <h5>Reddit</h5>
            <input type="text" name="reddit" class="form-control">
        </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
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