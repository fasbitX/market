

<?php $__env->startSection('title'); ?>

Ads

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
                      
<style>
    .toggle.btn {
    min-width: 26px !IMPORTANT;
    min-height: 20px !IMPORTANT;
    max-width: 20px;
    max-height: 20px;
}
i.fa.fa-pencil-square-o {
    color: #337ab7;
    font-size: 20px;
}
i.fa.fa-trash {
    color: #dc3545;
    font-size: 20px;
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
                                  Ads
                                </div>
                                <div class="card-block m-t-35">
                                    <table  id="example1" class="display table table-stripped table-bordered"> 
                                      <thead>
                                        <tr> 
                                          <th>SI</th>
                                          <th>Name</th> 
                                          <th>Action</th> 
                                          <th>Add Script</th> 
                                        </tr>
                                      </thead> 
                                      <tbody>
                                        <?php $i=1; ?>
                                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                          <td><?php echo e($i); ?></td>
                                          <td><?php echo e($d->name); ?></td>
                                          <?php if($d->status==1): ?>
                                          <td>
                                            <a class="btn btn-danger" href="<?php echo e(url('/')); ?>/ads/status-update/0/<?php echo e($d->id); ?>">
                                                OFF
                                            </a>
                                            
                                          </td>
                                          <?php endif; ?>
                                          <?php if($d->status==0): ?>
                                          <td>
                                             <a class="btn btn-success" href="<?php echo e(url('/')); ?>/ads/status-update/1/<?php echo e($d->id); ?>">
                                                ON
                                            </a>
                                          </td>
                                          <?php endif; ?>
                                          <td>
                                             <a data-toggle="modal" data-target="#edit<?php echo e($d->id); ?>"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                             <a data-toggle="modal" data-target="#delete<?php echo e($d->id); ?>">  <i class="fa fa-trash" aria-hidden="true"></i></a>
                                          </td>
                                        </tr>
                                        <?php $i++; ?>
                                        <div id="edit<?php echo e($d->id); ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <form method="post" action="<?php echo e(url('/')); ?>/admin/ads/script">
                                                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                                    <div class="modal-header">
                                                        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                                        <h4 class="modal-title">Enter Script</h4>
                                                        <div class="form-group">
                                                        <input class="form-control" type="hidden" name="id" value="<?php echo e($d->id); ?>">
                                                        <input class="form-control" type="text" name="script" value="<?php echo e($d->script); ?>">
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                       
                                                       <button type="submit" class="btn btn-default">Submit</button>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                    </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                        <div id="delete<?php echo e($d->id); ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Are you sure to delete <?php echo e($d->name); ?> ? </h4>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <a href="<?php echo e(url('/')); ?>/admin/ads/delete/<?php echo e($d->id); ?>" class="btn btn-danger" >Yes</a>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                         <div id="<?php echo e($d->id); ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Are you sure to deactivate <?php echo e($d->name); ?> ? </h4>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <a href="<?php echo e(url('/')); ?>/admin/ads/deactivate/<?php echo e($d->id); ?>" class="btn btn-danger" >Yes</a>
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
                                                        <a href="<?php echo e(url('/')); ?>/admin/ads/activate/<?php echo e($d->id); ?>" class="btn btn-danger" >Yes</a>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
<script>
    $(".toggle.btn").click(function(){
    alert($(this).val());
});
    function myFunction() {
 alert($("#toggle-one").val());

}
</script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
  $(function() {
    $('#toggle-event').change(function() {
        alert("hello");
      $('#console-event').html('Toggle: ' + $(this).prop('checked'))
    })
  })

  function status_update(status,id){
    var a_url = "http://18.191.39.172/cryptocompare/ads/status-update/"+status+"/"+id;
    $.ajax({
        type: "GET",
        url: a_url,
        success: function(data) {
            location.reload();
        }
    });
  }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>