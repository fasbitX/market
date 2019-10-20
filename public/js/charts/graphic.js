
    let paths = window.location.pathname.split('/',3);
    let name = paths[paths.length-1]; //crypto symbol
    //------------------------------------------------------
Highcharts.theme = {
    colors: ['#2b908f', '#90ee7e', '#f45b5b', '#7798BF', '#aaeeee', '#ff0066',
        '#eeaaee', '#55BF3B', '#DF5353', '#7798BF', '#aaeeee'],
    chart: {
        backgroundColor: {
            linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
            stops: [
                [0, '#2a2a2b'],
                [1, '#3e3e40']
            ]
        },
        style: {
            fontFamily: '\'Unica One\', sans-serif'
        },
        plotBorderColor: '#606063'
    },
    title: {
        style: {
            color: '#E0E0E3',
            textTransform: 'uppercase',
            fontSize: '20px'
        }
    },
    subtitle: {
        style: {
            color: '#E0E0E3',
            textTransform: 'uppercase'
        }
    },
    xAxis: {
        events: {
        },
        minRange: 3600 * 1000 *24 ,
    
        gridLineColor: '#707073',
        labels: {
            style: {
                color: '#E0E0E3'
            }
        },
        lineColor: '#707073',
        minorGridLineColor: '#505053',
        tickColor: '#707073',
        title: {
            style: {
                color: '#A0A0A3'

            }
        }
    },
    yAxis: {
        gridLineColor: '#707073',
        labels: {
            style: {
                color: '#E0E0E3'
            }
        },
        lineColor: '#707073',
        minorGridLineColor: '#505053',
        tickColor: '#707073',
        tickWidth: 1,
        title: {
            style: {
                color: '#A0A0A3'
            }
        }
    },
    tooltip: {
        backgroundColor: 'rgba(0, 0, 0, 0.85)',
        style: {
            color: '#F0F0F0'
        }
    },
    plotOptions: {
        series: {
            dataLabels: {
                color: '#B0B0B3'
            },
            marker: {
                lineColor: '#333'
            }
        },
        boxplot: {
            fillColor: '#505053'
        },
        candlestick: {
            lineColor: 'white'
        },
        errorbar: {
            color: 'white'
        }
    },
    legend: {
        itemStyle: {
            color: '#E0E0E3'
        },
        itemHoverStyle: {
            color: '#FFF'
        },
        itemHiddenStyle: {
            color: '#606063'
        }
    },
    credits: {
        style: {
            color: '#666'
        }
    },
    labels: {
        style: {
            color: '#707073'
        }
    },

    drilldown: {
        activeAxisLabelStyle: {
            color: '#F0F0F3'
        },
        activeDataLabelStyle: {
            color: '#F0F0F3'
        }
    },

    navigation: {
        buttonOptions: {
            symbolStroke: '#DDDDDD',
            theme: {
                fill: '#505053'
            }
        },

    },

    // scroll charts
    rangeSelector: {
        buttons: [
        {
            type: 'day',
            count: 3,
            text: '3D'
        },
        {
            type: 'week',
            count: 1,
            text: '7D'
        },
        
        {
            type: 'month',
            count: 1,
            text: '1M'
        }, {
            type: 'month',
            count: 3,
            text: '3M'
        }, {
            type: 'month',
            count: 6,
            text: '6M'
        }, {
            type: 'ytd',
            text: 'YTD'
        }, {
            type: 'year',
            count: 1,
            text: '1Y'
        }, {
            type: 'all',
            text: 'All'
        }],
        allButtonsEnabled: true,
        buttonTheme: {
            fill: '#505053',
            stroke: '#000000',
            style: {
                color: '#CCC'
            },
            states: {
                hover: {
                    fill: '#707073',
                    stroke: '#000000',
                    style: {
                        color: 'white'
                    }
                },
                select: {
                    fill: '#000003',
                    stroke: '#000000',
                    style: {
                        color: 'white'
                    }
                }
            }
        },
        inputBoxBorderColor: '#505053',
        inputStyle: {
            backgroundColor: '#333',
            color: 'silver'
        },
        labelStyle: {
            color: 'silver'
        },
        preserveDataGrouping: false,

    },

    navigator: {
        //enabled: false,
        handles: {
            backgroundColor: '#666',
            borderColor: '#AAA'
        },
        outlineColor: '#CCC',
        maskFill: 'rgba(255,255,255,0.1)',
        series: {
            color: '#7798BF',
            lineColor: '#A6C7ED'
        },
        xAxis: {
            gridLineColor: '#505053'
        },
       
        adaptToUpdatedData: false,
       

    },

    scrollbar: {
        enabled: false,
        barBackgroundColor: '#808083',
        barBorderColor: '#808083',
        buttonArrowColor: '#CCC',
        buttonBackgroundColor: '#606063',
        buttonBorderColor: '#606063',
        rifleColor: '#FFF',
        trackBackgroundColor: '#404043',
        trackBorderColor: '#404043',
        
          
     
    },

    // special colors for some of the
    legendBackgroundColor: 'rgba(0, 0, 0, 0.5)',
    background2: '#505053',
    dataLabelsColor: '#B0B0B3',
    textColor: '#C0C0C0',
    contrastTextColor: '#F0F0F3',
    maskColor: 'rgba(255,255,255,0.3)'
};
//----------------------------------------------------
// Apply the theme
Highcharts.setOptions(Highcharts.theme);


    let price = [],
    volume = [];
   //-------------------------------------------     
    Highcharts.getJSON('https://min-api.cryptocompare.com/data/histoday?aggregate=1&fsym='+name+'&tsym=USD&limit=1825', function (data) {
        $("#container-chart").hide();
        // Create the chart
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'GET',
            url: '/score/'+name,
            success: function(response) {
                score = [];
                volume=[];
                //console.log(response[0]['Date']);
                for(let j = 0 ; j<response.length;j++ ){
                    console.log( response[j]);
                    let dia = new Date(response[j]['Date']).getTime() / 1000;
                    score.push([
                        dia*1000,
                        parseFloat(response[j]['sum'])
                    ]);
                }


               /*Test*/
               // Create the chart
               Highcharts.stockChart('container-chart', {
                rangeSelector: {
                    selected: 6,
                },
                title: {
                    text: name+' Score'
                },
                yAxis: [{
                    labels: {
                        align: 'right',
                        x: -3
                    },
                    title: {
                        text: 'Score'
                    },
                    height: '60%',
                    lineWidth: 2,
                
                }, 
                /*{
                    labels: {
                        align: 'right',
                        x: -3
                    },
                    title: {
                        text: 'Volume'
                    },
                    top: '65%',
                    height: '35%',
                    offset: 0,
                    lineWidth: 2
                }*/],
    
                series: [{  
                        name: name+' Score',
                        data: score,
                        type: 'area',
                        threshold: null,
                        tooltip: {
                            valueDecimals: 4
                        },
                        
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    dataGrouping: {
                        enabled: false
                    },    
                }, 
               /* {
                    type: 'column',
                    name: name+' Volume',
                    data: volume,
                    yAxis: 1,
                    tooltip: {
                        valueDecimals: 4
                    },
                    dataGrouping: {
                        enabled: false
                    },
                
                }*/
                ],
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 800
                        },
                        chartOptions: {
                            rangeSelector: {
                                inputEnabled: false
                            }
                        }
                    }]
                }
            });

            /*End test*/

            $('.loading-chart').hide();
            
            $("#container-chart").show();
            },
            error: function(){
                console.log("ERROR");
            }
        });


        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'GET',
            url: '/graph/'+name,
            success: function(response) {

                price = [];
                volume=[];
                //console.log(response[0]['Date']);
                for(let j = 0 ; j<response.length;j++ ){
                    //console.log( response[j]);
                    let dia = new Date(response[j]['Date']).getTime() / 1000;
                    price.push([
                        dia*1000,
                        parseFloat(response[j]['prom_price'])
                    ]);
                }


               /*Test*/
               // Create the chart
               Highcharts.stockChart('container-chart-test', {
                rangeSelector: {
                    selected: 6,
                },
                title: {
                    text: name+' Price'
                },
                yAxis: [{
                    labels: {
                        align: 'right',
                        x: -3
                    },
                    title: {
                        text: 'Price'
                    },
                    height: '60%',
                    lineWidth: 2,
                
                }, 
                /*{
                    labels: {
                        align: 'right',
                        x: -3
                    },
                    title: {
                        text: 'Volume'
                    },
                    top: '65%',
                    height: '35%',
                    offset: 0,
                    lineWidth: 2
                }*/],
    
                series: [{  
                        name: name+' Price',
                        data: price,
                        type: 'area',
                        threshold: null,
                        tooltip: {
                            valueDecimals: 4
                        },
                        
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    dataGrouping: {
                        enabled: false
                    },    
                }, 
               /* {
                    type: 'column',
                    name: name+' Volume',
                    data: volume,
                    yAxis: 1,
                    tooltip: {
                        valueDecimals: 4
                    },
                    dataGrouping: {
                        enabled: false
                    },
                
                }*/
                ],
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 800
                        },
                        chartOptions: {
                            rangeSelector: {
                                inputEnabled: false
                            }
                        }
                    }]
                }
            });

            /*End test*/

            $('.loading-chart').hide();
            
            $("#container-chart").show();
            },
            error: function(){
                console.log("ERROR");
            }
        });

    });