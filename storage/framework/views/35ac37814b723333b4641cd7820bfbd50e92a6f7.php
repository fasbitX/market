<?php $__env->startSection('title'); ?>
Cryptocompare-Coin detailss
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/amstock.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
<style>
   table {
   border-collapse: collapse;
   width: 100%;
   }
  
   body,html{
  font-family: arial;
}
  th{
    background: #e8ebef;
  }
  tr,th{
    height:50px;
  }
  #table_body,tbody{
    min-height: 500px;
  }
   tr:hover {background-color:#f5f5f5;}
</style>
<style type="text/css">
   th{
   background: #e8ebef;
   }
   tr{
   height:50px;
   }
   #chartdiv {
   width: 100%;
   height: 500px;
   }
   .nav-item{
   color:;
   }
   .poweredByWrapper{
   display: none;
   }
   .center {
   margin: auto;
   padding: 10px;
   }
   .tab-pane{
   font-family: arial;
   line-height: 250%;
   text-indent: 10px;
   }
   table,tbody{
   min-height: 500px;
   }
   @media  screen and (max-width: 400px){
   .center {
   width: 100%;
   clear: both;
   margin-left: 0;
   padding: 10px;
   }
   }
   #show{
   display: none;
   }
   @media  only screen 
   and (min-device-width : 320px) 
   and (max-device-width : 480px) { #price_here { display: none; }
   #show{display:block;
   margin-left: 25px;}}

  #hig_incre{
   
    background:#146822;
    font-weight: bold;
    text-align: center;
    color:white;
    border-radius: 10px;
    width: 110px;
    height: 32px;  
    height: 25px;  position: absolute;

  }
   #hig_decre{
   background:#b51717;
    font-weight: bold;
    text-align: center;
    color:white;
    border-radius: 10px;
    border: 1px solid #e8e8e8;
    width: 110px;
    height: 32px;  
    height: 25px;  position: absolute;
  }
  td,th{
    text-align: center;
    width:100px;
    position: relative;
  }
</style>
<div id="wrap">
   <div class="wrapper">
      <div id="content" class="bg-container">
         <?php if($ads->status==""): ?>
         <img src="<?php echo e(url('/')); ?>/public/ad.jpg" style="margin-top: 25px;max-width: 950px;margin-left: 195px;">
         <?php endif; ?>
         <br>
         <br>

         <div class="row justify-content-center align-items-center" style="margin-top: 50px;">
            <div>
               <img src="<?php echo e($data->SEO->BaseUrl); ?><?php echo e($data->SEO->OgImageUrl); ?>" alt="Image missing" class="img-fluid rounded-circle" width="100">
            </div>
            <div class="col-lg-7 col-md-8 col-8">
               <div class="col-lg-9 col-md-8" style="float:left;">
                  <h1><?php echo e($data->General->H1Text); ?></h1>
               </div>
               <div id="price_here" >
                  <br>
                  <div>
                    <script type="text/javascript">
baseUrl = "https://widgets.cryptocompare.com/";
var scripts = document.getElementsByTagName("script");
var embedder = scripts[ scripts.length - 1 ];
var cccTheme = {"Chart":{"labelBackground":"green","fillColor":"#8dc647","borderColor":"green"},"Trend":{"background":"trans","colorUp":"#8dc647","colorUnchanged":"#8dc647"}};
(function (){
var appName = encodeURIComponent(window.location.hostname);
if(appName==""){appName="local";}
var s = document.createElement("script");
s.type = "text/javascript";
s.async = true;
var theUrl = baseUrl+'serve/v1/coin/header?fsym=BTC&tsyms=USD,CNY,EUR,GBP';
s.src = theUrl + ( theUrl.indexOf("?") >= 0 ? "&" : "?") + "app=" + appName;
embedder.parentNode.appendChild(s);
})();
</script>
                 </div>
               </div>
               <!-- Price change refrences!-->
               <?php if($markat_cap): ?>
               <div class="col-lg-7 col-md-8 col-8">
                  <h5>MARKET CAPITALIZATION <br><br><span class="highlgt"> $ <?php echo e(number_format($markat_cap,2)); ?></span></h5>
                  <h5>24 HOUR TRADING VOLUME <br><br><span class="highlgt"> $ <?php echo e(number_format($volume_24h,2)); ?></span></h5>
               </div>
               <div style="margin-left: 18px;float:left">
                  Website :  <a href="<?php echo e($data->General->WebsiteUrl); ?>" target="_blank" class="highlgt"><?php echo e($data->General->WebsiteUrl); ?></a>
               </div>
               <?php endif; ?>
            </div>
            <input id="price" type="hidden" value="<?php echo e($price); ?>">
            <input id="name_coin" type="hidden" value="<?php echo e($data->General->Name); ?>">
            <br>
            <br>
         </div>
         <div id="show" >
            <br>
            <div class="col-md-4 center">
                 <script type="text/javascript">
  baseUrl = "https://widgets.cryptocompare.com/";
  var scripts = document.getElementsByTagName("script");
  var embedder = scripts[ scripts.length - 1 ];
  var cccTheme = {"Chart":{"labelBackground":"green","fillColor":"#8dc647","borderColor":"green"},"Trend":{"background":"trans","colorUp":"#8dc647","colorUnchanged":"#8dc647"}};
  (function (){
  var appName = encodeURIComponent(window.location.hostname);
  if(appName==""){appName="local";}
  var s = document.createElement("script");
  s.type = "text/javascript";
  s.async = true;
  var theUrl = baseUrl+'serve/v1/coin/header?fsym=BTC&tsyms=USD,CNY,EUR,GBP';
  s.src = theUrl + ( theUrl.indexOf("?") >= 0 ? "&" : "?") + "app=" + appName;
  embedder.parentNode.appendChild(s);
  })();
  </script>

            </div>
         </div>
         <br>
         <div class="col-md-4 center right" >
            <script type="text/javascript">
               baseUrl = "https://widgets.cryptocompare.com/";
               var scripts = document.getElementsByTagName("script");
               var embedder = scripts[ scripts.length - 1 ];
               var cccTheme = {"General":{"borderWidth":"1px","borderColor":"#8dc647"}};
               (function (){
               var appName = encodeURIComponent(window.location.hostname);
               if(appName==""){appName="local";}
               var s = document.createElement("script");
               s.type = "text/javascript";
               s.async = true;
               var urlParams = new URLSearchParams(window.location.search);
               var name = urlParams.get('name');
               var theUrl = baseUrl+'serve/v1/coin/converter?fsym='+name+'&tsyms=USD,EUR,CNY,GBP';
               s.src = theUrl + ( theUrl.indexOf("?") >= 0 ? "&" : "?") + "app=" + appName;
               embedder.parentNode.appendChild(s);
               })();
            </script>
         </div>
         <div class="outer">
            <div class="inner bg-light lter bg-container">
               <div class="col-md-12">
               </div>
               <div class="row justify-content-center align-items-center">
                  <div class="col-lg-10">
                     <br>
                     <center>
                        <div id="chartdiv"></div>
                        <br><br>
                        <script type="text/javascript">
                           baseUrl = "https://widgets.cryptocompare.com/";
                           var scripts = document.getElementsByTagName("script");
                           var embedder = scripts[ scripts.length - 1 ];
                           var cccTheme = {"General":{"borderWidth":"1px","borderColor":"#42b251","borderRadius":"2 2 2 2"},"Conversion":{"background":"lightgrey"}};
                           (function (){
                           var appName = encodeURIComponent(window.location.hostname);
                           if(appName==""){appName="local";}
                           var s = document.createElement("script");
                           s.type = "text/javascript";
                           s.async = true;
                           var urlParams = new URLSearchParams(window.location.search);
                           var name = urlParams.get('name');
                           var theUrl = baseUrl+'serve/v1/coin/histo_week?fsym='+name+'&tsym=USD';
                           s.src = theUrl + ( theUrl.indexOf("?") >= 0 ? "&" : "?") + "app=" + appName;
                           embedder.parentNode.appendChild(s);
                           })();
                        </script> 
                     </center>
                     <br>
                     <br>
                     <div class="card">
                        <div class="card-header bg-white" style="font-weight: bold;">
                           <?php echo e($data->General->H1Text); ?>

                        </div>
                        <div class="card-block m-t-35">
                           <div>
                              <div class="nav-tabs-custom">
                                 <ul class="nav nav-tabs">
                                    <li class="nav-item" style="text-align: center;">
                                       <a href="#tab_2" class="nav-link active" data-toggle="tab" style="font-weight: bold;color:rgb(66, 139, 202);">Description</a>
                                    </li>
                                    <li class="nav-item" style="text-align: center;">
                                       <a href="#tab_1" class="nav-link" data-toggle="tab" style="font-weight: bold;color:rgb(66, 139, 202);">Features</a>
                                    </li>
                                    <li class="nav-item" style="text-align: center;">
                                       <a href="#tab_3" class="nav-link" data-toggle="tab" style="font-weight: bold;color:rgb(66, 139, 202);">Technology</a>
                                    </li>
                                    <li class="nav-item" style="text-align: center;">
                                       <a href="#tab_4" class="nav-link" data-toggle="tab" style="font-weight: bold;color:rgb(66, 139, 202);">Exchange</a>
                                    </li>
                                 </ul>
                                 <div class="tab-content">
                                    <div class="tab-pane active gallery-padding" id="tab_2">
                                       <div class="row no-gutters">
                                          <br>
                                          <?php echo e(strip_tags($data->General->Description)); ?>

                                          <?php if(!$data->General->Description): ?>
                                          <center>
                                             <h3 style="margin-top: 10px;">No Data Available</h3>
                                          </center>
                                          <?php endif; ?>
                                       </div>
                                    </div>
                                    <div class="tab-pane gallery2-padding" id="tab_1">
                                       <br><?php echo e(strip_tags($data->General->Features)); ?>

                                       <?php if(!$data->General->Features): ?>
                                       <center>
                                          <h3 style="margin-top: 10px;">No Data Available</h3>
                                       </center>
                                       <?php endif; ?>
                                    </div>
                                    <!-- /standard gallery -->
                                    <div class="tab-pane gallery-padding" id="tab_3">
                                       <br><?php echo e(strip_tags($data->General->Technology)); ?>

                                       <?php if(!$data->General->Technology): ?>
                                       <center>
                                          <h2>No Data Available</h2>
                                       </center>
                                       <?php endif; ?>
                                       <center>
                                          <div class="card-block flip-scroll">
                                             <div class="m-t-35 table-responsive">
                                                <table style="max-width: 800px;margin-top: 35px;">
                                                   <tr>
                                                      <td style="font-weight: 800;">TotalCoinSupply</td>
                                                      <td><?php echo e($data->General->TotalCoinSupply); ?></td>
                                                   </tr>
                                                   <tr>
                                                      <td style="font-weight: 800;">DifficultyAdjustment</td>
                                                      <td><?php echo e($data->General->DifficultyAdjustment); ?></td>
                                                   </tr>
                                                   <tr>
                                                      <td style="font-weight: 800;">BlockRewardReduction</td>
                                                      <td><?php echo e($data->General->BlockRewardReduction); ?></td>
                                                   </tr>
                                                   <tr>
                                                      <td style="font-weight: 800;">Algorithm</td>
                                                      <td><?php echo e($data->General->Algorithm); ?></td>
                                                   </tr>
                                                   <tr>
                                                      <td style="font-weight: 800;">ProofType</td>
                                                      <td><?php echo e($data->General->ProofType); ?></td>
                                                   </tr>
                                                   <tr>
                                                      <td style="font-weight: 800;">StartDate</td>
                                                      <td><?php echo e($data->General->StartDate); ?></td>
                                                   </tr>
                                                   <tr>
                                                      <td style="font-weight: 800;">LastBlockExplorerUpdateTS</td>
                                                      <td><?php echo e($data->General->LastBlockExplorerUpdateTS); ?></td>
                                                   </tr>
                                                   <tr>
                                                      <td style="font-weight: 800;">BlockNumber</td>
                                                      <td><?php echo e($data->General->BlockNumber); ?></td>
                                                   </tr>
                                                   <tr>
                                                      <td style="font-weight: 800;">BlockTime</td>
                                                      <td><?php echo e($data->General->BlockTime); ?></td>
                                                   </tr>
                                                   <tr>
                                                      <td style="font-weight: 800;">NetHashesPerSecond</td>
                                                      <td><?php echo e($data->General->NetHashesPerSecond); ?></td>
                                                   </tr>
                                                   <tr>
                                                      <td style="font-weight: 800;">TotalCoinsMined</td>
                                                      <td><?php echo e($data->General->TotalCoinsMined); ?></td>
                                                   </tr>
                                                   <tr>
                                                      <td style="font-weight: 800;">PreviousTotalCoinsMined</td>
                                                      <td><?php echo e($data->General->PreviousTotalCoinsMined); ?></td>
                                                   </tr>
                                                   <tr>
                                                      <td style="font-weight: 800;">BlockReward</td>
                                                      <td><?php echo e($data->General->BlockReward); ?></td>
                                                   </tr>
                                                </table>
                                             </div>
                                          </div>
                                       </center>
                                    </div>
                                    <!-- /button helper gallery -->
                                    <div class="tab-pane gallery-padding" id="tab_4">
                                       <div class="card-block flip-scroll">
                                         <div class="card-block flip-scroll">
                            <div class="m-t-35 table-responsive">
                                <div id="table_body"></div>
                            </div>
                        </div>
                   
                                       </div>
                                    </div>
                                 </div>
                               </div>
                             </div>
                           </div>
                         </div>
                       </div>
                     </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <br><br><br>
<script type="text/javascript">
   //alert(api_url);
   //console.log(chartData);
   var api_url1 = window.location.protocol + "//" + window.location.host + "/newcrypto/getItemAjax/exchange/load";
   var redirect_ex = window.location.protocol + "//" + window.location.host + "/newcrypto/";


    //var start = '0';
    
    setInterval(function(){ 
        // Ajax starts
        $.ajax({
            type: "GET",
            url: api_url1,
            dataType:'json',
            success: function(data){
                //start = data.start;

                var temp = '<table id="" class="display table table-stripped table-bordered"> <thead class="flip-content"> <tr clas="coin"> <th>#</td><th>EXCHANGE</th> <th>CURRENCY</th><th>PRICE</th> <th class="numeric">24H VOLUME</th> <th class="numeric">24H VOLUME HIGH</th> <th class="numeric">24H VOLUME LOW</th></tr></thead> <tbody>';
                //temp += g_data;
                var i=1;
                data.forEach(function(element) {
                    var price_old = $("#id_"+element.MARKET+'_'+i).val();
                    //console.log(element);
                  // console.log(price_old);
                  //  //price_old = parseFloat(price_old);
                    price_new = parseFloat(element.PRICE);

                  
                    
                    
                    // alert(element.PRICE);
                    if (price_old < element.PRICE) { 
                        console.log("Value increased : " + i);
                       temp+="<input type='hidden' value='id_"+element.MARKET+'_'+element.PRICE +"' id='id_"+element.MARKET+'_'+i+"'>";

                        temp += '<tr> <td >'+i+'</td><td class="highlgt"> &nbsp;&nbsp'+
                            '<a href="'+redirect_ex+'exchange/'+element.MARKET+ '"><span class="highlgt">'
                          +element.MARKET+'</span></a><td>'+element.CURRENCY+'</td></td><td><div id="hig_incre">$ '+element.PRICE+'</div></td><td class="numeric">'+element.VOLUME24HOUR+'</td><td class="numeric">'+element.HIGH24HOUR+'</td><td class="numeric">'+element.LOW24HOUR+'</td></tr>';
                    }else if (price_old > element.PRICE){

                       console.log("Value decreased: " + i);
                       temp+="<input type='hidden' value='id_"+element.MARKET+'_'+element.PRICE +"' id='id_"+element.MARKET+'_'+i+"'>";
;
                        temp += '<tr> <td>'+i+'</td><td class="highlgt"> &nbsp;&nbsp'+
                            '<a href="'+redirect_ex+'exchange/'+element.MARKET+ '"><span class="highlgt">'
                          +element.MARKET+'</span></a></td><td>'+element.CURRENCY+'</td><td><div id= "hig_decre"> $ '+element.PRICE+'</div></td><td class="numeric">'+element.VOLUME24HOUR+'</td><td class="numeric">'+element.HIGH24HOUR+'</td><td class="numeric"> '+element.LOW24HOUR+' </td></tr>';
                    }else{
                        temp+="<input type='hidden' value='"+element.PRICE+"' id='id_"+element.MARKET+'_'+i+"'>";
                        temp += '<tr> <td >'+i+'</td><td class="highlgt">  &nbsp;&nbsp'+
                            '<a href="'+redirect_ex+'exchange/'+element.MARKET+ '"><span class="highlgt">'
                          +element.MARKET+'</span></a></td><td>'+element.CURRENCY+'</td><td>$ '+element.PRICE+'</td><td class="numeric">'+element.VOLUME24HOUR+'</td><td class="numeric">'+element.HIGH24HOUR+'</td><td class="numeric"> '+element.LOW24HOUR+' </td></tr>';
                    }
                   i++; 
                  
                });

                temp += '</tbody></table>';
                document.getElementById("table_body").innerHTML = temp;
            }
        });
        // end of ajax

    }, 2000);
   
       var chartData = generateChartData();
   
   function generateChartData() {
     var chartData = [];
     var firstDate = new Date( 2012, 0, 1 );
     firstDate.setDate( firstDate.getDate() - 1000 );
     firstDate.setHours( 0, 0, 0, 0 );
   
     var a = 2000;
    
     for ( var i = 0; i < 1000; i++ ) {
       var newDate = new Date( firstDate );
       newDate.setHours( 0, i, 0, 0 );
   
       a += Math.round((Math.random()<0.5?1:-1)*Math.random()*10);
       var b = Math.round( Math.random() * 100000000 );
   
       chartData.push( {
         "date": newDate,
         "value": a,
         "volume": b
       } );
     }
     return chartData;
   }
   
   var n_chart_data = [];
   var urlParams = new URLSearchParams(window.location.search);
   var name = urlParams.get('name');
   var api_url = "https://min-api.cryptocompare.com/data/histominute?fsym="+name+"&tsym=USD&limit=60&aggregate=3&e=CCCAGG";
   //alert(api_url);
   $.ajax({
               type: "GET",
               url: api_url,
               dataType:'json',
               success: function(data){
                // console.log(data.Data);
                 data.Data.forEach(function(element) {
                   ///console.log(element);
                   var newDate = new Date(element.time*1000);
                   n_chart_data.push( {
                     "date": newDate,
                     "value": element.high,
                     "volume": element.volumeto
                   } );
                   //console.log("single Data :"+n_chart_data);
                 });
                 ///////////////////////////////////
   
                 var chart = AmCharts.makeChart( "chartdiv", {
     "type": "stock",
     "theme": "light",
     "categoryAxesSettings": {
       "minPeriod": "mm"
     },
   
     "dataSets": [ {
       "color": "#8dc647",
       "fieldMappings": [ {
         "fromField": "value",
         "toField": "value"
       }, {
         "fromField": "volume",
         "toField": "volume"
       } ],
   
       "dataProvider": n_chart_data,
       "categoryField": "date"
     } ],
   
     "panels": [ {
       "showCategoryAxis": false,
       "title": "Value",
       "percentHeight": 70,
   
       "stockGraphs": [ {
         "id": "g1",
         "valueField": "value",
         "type": "smoothedLine",
         "lineThickness": 2,
         "bullet": "round"
       } ],
   
   
       "stockLegend": {
         "valueTextRegular": " ",
         "markerType": "none"
       }
     }, {
       "title": "Volume",
       "percentHeight": 30,
       "stockGraphs": [ {
         "valueField": "volume",
         "type": "column",
         "cornerRadiusTop": 2,
         "fillAlphas": 1
       } ],
   
       "stockLegend": {
         "valueTextRegular": " ",
         "markerType": "none"
       }
     } ],
   
     "chartScrollbarSettings": {
       "graph": "g1",
       "usePeriod": "10mm",
       "position": "top"
     },
   
     "chartCursorSettings": {
       "valueBalloonsEnabled": true
     },
   
     "periodSelector": {
       "position": "top",
       "dateFormat": "YYYY-MM-DD JJ:NN",
       "inputFieldWidth": 150,
       "periods": [ {
         "period": "hh",
         "count": 1,
         "label": "1 hour"
       }, {
         "period": "hh",
         "count": 2,
         "label": "2 hours"
       }, {
         "period": "hh",
         "count": 5,
         "selected": true,
         "label": "5 hour"
       }, {
         "period": "hh",
         "count": 12,
         "label": "12 hours"
       }, {
         "period": "MAX",
         "label": "MAX"
       } ]
     },
   
     "panelsSettings": {
       "usePrefixes": true
     },
   
     "export": {
       "enabled": true,
       "position": "bottom-right"
     }
   } );
                 ////////////////////////////////////
               }
           });
   
   
   
   
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>