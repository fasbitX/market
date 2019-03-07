<?php $__env->startSection('title'); ?>

Basic Settings

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

   <div class="wrapper">        <!-- /#left -->
        <div id="content" class="bg-container">
            <div class="outer">
                <div class="inner bg-container">
                	 <div class="row web-mail mail_compose">
                        <div class="col-lg-12">
                            <div class="card media_max_991">
                                <div class="card-header bg-white">
                                    <i class="fa fa-edit"></i>
                                    Update Settings
                                </div>
                                <div class="card-block m-t-35">
                                	 <form action="<?php echo e(url('/')); ?>/admin/update_basic_settings" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                         <div class="form-group">
                                         	<div class="row">
                                         		<img src="<?php echo e($logo->value); ?>" height="75" width="150">
	                                            <div class="col-lg-4">
	                                                <h6>LOGO</h6>
	                                             <input type="file" name="logo" class="form-control" style="max-width: 210px;">
	                                            </div>
                                        	</div><br>
                                        	<div class="row">
	                                            <div class="col-lg-4">
	                                                <h6>Title</h6>
	                                              <input type="text" class="form-control" name="title" value="<?php echo e($title->value); ?>">
	                                            </div>
                                        	</div><br>
                                          <div class="row">
                                              <div class="col-lg-4">
                                                  <h6>Meta Description</h6>
                                                <input type="text" class="form-control" name="meta_description" value="<?php echo e($meta_description->value); ?>">
                                              </div>
                                          </div><br>
                                          <div class="row">
                                              <div class="col-lg-4">
                                                  <h6>Meta Keyword</h6>
                                                <input type="text" class="form-control" name="meta_keyword" value="<?php echo e($meta_keyword->value); ?>">
                                              </div>
                                          </div><br>
                                          <div class="row">
                                              <div class="col-lg-4">
                                                  <h6>Disqus url</h6>
                                                <input type="text" class="form-control" name="disqus_url" value="<?php echo e($disqus_url->value); ?>">
                                              </div>
                                          </div><br>
                                        	<button type="submit" class="btn btn-primary"> Submit</button>
                                         </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>