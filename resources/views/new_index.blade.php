@extends('Layout.master') 

@section('title') 

{{$title->value}}  | Home 

@endsection

@section('meta')

<meta name="title" content=" Cryptocurrency Price,Volume, Traded Exchanges, Market Capital, ICO Reviews and Bitcoin News">
<!-- <meta name="description" content="All Live Prices of Cryptocurrency, Volume, Charts, Market capitalisation, ICO Reviews, News present in one place. With Forum and community discussion, advice">
<meta name="keywords" content="Cryptocurrency Price,Cryptocurrency Trade volume, Cryptocurrency compare,Cryptocurrency News, ICO review">
 -->
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
                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 min-add-div" style="display: inline-block;width: 100%;">   
                @else
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 min-add-div" style="display: inline-block;width: 100%;">   
                @endif
            </div>
            <div class="dark container">
                <div class="tab-content">
                    <div class="tab-pane active" id="top" role="tabpanel">
                        
                        <table class="table coinlist">
                            <thead>
                                <tr>
                                    <th class="tbl-col-sm"></th>
                                    <th><span class="d-none d-sm-block">Rank</span></th>
                                    <th colspan="2">Name</th>
                                    <th class="text-right">Price</th>
                                    <th class="d-none d-lg-table-cell text-right">Market cap</th>
                                    <th class="d-none d-lg-table-cell text-right">
                                        <a href="javascript:void(0);" onclick="Homepage.setOrder('volume');" class="order-volume">Volume</a>
                                    </th>
                                    <th class="text-right">
                                        <a href="javascript:void(0);" onclick="Homepage.setOrder('volume');" class="order-volume">24H PERFORMENCE</a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data as $index => $item)
                                    
                                
                                    <tr coin_id="{{$item->id}}" coin_url="/coin/{{$item->symbol}}">
                                        <td class="tbl-col-sm"></td>  
                                        <td class="tbl-col-sm"><span class="tbl-rank">{{$index+1}}</span></td>
                                        <td class="fit clickable-coin-td">
                                            <img class="tbl-icon" src="{{$item->image_url}}" alt="{{$item->name}} logo">
                                        </td>
                                        <td class="clickable-coin-td">
                                            <div class="tbl-currency">
                                                <a href="/coin/{{$item->symbol}}">{{$item->name}}</a>
                                                <span class="tbl-coin-abbrev">[{{$item->symbol}}]</span>
                                            </div>
                                            <div class="d-lg-none tbl-mob-info smaller">
                                                <span class="mob-info-title">Mkt Cap:&nbsp;</span>
                                                <span class="mob-info-value marketcap-859">{{$item->f_market_cap}}</span>
                                                <span class="mob-info-title">Volume:&nbsp;</span>
                                                <span class="mob-info-value volume-859">{{$item->f_volume_24h}}</span>
                                            </div>
                                        </td>
                                        <td class="clickable-coin-td">
                                            <span class="tbl-price avgprice-859 price">{{$item->f_price}}</span>
                                            <span class="tbl-price small price avgprice-145-859 dimmed">{{$item->btc_price}}</span>
                                        </td>
                                        <td class="d-none d-lg-table-cell clickable-coin-td">
                                            <span class="tbl-price price dimmed marketcap-859">{{$item->f_market_cap}}</span>
                                        </td>
                                        <td class="d-none d-lg-table-cell clickable-coin-td">
                                            <span class="tbl-price price dimmed volume-859">{{$item->f_volume_24h}}</span>
                                        </td>
                                        <td class="tbl-col-md change-period clickable-coin-td">
                                            <span class="tbl-price pr-change delta-859 price down">{{$item->percent_change_24h}}%</span>
                                            <span class="small-chart-container">
                                                <div class="small-chart small-live-chart">
                                                    <div id="highcharts-q6qp1d2-0" class="highcharts-container " style="overflow: hidden; text-align: left;">
                                                        
                                                        <img src="{{$item->chart_image}}"/>  
                                                    
                                                    </div>
                                                </div>
                                            </span>
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
<script type="text/javascript" async src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5afec5426d44f1e2"></script>
