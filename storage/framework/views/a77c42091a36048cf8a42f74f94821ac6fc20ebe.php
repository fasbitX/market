
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
                    <li <?php echo e((Request::is('admin/index') ? 'class=active' : '')); ?>>
                        <a href="<?php echo e(url('/')); ?>/admin/index" >
                            <i class="fa fa-home"></i>
                            <span class="link-title menu_hide">&nbsp;ICO</span>
                        </a>
                    </li>
                    <li <?php echo e((Request::is('admin/coins') ? 'class=active' : '')); ?>>
                        <a href="<?php echo e(url('/')); ?>/admin/coins" >
                            <i class="fa fa-tachometer"></i>
                            <span class="link-title menu_hide">&nbsp;Coins</span>
                        </a>
                    </li>
                     <li <?php echo e((Request::is('admin/ads') ? 'class=active' : '')); ?>>
                        <a href="<?php echo e(url('/')); ?>/admin/ads" >
                            <i class="fa fa-anchor"></i>
                            <span class="link-title menu_hide">&nbsp;ADS</span>
                        </a>
                    </li>
                    
                </ul>
                <!-- /#menu -->
            </div>
        </div>
   