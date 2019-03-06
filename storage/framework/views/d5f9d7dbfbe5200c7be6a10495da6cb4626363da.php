<?php $__env->startSection('title'); ?>

Cryptocompare dashboard

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
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>   
<style type="text/css">
    #chartdiv {
      width: 80%;
      height: 500px;
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

                        <div class="col-lg-12">
                           
                                <center><div id="chartdiv"></div> </center>
                            
                            <br>
                            <div class="card">
                                <div class="card-header bg-white" style="font-weight: 800;">
                                    <?php echo e($data->General->H1Text); ?>

                                </div>
                                <div class="card-block m-t-35">
                                    <div>
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs">
                                                <li class="nav-item" style="min-width: 300px;text-align: center;">
                                                    <a href="#tab_2" class="nav-link active" data-toggle="tab" style="font-weight: 800;">Description</a>
                                                </li>
                                                <li class="nav-item" style="min-width: 300px;text-align: center;">
                                                    <a href="#tab_1" class="nav-link" data-toggle="tab" style="font-weight: 800;">Features</a>
                                                </li>
                                                <li class="nav-item" style="min-width: 300px;text-align: center;">
                                                    <a href="#tab_3" class="nav-link" data-toggle="tab" style="font-weight: 800;">Technology</a>
                                                </li>
                                                <li class="nav-item" style="min-width: 300px;text-align: center;">
                                                    <a href="#tab_4" class="nav-link" data-toggle="tab" style="font-weight: 800;">Exchange</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active gallery-padding" id="tab_2">
                                                    <div class="row no-gutters">
                                                        <br><?php echo e(strip_tags($data->General->Description)); ?>

                                                        <?php if(!$data->General->Description): ?>
                                                        <center><h3 style="margin-top: 10px;">No Data Available</h3></center>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="tab-pane gallery2-padding" id="tab_1">
                                                    <br><?php echo e(strip_tags($data->General->Features)); ?>

                                                    <?php if(!$data->General->Features): ?>
                                                        <center><h3 style="margin-top: 10px;">No Data Available</h3></center>
                                                        <?php endif; ?>
                                                </div>
                                                <!-- /standard gallery -->
                                                <div class="tab-pane gallery-padding" id="tab_3">
                                                    <br><?php echo e(strip_tags($data->General->Technology)); ?>

                                                    <?php if(!$data->General->Technology): ?>
                                                        <center><h2>No Data Available</h2></center>
                                                        <?php endif; ?>
                                                    <center>
                                                      <table style="max-width: 800px;margin-top: 35px;">
                                                      <tr>
                                                        <td style="font-weight: 800;">TotalCoinSupply</td>
                                                        <td><?php echo e($data->General->TotalCoinSupply); ?></td>
                                                      </tr>
                                                      <tr><td style="font-weight: 800;">DifficultyAdjustment</td><td><?php echo e($data->General->DifficultyAdjustment); ?></td></tr>
                                                      <tr><td style="font-weight: 800;">BlockRewardReduction</td><td><?php echo e($data->General->BlockRewardReduction); ?></td></tr>
                                                      <tr><td style="font-weight: 800;">Algorithm</td><td><?php echo e($data->General->Algorithm); ?></td></tr>
                                                      <tr><td style="font-weight: 800;">ProofType</td><td><?php echo e($data->General->ProofType); ?></td></tr>
                                                      <tr><td style="font-weight: 800;">StartDate</td><td><?php echo e($data->General->StartDate); ?></td></tr>
                                                      <tr><td style="font-weight: 800;">LastBlockExplorerUpdateTS</td><td><?php echo e($data->General->LastBlockExplorerUpdateTS); ?></td></tr>
                                                       <tr><td style="font-weight: 800;">BlockNumber</td><td><?php echo e($data->General->BlockNumber); ?></td></tr>
                                                        <tr><td style="font-weight: 800;">BlockTime</td><td><?php echo e($data->General->BlockTime); ?></td></tr>
                                                         <tr><td style="font-weight: 800;">NetHashesPerSecond</td><td><?php echo e($data->General->NetHashesPerSecond); ?></td></tr>
                                                         <tr><td style="font-weight: 800;">TotalCoinsMined</td><td><?php echo e($data->General->TotalCoinsMined); ?></td></tr>
                                                          <tr><td style="font-weight: 800;">PreviousTotalCoinsMined</td><td><?php echo e($data->General->PreviousTotalCoinsMined); ?></td></tr>
                                                          <tr><td style="font-weight: 800;">BlockReward</td><td><?php echo e($data->General->BlockReward); ?></td></tr>
                                                    </table>
           
                                                    </center>
                                                </div>
                                                <!-- /button helper gallery -->
                                                <div class="tab-pane gallery-padding" id="tab_4">
                                                    <div class="row no-gutters">
                                                      <center>
                                                        <table style="margin-top: 50px;max-width: 80%;margin-left: 30%;">
                                                          <thead>
                                                            <tr>
                                                              <th>Exchange</th>
                                                              <th>Currency</th>
                                                              <th>Price</th>
                                                              <th>24 Hour Volume</th>
                                                              <th>High 24 Hour</th>
                                                              <th>Low 24 Hour</th>
                                                            </tr>
                                                          </thead>

                                                          <tbody>
                                                            <?php $__currentLoopData = $exchange_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                              <td style="font-weight: 600;"><?php echo e($e_data->MARKET); ?></td>
                                                              <td><?php echo e($e_data->TOSYMBOL); ?></td>
                                                              <td><?php echo e($e_data->PRICE); ?></td>
                                                              <td><?php echo e($e_data->VOLUME24HOUR); ?></td>
                                                              <td><?php echo e($e_data->HIGH24HOUR); ?></td>
                                                              <td><?php echo e($e_data->LOW24HOUR); ?></td>
                                                             
                                                            </tr>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                          </tbody>
                                                        </table>
                                                      </center>
                                                    </div>
                                                </div>
                                                <!-- /thumnail helper gallery -->
                                            </div>
                                            <!-- /.tab-content -->
                                        </div>
                                        <!-- nav-tabs-custom -->
                                    </div>
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


<script type="text/javascript">
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
console.log(chartData);
$.ajax({
            type: "GET",
            url: api_url,
            dataType:'json',
            success: function(data){
              console.log(data.Data);
              data.Data.forEach(function(element) {
                console.log(element);
                var newDate = new Date(element.time*1000);
                n_chart_data.push( {
                  "date": newDate,
                  "value": element.high,
                  "volume": element.volumeto
                } );
                console.log("single Data :"+n_chart_data);
              });
              ///////////////////////////////////

              var chart = AmCharts.makeChart( "chartdiv", {
  "type": "stock",
  "theme": "light",
  "categoryAxesSettings": {
    "minPeriod": "mm"
  },

  "dataSets": [ {
    "color": "#b0de09",
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