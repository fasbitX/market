 <?php $__env->startSection('title'); ?> Cryptocompare dashboard <?php $__env->stopSection(); ?> <?php $__env->startSection('content'); ?>
<br>
<br>
<div class="text-center">
    <h2> welcome <?php echo e(Session::get( 'user_name' )); ?></h2>
    <h6><strong>Select Your Favorite Coins</strong></h6>
    <p><small>
Choose your favorite coins to follow by clicking on the coins.</small>
    </p>
    <form name="fov_coin" action="<?php echo e(URL('/')); ?>/add_fav_coin" method="post">
        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
        <center>
            <button type="submit" class="btn btn-block" style="width: 80%;background: #8dc647;color: white;font-weight: bold">Save</button>
        </center>
        <br>
</div>
<div class="container pages" style="margin-top: 35px">
    <div class="unobtrusive-flash-container"></div>
    <div class="row">
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-12 col-lg-3 col-md-6 col-12 m-t-35 coin-box">
            <input type="checkbox" name="coin_id[]" value="<?php echo e($d->id); ?>" id="check-<?php echo e($d->id); ?>">
            <label for="check-<?php echo e($d->id); ?>">
                <div class="image">
                    <img src="<?php echo e($d->image_url); ?>" alt="Image missing" class="img-fluid rounded-circle" width="100">
                </div>
                <h5 class="name"><?php echo e($d->name); ?></h5>
            </label>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <br>
    <br>
</div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>