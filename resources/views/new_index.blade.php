@extends('Layout.master') 

@section('title') 

{{$title->value}}  | Home 

@endsection

@section('meta')

<meta name="title" content=" Cryptocurrency Price,Volume, Traded Exchanges, Market Capital, ICO Reviews and Bitcoin News">

 <?php echo $meta_description->value; ?>
 <?php echo $meta_keyword->value; ?>


@endsection

 @section('content')

    <div class="container">
        @if($ads->status == 1)
            <img class="banner-img" src="{{url('/')}}/public/ad.jpg">
        @endif    
        <div class="row"> 
            @if($ads1->status == 1)
                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 min-add-div" > 
            @else
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 min-add-div" >   
            @endif
        </div>
        <div class="row padding-button-sort">
            <div class="col-lg-2 content-buttons-box d-block">
                <label class="pl-8"> Choose sort basis</label>
                <div class="row">
                <a href="{{url('/')}}/?order-by=market" class="basis-button space-button text-white "> Market Cap </a>         
                </div>
                <div class="row">
                    <a href="{{url('/')}}/?order-by=score" class="space-button second-section-single-coin text-white basis-button" >Investment Quality </a>                
                </div>
            </div>
            <div class="col-lg-4 content-buttons-box d-block">
                <label> Choose a Tier </label>
                <div class="row">
                    <div class="col-lg-12 d-flex">
                        <a href="{{url('/')}}/?page=1" class="text-white sort-buttton">
                            1st Tier 
                        </a>
                        <a href="{{url('/')}}/?page=2" class="text-white sort-buttton space-button" >
                           2nd Tier
                        </a> 
                        <a href="{{url('/')}}/?page=3" class="text-white sort-buttton space-button"> 
                           3rd Tier
                        </a> 
                        <a href="{{url('/')}}/?page=4" class="text-white sort-buttton space-button">
                           4th Tier
                        </a> 
                        <a href="{{url('/')}}/?page=5" class="text-white sort-buttton space-button">
                           5th Tier
                        </a>
                    </div>       
                </div>                  
              </div> 
        </div>
        <div class="dark container">
            <div class="tab-content">
                <div class="tab-pane active" id="top" role="tabpanel">  
                    <table id="coin-table" class="table coinlist">
                        <thead>
                            <tr>
                                <th class="tbl-col-sm"></th>
                                <th onclick="sortTable(1,this)" ><span class="d-none d-sm-block">Rank<i class="fa fa-fw fa-sort"></i></span></th>
                                <th colspan="2">Name</th>
                                <th class="text-center">Price</th>
                                <th class="d-none d-lg-table-cell text-right" onclick="sortTable(5,this)"> Market cap<i class="fa fa-fw fa-sort"></i> </th>
                                <th class="d-none d-lg-table-cell text-right" onclick="sortTable(6,this)"> Volume<i class="fa fa-fw fa-sort"></i></th>
                                <th class="d-none d-lg-table-cell text-right">1D</th>
                                <th class="d-none d-lg-table-cell text-right">7D</th>
                                <th class="d-none d-lg-table-cell text-right">14D</th>
                                <th class="d-none d-lg-table-cell text-right">30D</th>
                                <th class="d-none d-lg-table-cell text-right">90D</th>
                                <th class="d-none d-lg-table-cell text-right" onclick="sortTable(12,this)">Score<i class="fa fa-fw fa-sort"></i></th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach ($data as $index => $item)
                                @if(app('request')->input('page'))
                                    @php
                                        $rank= ($index+1)+( (  app('request')->input('page') - 1)*100)  
                                    @endphp      
                                @else
                                    @php 
                                        $rank= ($index+1)
                                    @endphp
                                @endif   
                                <tr coin_id="{{$item->id}}" coin_href="/coin/{{$item->symbol}}/{{$rank}}" >
                                    <td class="tbl-col-sm"></td>  
                                    <td class="tbl-col-sm">
                                        <span class="tbl-rank">
                                            @if(app('request')->input('page'))
                                                {{ $rank }}
                                            @else
                                                {{$rank}}
                                            @endif  
                                        </span>
                                    </td>
                                    <td class="fit clickable-coin-td">
                                        <img class="tbl-icon" src="{{$item->image_url}}?width=30" alt="{{$item->name}} logo">
                                    </td>
                                    <td class="clickable-coin-td">
                                        <div class="tbl-currency">
                                            @if(app('request')->input('page'))
                                                <a id="name" href="/coin/{{$item->symbol}}/{{$rank}}">{{$item->name}}</a>
                                            @else
                                                <a id="name" href="/coin/{{$item->symbol}}/{{$rank}}" >{{$item->name}}</a>
                                            @endif  
                                           <!-- <a id="name" href="/coin/{{$item->symbol}}/{{ (app('request')->input('page') ) ? ($index+1)+( (  app('request')->input('page') - 1)*100) : ($index+1) }}">{{$item->name}}</a>
                                            -->
                                            <span id="symbol" class="tbl-coin-abbrev">[{{$item->symbol}}]</span>
                                        </div>
                                        <div class="d-lg-none tbl-mob-info smaller">
                                            <span class="mob-info-title">Mkt Cap:&nbsp;</span>
                                            <span class="mob-info-value marketcap-859" data-market="{{$item->market_cap}}">{{$item->market_cap}}</span>
                                            <span class="mob-info-title">Volume:&nbsp;</span>
                                            <span class="mob-info-value volume-859" data-volume="{{$item->volume_24h}}">{{$item->volume_24h}}</span>
                                            <span class="mob-info-title">Price change percentage: </span>
                                            <br>
                                            <br>
                                            <br>
                                            <span class="mob-info-title">1D:</span>
                                            @if($item->percent_change_24h < 0)
                                                <span id="p_down" class="tbl-price pr-change delta-859 price down mob-info-value volume-859 p-0">{{number_format($item->percent_change_24h, 2, '.', ',')}}%</span>
                                            @else
                                                <span id="p_up" class="tbl-price pr-change delta-859 price up  mob-info-value volume-859 p-0">{{number_format($item->percent_change_24h, 2, '.', ',')}}%</span>
                                            @endif
                                            <span class="mob-info-title">7D:</span>
                                            @if($item->percent_change7d < 0)
                                                <span id="p_down_7" class="tbl-price pr-change delta-859 price down  mob-info-value volume-859 p-0">{{number_format($item->percent_change7d, 2, '.', ',')}}%</span>
                                            @else
                                                <span id="p_up_7" class="tbl-price pr-change delta-859 price up  mob-info-value volume-859 p-0">{{number_format($item->percent_change7d, 2, '.', ',')}}%</span>
                                            @endif
                                            <span class="mob-info-title">14D:</span>
                                            @if($item->percent_change14d < 0)
                                                {{-- <span id="p_up_14" class="tbl-price pr-change delta-859 price down p-0">{{ -- }}</span> --}}
                                                <span id="p_up_14" class="tbl-price pr-change delta-859 price down  mob-info-value volume-859 p-0">{{number_format($item->percent_change14d, 2, '.', ',')}}%</span>
                                            @else
                                                {{-- <span id="p_up_14" class="tbl-price pr-change delta-859 price up p-0">{{ -- }}</span> --}}
                                                <span id="p_up_14" class="tbl-price pr-change delta-859 price up  mob-info-value volume-859 p-0">{{number_format($item->percent_change14d, 2, '.', ',')}}%</span>
                                            @endif         
                                            <span class="mob-info-title">30D: </span>
                                            @if($item->percent_change30d < 0)
                                                <span id="p_down_30" class="tbl-price pr-change delta-859 price  mob-info-value volume-859 down p-0">{{number_format($item->percent_change30d, 2, '.', ',')}}%</span>    
                                            @else
                                                <span id="p_up_30" class="tbl-price pr-change delta-859 price up  mob-info-value volume-859 p-0">{{number_format($item->percent_change30d, 2, '.', ',')}}%</span>
                                            @endif
                                            <span class="mob-info-title">90D: </span>
                                            @if($item->percent_change90d < 0)
                                                <span id="p_down" class="tbl-price pr-change delta-859 price  mob-info-value volume-859 down p-0">{{number_format($item->percent_change90d, 2, '.', ',')}}%</span>
                                                {{-- <span id="p_up_90" class="tbl-price pr-change delta-859 price down  mob-info-value volume-859 p-0">--%</span> --}}
                                            @else
                                                {{-- <span id="p_up_90" class="tbl-price pr-change delta-859 price down  mob-info-value volume-859 p-0">--%</span> --}}
                                                <span id="p_up_90" class="tbl-price pr-change delta-859 price up mob-info-value volume-859 p-0">{{number_format($item->percent_change90d, 2, '.', ',')}}%</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="clickable-coin-td">
                                        <span id="price" class="tbl-price avgprice-859 price">${{number_format($item->price,8,".",",")}}</span>
                                    </td>
                                    <td class="d-none d-lg-table-cell clickable-coin-td">
                                        <span id="market_cap" class="tbl-price price dimmed marketcap-859" data="{{$item->market_cap}}">{{number_format($item->market_cap,0,".",",")}}</span>
                                    </td>
                                    <td class="d-none d-lg-table-cell clickable-coin-td">
                                        <span id="market_cap" class="tbl-price price dimmed marketcap-859" data="{{$item->volume_24h}}">{{number_format($item->volume_24h,0,".",",")}}</span>
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right">
                                        @if($item->percent_change_24h*100 < 0)
                                            <span id="p_down" class="tbl-price pr-change delta-859 price down perc_none p-0">@if($item->percent_change_24h*100 > -10)
                                                {{substr_replace(number_format($item->percent_change_24h*100,2,".",","),"0",1,0)}}
                                                @else 
                                                {{number_format($item->percent_change_24h*100,2,".",",")}}
                                                @endif %</span>
                                        @else
                                            <span id="p_up" class="tbl-price pr-change delta-859 price up perc_none p-0">@if($item->percent_change_24h*100 < 10)
                                                0{{number_format($item->percent_change_24h*100,2,".",",")}}   
                                            @else
                                                {{number_format($item->percent_change_24h*100,2,".",",")}} 
                                            @endif%</span>
                                        @endif
                                        {{-- Graph
                                        <span class="small-chart-container">
                                            <div class="small-chart small-live-chart">
                                                <div id="highcharts-q6qp1d2-0" class="highcharts-container" style="overflow: hidden; text-align: left;">
                                                                
                                                </div>
                                            </div>
                                        </span> --}}
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right">
                                        @if($item->percent_change7d*100 < 0)
                                            <span id="p_down_7" class="tbl-price pr-change delta-859 price down perc_none p-0">@if($item->percent_change7d*100 > -10) 
                                                {{substr_replace(number_format($item->percent_change7d*100,2,".",","),"0",1,0)}}
                                                @else
                                                {{number_format($item->percent_change7d*100, 2, '.', ',')}}
                                                @endif %</span>
                                        @else
                                            <span id="p_up_7" class="tbl-price pr-change delta-859 price up perc_none p-0">@if($item->percent_change7d*100<10)
                                                0{{number_format($item->percent_change7d*100, 2, '.', ',')}}
                                                @else 
                                                {{number_format($item->percent_change7d*100, 2, '.', ',')}}
                                                @endif %</span>
                                        @endif
                                        {{-- Graph
                                        <span class="small-chart-container">
                                            <div class="small-chart small-live-chart">
                                                <div id="highcharts-q6qp1d2-0" class="highcharts-container align-graph">
                                                                
                                                </div>
                                            </div>
                                        </span> --}}
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right" >
                                        @if($item->percent_change14d*100 < 0)
                                             <span id="p_up_14" class="tbl-price pr-change delta-859 price down perc_none p-0">@if($item->percent_change14d*100 > -10) 
                                                {{substr_replace(number_format($item->percent_change14d*100,2,".",","),"0",1,0)}} 
                                                @else 
                                                {{number_format($item->percent_change14d*100, 2, '.', ',')}}
                                                 @endif
                                                 %</span>
                                        @else
                                            <span id="p_up_14" class="tbl-price pr-change delta-859 price up perc_none p-0">@if ($item->percent_change14d*100 < 10) 
                                                0{{number_format($item->percent_change14d*100, 2, '.', ',')}}
                                                @else 
                                                {{number_format($item->percent_change14d*100, 2, '.', ',')}}
                                                @endif %</span>
                                        @endif
                                        {{-- Graph 
                                        <span class="small-chart-container">
                                            <div class="small-chart small-live-chart">
                                                <div id="highcharts-q6qp1d2-0" class="highcharts-container align-graph">               
                                                </div>
                                            </div>
                                        </span> --}}
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right" >
                                        @if($item->percent_change30d*100 < 0)
                                            <span id="p_down_30" class="tbl-price pr-change delta-859 price down perc_none p-0">@if($item->percent_change30d*100 > -10) 
                                                {{substr_replace(number_format($item->percent_change30d*100,2,".",","),"0",1,0)}} 
                                                @else 
                                                {{number_format($item->percent_change30d*100, 2, '.', ',')}}
                                                @endif %</span>    
                                        @else
                                            <span id="p_up_30" class="tbl-price pr-change delta-859 price up perc_none p-0"> @if($item->percent_change30d*100 < 10) 
                                                0{{number_format($item->percent_change30d*100, 2, '.', ',')}}
                                                @else 
                                                {{number_format($item->percent_change30d*100, 2, '.', ',')}}
                                                @endif%</span>
                                        @endif
                                        {{-- Graph 
                                        <span class="small-chart-container">
                                            <div class="small-chart small-live-chart">
                                                <div id="highcharts-q6qp1d2-0" class="highcharts-container align-graph">
                                                                
                                                </div>
                                            </div>
                                        </span> --}}
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right" >
                                        @if($item->percent_change90d*100 < 0)
                                            <span id="p_down" class="tbl-price pr-change delta-859 price down perc_none p-0">@if($item->percent_change90d*100 > -10) 
                                                {{substr_replace(number_format($item->percent_change90d*100,2,".",","),"0",1,0)}} 
                                                @else 
                                                {{number_format($item->percent_change90d*100, 2, '.', ',')}}
                                                @endif 
                                                %</span>
                                        @else
                                            <span id="p_up_90" class="tbl-price pr-change delta-859 price up perc_none p-0">@if($item->percent_change90d*100 < 10) 
                                                0{{number_format($item->percent_change90d*100, 2, '.', ',')}}
                                                @else 
                                                {{number_format($item->percent_change90d*100, 2, '.', ',')}}
                                                @endif %</span>
                                        @endif
                                        {{-- Graph 
                                        <span class="small-chart-container">
                                            <div class="small-chart small-live-chart">
                                                <div id="highcharts-q6qp1d2-0" class="highcharts-container align-graph">
                                                                
                                                </div>
                                            </div>
                                        </span> --}}
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right" >
                                       <span id="score" class="tbl-price pr-change delta-859 perc_none p-0"> {{number_format(($item->percent_change_24h*1.15*100 + $item->percent_change7d*1.25*100 + $item->percent_change14d*1.25*100 + $item->percent_change30d*1.2*100 + $item->percent_change90d*1.15*100), 6, '.', ',')}} </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
<br>
<br>
<br>
    @if($ads1->status == 1)
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 hide-add-div" style="display: inline-block;width: auto;"> 
            <img src="{{url('/')}}/public/add-bg.jpg" class="single-img-pro"> 
            <img src="{{url('/')}}/public/add-bg1.jpg" class="single-img-pro"> 
        </div>
    @endif
</div>
</div>

</div>
<!-- # right side -->

@endsection


@section('scripts')
<script>
$(document).ready(function(){
    $('table tbody tr').click(function(){
        window.location = $(this).attr('coin_href');
        return false;
    });
});
</script>
<script type="text/javascript" src="{{ URL::asset("public/js/sort_table.js") }}"></script>
<script type="text/javascript" src="{{ URL::asset("public/js/jquery-3.1.1.min.js") }}"></script>
<script type="text/javascript" src='{{ URL::asset("public/js/highcharts.js") }}' ></script>
<script type="text/javascript" src='{{ URL::asset("public/js/chart.1.js") }}' ></script>
<!--<script type="text/javascript" async src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5afec5426d44f1e2"></script>-->
@endsection
