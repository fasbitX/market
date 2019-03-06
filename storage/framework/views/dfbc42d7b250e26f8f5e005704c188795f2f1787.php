<nav class="navbar navbar-static-top" style="background-color: #8dc647; color: #FFF;padding-bottom: 5px;padding-top: 2px;">
            <div class="container-fluid m-0">
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>/">
                    <h4>
                         <img src="https://www.bitexchange.cash/images/logo1.png" alt="logo" width="124px"> </h4>
                </a>
                
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>/" style="font-size: 16px;color: #FFF;font-weight: 800;">
                    Coins</a>
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>/news" style="font-size: 16px;color: #FFF;font-weight: 800;">News</a>
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>/ico" style="font-size: 16px;color: #FFF;font-weight: 800;">ICO</a>

                <div class="topnav dropdown-menu-right float-right">


                    <!-- <div class="btn-group">
                        <div class="user-settings no-bg">
                            <button type="button" class="btn btn-default no-bg micheal_btn" data-toggle="dropdown">
                                <img src="<?php echo e(url('/')); ?>/public/img/admin.jpg" class="admin_img2 img-thumbnail rounded-circle avatar-img"
                                     alt="avatar"> <strong>Micheal</strong>
                                <span class="fa fa-sort-down white_bg"></span>
                            </button>
                            <div class="dropdown-menu admire_admin">
                                <a class="dropdown-item title" href="#">
                                    Admire Admin</a>
                                <a class="dropdown-item" href="edit_user.html"><i class="fa fa-cogs"></i>
                                    Account Settings</a>
                                <a class="dropdown-item" href="#">
                                    <i class="fa fa-user"></i>
                                    User Status
                                </a>
                                <a class="dropdown-item" href="mail_inbox.html"><i class="fa fa-envelope"></i>
                                    Inbox</a>

                                <a class="dropdown-item" href="lockscreen.html"><i class="fa fa-lock"></i>
                                    Lock Screen</a>
                                <a class="dropdown-item" href="login2.html"><i class="fa fa-sign-out"></i>
                                    Log Out</a>
                            </div>
                        </div>
                    </div> -->

                    <a class="navbar-brand" href="#" style="font-size: 16px;color: #FFF;font-weight: 800;">Sign in</a>
                    <a class="navbar-brand" href="#" style="font-size: 16px;color: #FFF;font-weight: 800;">| &nbsp;&nbsp;&nbsp;Sign Up</a>
                </div>
                
            </div>
            <!-- /.container-fluid -->
        </nav><br>
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