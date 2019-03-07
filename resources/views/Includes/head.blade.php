
<link href="https://fonts.googleapis.com/css?family=Concert+One" rel="stylesheet">
<nav class="navbar navbar-expand-lg navbar-static-top">
  <div class="container">
  

   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
   </button>

   <a class="navbar-brand content-image-header" href="{{url('/')}}/">
      <img src="{{$global_logo}}" alt="logo">
      <p>Fasbit Market Watch</p>
   </a>
   <div class="collapse navbar-collapse justify-content-md-center" id="navbarToggler">
    <!-- 
              
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    <div class="collapse navbar-collapse" id="navbarText"> -->
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{url('/')}}/">Coins</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('/')}}/news">News</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('/')}}/ico"">ICO</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('/')}}/mining"">Mining</a>
      </li>
       @if(Session::get( 'user_name' ) !="")
      
      @endif
    </ul>
    
    <ul class="navbar-nav ml-auto">

    @if(Session::get( 'user_name' ) =="")
      <li class="nav-item">
        <a class="nav-link" href="{{URL('/')}}/sign_in">Sign in</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{URL('/')}}/sign_up">Sign up</a>
      </li>

      @else

      <li class="nav-item">
        <a class="nav-link" href="#" id="navbarDropdownMenuLink" aria-haspopup="true" aria-expanded="false">
         Welcome {{Session::get( 'user_name' )}} !
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{url('/')}}/fav_coin_list">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('/')}}/logout">Logout</a>
      </li>
  
      @endif
       
    </ul>
  </div>



</div>
</nav >


<div class="scroller">

        <script type="text/javascript">
baseUrl = "https://widgets.cryptocompare.com/";
var scripts = document.getElementsByTagName("script");
var embedder = scripts[ scripts.length - 1 ];
var cccTheme = {"General":{"enableMarquee":true}};
(function (){
var appName = encodeURIComponent(window.location.hostname);
if(appName==""){appName="local";}
var s = document.createElement("script");
s.type = "text/javascript";
s.async = true;
var theUrl = baseUrl+'serve/v3/coin/header?fsyms=BTC,ETH,XMR,LTC,DASH&tsyms=USD,EUR,CNY,GBP,BTC';
s.src = theUrl + ( theUrl.indexOf("?") >= 0 ? "&" : "?") + "app=" + appName;
embedder.parentNode.appendChild(s);
})();
</script>
</div>
