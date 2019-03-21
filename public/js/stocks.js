/*************************************************************************/
/*************************  ADMIN SECTION  *******************************/
/*************************************************************************/

$('#list_search_stock').hide();
$('#errorStock').hide();
$('.lds-roller').hide();


let API = 'S672N57EU2CP2L0I';
$("#search_stock_form").submit((e)=>{
    $('#list_search_stock').hide("slow");
    $('.lds-roller').show();
    e.preventDefault();
    let val = $("#search_stock_text").val();
    $url = 'https://www.alphavantage.co/query?function=SYMBOL_SEARCH&keywords='+val+'&apikey='+API;

    $.ajax({
        type: "GET",
        url: $url,
        success: function(data) {
            $('.lds-roller').hide();
            let html = '';
            data.bestMatches.map((item)=>{     
                //console.log(item);
                let array = "'"+item['1. symbol']+ ','+item['2. name']+','+item['4. region']+"'";
                let aux = '<li onclick="add_stock('+array+');">'+
                                '<strong>'+item['1. symbol']+' </strong>'+
                                '<span> - '+item['2. name']+' </span>'+
                                '<span> | '+item['4. region']+' </span>'+
                            '</li>';
                html += aux;
            });
            let ul = document.getElementById("list_search_stock");
            ul.innerHTML = html;
            $('#list_search_stock').show("slow");
        }
    });
    
});


function add_stock(array){
    //var URL = "https://market.fasbit.com/cron/test.php";
    let _data = array.split(",");
    let paramns = {
        symbol: _data[0],
        name: _data[1],
        region: _data[2]
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "/admin/stocks",
        data: paramns,
        success: function(data) {
            //console.log(data);
            if(data == "success") location.reload();
            else $('#errorStock').click();
        }
    });
}


setInterval((e)=>{
    if($("#search_stock_text").val() == '') $('#list_search_stock').hide("slow");
}, 500);

/*************************************************************************/
/************************ END  ADMIN SECTION *****************************/
/*************************************************************************/

