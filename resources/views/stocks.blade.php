@extends('Layout.master')

@section('title')

{{$title->value}} | Stocks

@endsection

@section('content')
<div class="outer container" id="stocks-table">
    <div class="row">
        <div class="col-lg-12">
            <div class="tab-pane">
                <div class="row no-gutters">
                            
                    <div class="m-t-35 table-responsive">
                        <table class="table table-bordered table-striped flip-content">
                            <thead class="flip-content">
                                <tr>
                                    <th>Symbol</th> 
                                    <th>Name</th>
                                    <th>Open</th>
                                    <th>High</th>
                                    <th>Low</th>
                                    <th>Price</th>
                                    <th>Volume</th>
                                </tr>
                            </thead> 
                            <tbody>
                                <td id="loading" colspan="10">
                                    <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                                </td>
                                <?php $cont=0; ?>
                                @foreach($data as $item)
                                    <?php $cont++; ?>
                                    <tr class="itemsStock">
                                        <td data-id="{{$item->symbol}}">{{$item->symbol}}</td>
                                        <td>{{$item->name}}</td>
                                        <td id="{{$item->symbol}}Open"></td>
                                        <td id="{{$item->symbol}}High"></td>
                                        <td id="{{$item->symbol}}Low"></td>
                                        <td id="{{$item->symbol}}Price"></td>
                                        <td id="{{$item->symbol}}Volume"></td>
                                    </tr>
                                @endforeach
                                <?php 
                                  if($cont == 0):
                                  ?>
                                      <td colspan="10" style="font-size: 26px !important; text-align: center;">
                                        No results found
                                      <td>
                                  <?php   
                                  endif;
                                  ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>                      
</div>
@endsection

@section('scripts')
<script type="text/javascript">

    $(document).ready(()=>{
        let API = 'S672N57EU2CP2L0I';
        //let data = [];
        $(".table").find("td[data-id]").each(function(){
            //data.push($(this).attr("data-id"));
            $url = 'https://www.alphavantage.co/query?function=GLOBAL_QUOTE&symbol='+$(this).attr("data-id")+'&apikey='+API;
            //data.push($url);
            $.ajax({
                type: "GET",
                url: $url,
                success: function(data) {
                    $("#"+data["Global Quote"]['01. symbol']+"Open").text(data["Global Quote"]['02. open']);
                    $("#"+data["Global Quote"]['01. symbol']+"High").text(data["Global Quote"]['03. high']);
                    $("#"+data["Global Quote"]['01. symbol']+"Low").text(data["Global Quote"]['04. low']);
                    $("#"+data["Global Quote"]['01. symbol']+"Price").text(data["Global Quote"]['05. price']);
                    $("#"+data["Global Quote"]['01. symbol']+"Volume").text(data["Global Quote"]['06. volume']);
                    //console.log($("#"+data["Global Quote"]['01. symbol']+"Open"));
                    //console.log(data)
                }
            });
        });
        $('#loading').hide();
        $(".itemsStock").show("slow");
        //console.log(data);
    })


</script>

@endsection