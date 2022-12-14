<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title> <?php echo $data_table;?></title>

        <meta name="description" content="Static &amp; Dynamic Tables" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

       <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/4.1.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.custom.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/fonts.googleapis.com.css" />

    <!-- ace styles -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace.min.css" id="main-ace-style" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace-skins.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace-rtl.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/icon.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/demo.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/color.css"> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datepicker.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/dataTables.jqueryui.css"> 
    
    

    <script src="<?php echo base_url(); ?>assets/js/jquery-1.8.3.min.js" type="text/javascript"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/css/ckeditor/ckeditor.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.easyui.min.js"></script> 
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datagrid-detailview.js"></script>  
    
    <script src="<?php echo base_url(); ?>assets/js/ace-extra.min.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/js/time.js" type="text/javascript"></script> -->
    <script src="<?php echo base_url(); ?>assets/js/sts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.min.js" type="text/javascript"></script>    
<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.js" type="text/javascript"></script> 
<!-- <script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.bootstrap.js" type="text/javascript"></script>  -->

  
   <script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url(); ?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

<!-- <script src="<?php echo base_url(); ?>assets/js/jquery-ui.custom.min.js"></script> -->
<script src="<?php echo base_url(); ?>assets/js/jquery.ui.touch-punch.min.js"></script>

<!-- ace scripts -->
<script src="<?php echo base_url(); ?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
    </head>


    <body class="no-skin">
        <div id="navbar" class="navbar navbar-default ace-save-state">
            <div class="navbar-container ace-save-state" id="navbar-container">
                <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
                    <span class="sr-only">Toggle sidebar</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>
                </button>

                <div class="navbar-header pull-left">
                    <a href="index.html" class="navbar-brand">
                        <small>
                            <i class="fa fa-leaf"></i>
                            Ace Admin
                        </small>
                    </a>
                </div>

                <div class="navbar-buttons navbar-header pull-right" role="navigation">
                    <ul class="nav ace-nav">
                        <li class="grey dropdown-modal">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="ace-icon fa fa-tasks"></i>
                                <span class="badge badge-grey">4</span>
                            </a>

                            <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                                <li class="dropdown-header">
                                    <i class="ace-icon fa fa-check"></i> 4 Tasks to complete
                                </li>

                                <li class="dropdown-content">
                                    <ul class="dropdown-menu dropdown-navbar">
                                        <li>
                                            <a href="#">
                                                <div class="clearfix">
                                                    <span class="pull-left">Software Update</span>
                                                    <span class="pull-right">65%</span>
                                                </div>

                                                <div class="progress progress-mini">
                                                    <div style="width:65%" class="progress-bar"></div>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <div class="clearfix">
                                                    <span class="pull-left">Hardware Upgrade</span>
                                                    <span class="pull-right">35%</span>
                                                </div>

                                                <div class="progress progress-mini">
                                                    <div style="width:35%" class="progress-bar progress-bar-danger"></div>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <div class="clearfix">
                                                    <span class="pull-left">Unit Testing</span>
                                                    <span class="pull-right">15%</span>
                                                </div>

                                                <div class="progress progress-mini">
                                                    <div style="width:15%" class="progress-bar progress-bar-warning"></div>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <div class="clearfix">
                                                    <span class="pull-left">Bug Fixes</span>
                                                    <span class="pull-right">90%</span>
                                                </div>

                                                <div class="progress progress-mini progress-striped active">
                                                    <div style="width:90%" class="progress-bar progress-bar-success"></div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="dropdown-footer">
                                    <a href="#">
                                        See tasks with details
                                        <i class="ace-icon fa fa-arrow-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="purple dropdown-modal">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="ace-icon fa fa-bell icon-animated-bell"></i>
                                <span class="badge badge-important">8</span>
                            </a>

                            <ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
                                <li class="dropdown-header">
                                    <i class="ace-icon fa fa-exclamation-triangle"></i> 8 Notifications
                                </li>

                                <li class="dropdown-content">
                                    <ul class="dropdown-menu dropdown-navbar navbar-pink">
                                        <li>
                                            <a href="#">
                                                <div class="clearfix">
                                                    <span class="pull-left">
                                                        <i class="btn btn-xs no-hover btn-pink fa fa-comment"></i>
                                                        New Comments
                                                    </span>
                                                    <span class="pull-right badge badge-info">+12</span>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <i class="btn btn-xs btn-primary fa fa-user"></i>
                                                Bob just signed up as an editor ...
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <div class="clearfix">
                                                    <span class="pull-left">
                                                        <i class="btn btn-xs no-hover btn-success fa fa-shopping-cart"></i>
                                                        New Orders
                                                    </span>
                                                    <span class="pull-right badge badge-success">+8</span>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <div class="clearfix">
                                                    <span class="pull-left">
                                                        <i class="btn btn-xs no-hover btn-info fa fa-twitter"></i>
                                                        Followers
                                                    </span>
                                                    <span class="pull-right badge badge-info">+11</span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="dropdown-footer">
                                    <a href="#">
                                        See all notifications
                                        <i class="ace-icon fa fa-arrow-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="green dropdown-modal">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="ace-icon fa fa-envelope icon-animated-vertical"></i>
                                <span class="badge badge-success">5</span>
                            </a>

                            <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                                <li class="dropdown-header">
                                    <i class="ace-icon fa fa-envelope-o"></i> 5 Messages
                                </li>

                                <li class="dropdown-content">
                                    <ul class="dropdown-menu dropdown-navbar">
                                        <li>
                                            <a href="#" class="clearfix">
                                                <img src="<?php echo base_url()?>aceadmin/assets/images/avatars/avatar.png" class="msg-photo" alt="Alex's Avatar" />
                                                <span class="msg-body">
                                                    <span class="msg-title">
                                                        <span class="blue">Alex:</span>
                                                        Ciao sociis natoque penatibus et auctor ...
                                                    </span>

                                                    <span class="msg-time">
                                                        <i class="ace-icon fa fa-clock-o"></i>
                                                        <span>a moment ago</span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="clearfix">
                                                <img src="<?php echo base_url()?>aceadmin/assets/images/avatars/avatar3.png" class="msg-photo" alt="Susan's Avatar" />
                                                <span class="msg-body">
                                                    <span class="msg-title">
                                                        <span class="blue">Susan:</span>
                                                        Vestibulum id ligula porta felis euismod ...
                                                    </span>

                                                    <span class="msg-time">
                                                        <i class="ace-icon fa fa-clock-o"></i>
                                                        <span>20 minutes ago</span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="clearfix">
                                                <img src="<?php echo base_url()?>aceadmin/assets/images/avatars/avatar4.png" class="msg-photo" alt="Bob's Avatar" />
                                                <span class="msg-body">
                                                    <span class="msg-title">
                                                        <span class="blue">Bob:</span>
                                                        Nullam quis risus eget urna mollis ornare ...
                                                    </span>

                                                    <span class="msg-time">
                                                        <i class="ace-icon fa fa-clock-o"></i>
                                                        <span>3:15 pm</span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="clearfix">
                                                <img src="<?php echo base_url()?>aceadmin/assets/images/avatars/avatar2.png" class="msg-photo" alt="Kate's Avatar" />
                                                <span class="msg-body">
                                                    <span class="msg-title">
                                                        <span class="blue">Kate:</span>
                                                        Ciao sociis natoque eget urna mollis ornare ...
                                                    </span>

                                                    <span class="msg-time">
                                                        <i class="ace-icon fa fa-clock-o"></i>
                                                        <span>1:33 pm</span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="clearfix">
                                                <img src="<?php echo base_url()?>aceadmin/assets/images/avatars/avatar5.png" class="msg-photo" alt="Fred's Avatar" />
                                                <span class="msg-body">
                                                    <span class="msg-title">
                                                        <span class="blue">Fred:</span>
                                                        Vestibulum id penatibus et auctor  ...
                                                    </span>

                                                    <span class="msg-time">
                                                        <i class="ace-icon fa fa-clock-o"></i>
                                                        <span>10:09 am</span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="dropdown-footer">
                                    <a href="inbox.html">
                                        See all messages
                                        <i class="ace-icon fa fa-arrow-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="light-blue dropdown-modal">
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                <img class="nav-user-photo" src="<?php echo base_url()?>aceadmin/assets/images/avatars/user.jpg" alt="Jason's Photo" />
                                <span class="user-info">
                                    <small>Welcome,</small>
                                    <?php 
                                   echo $this->session->userdata('isUser'); 
                                    // echo $sessionArray['isUser'];
                                    ?>
                                </span>

                                <i class="ace-icon fa fa-caret-down"></i>
                            </a>

                            <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                                <li>
                                    <a href="#">
                                        <i class="ace-icon fa fa-cog"></i>
                                        Settings
                                    </a>
                                </li>

                                <li>
                                    <a href="profile.html">
                                        <i class="ace-icon fa fa-user"></i>
                                        Profile
                                    </a>
                                </li>

                                <li class="divider"></li>

                                <li>
                                    <a href="#">
                                        <i class="ace-icon fa fa-power-off"></i>
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /.navbar-container -->
        </div>

        <div class="main-container ace-save-state" id="main-container">
            <script type="text/javascript">
                try {
                    ace.settings.loadState('main-container')
                } catch (e) {}
            </script>

            <div id="sidebar" class="sidebar responsive ace-save-state">
                <script type="text/javascript">
                    try {
                        ace.settings.loadState('sidebar')
                    } catch (e) {}
                </script>

                <div class="sidebar-shortcuts" id="sidebar-shortcuts">
                    <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                        <button class="btn btn-success">
                            <i class="ace-icon fa fa-signal"></i>
                        </button>

                        <button class="btn btn-info">
                            <i class="ace-icon fa fa-pencil"></i>
                        </button>

                        <button class="btn btn-warning">
                            <i class="ace-icon fa fa-users"></i>
                        </button>

                        <button class="btn btn-danger">
                            <i class="ace-icon fa fa-cogs"></i>
                        </button>
                    </div>

                    <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                        <span class="btn btn-success"></span>

                        <span class="btn btn-info"></span>

                        <span class="btn btn-warning"></span>

                        <span class="btn btn-danger"></span>
                    </div>
                </div>
                <!-- /.sidebar-shortcuts -->

                <ul class="nav nav-list">
                    <?php
                    $menu_1=$this->M_menu->menu('1','',$role)->result();
                    foreach ($menu_1 as $level_1) {
                        $cek_1=$this->M_menu->check_root($level_1->menu_cd)->num_rows();
                    ?>
                    <li class="">
                        <a href="<?php echo site_url($level_1->menu_url);?>" class="dropdown-toggle">
                            <i class="menu-icon fa <?php echo $level_1->menu_image;?>"></i>
                            <span class="menu-text"> <?php echo $level_1->menu_nm;?> </span>
                            <?php
                        if($cek_1>0){
                            echo "<b class='arrow fa fa-angle-down'></b>";
                        }
                            ?>
                        </a>

                        <b class="arrow"></b>
                        <ul class="submenu">
                            <?php
                        $menu_2=$this->M_menu->menu('2',$level_1->menu_cd,$role)->result();
                        foreach ($menu_2 as $level_2) {
                            $cek_2=$this->M_menu->check_root($level_2->menu_cd)->num_rows();
                            ?>
                         
                            <li class="">

                                <?php
                            if($cek_2>0){
                                echo "<a href='".site_url($level_2->menu_url)."' class='dropdown-toggle'";
                                echo "<i class='menu-icon fa fa-caret-right'></i>";
                                echo $level_2->menu_nm;
                                echo "<b class='arrow fa fa-angle-down'></b>";
                                echo "</a>";
                            }else{
                                echo "<a href='".site_url($level_2->menu_url)."'>";
                                echo $level_2->menu_nm;
                                echo "</a>";
                            }
                                ?>



                                <b class="arrow"></b>
                                <ul class="submenu">
                                    <?php
                            $menu_3=$this->M_menu->menu('3',$level_2->menu_cd,$role)->result();
                            foreach ($menu_3 as $level_3) {
                                $cek_3=$this->M_menu->check_root($level_3->menu_cd)->num_rows();
                                    ?>
                                    <li class="">
                                        <?php
                                if($cek_3>0){
                                    echo "<a href='".site_url($level_3->menu_url)."' class='dropdown-toggle'";
                                    echo "<i class='menu-icon fa fa-caret-right'></i>";
                                    echo $level_3->menu_nm;
                                    echo "<b class='arrow fa fa-angle-down'></b>";
                                    echo "</a>";
                                }else{
                                    echo "<a href='".site_url($level_3->menu_url)."'>";
                                    echo $level_3->menu_nm;
                                    echo "</a>";
                                }
                                        ?>

                                        <b class="arrow"></b>
                                        <ul class="submenu">
                                            <?php
                                $menu_4=$this->M_menu->menu('4',$level_3->menu_cd,$role)->result();
                                foreach ($menu_4 as $level_4) {
                                    $cek_4=$this->M_menu->check_root($level_4->menu_cd)->num_rows();
                                            ?>
                                            <li class="">
                                                <?php
                                    if($cek_4>0){
                                        echo "<a href='".site_url($level_4->menu_url)."' class='dropdown-toggle'";
                                        echo "<i class='menu-icon fa fa-caret-right'></i>";
                                        echo $level_4->menu_nm;
                                        echo "<b class='arrow fa fa-angle-down'></b>";
                                        echo "</a>";
                                    }else{
                                        echo "<a href='".site_url($level_4->menu_url)."'>";
                                        echo $level_4->menu_nm;
                                        echo "</a>";
                                    }
                                                ?>

                                                <b class="arrow"></b>
                                                <ul class="submenu">
                                                    <?php
                                    $menu_5=$this->M_menu->menu('5',$level_4->menu_cd,$role)->result();
                                    foreach ($menu_5 as $level_5) {
                                        $cek_5=$this->M_menu->check_root($level_5->menu_cd)->num_rows();
                                                    ?>
                                                    <li class="">
                                                        <?php
                                        if($cek_5>0){
                                            echo "<a href='".site_url($level_5->menu_url)."' class='dropdown-toggle'";
                                            echo "<i class='menu-icon fa fa-caret-right'></i>";
                                            echo $level_5->menu_nm;
                                            echo "<b class='arrow fa fa-angle-down'></b>";
                                            echo "</a>";
                                        }else{
                                            echo "<a href='".site_url($level_5->menu_url)."'>";
                                            echo $level_5->menu_nm;
                                            echo "</a>";
                                        }
                                                        ?>

                                                        <b class="arrow"></b>
                                                    </li>
                                                    <?php
                                    }
                                                    ?>
                                                </ul>
                                            </li>
                                            <?php
                                }
                                            ?>
                                        </ul>
                                    </li>
                                    <?php
                            }
                                    ?>
                                </ul>
                            </li>
                            <?php
                        }
                            ?>
                        </ul>
                    </li>
                    <?php } ?>
                </ul>
                <!-- /.nav-list -->

                <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
                    <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
                </div>
            </div>

            <div class="main-content">
                <div class="main-content-inner">
                    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                        <ul class="breadcrumb">
                            <li>
                                <i class="ace-icon fa fa-home home-icon"></i>
                                <a href="<?php echo site_url('welcome')?>">Home</a>
                            </li>

                            <li>
                                <a href="#"><?php echo $data_table; ?></a>
                            </li>
                        </ul>
                        <!-- /.breadcrumb -->

                        <div class="nav-search" id="nav-search">
                            <form class="form-search">
                                <span class="input-icon">
                                    <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                                    <i class="ace-icon fa fa-search nav-search-icon"></i>
                                </span>
                            </form>
                        </div>
                        <!-- /.nav-search -->
                    </div>

                    <div class="page-content">
                        <?php echo $contents;?>
                    </div>
                    <!-- /.page-content -->
                </div>
            </div>
            <!-- /.main-content -->

            <div class="footer">
                <div class="footer-inner">
                    <div class="footer-content">
                        <span class="bigger-120">
                            <span class="blue bolder">Ace</span> Application &copy; 2013-2014
                        </span>
                        &nbsp; &nbsp;
                        <span class="action-buttons">
                            <a href="#">
                                <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                            </a>

                            <a href="#">
                                <i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
                            </a>

                            <a href="#">
                                <i class="ace-icon fa fa-rss-square orange bigger-150"></i>
                            </a>
                        </span>
                    </div>
                </div>
            </div>

            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
            </a>
        </div>



    </body>

</html>
