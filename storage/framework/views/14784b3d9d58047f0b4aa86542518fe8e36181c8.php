 <?php $__env->startSection('title'); ?> <?php echo e($title->value); ?>  | Home <?php $__env->stopSection(); ?>

<?php $__env->startSection('meta'); ?>

<meta name="title" content=" Cryptocurrency Price,Volume, Traded Exchanges, Market Capital, ICO Reviews and Bitcoin News">
<!-- <meta name="description" content="All Live Prices of Cryptocurrency, Volume, Charts, Market capitalisation, ICO Reviews, News present in one place. With Forum and community discussion, advice">
<meta name="keywords" content="Cryptocurrency Price,Cryptocurrency Trade volume, Cryptocurrency compare,Cryptocurrency News, ICO review">
 -->
 <?php echo $meta_description->value; ?>
 <?php echo $meta_keyword->value; ?>


<?php $__env->stopSection(); ?>


 <?php $__env->startSection('content'); ?>
<style>
    div.fluid-container {
    padding-left: 50px;
    padding-right: 42px;
}
img.single-img-pro {
    /*margin-top: -560px;*/
        padding-top: 25px;
}
img.single-img-pro {
        padding-top: 50px;
}

@media  only screen and (max-width: 766px) {
.hide-add-div {
    display: none !important;
}
div.fluid-container {
    padding-left: 30px;
    padding-right: 30px;
}
div.min-add-div {
    width: 100% !important;
}
}
</style>
     <div class="container">
        <?php if($ads->status == 1): ?>
        <img class="banner-img" src="<?php echo e(url('/')); ?>/public/ad.jpg">
        <?php endif; ?>
            <div class="row">
                <?php if($ads1->status == 1): ?>
                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 min-add-div" style="display: inline-block;width: auto;">   
                <?php else: ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 min-add-div" style="display: inline-block;width: auto;">   
                <?php endif; ?>
<div class="">
    <div class="row">
        <div class="col-md-12">
            <div class="m-t-30">

                <div class="m-t-30">
                    <!-- <i class="fa fa-table"></i> -->
                    <!-- <button class="btn btn-success">Coin list</button> -->
                    <h5 style="color:#8dc647;font-weight:bold;">Coin List</h5>
                </div>
                <div class="">
                    <div class="m-t-10 home-table">
                        <div id="table_body"></div>
                    </div>
                </div>
            </div>
            <!-- end of responsive tables-->
        </div>
        <!-- /.inner -->
    </div>
</div>
<!-- </div>
</div> -->

<br>
<br>
<br>
</div>
<?php if($ads1->status == 1): ?>
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 hide-add-div" style="display: inline-block;width: auto;">
                
                <img src="<?php echo e(url('/')); ?>/public/add-bg.jpg" class="single-img-pro"> 
                <img src="<?php echo e(url('/')); ?>/public/add-bg1.jpg" class="single-img-pro"> 
            </div>
<?php endif; ?>
</div>
</div>

</div>
<!-- # right side -->
<script type="text/javascript">
function insertParam(value) {
    var key = "page";
    key = encodeURI(key);
    value = encodeURI(value);

    var kvp = document.location.search.substr(1).split('&');

    var i = kvp.length;
    var x;
    while (i--) {
        x = kvp[i].split('=');

        if (x[0] == key) {
            x[1] = value;
            kvp[i] = x.join('=');
            break;
        }
    }

    if (i < 0) { kvp[kvp.length] = [key, value].join('='); }

    //this will reload the page, it's likely better to store this until finished
    document.location.search = kvp.join('&');
}

//insertParam("test", 1);

function getURLParameters(paramName) {
    var sURL = window.document.URL.toString();
    if (sURL.indexOf("?") > 0) {
        var arrParams = sURL.split("?");
        var arrURLParams = arrParams[1].split("&");
        var arrParamNames = new Array(arrURLParams.length);
        var arrParamValues = new Array(arrURLParams.length);

        var i = 0;
        for (i = 0; i < arrURLParams.length; i++) {
            var sParam = arrURLParams[i].split("=");
            arrParamNames[i] = sParam[0];
            if (sParam[1] != "")
                arrParamValues[i] = unescape(sParam[1]);
            else
                arrParamValues[i] = "No Value";
        }

        for (i = 0; i < arrURLParams.length; i++) {
            if (arrParamNames[i] == paramName) {
                //alert("Parameter:" + arrParamValues[i]);
                return arrParamValues[i];
            }
        }
        return "No Parameters Found";
    }
}

function test(url) {
    //alert(url);
    // body...
    var name = $("#R" + url).val();
    var load_url = window.location.protocol + "//" + window.location.host + "/coin/" + name;
    // var load_url = "http://coincap.levelten.org/coin/" + name;
    window.location.href = load_url;
}

var r = getURLParameters("page");

if (r) {
    var page_number = r;
} else {
    var page_number = 1;
}

var api_url = window.location.protocol + "//" + window.location.host + "/getItemAjax";
var api_url1 = window.location.protocol + "//" + window.location.host + "/";

// var api_url = "http://coincap.levelten.org/getItemAjax";
// var api_url1 = "http://coincap.levelten.org/";

var start = '0';
var g_data;
let saveOrder = '';
let orderAscDesc = [false, false, false, false, false];
setInterval( ajaxFunction , 3000);
function ajaxFunction() {
    // Ajax starts
    $.ajax({
        type: "GET",
        url: api_url + '?page=' + page_number,
        dataType: 'json',
        success: function(data) {
           start = data.start;

            //Fix data
            data.data.forEach(function(element){
                if(element.price){
                    element.price = element.price.replace('$', '');
                    element.price = element.price.replace(',', '');
                }
                else element.price = "0.00";

                if(element.volume_24h) element.volume_24h = element.volume_24h.replace(/,/g, '');
                else element.volume_24h = "0.00";

                if(element.market_cap){
                    element.market_cap = parseFloat(element.market_cap);
                    element.market_cap = element.market_cap.toFixed(2);
                } else{
                    element.market_cap = 0.00;
                }
            });
            
            //Order
            switch(saveOrder){
                case "name": {
                    if(orderAscDesc[0]) data.data.sort((a, b) => (a.name > b.name) ? 1 : -1);
                    else data.data.sort((a, b) => (a.name < b.name) ? 1 : -1);
                    break;
                }
                case "price": {
                    if(orderAscDesc[1]){ 
                        data.data.sort((a, b) => {
                            return (parseFloat(a.price) > parseFloat(b.price) ? 1 : -1);
                        });
                    }
                    else{
                        data.data.sort((a, b) => {
                            return (parseFloat(a.price) < parseFloat(b.price) ? 1 : -1);
                        });
                    }
                    break;
                }
                case "percent_change_24h": {
                    if(orderAscDesc[2]){ 
                        data.data.sort((a, b) => {
                            return data.data.sort((a, b) => (parseFloat(a.percent_change_24h) > parseFloat(b.percent_change_24h)) ? 1 : -1);
                        });
                    }
                    else{
                        data.data.sort((a, b) => {
                            return data.data.sort((a, b) => (parseFloat(a.percent_change_24h) < parseFloat(b.percent_change_24h)) ? 1 : -1);
                        }); 
                    }
                    break;
                }
                case "volume_24h" :{
                    if(orderAscDesc[3]){
                        data.data.sort((a, b) => {
                            return ((parseFloat(a.volume_24h) > parseFloat(b.volume_24h)) ? 1 : -1);
                        });
                    }
                    else{
                        data.data.sort((a, b) => {
                            return ((parseFloat(a.volume_24h) < parseFloat(b.volume_24h)) ? 1 : -1);
                        });
                    }
                    break;
                }
                case "market_cap" :{
                    if(orderAscDesc[4]){
                        data.data.sort((a, b) => {
                            return ((parseFloat(a.market_cap) > parseFloat(b.market_cap)) ? 1 : -1);
                        });
                    } 
                    else{
                        data.data.sort((a, b) => {
                            return ((parseFloat(a.market_cap) < parseFloat(b.market_cap)) ? 1 : -1);
                        });
                    }
                    break;
                }
            }
            

            //Map
            var temp = '<div class="table-responsive"><table id="example1" class="table"> <thead class="flip-content"> <tr> <th onclick=orderBy("name") style="cursor: pointer">Cryptocurrency</th> <th onclick=orderBy("price") style="cursor: pointer">Price</th> <th onclick=orderBy("percent_change_24h") style="cursor: pointer" class="numeric">24h % change</th> <th class="numeric" onclick=orderBy("volume_24h") style="cursor: pointer">Volume</th> <th class="numeric" onclick=orderBy("market_cap") style="cursor: pointer">Market cap</th> <th class="numeric">24h performence</th> </tr></thead> <tbody>';
            data.data.forEach(function(element) {

                var o_graph = $("#G"+element.id).val();
                var t_tt = '<input type="hidden" id="R' + element.id + '" value="' + element.name + '" >';
                temp += t_tt;
                var t_tt = '<input type="hidden" id="G' + element.id + '" value="' + o_graph + '" >';
                temp += t_tt;
                var price_old = $("#" + element.id).html();
                //price_old = parseFloat(price_old);
                price_new = parseFloat(element.price);
                
                price_old = price_old.replace('$ ', '');

                element.price = element.price.replace(' ', '');

                var t_url = '"' + api_url1 + element.id + '?name=' + element.name + '"';
                if (element.percent_change_24h < 0) {
                    var percent_back = "width: 55px;max-width: 55px;background-color:#ed5565!important;color: #fff;border-radius: 30px; font-size: 0.8em;padding:5px 5px;display: inline-block;text-align:center;padding-bottom:3px;";
                } else {
                    var percent_back = "width: 55px;max-width: 55px;background-color:#57bd0f!important;color: #fff;border-radius: 30px; font-size: 0.8em;padding:5px 5px;display: inline-block;text-align:center;padding-bottom:3px;";
                }

                if (price_old < element.price) {
                    console.log("Value increased");

                    temp += '<tr onclick="test(' + element.id + ');" style="background-color: #8acc8a;cursor: pointer;"> <td> <img src="' + element.image_url + '" height="16" width="16">&nbsp;&nbsp;'+element.name+'</td><td id="' + element.id + '">$ ' + element.price + '</td><td class="numeric"><div style="' + percent_back + '"><span>' + element.percent_change_24h + '</span></div></td><td class="numeric">' + element.volume_24h + '</td><td class="numeric" style="color:rgb(66, 139, 202);">$ ' + element.market_cap + '</td><td class="numeric"> <img height="35" style="border: 1px solid #eee;" width="100" src="' + o_graph + '"> </td></tr>';
                } else if (price_old > element.price) {
                    console.log("Value decreased");
                    temp += '<tr onclick="test(' + element.id + ');" style="background-color: #e46565;cursor: pointer;"> <td> <img src="' + element.image_url + '" height="16" width="16">&nbsp;&nbsp;'+element.name+'</td><td id="' + element.id + '">$ ' + element.price + '</td><td class="numeric"><div style="' + percent_back + '"><span>' + element.percent_change_24h + '</span></div></td><td class="numeric">' + element.volume_24h + '</td><td class="numeric" style="color:rgb(66, 139, 202);">$ ' + element.market_cap + '</td><td class="numeric"> <img height="35" style="border: 1px solid #eee;" width="100" src="' + o_graph + '"> </td></tr>';
                } else {
                    temp += '<tr style="cursor: pointer;" onclick="test(' + element.id + ');" > <td> <img src="' + element.image_url + '" height="16" width="16">&nbsp;&nbsp;'+element.name+'</td><td id="' + element.id + '">$ ' + element.price + '</td><td class="numeric"><div style="' + percent_back + '"><span>' + element.percent_change_24h + '</span></div></td><td class="numeric">' + element.volume_24h + '</td><td class="numeric" style="color:rgb(66, 139, 202);">$ ' + element.market_cap + '</td><td class="numeric"> <img height="35" style="border: 1px solid #eee;" width="100" src="' + o_graph + '"> </td></tr>';
                }


            });

            temp += '</tbody></table></div><div id="pagination" class="float-right"></div>';

            document.getElementById("table_body").innerHTML = temp;

            var page_html = "";
            page_html += '<button class="btn pagination-btn" onclick="insertParam(1);">1</button>';
            for (var i = 2; i < data.recordsTotal / 25; i++) {

                if (i <= 5) {
                    page_html += '<button class="btn pagination-btn" onclick="insertParam(' + i + ');">' + i + '</button>';
                }
                if (i == 6) {
                    page_html += '<button class="btn pagination-btn">...</button><button class="btn pagination-btn" onclick="insertParam(' + i + ');">Next</button>';
                }

            }

            var last = data.recordsTotal / 25;
            last = parseInt(last);
            page_html += '<button class="btn pagination-btn" onclick="insertParam(' + last + ');">Last</button>';

            document.getElementById("pagination").innerHTML = page_html;


        }
    });
    // end of ajax
}

/***********************************************/
/*               Events on table               */
/***********************************************/
function orderBy(order){
    //alert(order);
    saveOrder = order;
    switch(saveOrder){
        case "name": {
            if(orderAscDesc[0])  orderAscDesc[0]=false;
            else orderAscDesc[0] = true;
            break;
        }
        case "price": {
            if(orderAscDesc[1])  orderAscDesc[1]=false;
            else orderAscDesc[1] = true;
            break;
        }
        case "percent_change_24h": {
            if(orderAscDesc[2])  orderAscDesc[2]=false;
            else orderAscDesc[2] = true;
            break;
        }
        case "volume_24h" :{
            if(orderAscDesc[3])  orderAscDesc[3]=false;
            else orderAscDesc[3] = true;
            break;
        }
        case "market_cap" :{
            if(orderAscDesc[4])  orderAscDesc[4]=false;
            else orderAscDesc[4] = true;
            break;
        }
    }
    ajaxFunction();
}

/***********************************************/
/***********************************************/


setInterval(function() {
    var cron_url = "https://market.fasbit.com/cron/test.php";
    //var cron_url = "http://cryptocompare.local/cron/test.php";
    let data = [];
    $("#table_body").find("td[id]").each(function(){data.push(parseInt($(this).attr("id")))});
 
    let paramns = {
        data: data
    }
    $.ajax({
        type: "POST",
        url: cron_url,
        data: paramns,
        success: function(data) {
            //console.log(data);
        }
    });
}, 3000);



// Ajax starts
$.ajax({
    type: "GET",
    url: api_url + '?page=' + page_number,
    dataType: 'json',
    success: function(data) {
        console.log(data.data);
        //alert(data);

        var temp = '<table id="example1" class="table"> <thead class="flip-content"> <tr> <th>Cryptocurrency</th> <th>Price</th> <th class="numeric">24h % change</th> <th class="numeric">Volume</th> <th class="numeric">Market cap</th> <th class="numeric">24h performence</th> </tr></thead> <tbody>';
        data.data.forEach(function(element) {
            
            if(element.price) element.price = element.price.replace(',', '');
            if(element.volume_24h) element.volume_24h = element.volume_24h.replace(/,/g, '');
            if(element.market_cap){ 
                element.market_cap = parseFloat(element.market_cap);
                element.market_cap = element.market_cap.toFixed(2);
            }
            
            var t_tt = '<input type="hidden" id="R' + element.id + '" value="' + element.name + '" >';
            temp += t_tt;
            var t_tt = '<input type="hidden" id="G' + element.id + '" value="' + element.chart_image + '" >';
            temp += t_tt;

            //element.name = '"'+element.name+'"';
            var t_url = '"' + api_url1 + element.id + '?name=' + element.name + '"';

            temp += '<tr style="cursor: pointer;" onclick="test(' + element.id + ');"> <td> <img src="' + element.image_url + '" height="16" width="16">&nbsp;&nbsp;<span class="highlgt">' + element.name + '</span></td><td id="' + element.id + '">' + element.price + '</td><td class="numeric">' + element.percent_change_24h + '</td><td class="numeric">' + element.volume_24h + '</td><td class="numeric">$ ' + element.market_cap + '</td><td class="numeric"> <img height="50" style="border: 1px solid #eee;" width="150" src="' + element.chart_image + '"> </td></tr>';


        });

        temp += '</tbody></table>';
        document.getElementById("table_body").innerHTML = temp;

        var page_html = "";
        page_html += '<button class="btn" onclick="insertParam(1);">First</button>';
        for (var i = 2; i < data.recordsTotal / 25; i++) {

            if (i == page_number - 1) {
                page_html += '<button class="btn" onclick="insertParam(' + i + ');">Previous</button>';
            }
            if (i == parseInt(page_number) + 1) {
                page_html += '<button class="btn" onclick="insertParam(' + i + ');">Next</button>';
            }
            //page_html += '<button class="btn" onclick="insertParam('+i+');">'+i+'</button>';
        }

        var last = data.recordsTotal / 25;
        last = parseInt(last);
        page_html += '<button class="btn" onclick="insertParam(' + last + ');">Last</button>';

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