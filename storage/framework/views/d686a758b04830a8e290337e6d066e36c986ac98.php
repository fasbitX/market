<nav class="navbar navbar-expand-lg navbar-static-top mynav">
  <div class="container">
  
   <div class="col-lg-6 burger-btn">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand content-image-header" href="<?php echo e(url('/')); ?>/">
          <img src="<?php echo e($global_logo); ?>" alt="logo">
          <p><strong>Fasbit</strong></p>
      </a>
   </div>

  <div class="col-6 menu-front-desktop">
      <ul class="navbar-nav ml-auto float-right">

      <?php if(Session::get( 'user_name' ) ==""): ?>
        <!--li class="nav-item">
          <a class="nav-link" href="<?php echo e(URL('/')); ?>/sign_in">Sign in</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo e(URL('/')); ?>/sign_up">Sign up</a>
        </li -->

      <?php else: ?>

        <li class="nav-item">
          <a class="nav-link" href="#" id="navbarDropdownMenuLink" aria-haspopup="true" aria-expanded="false">
          Welcome <?php echo e(Session::get( 'user_name' )); ?> !
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="<?php echo e(url('/')); ?>/fav_coin_list">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo e(url('/')); ?>/logout">Logout</a>
        </li>

      <?php endif; ?>    
    </ul>
   </div>
</div>

<div class="container">
   <div class="collapse navbar-collapse justify-content-md-center" id="navbarToggler">
    <div class="market menu-front-desktop">MARKET WATCH</div>
    <ul class="navbar-nav mr-auto" style="margin-bottom: 5px !important; margin-top: -10px !important;">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo e(url('/')); ?>/">Crypto-Currency</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo e(url('/stock')); ?>/">STOCKS</a>
      </li>
      <!--li class="nav-item">
        <a class="nav-link" href="<?php echo e(url('/forex')); ?>/">FOREX</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo e(url('/')); ?>/">TECHNICAL INDICATORS</a>
      </li-->
      <li class="nav-item">
        <a class="nav-link" href="<?php echo e(url('/')); ?>/ico">ICO</a>
      </li>

      <ul class="navbar-nav menu-front-mobile">
        <?php if(Session::get( 'user_name' ) ==""): ?>
          <!--li class="nav-item">
            <a class="nav-link" href="<?php echo e(URL('/')); ?>/sign_in">Sign in</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo e(URL('/')); ?>/sign_up">Sign up</a>
          </li-->

        <?php else: ?>

          <li class="nav-item">
            <a class="nav-link" href="#" id="navbarDropdownMenuLink" aria-haspopup="true" aria-expanded="false">
            Welcome <?php echo e(Session::get( 'user_name' )); ?> !
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?php echo e(url('/')); ?>/fav_coin_list">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo e(url('/')); ?>/logout">Logout</a>
          </li>

        <?php endif; ?>  
      </ul>
    </ul>
    
  </div>



</div>
</nav >


<!--div class="scroller">

<script async type="text/javascript">
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
</div-->
