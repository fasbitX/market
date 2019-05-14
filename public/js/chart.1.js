
Highcharts.SparkLine = function (a, b) {
    // console.log(b.series[0].color);
     options = b,
     defaultOptions = {
      
         chart: {
             
             renderTo: a,
             backgroundColor: null,
             borderWidth: 0,
             
             margin: [2, 0, 2, 0],
             
             height: 38,
             style: {
                 
                 overflow: 'visible'
             },


             skipClone: true
         }, 

     
         
         title: {
             text: ''
         },
         credits: {
             enabled: false
         },
         xAxis: {
             type: 'datetime',
           
             labels: {
                 enabled: false
             },
             title: {
                 text: null
             },
             lineColor: 'transparent',
             startOnTick: false,
             endOnTick: false,
             tickPositions: []
         },
         yAxis: {
             
             endOnTick: false,
             startOnTick: false,
             labels: {
                 enabled: false
             },
             title: {
                 text: null
             },
             tickPositions: [0]
         },
         legend: {
             enabled: false
         },
         tooltip: {
            
              
             
             hideDelay: 0,
             outside: true,
             shared: true,
             backgroundColor: 'rgba(0, 0, 0, 0.65)',
             style: {
                 color: '#F0F0F0'
             },
         },
         plotOptions: {
             area: {
                 fillColor: {
                     linearGradient: {
                         x1: 0,
                         y1: 0,
                         x2: 0,
                         y2: 1
                     },
                     stops: [
                         [0, Highcharts.Color(b.series[0].color).setOpacity(0.5).get('rgba')],
                         [0.9, Highcharts.Color(b.series[0].color).setOpacity(0.09).get('rgba')]
                     ]
                 },
                 marker: {
                     radius: 2
                 },
                 lineWidth: 1,
                 states: {
                     hover: {
                         lineWidth: 1
                     }
                 },
                 threshold: null
             },
             series: {
                
                 animation: false,
                 lineWidth: 1,
                 shadow: false,
                 states: {
                     hover: {
                         lineWidth: 1
                     }
                 },
                 marker: {
                     radius: 3,
                     states: {
                         hover: {
                             radius: 4
                         }
                     }
                 },
                  
                 fillOpacity: 0.25
             },
         
         }
     };

 options = Highcharts.merge(defaultOptions, options);

 return  new Highcharts.Chart(a, options);
    
};




$tr_coin = $('tr[coin_id]');
len = $tr_coin.length;
 
 
for ( let i = 0; i < len; i += 1) {
 
     
     let $tr_i = $($tr_coin[i]);
     let symbol_coin = $tr_i.attr('coin_url').substring(6);
     $.getJSON('https://min-api.cryptocompare.com/data/histohour?fsym='+symbol_coin+'&tsym=USD&limit=24', function (data) {

         $td = $tr_i.find('#highcharts-q6qp1d2-0');
         sign = $tr_i.find('span.price.up').text();

         
         if(sign){
             line_color = '#26da71';
         }
         else {
             line_color = '#FF0000';
         }
         var price = [];
         
         data.Data.forEach(item => {
            price.push([(item.time*1000),item.close]);
         });
     
         
         $td.highcharts('SparkLine', {
             
             series: [{
                 type: 'area',
                 data: price,
                 color: line_color,//'#FF0000', //#00B600
                 marker: {
                     enabled: false
                 }
                 

             }],
             tooltip: {
             
         
                 //headerFormat: '<span style="font-size: 10px">{point.x}:</span><br/>',
               
                pointFormat: '<b>{point.y}</b> $'
             }
 
         });

     

 });

}