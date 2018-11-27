<body style="margin-left: -2px": 6px;" class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div  class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="<?= BASE_URL . 'admin/dashboard'?>" class="site_title"><i class="fa fa-plane"></i> <span>PHP2pm</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">

                        <img src="<?= BASE_URL . 'public/images/users/' . $_SESSION['user_image'] ?>"
                             class="img-circle profile_img alt=" image not found">
                    </div>
                    <div class="profile_info">
                        <span>Welcome,</span>
                        <h2>  <?= $_SESSION['user_name'] ?></h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br/>

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">

                        <h3>General</h3>
                        <ul class="nav side-menu">
                            <li><a href="<?=ADMIN_PATH.'dashboard'?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                            <li><a><i class="fa fa-edit"></i> Users <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?= ADMIN_PATH . 'addUser' ?>"><i class="fa fa-plus"></i> Add User</a>
                                    </li>
                                    <li><a href="<?= ADMIN_PATH . 'show_users' ?>"><i class="fa fa-user"></i>Show Users
                                        </a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-image"></i> Gallery <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?= ADMIN_PATH . 'add_gallery' ?>"></i> Add
                                            Images</a></li>
                                    <li><a href="<?= ADMIN_PATH . 'show_gallery' ?>"></i>Show
                                            Gallery </a></li>
                                </ul>
                            </li>

                            <li><a><i class="fa fa-newspaper-o";></i> News <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?= ADMIN_PATH . 'add_category' ?>"> Add News Category</a></li>
                                    <li><a href="<?= ADMIN_PATH . 'add_news' ?>"></i>Add News </a>
                                    </li>
                                    <li><a href="<?=ADMIN_PATH.'show_news' ?>"> Show News Posted </a> </li>
                                </ul>
                            </li>

                            <li><a><i class="fa fa-list";></i> Menu <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?= ADMIN_PATH . 'add_menu' ?>"> Menu </a></li>
                                    <li><a href="<?= ADMIN_PATH . 'add_submenu' ?>"></i>Sub Menu </a>
                                    <li><a href="<?= ADMIN_PATH . 'show_submenu' ?>"></i>Show Submenu </a>
                                    </li>
                                </ul>
                            </li>

                            <li><a><i class="fa fa-folder-o"></i> Manage Slide <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?= ADMIN_PATH . 'add_slider' ?>"> Add Slider </a></li>
                                    <li><a href="<?= ADMIN_PATH . 'show_slider' ?>"> Show Slider </a></li>
                                    <li><a href="<?= ADMIN_PATH . 'add_advertiser' ?>"> Add Sponser </a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Lock">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Logout" href="logout.php">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>
    </div>

