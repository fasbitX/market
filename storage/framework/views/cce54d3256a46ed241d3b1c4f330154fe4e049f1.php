<?php $__env->startSection('title'); ?>

Cryptocompare dashboard

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div id="wrap">
<div class="wrapper">
<div id="content" class="bg-container">

<?php if($ads->status == 1): ?>
<img src="<?php echo e(url('/')); ?>/public/ad.jpg" style="margin-top: 25px;max-width: 950px;margin-left: 186px;">
<?php endif; ?>

<div class="outer">

	<div class="inner bg-light lter bg-container">
		<div class="row">
			
			
				
				<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="col-md-10">
					<div class="col-md-4" style="float:left;margin-bottom: 30px">
						<img src="<?php echo e($d->imageurl); ?>" width="300px" height="150px">

					</div>
						
					<div class="col-md-6"  style="float:left;">
						<a href="<?php echo e($d->url); ?>" target="_blank">
						<h3><?php echo e($d->title); ?></h3>
						</a>
						<div><?php echo e($d->body); ?></div>
						<br>
					</div>

					
				</div>
				<br>


			<div class="col-2">
								<?php if($ads_right->status == 1): ?>
				<img src="<?php echo e(url('/')); ?>/public/ad.jpg">
				<?php endif; ?>
				</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

			
		</div>
	</div>
</div>
</div>
</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>