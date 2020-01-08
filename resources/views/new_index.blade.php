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
                <a href="{{url('/')}}{{$categoryUrl}}/?order-by=market" class="basis-button space-button text-white ">Market Cap</a>         
                </div>
                <div class="row">
                    <a href="{{url('/')}}{{$categoryUrl}}/?order-by=score" class="space-button second-section-single-coin text-white basis-button" >Investment Quality</a>
                </div>
                <div class="row">
                    <a href="{{url('/')}}{{$categoryUrl}}/?order-by=volume" class="space-button second-section-single-coin text-white basis-button" >Volume</a>
                </div>
            </div>
            <div class="col-lg-4 content-buttons-box d-block">
                <label> Choose a Tier </label>
                <div class="row">
                    <div class="col-lg-12 d-flex">
                        <a href="{{url('/')}}{{$categoryUrl}}/?page=1" class="text-white sort-buttton">
                            1st Tier 
                        </a>
                        <a href="{{url('/')}}{{$categoryUrl}}/?page=2" class="text-white sort-buttton space-button" >
                           2nd Tier
                        </a> 
                        <a href="{{url('/')}}{{$categoryUrl}}/?page=3" class="text-white sort-buttton space-button"> 
                           3rd Tier
                        </a> 
                        <a href="{{url('/')}}{{$categoryUrl}}/?page=4" class="text-white sort-buttton space-button">
                           4th Tier
                        </a> 
                        <a href="{{url('/')}}{{$categoryUrl}}/?page=5" class="text-white sort-buttton space-button">
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
                                <th rowspan="2" class="text-center">Coin</th>
                                <th rowspan="2" colspan="2" class="text-center">Vitals</th>
                                <th colspan="5" class="text-center">Changes in Vitals</th>
                                <th rowspan="2" class="text-center">Rank</th>
                                <th colspan="4" class="text-center">Changes in Rank</th>
                            </tr>
                            <tr>
                                <th class="text-right">1D</th>
                                <th class="text-right">7D</th>
                                <th class="text-right">14D</th>
                                <th class="text-right">30D</th>
                                <th class="text-right">90D</th>
                                <th class="text-right">3H</th>
                                <th class="text-right">6H</th>
                                <th class="text-right">12H</th>
                                <th class="text-right">24H</th>
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
                                <tr>
                                    <td rowspan="4" class="text-center">
                                        <div>
                                            <img class="tbl-icon" src="{{$item->image_url}}?width=30" alt="{{$item->name}} logo">
                                        </div>
                                        <div>
                                            {{$item->name}}
                                        </div>
                                        <div>
                                            <span id="symbol" class="tbl-coin-abbrev">[{{$item->symbol}}]</span>
                                        </div>
                                        <div>
                                            <a class="badge badge-light" href="{{url('/coin-chart/' . $item->symbol)}}">Charts</a>
                                        </div>
                                    </td>
                                    <td>
                                        Market Cap
                                    </td>
                                    <td>
                                        <span id="market_cap" class="tbl-price avgprice-859 price" data="{{$item->market_cap}}">{{number_format($item->market_cap,0,".",",")}}</span>
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right">
                                        @if($item->market_cap_24h_change < 0)
                                            <span id="p_down" class="tbl-price pr-change delta-859 price down perc_none p-0">@if($item->market_cap_24h_change > -10)
                                                {{substr_replace(number_format($item->market_cap_24h_change,2,".",","),"0",1,0)}}
                                                @else 
                                                {{number_format($item->market_cap_24h_change,2,".",",")}}
                                                @endif %</span>
                                        @else
                                            <span id="p_up" class="tbl-price pr-change delta-859 price up perc_none p-0">@if($item->market_cap_24h_change < 10)
                                                0{{number_format($item->market_cap_24h_change,2,".",",")}}   
                                            @else
                                                {{number_format($item->market_cap_24h_change,2,".",",")}} 
                                            @endif%</span>
                                        @endif
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right">
                                        @if($item->market_cap_7d_change < 0)
                                            <span id="p_down_7" class="tbl-price pr-change delta-859 price down perc_none p-0">@if($item->market_cap_7d_change > -10) 
                                                {{substr_replace(number_format($item->market_cap_7d_change,2,".",","),"0",1,0)}}
                                                @else
                                                {{number_format($item->market_cap_7d_change, 2, '.', ',')}}
                                                @endif %</span>
                                        @else
                                            <span id="p_up_7" class="tbl-price pr-change delta-859 price up perc_none p-0">@if($item->market_cap_7d_change<10)
                                                0{{number_format($item->market_cap_7d_change, 2, '.', ',')}}
                                                @else 
                                                {{number_format($item->market_cap_7d_change, 2, '.', ',')}}
                                                @endif %</span>
                                        @endif
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right" >
                                        @if($item->market_cap_14d_change < 0)
                                             <span id="p_up_14" class="tbl-price pr-change delta-859 price down perc_none p-0">@if($item->market_cap_14d_change > -10) 
                                                {{substr_replace(number_format($item->market_cap_14d_change,2,".",","),"0",1,0)}} 
                                                @else 
                                                {{number_format($item->market_cap_14d_change, 2, '.', ',')}}
                                                 @endif
                                                 %</span>
                                        @else
                                            <span id="p_up_14" class="tbl-price pr-change delta-859 price up perc_none p-0">@if ($item->market_cap_14d_change < 10) 
                                                0{{number_format($item->market_cap_14d_change, 2, '.', ',')}}
                                                @else 
                                                {{number_format($item->market_cap_14d_change, 2, '.', ',')}}
                                                @endif %</span>
                                        @endif
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right" >
                                        @if($item->market_cap_30d_change < 0)
                                            <span id="p_down_30" class="tbl-price pr-change delta-859 price down perc_none p-0">@if($item->market_cap_30d_change > -10) 
                                                {{substr_replace(number_format($item->market_cap_30d_change,2,".",","),"0",1,0)}} 
                                                @else 
                                                {{number_format($item->market_cap_30d_change, 2, '.', ',')}}
                                                @endif %</span>    
                                        @else
                                            <span id="p_up_30" class="tbl-price pr-change delta-859 price up perc_none p-0"> @if($item->market_cap_30d_change < 10) 
                                                0{{number_format($item->market_cap_30d_change, 2, '.', ',')}}
                                                @else 
                                                {{number_format($item->market_cap_30d_change, 2, '.', ',')}}
                                                @endif%</span>
                                        @endif
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right" >
                                        @if($item->market_cap_90d_change < 0)
                                            <span id="p_down" class="tbl-price pr-change delta-859 price down perc_none p-0">@if($item->market_cap_90d_change > -10) 
                                                {{substr_replace(number_format($item->market_cap_90d_change,2,".",","),"0",1,0)}} 
                                                @else 
                                                {{number_format($item->market_cap_90d_change, 2, '.', ',')}}
                                                @endif 
                                                %</span>
                                        @else
                                            <span id="p_up_90" class="tbl-price pr-change delta-859 price up perc_none p-0">@if($item->market_cap_90d_change < 10) 
                                                0{{number_format($item->market_cap_90d_change, 2, '.', ',')}}
                                                @else 
                                                {{number_format($item->market_cap_90d_change, 2, '.', ',')}}
                                                @endif %</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ $item->market_cap_rank }}
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right" >
                                        @if($item->market_cap_rank_3h_change < 0)
                                            <span id="p_down_30" class="tbl-price pr-change delta-859 price down perc_none p-0">
                                                {{$item->market_cap_rank_3h_change}}
                                            </span>    
                                        @else
                                            <span id="p_up_30" class="tbl-price pr-change delta-859 price up perc_none p-0">
                                                {{($item->market_cap_rank_3h_change == 0) ? 0 : ('+' . $item->market_cap_rank_3h_change)}}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right" >
                                        @if($item->market_cap_rank_6h_change < 0)
                                            <span id="p_down_30" class="tbl-price pr-change delta-859 price down perc_none p-0">
                                                {{$item->market_cap_rank_6h_change}}
                                            </span>    
                                        @else
                                            <span id="p_up_30" class="tbl-price pr-change delta-859 price up perc_none p-0">
                                                {{($item->market_cap_rank_6h_change == 0) ? 0 : ('+' . $item->market_cap_rank_6h_change)}}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right" >
                                        @if($item->market_cap_rank_12h_change < 0)
                                            <span id="p_down_30" class="tbl-price pr-change delta-859 price down perc_none p-0">
                                                {{$item->market_cap_rank_12h_change}}
                                            </span>    
                                        @else
                                            <span id="p_up_30" class="tbl-price pr-change delta-859 price up perc_none p-0">
                                                {{($item->market_cap_rank_12h_change == 0) ? 0 : ('+' . $item->market_cap_rank_12h_change)}}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right" >
                                        @if($item->market_cap_rank_24h_change < 0)
                                            <span id="p_down_30" class="tbl-price pr-change delta-859 price down perc_none p-0">
                                                {{$item->market_cap_rank_24h_change}}
                                            </span>    
                                        @else
                                            <span id="p_up_30" class="tbl-price pr-change delta-859 price up perc_none p-0">
                                                {{($item->market_cap_rank_24h_change == 0) ? 0 : ('+' . $item->market_cap_rank_24h_change)}}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Price
                                    </td>
                                    <td>
                                        <span id="price" class="tbl-price avgprice-859 price">${{number_format($item->price,8,".",",")}}</span>
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right">
                                        @if($item->price_24h_change < 0)
                                            <span id="p_down" class="tbl-price pr-change delta-859 price down perc_none p-0">@if($item->price_24h_change > -10)
                                                {{substr_replace(number_format($item->price_24h_change,2,".",","),"0",1,0)}}
                                                @else 
                                                {{number_format($item->price_24h_change,2,".",",")}}
                                                @endif %</span>
                                        @else
                                            <span id="p_up" class="tbl-price pr-change delta-859 price up perc_none p-0">@if($item->price_24h_change < 10)
                                                0{{number_format($item->price_24h_change,2,".",",")}}   
                                            @else
                                                {{number_format($item->price_24h_change,2,".",",")}} 
                                            @endif%</span>
                                        @endif
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right">
                                        @if($item->price_7d_change < 0)
                                            <span id="p_down_7" class="tbl-price pr-change delta-859 price down perc_none p-0">@if($item->price_7d_change > -10) 
                                                {{substr_replace(number_format($item->price_7d_change,2,".",","),"0",1,0)}}
                                                @else
                                                {{number_format($item->price_7d_change, 2, '.', ',')}}
                                                @endif %</span>
                                        @else
                                            <span id="p_up_7" class="tbl-price pr-change delta-859 price up perc_none p-0">@if($item->price_7d_change<10)
                                                0{{number_format($item->price_7d_change, 2, '.', ',')}}
                                                @else 
                                                {{number_format($item->price_7d_change, 2, '.', ',')}}
                                                @endif %</span>
                                        @endif
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right" >
                                        @if($item->price_14d_change < 0)
                                             <span id="p_up_14" class="tbl-price pr-change delta-859 price down perc_none p-0">@if($item->price_14d_change > -10) 
                                                {{substr_replace(number_format($item->price_14d_change,2,".",","),"0",1,0)}} 
                                                @else 
                                                {{number_format($item->price_14d_change, 2, '.', ',')}}
                                                 @endif
                                                 %</span>
                                        @else
                                            <span id="p_up_14" class="tbl-price pr-change delta-859 price up perc_none p-0">@if ($item->price_14d_change < 10) 
                                                0{{number_format($item->price_14d_change, 2, '.', ',')}}
                                                @else 
                                                {{number_format($item->price_14d_change, 2, '.', ',')}}
                                                @endif %</span>
                                        @endif
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right" >
                                        @if($item->price_30d_change < 0)
                                            <span id="p_down_30" class="tbl-price pr-change delta-859 price down perc_none p-0">@if($item->price_30d_change > -10) 
                                                {{substr_replace(number_format($item->price_30d_change,2,".",","),"0",1,0)}} 
                                                @else 
                                                {{number_format($item->price_30d_change, 2, '.', ',')}}
                                                @endif %</span>    
                                        @else
                                            <span id="p_up_30" class="tbl-price pr-change delta-859 price up perc_none p-0"> @if($item->price_30d_change < 10) 
                                                0{{number_format($item->price_30d_change, 2, '.', ',')}}
                                                @else 
                                                {{number_format($item->price_30d_change, 2, '.', ',')}}
                                                @endif%</span>
                                        @endif
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right" >
                                        @if($item->price_90d_change < 0)
                                            <span id="p_down" class="tbl-price pr-change delta-859 price down perc_none p-0">@if($item->price_90d_change > -10) 
                                                {{substr_replace(number_format($item->price_90d_change,2,".",","),"0",1,0)}} 
                                                @else 
                                                {{number_format($item->price_90d_change, 2, '.', ',')}}
                                                @endif 
                                                %</span>
                                        @else
                                            <span id="p_up_90" class="tbl-price pr-change delta-859 price up perc_none p-0">@if($item->price_90d_change < 10) 
                                                0{{number_format($item->price_90d_change, 2, '.', ',')}}
                                                @else 
                                                {{number_format($item->price_90d_change, 2, '.', ',')}}
                                                @endif %</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        -
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right" >
                                        -
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right" >
                                        -
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right" >
                                        -
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right" >
                                        -
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Volume
                                    </td>
                                    <td>
                                        <span id="market_cap" class="tbl-price avgprice-859 price" data="{{$item->volume_24h}}">{{number_format($item->volume_24h,0,".",",")}}</span>
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right">
                                        @if($item->volume_24h_24h_change < 0)
                                            <span id="p_down" class="tbl-price pr-change delta-859 price down perc_none p-0">@if($item->volume_24h_24h_change > -10)
                                                {{substr_replace(number_format($item->volume_24h_24h_change,2,".",","),"0",1,0)}}
                                                @else 
                                                {{number_format($item->volume_24h_24h_change,2,".",",")}}
                                                @endif %</span>
                                        @else
                                            <span id="p_up" class="tbl-price pr-change delta-859 price up perc_none p-0">@if($item->volume_24h_24h_change < 10)
                                                0{{number_format($item->volume_24h_24h_change,2,".",",")}}   
                                            @else
                                                {{number_format($item->volume_24h_24h_change,2,".",",")}} 
                                            @endif%</span>
                                        @endif
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right">
                                        @if($item->volume_24h_7d_change < 0)
                                            <span id="p_down_7" class="tbl-price pr-change delta-859 price down perc_none p-0">@if($item->volume_24h_7d_change > -10) 
                                                {{substr_replace(number_format($item->volume_24h_7d_change,2,".",","),"0",1,0)}}
                                                @else
                                                {{number_format($item->volume_24h_7d_change, 2, '.', ',')}}
                                                @endif %</span>
                                        @else
                                            <span id="p_up_7" class="tbl-price pr-change delta-859 price up perc_none p-0">@if($item->volume_24h_7d_change<10)
                                                0{{number_format($item->volume_24h_7d_change, 2, '.', ',')}}
                                                @else 
                                                {{number_format($item->volume_24h_7d_change, 2, '.', ',')}}
                                                @endif %</span>
                                        @endif
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right" >
                                        @if($item->volume_24h_14d_change < 0)
                                             <span id="p_up_14" class="tbl-price pr-change delta-859 price down perc_none p-0">@if($item->volume_24h_14d_change > -10) 
                                                {{substr_replace(number_format($item->volume_24h_14d_change,2,".",","),"0",1,0)}} 
                                                @else 
                                                {{number_format($item->volume_24h_14d_change, 2, '.', ',')}}
                                                 @endif
                                                 %</span>
                                        @else
                                            <span id="p_up_14" class="tbl-price pr-change delta-859 price up perc_none p-0">@if ($item->volume_24h_14d_change < 10) 
                                                0{{number_format($item->volume_24h_14d_change, 2, '.', ',')}}
                                                @else 
                                                {{number_format($item->volume_24h_14d_change, 2, '.', ',')}}
                                                @endif %</span>
                                        @endif
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right" >
                                        @if($item->volume_24h_30d_change < 0)
                                            <span id="p_down_30" class="tbl-price pr-change delta-859 price down perc_none p-0">@if($item->volume_24h_30d_change > -10) 
                                                {{substr_replace(number_format($item->volume_24h_30d_change,2,".",","),"0",1,0)}} 
                                                @else 
                                                {{number_format($item->volume_24h_30d_change, 2, '.', ',')}}
                                                @endif %</span>    
                                        @else
                                            <span id="p_up_30" class="tbl-price pr-change delta-859 price up perc_none p-0"> @if($item->volume_24h_30d_change < 10) 
                                                0{{number_format($item->volume_24h_30d_change, 2, '.', ',')}}
                                                @else 
                                                {{number_format($item->volume_24h_30d_change, 2, '.', ',')}}
                                                @endif%</span>
                                        @endif
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right" >
                                        @if($item->volume_24h_90d_change < 0)
                                            <span id="p_down" class="tbl-price pr-change delta-859 price down perc_none p-0">@if($item->volume_24h_90d_change > -10) 
                                                {{substr_replace(number_format($item->volume_24h_90d_change,2,".",","),"0",1,0)}} 
                                                @else 
                                                {{number_format($item->volume_24h_90d_change, 2, '.', ',')}}
                                                @endif 
                                                %</span>
                                        @else
                                            <span id="p_up_90" class="tbl-price pr-change delta-859 price up perc_none p-0">@if($item->volume_24h_90d_change < 10) 
                                                0{{number_format($item->volume_24h_90d_change, 2, '.', ',')}}
                                                @else 
                                                {{number_format($item->volume_24h_90d_change, 2, '.', ',')}}
                                                @endif %</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ $item->volume_24h_rank }}
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right" >
                                        @if($item->volume_24h_rank_3h_change < 0)
                                            <span id="p_down_30" class="tbl-price pr-change delta-859 price down perc_none p-0">
                                                {{$item->volume_24h_rank_3h_change}}
                                            </span>    
                                        @else
                                            <span id="p_up_30" class="tbl-price pr-change delta-859 price up perc_none p-0">
                                                {{($item->volume_24h_rank_3h_change == 0) ? 0 : ('+' . $item->volume_24h_rank_3h_change)}}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right" >
                                        @if($item->volume_24h_rank_6h_change < 0)
                                            <span id="p_down_30" class="tbl-price pr-change delta-859 price down perc_none p-0">
                                                {{$item->volume_24h_rank_6h_change}}
                                            </span>    
                                        @else
                                            <span id="p_up_30" class="tbl-price pr-change delta-859 price up perc_none p-0">
                                                {{($item->volume_24h_rank_6h_change == 0) ? 0 : ('+' . $item->volume_24h_rank_6h_change)}}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right" >
                                        @if($item->volume_24h_rank_12h_change < 0)
                                            <span id="p_down_30" class="tbl-price pr-change delta-859 price down perc_none p-0">
                                                {{$item->volume_24h_rank_12h_change}}
                                            </span>    
                                        @else
                                            <span id="p_up_30" class="tbl-price pr-change delta-859 price up perc_none p-0">
                                                {{($item->volume_24h_rank_12h_change == 0) ? 0 : ('+' . $item->volume_24h_rank_12h_change)}}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right" >
                                        @if($item->volume_24h_rank_24h_change < 0)
                                            <span id="p_down_30" class="tbl-price pr-change delta-859 price down perc_none p-0">
                                                {{$item->volume_24h_rank_24h_change}}
                                            </span>    
                                        @else
                                            <span id="p_up_30" class="tbl-price pr-change delta-859 price up perc_none p-0">
                                                {{($item->volume_24h_rank_24h_change == 0) ? 0 : ('+' . $item->volume_24h_rank_24h_change)}}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Score
                                    </td>
                                    <td>
                                        <span id="score" class="tbl-price avgprice-859 price"> {{number_format($item->score, 6, '.', ',')}} </span>
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right">
                                        @if($item->score_24h_change < 0)
                                            <span id="p_down" class="tbl-price pr-change delta-859 price down perc_none p-0">@if($item->score_24h_change > -10)
                                                {{substr_replace(number_format($item->score_24h_change,2,".",","),"0",1,0)}}
                                                @else 
                                                {{number_format($item->score_24h_change,2,".",",")}}
                                                @endif %</span>
                                        @else
                                            <span id="p_up" class="tbl-price pr-change delta-859 price up perc_none p-0">@if($item->score_24h_change < 10)
                                                0{{number_format($item->score_24h_change,2,".",",")}}   
                                            @else
                                                {{number_format($item->score_24h_change,2,".",",")}} 
                                            @endif%</span>
                                        @endif
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right">
                                        @if($item->score_7d_change < 0)
                                            <span id="p_down_7" class="tbl-price pr-change delta-859 price down perc_none p-0">@if($item->score_7d_change > -10) 
                                                {{substr_replace(number_format($item->score_7d_change,2,".",","),"0",1,0)}}
                                                @else
                                                {{number_format($item->score_7d_change, 2, '.', ',')}}
                                                @endif %</span>
                                        @else
                                            <span id="p_up_7" class="tbl-price pr-change delta-859 price up perc_none p-0">@if($item->score_7d_change<10)
                                                0{{number_format($item->score_7d_change, 2, '.', ',')}}
                                                @else 
                                                {{number_format($item->score_7d_change, 2, '.', ',')}}
                                                @endif %</span>
                                        @endif
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right" >
                                        @if($item->score_14d_change < 0)
                                             <span id="p_up_14" class="tbl-price pr-change delta-859 price down perc_none p-0">@if($item->score_14d_change > -10) 
                                                {{substr_replace(number_format($item->score_14d_change,2,".",","),"0",1,0)}} 
                                                @else 
                                                {{number_format($item->score_14d_change, 2, '.', ',')}}
                                                 @endif
                                                 %</span>
                                        @else
                                            <span id="p_up_14" class="tbl-price pr-change delta-859 price up perc_none p-0">@if ($item->score_14d_change < 10) 
                                                0{{number_format($item->score_14d_change, 2, '.', ',')}}
                                                @else 
                                                {{number_format($item->score_14d_change, 2, '.', ',')}}
                                                @endif %</span>
                                        @endif
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right" >
                                        @if($item->score_30d_change < 0)
                                            <span id="p_down_30" class="tbl-price pr-change delta-859 price down perc_none p-0">@if($item->score_30d_change > -10) 
                                                {{substr_replace(number_format($item->score_30d_change,2,".",","),"0",1,0)}} 
                                                @else 
                                                {{number_format($item->score_30d_change, 2, '.', ',')}}
                                                @endif %</span>    
                                        @else
                                            <span id="p_up_30" class="tbl-price pr-change delta-859 price up perc_none p-0"> @if($item->score_30d_change < 10) 
                                                0{{number_format($item->score_30d_change, 2, '.', ',')}}
                                                @else 
                                                {{number_format($item->score_30d_change, 2, '.', ',')}}
                                                @endif%</span>
                                        @endif
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right" >
                                        @if($item->score_90d_change < 0)
                                            <span id="p_down" class="tbl-price pr-change delta-859 price down perc_none p-0">@if($item->score_90d_change > -10) 
                                                {{substr_replace(number_format($item->score_90d_change,2,".",","),"0",1,0)}} 
                                                @else 
                                                {{number_format($item->score_90d_change, 2, '.', ',')}}
                                                @endif 
                                                %</span>
                                        @else
                                            <span id="p_up_90" class="tbl-price pr-change delta-859 price up perc_none p-0">@if($item->score_90d_change < 10) 
                                                0{{number_format($item->score_90d_change, 2, '.', ',')}}
                                                @else 
                                                {{number_format($item->score_90d_change, 2, '.', ',')}}
                                                @endif %</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ $item->score_rank }}
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right" >
                                        @if($item->score_rank_3h_change < 0)
                                            <span id="p_down_30" class="tbl-price pr-change delta-859 price down perc_none p-0">
                                                {{$item->score_rank_3h_change}}
                                            </span>    
                                        @else
                                            <span id="p_up_30" class="tbl-price pr-change delta-859 price up perc_none p-0">
                                                {{($item->score_rank_3h_change == 0) ? 0 : ('+' . $item->score_rank_3h_change)}}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right" >
                                        @if($item->score_rank_6h_change < 0)
                                            <span id="p_down_30" class="tbl-price pr-change delta-859 price down perc_none p-0">
                                                {{$item->score_rank_6h_change}}
                                            </span>    
                                        @else
                                            <span id="p_up_30" class="tbl-price pr-change delta-859 price up perc_none p-0">
                                                {{($item->score_rank_6h_change == 0) ? 0 : ('+' . $item->score_rank_6h_change)}}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right" >
                                        @if($item->score_rank_12h_change < 0)
                                            <span id="p_down_30" class="tbl-price pr-change delta-859 price down perc_none p-0">
                                                {{$item->score_rank_12h_change}}
                                            </span>    
                                        @else
                                            <span id="p_up_30" class="tbl-price pr-change delta-859 price up perc_none p-0">
                                                {{($item->score_rank_12h_change == 0) ? 0 : ('+' . $item->score_rank_12h_change)}}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="tbl-col-md change-period clickable-coin-td text-right" >
                                        @if($item->score_rank_24h_change < 0)
                                            <span id="p_down_30" class="tbl-price pr-change delta-859 price down perc_none p-0">
                                                {{$item->score_rank_24h_change}}
                                            </span>    
                                        @else
                                            <span id="p_up_30" class="tbl-price pr-change delta-859 price up perc_none p-0">
                                                {{($item->score_rank_24h_change == 0) ? 0 : ('+' . $item->score_rank_24h_change)}}
                                            </span>
                                        @endif
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
<script type="text/javascript" src="{{ URL::asset("public/js/sort_table.js") }}"></script>
<script type="text/javascript" src="{{ URL::asset("public/js/jquery-3.1.1.min.js") }}"></script>
<script type="text/javascript" src='{{ URL::asset("public/js/highcharts.js") }}' ></script>
<script type="text/javascript" src='{{ URL::asset("public/js/chart.1.js") }}' ></script>
<!--<script type="text/javascript" async src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5afec5426d44f1e2"></script>-->
@endsection
