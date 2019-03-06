

<?php $__env->startSection('title'); ?>

<?php echo e($title->value); ?> | News

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
      div.fluid-container {
    padding-left: 75px;
    padding-right: 42px;
}
img.single-img-pro {
    /*margin-top: -560px;*/
        padding-top: 25px;
}
img.single-img-pro {
        padding-top: 50px;
}
/*.row.news-box {
    padding-bottom: 0px;
}*/
/*.newsDiv img.webfeedsFeaturedVisual.wp-post-image {
    max-width: 30% !important;
    flex: 0 0 75%;
    position: absolute;
}
.news-box p:nth-child(2) {
    padding-left: 175px;
    font-size: 15px;
    text-align: justify;
    padding-top: 40px;
}
.news-box p:nth-child(3) {
    padding-left: 175px;
    font-size: 15px;
    text-align: justify;
}
.news-box p:nth-child(4) {
    padding-left: 175px;
    font-size: 15px;
    text-align: justify;
}
img.img-default-check {
    max-width: 30% !important;
    flex: 0 0 75%;
    position: absolute;
}
h5.news-h5 {
    position: absolute;
    padding-left: 175px;
}*/
/*.news-box p {
    
    font-size: 15px;
    text-align: justify;
    
}*/
@media  only screen and (max-width: 766px) {
.hide-add-div {
    display: none !important;
}
div.fluid-container {
    padding-left: 30px;
    padding-right: 30px;
}
}
/*.row.news-box {
    width: 100%;
}*/
.hide-add-div {
    max-width: 24%;
}
</style>
<div id="">

<div class="">
<div id="" class="fluid-container">
 <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12" style="display: inline-block;width: auto;">   

<?php if($ads->status == 1): ?>
<img class="banner-img" src="<?php echo e(url('/')); ?>/public/ad.jpg">
<?php endif; ?>

<div class="outer">
	<div class="">
		<div class="row">
			<!--<?php echo e($i = 1); ?>-->
				<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<!-- <div class="col-md-10"> -->
					<div class="row news-box">
					
						
					<div  class="col-md-12 right">
						<!-- <b><?php echo e($i); ?></b> -->
						<h5 class="news-h5"><a href="<?php echo e($d->link); ?>" id="link" target="_blank"><strong><?php echo e($d->title); ?></strong></a></h5>
					
						<div class="newsDiv img-check<?php echo $i; ?>" style="text-indent: 1em">
							<?php echo $d->description; ?>
						</div>
						<!-- <br><br> -->
					</div>
					</div>
					
					
				<!-- </div> -->
				<!-- <div class="col-md-2">

						<img class="full-img" src="http://btcclicks.com/img/square.png">
					</div> -->
					<!--<?php echo e($i++); ?>-->
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<p class="p_value" style="visibility: hidden;"><b><?php echo e($i); ?></b></p>
					
			
		</div>
	</div>
</div>
</div>
	 <div class="col-lg-3 col-md-2 col-sm-12 col-xs-12 hide-add-div" style="display: inline-block;width: auto;">
                
                <img src="<?php echo e(url('/')); ?>/public/add-bg.jpg" class="single-img-pro"> 
                <img src="<?php echo e(url('/')); ?>/public/add-bg1.jpg" class="single-img-pro"> 
            </div>
</div>
</div>
</div>
</div>

<script>
	// var p_value = $('.p_value').text();
	// var p_value1 = p_value - 1;
	// var img_val1 = 0;
	// for(var i = 1;p_value > i;i++){
	// 	var img_check = ".img-check";
	// 	var img_check1 = img_check+i;
	// 	// console.log(img_check1);
	// 	img_val1 = 1;
	// 	$(img_check1).find('img.webfeedsFeaturedVisual.wp-post-image').each(function(){
	// 			if($(this).is(':visible')){
 //        img_val1 = 2;
 //   		// console.log("hello");
 //     }
 //     });

	// 	if(img_val1 == 1){
	// 		$(img_check1).prepend('<img width="150" height="150" src="http://18.191.39.172/cryptocompare/public/news_page_default_image.jpg" class="img-default-check" alt="" style="display: block; margin-bottom: 5px; clear:both;max-width: 100%;" sizes="(max-width: 150px) 100vw, 150px">');
	// 	}
	// 	// console.log(img_val1);
	// }

</script>
<?php $__env->stopSection(); ?>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5afec5426d44f1e2"></script>
<?php echo $__env->make('Layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>