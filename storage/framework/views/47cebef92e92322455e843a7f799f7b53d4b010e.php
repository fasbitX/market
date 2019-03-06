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

    function insertParam( value)
{
    var key = "page";
    key = encodeURI(key); value = encodeURI(value);

    var kvp = document.location.search.substr(1).split('&');

    var i=kvp.length; var x; while(i--) 
    {
        x = kvp[i].split('=');

        if (x[0]==key)
        {
            x[1] = value;
            kvp[i] = x.join('=');
            break;
        }
    }

    if(i<0) {kvp[kvp.length] = [key,value].join('=');}

    //this will reload the page, it's likely better to store this until finished
    document.location.search = kvp.join('&'); 
}

//insertParam("test", 1);

    function getURLParameters(paramName)
{
    var sURL = window.document.URL.toString();
    if (sURL.indexOf("?") > 0)
    {
        var arrParams = sURL.split("?");
        var arrURLParams = arrParams[1].split("&");
        var arrParamNames = new Array(arrURLParams.length);
        var arrParamValues = new Array(arrURLParams.length);

        var i = 0;
        for (i = 0; i<arrURLParams.length; i++)
        {
            var sParam =  arrURLParams[i].split("=");
            arrParamNames[i] = sParam[0];
            if (sParam[1] != "")
                arrParamValues[i] = unescape(sParam[1]);
            else
                arrParamValues[i] = "No Value";
        }

        for (i=0; i<arrURLParams.length; i++)
        {
            if (arrParamNames[i] == paramName)
            {
                //alert("Parameter:" + arrParamValues[i]);
                return arrParamValues[i];
            }
        }
        return "No Parameters Found";
    }
}

function test(url) 
{
    //alert(url);
    // body...
    var load_url = window.location.protocol + "//" + window.location.host + "/newcrypto/"+url;
    window.location.href = load_url;
}

var r = getURLParameters("page");

if (r) {
    var page_number = r;
    }else{
        var page_number = 1;
    }

    var api_url = window.location.protocol + "//" + window.location.host + "/newcrypto/getItemAjax";
    var api_url1 = window.location.protocol + "//" + window.location.host + "/newcrypto/";

    var start = '0';
    var g_data; 
    setInterval(function(){ 
        // Ajax starts
        $.ajax({
            type: "GET",
            url: api_url+'?page='+page_number,
            dataType:'json',
            success: function(data){
                start = data.start;
                console.log(data.data);
                //alert(data);
                var temp = '<table id="example1" class="table"> <thead class="flip-content"> <tr> <th>Cryptocurrency</th> <th>Price</th> <th class="numeric">24h % change</th> <th class="numeric">Volume</th> <th class="numeric">Market cap</th> <th class="numeric">24h performence</th> </tr></thead> <tbody>';
                //temp += g_data;
                data.data.forEach(function(element) {


                    var price_old = $("#"+element.id).html();
                    //price_old = parseFloat(price_old);
                    price_new = parseFloat(element.price);

                    price_old = price_old.replace('$','');
                    element.price = element.price.replace('$','');
                    // alert(price_old);
                    // alert(element.price);
                    var t_url = '"'+api_url1+element.id+'?name='+element.name+'"';
                    if (price_old < element.price) { 
                        console.log("Value increased");
                        temp += '<tr onclick="test('+element.id+');" style="background-color: #8acc8a;"> <td> <img src="'+element.image_url+'" height="16" width="16"><a href="'+api_url1+element.id+'?name='+element.name+'">&nbsp;&nbsp;'+element.name+'</a></td><td id="'+element.id+'">'+element.price+'</td><td class="numeric">'+element.percent_change_24h+'</td><td class="numeric">'+element.volume_24h+'</td><td class="numeric">'+element.market_cap+'</td><td class="numeric"> <img height="50" style="border: 1px solid #333;" width="150" src="'+element.chart_image+'"> </td></tr>';
                    }else if (price_old > element.price){
                        console.log("Value decreased");
                        temp += '<tr onclick="test('+element.id+');" style="background-color: #e46565;"> <td> <img src="'+element.image_url+'" height="16" width="16"><a href="'+api_url1+element.id+'?name='+element.name+'">&nbsp;&nbsp;'+element.name+'</a></td><td id="'+element.id+'">'+element.price+'</td><td class="numeric">'+element.percent_change_24h+'</td><td class="numeric">'+element.volume_24h+'</td><td class="numeric">'+element.market_cap+'</td><td class="numeric"> <img height="50" style="border: 1px solid #333;" width="150" src="'+element.chart_image+'"> </td></tr>';
                    }else{
                        temp += '<tr onclick="test('+element.id+');"> <td> <img src="'+element.image_url+'" height="16" width="16"><a href="'+api_url1+element.id+'?name='+element.name+'">&nbsp;&nbsp;'+element.name+'</a></td><td id="'+element.id+'">'+element.price+'</td><td class="numeric">'+element.percent_change_24h+'</td><td class="numeric">'+element.volume_24h+'</td><td class="numeric">'+element.market_cap+'</td><td class="numeric"> <img height="50" style="border: 1px solid #333;" width="150" src="'+element.chart_image+'"> </td></tr>';
                    }
                    
                  
                });

                temp += '</tbody></table><div id="pagination"></div>';

                document.getElementById("table_body").innerHTML = temp;

                var page_html = "";
                page_html += '<button class="btn" onclick="insertParam(1);">First</button>';
                for (var i = 2; i < data.recordsTotal/25; i++) {

                    if (i == page_number - 1) {
                        page_html += '<button class="btn" onclick="insertParam('+i+');">Previous</button>';
                    }
                    if (i == parseInt(page_number) + 1) {
                        page_html += '<button class="btn" onclick="insertParam('+i+');">Next</button>';
                    }
                    //page_html += '<button class="btn" onclick="insertParam('+i+');">'+i+'</button>';
                }

                var last = data.recordsTotal / 25;
                last = parseInt(last);
                page_html += '<button class="btn" onclick="insertParam('+last+');">Last</button>';

                document.getElementById("pagination").innerHTML = page_html;

                
            }
        });
        // end of ajax

    }, 3000);

    setInterval(function(){ 
    var cron_url = "http://localhost/newcrypto/cron/test.php";
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
            url: api_url+'?page='+page_number,
            dataType:'json',
            success: function(data){
                console.log(data.data);
                //alert(data);

                var temp = '<table id="example1" class="table"> <thead class="flip-content"> <tr> <th>Cryptocurrency</th> <th>Price</th> <th class="numeric">24h % change</th> <th class="numeric">Volume</th> <th class="numeric">Market cap</th> <th class="numeric">24h performence</th> </tr></thead> <tbody>';
                data.data.forEach(function(element) {
                    
                    var t_url = '"'+api_url1+element.id+'?name='+element.name+'"';

                    temp += '<tr onclick="test('+element.id+');"> <td> <img src="'+element.image_url+'" height="16" width="16">&nbsp;&nbsp;'+element.name+'</td><td id="'+element.id+'">'+element.price+'</td><td class="numeric">'+element.percent_change_24h+'</td><td class="numeric">'+element.volume_24h+'</td><td class="numeric">'+element.market_cap+'</td><td class="numeric"> <img height="50" style="border: 1px solid #333;" width="150" src="'+element.chart_image+'"> </td></tr>';
                    
                  
                });

                temp += '</tbody></table>';
                document.getElementById("table_body").innerHTML = temp;

                var page_html = "";
                page_html += '<button class="btn" onclick="insertParam(1);">First</button>';
                for (var i = 2; i < data.recordsTotal/25; i++) {

                    if (i == page_number - 1) {
                        page_html += '<button class="btn" onclick="insertParam('+i+');">Previous</button>';
                    }
                    if (i == parseInt(page_number) + 1) {
                        page_html += '<button class="btn" onclick="insertParam('+i+');">Next</button>';
                    }
                    //page_html += '<button class="btn" onclick="insertParam('+i+');">'+i+'</button>';
                }

                var last = data.recordsTotal / 25;
                last = parseInt(last);
                page_html += '<button class="btn" onclick="insertParam('+last+');">Last</button>';

                //document.getElementById("pagination").innerHTML = page_html;
            }
        });
        // end of ajax

function addRowHandlers() {
  var table = document.getElementById("example1");
  var rows = table.getElementsByTagName("tr");
  for (i = 0; i < rows.length; i++) {
    var currentRow = table.rows[i];
    var createClickHandler = function(row) {
      return function() {
        var cell = row.getElementsByTagName("td")[0];
        var id = cell.innerHTML;
        alert("id:" + id);
      };
    };
    currentRow.onclick = createClickHandler(currentRow);
  }
}

</script>

<?php $__env->stopSection(); ?>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5afec5426d44f1e2"></script>




<?php echo $__env->make('Layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>