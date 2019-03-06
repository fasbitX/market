
        <div id="left">
            <div class="menu_scroll">
                <!-- <div class="left_media">
                    <div class="media user-media">
                        <div class="user-media-toggleHover">
                            <span class="fa fa-user"></span>
                        </div>
                        <div class="user-wrapper">
                            <a class="user-link" href="#">
                                <img class="media-object img-thumbnail user-img rounded-circle admin_img3" alt="User Picture"
                                     src="img/admin.jpg">
                                <p class="user-info menu_hide">Welcome Micheal</p>
                            </a>
                        </div>
                    </div>
                    <hr/>
                </div> -->
                <ul id="menu" >
                    <li {{{ (Request::is('admin/index') ? 'class=active' : '') }}}>
                        <a href="{{url('/')}}/admin/index" >
                            <i class="fa fa-home"></i>
                            <span class="link-title menu_hide">&nbsp;ICO</span>
                        </a>
                    </li>
                    <li {{{ (Request::is('admin/coins') ? 'class=active' : '') }}}>
                        <a href="{{url('/')}}/admin/coins" >
                            <i class="fa fa-tachometer"></i>
                            <span class="link-title menu_hide">&nbsp;Coins</span>
                        </a>
                    </li>
                     <li {{{ (Request::is('admin/ads') ? 'class=active' : '') }}}>
                        <a href="{{url('/')}}/admin/ads" >
                            <i class="fa fa-anchor"></i>
                            <span class="link-title menu_hide">&nbsp;ADS</span>
                        </a>
                    </li>
                    <li {{{ (Request::is('admin/footer') ? 'class=active' : '') }}}>
                        <a href="{{url('/')}}/admin/footer" >
                            <i class="fa fa-anchor"></i>
                            <span class="link-title menu_hide">&nbsp;Scripts</span>
                        </a>
                    </li>
                    <li {{{ (Request::is('admin/basic_settings') ? 'class=active' : '') }}}>
                        <a href="{{url('/')}}/admin/basic_settings" >
                            <i class="fa fa-anchor"></i>
                            <span class="link-title menu_hide">&nbsp;Basic Settings</span>
                        </a>
                    </li>
                    
                </ul>
                <!-- /#menu -->
            </div>
        </div>
   