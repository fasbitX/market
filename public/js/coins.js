/*************************************************************************/
/*************************  ADMIN SECTION  *******************************/
/*************************************************************************/

$('#list_search_coin').hide();
$('#errorStock').hide();
$('.lds-roller').hide();


$("#search_coin_form").submit((e)=>{
    $('#list_search_coin').hide("slow");
    $('.lds-roller').show();
    e.preventDefault();
    

    let val = $("#search_coin_text").val();
    $url = 'https://min-api.cryptocompare.com/data/coin/generalinfo?fsyms='+val.toUpperCase()+'&tsym=USD';
    console.log($url);
    
    $.ajax({
        type: "GET",
        url: $url,
        success: function(data) {
            
            $('.lds-roller').hide();
            if(data.Message=="Success"){
                let html = '';
            
              //  console.log(data->Data[0]);
                let array = "'"+data.Data[0].CoinInfo.Name+ ','+data.Data[0].CoinInfo.FullName+"'";
                let aux = '<li onclick="add_coin('+array+');">'+
                                '<strong>'+data.Data[0].CoinInfo.Name+' </strong>'+
                                '<span> - '+data.Data[0].CoinInfo.FullName+' </span>'+
                            '</li>';
                html += aux;
          
                let ul = document.getElementById("list_search_stock");
                ul.innerHTML = html;
                $('#list_search_stock').show("slow");

            }
            else{
                $('#list_search_stock').hide();
                document.getElementById('error-t').innerHTML  = 'This coin does not exists in the API';
                $('#errorStock').click();
            }
            
        },
        error: function(){
            document.getElementById('error-t').innerHTML  = 'Error, it could not access to the API in this moment, please try it again.'; 
            $('.lds-roller').hide();
            $('#errorStock').click();
           
        }

      
    });
    
});


function add_coin(array){
    
    let _data = array.split(",");
    let paramns = {
        symbol: _data[0],
        name: _data[1],
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "/admin/ccoins",
        data: paramns,
        success: function(data) {
            console.log(data);
            if(data == "error") {
                document.getElementById('error-t').innerHTML  = 'This coin already added';
                $('#errorStock').click();
            }
            else location.reload();
        },
        error: function() {
            document.getElementById('error-t').innerHTML  = "Error, it could not save the API's data, please try to add it again";
            $('#errorStock').click();
        }
    });
}


setInterval((e)=>{
    if($("#search_coin_text").val() == '') $('#list_search_coin').hide("slow");
}, 500); 