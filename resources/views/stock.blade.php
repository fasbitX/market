
@extends('Layout.master')

@section('title')

{{$title->value}} | Stock | {{$stock->symbol}}

@endsection

@section('content')

<div class="stock-view">

  <div class="container chart-title">
    <h2>{{$stock->symbol}} <span>|</span> <span>{{$stock->name}}</span></h2>
  </div>

  <div class="chart-container row">
    <div class="col-12">
      <div class="container">
        <ul class="nav">
          <li class="nav-item">
            <input type="button" id="5years" value="5 years" class="nav-link active"/>
          </li>
          <li class="nav-item">
            <input type="button" id="year" value="1 year" class="nav-link"/>
          </li>
          <li class="nav-item">
            <input type="button" id="6months" value="6 months" class="nav-link"/>
          </li>
          <li class="nav-item">
            <input type="button" id="3months" value="3 months" class="nav-link"/>
          </li>
          <li class="nav-item">
            <input type="button" id="1month" value="1 month" class="nav-link"/>
          </li>
          <li class="nav-item">
            <input type="button" id="week" value="1 week" class="nav-link"/>
          </li>
          <li class="nav-item">
            <input type="button" id="day" value="1 day" class="nav-link"/>
          </li>
        </ul>
        <div id="curve_chart" style="height: 400px"></div>
      </div>    
    </div>
  </div>
</div>
@endsection



@section('scripts')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
//loading intraday data
let dailyData=[];
$.ajax({
    type: "GET",
    url: 'https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol={{$stock->symbol}}&interval=5min&apikey={{$API}}',
    success: function(data) {
      //console.log(data);
      Object.entries(data["Time Series (5min)"]).map((item)=>{
          let date = item[0].split("-");
          let day = date[2].split(" ");
          let hour = day[1].split(":");
          //console.log(date[0]+" "+(date[1]-1)+" "+day[0]+" "+hour[0]+" "+hour[1]+" "+hour[2]);
          dailyData.push([new Date(date[0], date[1], day[0], hour[0], hour[1], hour[2]), parseFloat(item[1]["4. close"])]);
      })
      //console.log(dailyData);
      dailyData.push([{type: 'date'}, {type: 'number'}]);
    }
});



/**********************************************************/
 //Google charts API
 //@type = all, year, 6months, 3months, 1month, week, day 
 /**********************************************************/
function renderCharts(type){
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  //Map data from Server
  let data=[], date;  
  let cont=0;

  //Weekly Data
  if(type == 'all' || type == 'year') {
    @foreach($pricesWeekly as $item)
      date = ('{{$item->date}}').split("-");
      if(type == 'all') 
        data.push([new Date(date[0], date[1]-1, date[2]), parseFloat('{{$item->close}}')]);
      else if(type == 'year'){
        if(++cont <= 52) data.push([new Date(date[0], date[1]-1, date[2]), parseFloat('{{$item->close}}')]);
      } 
    @endforeach
  }
  //Daily Data
  else{
    cont=0;
    @foreach($pricesDaily as $item)
      date = ('{{$item->date}}').split("-");
      if(type == '6months'){
        if(++cont <= 100){
          data.push([new Date(date[0], date[1]-1, date[2]), parseFloat('{{$item->close}}')]);
        }
      }
      if(type == '3months'){
        if(++cont <= 60){
          data.push([new Date(date[0], date[1]-1, date[2]), parseFloat('{{$item->close}}')]);
        }
      }
      if(type == '1month'){
        if(++cont <= 30){
          data.push([new Date(date[0], date[1]-1, date[2]), parseFloat('{{$item->close}}')]);
        }
      }
      if(type == 'week'){
        if(++cont <= 10){
          data.push([new Date(date[0], date[1]-1, date[2]), parseFloat('{{$item->close}}')]);
        }
      }
    @endforeach
  }

  data.push([{type: 'date'}, {type: 'number'}]);
  data.sort((a,b)=>{
    return a[0] - b[0];
  });
  console.log(data);
  //Chart Callback
  function drawChart() {
    //Data
    let _data = google.visualization.arrayToDataTable(data.reverse());
    if(type == 'day') _data = google.visualization.arrayToDataTable(dailyData.reverse());

    //fix hAxis labels for 5 years chart
    let dateRange = _data.getColumnRange(0);
    let oneYear = (1000 * 60 * 60 * 24 * 365.25);
    let ticksAxisH = [];
    for (let i = dateRange.min.getTime(); i <= dateRange.max.getTime(); i = i + oneYear) {
      let tick = new Date(i);
      ticksAxisH.push({
        v: tick,
        f: tick.getFullYear().toString()
      });
    }

    //Horizontal axis 
    let _hAxis = {};
    if(type == 'all'){
      _hAxis = {
        ticks: ticksAxisH,
        textStyle: {
          color: '#666',
          fontSize: 12
        },
        minorGridlines: {
          color: 'transparent'
        },
        gridlines: {
          color: '#282e3b'
        }
      }
    }
    else if(type == '1month'){
      _hAxis = {
        format: "dd MMM yyyy",
        textStyle: {
          color: '#666',
          fontSize: 12
        },
        minorGridlines: {
          color: 'transparent'
        },
        gridlines: {
          color: '#282e3b'
        }
      }
    }
    else if(type == 'week'){
      _hAxis = {
        format: "dd MMM",
        textStyle: {
          color: '#666',
          fontSize: 12
        },
        minorGridlines: {
          color: 'transparent'
        },
        gridlines: {
          color: '#282e3b'
        }
      }
    }
    else if(type=="day"){
      _hAxis = {
        textStyle: {
          color: '#666',
          fontSize: 12
        },
        minorGridlines: {
          color: 'transparent'
        },
        gridlines: {
          color: '#282e3b'
        }
      }
    }
    else{
      _hAxis = {
        format: "MMM yyyy",
        textStyle: {
          color: '#666',
          fontSize: 12
        },
        minorGridlines: {
          color: 'transparent'
        },
        gridlines: {
          color: '#282e3b'
        }
      }
    }

    //Media Querys
    mediaquery = window.matchMedia("(max-width: 991px)");
    let _chartArea = {};
    if (mediaquery.matches) {
      _chartArea = {
        top: '10%',
        bottom: '10%',
        left: '10%',
        right: '5%'
      }
    } else {
      _chartArea = {
        top: '10%',
        bottom: '10%',
        left: '5%',
        right: '5%'
      }
    }

    //Options grapichs
    let options = {
      legend: 'none',
      vAxis: {
        format: 'currency',
        minorGridlines: {
          color: 'transparent'
        },
        textStyle: {
          color: '#666',
          fontSize: 12
        },
        gridlines: {
          color: 'gray'
        }
      },
      hAxis: _hAxis,
      backgroundColor: 'none',
      chartArea: _chartArea
    }
    //Draw chart
    let chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
    chart.draw(_data, options);
  }
  
}
renderCharts('all');
$('#5years').addClass('active');

// Change data grapich
$('#5years').click((e)=>{
  renderCharts('all'); // all
  $('#5years').addClass('active');
  $('#year').removeClass('active');
  $('#6months').removeClass('active');
  $('#3months').removeClass('active');
  $('#1month').removeClass('active');
  $('#week').removeClass('active');
  $('#day').removeClass('active');
})
$('#year').click((e)=>{
  renderCharts('year'); // Year
  $('#year').addClass('active');
  $('#5years').removeClass('active');
  $('#6months').removeClass('active');
  $('#3months').removeClass('active');
  $('#1month').removeClass('active');
  $('#week').removeClass('active');
  $('#day').removeClass('active');
})
$('#6months').click((e)=>{
  renderCharts('6months'); // Six months
  $('#6months').addClass('active');
  $('#year').removeClass('active');
  $('#5years').removeClass('active');
  $('#3months').removeClass('active');
  $('#1month').removeClass('active');
  $('#week').removeClass('active');
  $('#day').removeClass('active');
})
$('#3months').click((e)=>{
  renderCharts('3months'); // three months
  $('#3months').addClass('active');
  $('#year').removeClass('active');
  $('#5years').removeClass('active');
  $('#6months').removeClass('active');
  $('#1month').removeClass('active');
  $('#week').removeClass('active');
  $('#day').removeClass('active');
})
$('#1month').click((e)=>{
  renderCharts('1month'); // one month
  $('#1month').addClass('active');
  $('#5years').removeClass('active');
  $('#year').removeClass('active');
  $('#6months').removeClass('active');
  $('#3months').removeClass('active');
  $('#week').removeClass('active');
  $('#day').removeClass('active');
})
$('#week').click((e)=>{
  renderCharts('week'); //weekly
  $('#week').addClass('active');
  $('#5years').removeClass('active');
  $('#year').removeClass('active');
  $('#6months').removeClass('active');
  $('#3months').removeClass('active');
  $('#1month').removeClass('active');
  $('#day').removeClass('active');
})
$('#day').click((e)=>{
  renderCharts('day'); //day
  $('#day').addClass('active');
  $('#5years').removeClass('active');
  $('#year').removeClass('active');
  $('#6months').removeClass('active');
  $('#3months').removeClass('active');
  $('#1month').removeClass('active');
  $('#week').removeClass('active');
})
$(window).resize(function(){
  renderCharts('all');
});

</script>
@endsection