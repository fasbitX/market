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
    <div class="row"> 
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 min-add-div" >  
            <br>
            <br>
            <br>
            <div id="coinChart"></div>
        </div>
        <div class="dark container">
            <div class="tab-content">
                <div class="tab-pane active" id="top" role="tabpanel">  
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
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
<script type="text/javascript" src="{{ URL::asset("public/js/jquery-3.1.1.min.js") }}"></script>
<script type="text/javascript" src='{{ URL::asset("public/js/highcharts.js") }}' ></script>
<script type="text/javascript" src='{{ URL::asset("public/js/chart.1.js") }}' ></script>

<script>
    Highcharts.chart('coinChart', {
        chart: {
            type: 'spline'
        },
        title: {
            text: '{{$coin}}',
            style: {
                color: "#FFF"
            }
        },
        xAxis: {
            type: 'datetime',
            labels: {
                overflow: 'justify',
                style: {
                    color: '#FFF'
                }
            }
        },
        yAxis: [{
            title: {
                text: '{{$graphDataArr[0]["name"]}}',
                style: {
                    color: '#FFF'
                }
            },
            labels: {
                style: {
                    color: '#FFF'
                }
            }
        }, {
            title: {
                text: '{{$graphDataArr[1]["name"]}}',
                style: {
                    color: '#FFF'
                }
            },
            labels: {
                style: {
                    color: '#FFF'
                }
            }
        }, {
            title: {
                text: '{{$graphDataArr[2]["name"]}}',
                style: {
                    color: '#FFF'
                }
            },
            labels: {
                style: {
                    color: '#FFF'
                }
            },
            opposite: true
        }],
        tooltip: {
            shared: true
        },
        plotOptions: {
            spline: {
                lineWidth: 3,
                states: {
                    hover: {
                        lineWidth: 4
                    }
                },
                marker: {
                    enabled: false
                },
                pointInterval: 60000,
                pointStart: {{$before24h}}
            }
        },
        series: {!! json_encode($graphDataArr) !!},
        legend: {
            itemStyle: {
                color: '#FFF'
            }
        }
    });
</script>
@endsection
