<?php $__env->startSection('title'); ?>

Cryptocompare- News

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<style>
#link:hover{
	color: blue;
}
div.ex2 {
    background-color: lightblue;
    width: 110px;
    height: 110px;
    overflow: hidden;
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
				<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="col-md-10">
					<div class="col-md-3 " style="float:left;margin-bottom: 30px">
						<img src="<?php echo e($d->imageurl); ?>" width="300px" height="150px">

					</div>
						
					<div  class="col-md-8"  style="float:left;margin-left: 15px;max-height: 200px;">
						
						<h3><a href="<?php echo e($d->url); ?>"   id="link" target="_blank"><?php echo e($d->title); ?></a></h3>
					
						<div class="newsDiv" style="text-indent: 1em"><?php echo e($d->body); ?></div>
						<br><br>
					</div>
					
					
					
				</div>
				<span class="col-md-2" style="float:right;margin:auto">

						<img src="http://btcclicks.com/img/square.png">
					</span>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

			
		</div>
	</div>
</div>
</div>
</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>