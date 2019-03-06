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
<div class="card m-t-35">
    
                        <div class="card-header bg-white">
                            <i class="fa fa-table"></i>
                            Live chart
                            
                        </div>
                        <div class="card-block flip-scroll">
                            <div class="m-t-35 table-responsive">
                                <div id="table_body"></div>
                            </div>
                        </div>

                        <!-- <div class="card-block flip-scroll">
                            <div class="m-t-35 table-responsive">
                                <table id="dynamic_table" class="table table-bordered table-striped flip-content"> 
                                    <thead class="flip-content"> 
                                        <tr> 
                                            <th>Cryptocurrency</th> 
                                            <th>Price</th> 
                                            <th class="numeric">24h % change</th> 
                                            <th class="numeric">Volume</th> 
                                            <th class="numeric">Market cap</th> 
                                            <th class="numeric">24h performence</th> 
                                        </tr>
                                    </thead> 
                                    <tbody>
                                       
                                        <?php $__currentLoopData = $live_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <img src="<?php echo e($l_data-image_url); ?>" height="16" width="16" /> <?php echo e($l_data->id); ?></td>
                                        <td><?php echo e($l_data->id); ?></td>
                                        <td><?php echo e($l_data->id); ?></td>
                                        <td><?php echo e($l_data->id); ?></td>
                                        <td><?php echo e($l_data->id); ?></td>
                                        <td><?php echo e($l_data->id); ?></td>
                                    </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div> -->

                    </div>
                     <!-- end of responsive tables-->
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

<script type="text/javascript">
    
    var api_url = window.location.protocol + "//" + window.location.host + "/cryptocompare/getItemAjax";
    var api_url1 = window.location.protocol + "//" + window.location.host + "/cryptocompare/";

  
    var g_data;
    setInterval(function(){ 
        
        // Ajax starts
         function LoadData(pagenum){

        $.ajax({
            type: "GET",
            url: api_url+'?p='+pagenum,
            dataType:'json',
            success: function(data){
                console.log(data.data);
                //alert(data);
                var temp = '<table id="example1" class="display table table-stripped table-bordered"> <thead class="flip-content"> <tr> <th>Cryptocurrency</th> <th>Price</th> <th class="numeric">24h % change</th> <th class="numeric">Volume</th> <th class="numeric">Market cap</th> <th class="numeric">24h performence</th> </tr></thead> <tbody>';
                //temp += g_data;
                data.data.forEach(function(element) {


                    var price_old = $("#"+element.id).html();
                    //price_old = parseFloat(price_old);
                    price_new = parseFloat(element.price);

                    price_old = price_old.replace('$','');
                    element.price = element.price.replace('$','');
                    // alert(price_old);
                    // alert(element.price);
                    if (price_old < element.price) { 
                        console.log("Value increased");
                        temp += '<tr style="background-color: #8acc8a;"> <td> <img src="'+element.image_url+'" height="16" width="16"><a href="'+api_url1+element.id+'?name='+element.name+'">&nbsp;&nbsp;'+element.name+'</a></td><td id="'+element.id+'">'+element.price+'</td><td class="numeric">'+element.percent_change_24h+'</td><td class="numeric">'+element.volume_24h+'</td><td class="numeric">'+element.market_cap+'</td><td class="numeric"> <img height="50" style="border: 1px solid #333;" width="150" src="'+element.chart_image+'"> </td></tr>';
                    }else if (price_old > element.price){
                        console.log("Value decreased");
                        temp += '<tr style="background-color: #e46565;"> <td> <img src="'+element.image_url+'" height="16" width="16"><a href="'+api_url1+element.id+'?name='+element.name+'">&nbsp;&nbsp;'+element.name+'</a></td><td id="'+element.id+'">'+element.price+'</td><td class="numeric">'+element.percent_change_24h+'</td><td class="numeric">'+element.volume_24h+'</td><td class="numeric">'+element.market_cap+'</td><td class="numeric"> <img height="50" style="border: 1px solid #333;" width="150" src="'+element.chart_image+'"> </td></tr>';
                    }else{
                        temp += '<tr> <td> <img src="'+element.image_url+'" height="16" width="16"><a href="'+api_url1+element.id+'?name='+element.name+'">&nbsp;&nbsp;'+element.name+'</a></td><td id="'+element.id+'">'+element.price+'</td><td class="numeric">'+element.percent_change_24h+'</td><td class="numeric">'+element.volume_24h+'</td><td class="numeric">'+element.market_cap+'</td><td class="numeric"> <img height="50" style="border: 1px solid #333;" width="150" src="'+element.chart_image+'"> </td></tr>';
                    }
                    
                  
                });

                temp += '</tbody></table>';
                document.getElementById("table_body").innerHTML = temp;
            }
        });
    }
        // end of ajax

    }, 3000);

    setInterval(function(){ 
    var cron_url = "http://localhost/cryptocompare/cron/test.php";
    $.ajax({
            type: "GET",
            url: cron_url,
            success: function(data){

            }
        });
    }, 3000);

    

     // Ajax starts
        $.ajax({
            type: "GET",
            url: api_url,
            dataType:'json',
            success: function(data){
                console.log(data.data);
                //alert(data);
                var temp = '<table id="example1" class="display table table-stripped table-bordered"> <thead class="flip-content"> <tr> <th>Cryptocurrency</th> <th>Price</th> <th class="numeric">24h % change</th> <th class="numeric">Volume</th> <th class="numeric">Market cap</th> <th class="numeric">24h performence</th> </tr></thead> <tbody>';
                data.data.forEach(function(element) {
                    
                    temp += '<tr> <td> <img src="'+element.image_url+'" height="16" width="16"><a href="'+api_url1+element.id+'?name='+element.name+'">&nbsp;&nbsp;'+element.name+'</a></td><td id="'+element.id+'">'+element.price+'</td><td class="numeric">'+element.percent_change_24h+'</td><td class="numeric">'+element.volume_24h+'</td><td class="numeric">'+element.market_cap+'</td><td class="numeric"> <img height="50" style="border: 1px solid #333;" width="150" src="'+element.chart_image+'"> </td></tr>';
                    
                  
                });

                temp += '</tbody></table>';
                document.getElementById("table_body").innerHTML = temp;
            }
        });
        // end of ajax

        
</script>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('Layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>