<nav class="navbar navbar-static-top">
            <div class="container-fluid m-0">
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>/admin/index">
                    <!-- <img src="<?php echo e($global_logo); ?>" class="admin_img" alt="logo"> -->
                    <h4>
                        <img src="<?php echo e($global_logo); ?>"  alt="logo">
                        <!-- <img src="<?php echo e(url('/')); ?>/public/img/logo1.ico" class="admin_img" alt="logo"> Crypto Admin -->
                    </h4>
                </a>

                <div class="topnav dropdown-menu-right float-right">


                    <div class="btn-group">
                        <div class="user-settings no-bg">
                            <button type="button" class="btn btn-default no-bg micheal_btn" data-toggle="dropdown">
                                <img src="<?php echo e(url('/')); ?>/public/img/admin.jpg" class="admin_img2 img-thumbnail rounded-circle avatar-img"
                                     alt="avatar"> <strong>Admin</strong>
                                <span class="fa fa-sort-down white_bg"></span>
                            </button>
                            <div class="dropdown-menu admire_admin">
                                <a class="dropdown-item title" href="#">
                                    Admin</a>
                                
                                <a class="dropdown-item" href="<?php echo e(url('/')); ?>/admin/logout"><i class="fa fa-sign-out"></i>
                                    Log Out</a>
                            </div>
                        </div>
                    </div>

                    <!-- <a href="<?php echo e(url('/')); ?>/sign-in" style="font-size: 25px;">Sign in</a>
                    <a href="<?php echo e(url('/')); ?>/sign-up" style="font-size: 25px;"> | Sign Up</a> -->

                </div>
                
            </div>
            <!-- /.container-fluid -->
        </nav>