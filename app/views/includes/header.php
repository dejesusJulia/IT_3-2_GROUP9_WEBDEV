<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo SITENAME;?></title>

  <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.5.0/css/all.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- Ionicons -->
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo URLROOT;?>/public/assets/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo URLROOT;?>/public/assets/css/OverlayScrollbars.min.css">

  <style>
      h5{
          color: black;
          font-weight: 500;
      }
      .side-nav{
          position: relative;
          margin: auto;
          padding-top: 20%;
      }
      .post{
          display: flex;
      }
      .post-image{
        flex: 1;
      }
      .post-content{
          flex: 11
      }
      .profile-image{
          border: 1px solid black;
          padding: 0.5px;

      }
      .btn-c-blue{
          background-color: #0763b4 !important;
          color: #fff;
      }
      .btn-c-blue:hover{
        background-color: #117edd !important;
        color: #fff;
      }
      
  </style>

</head>


<body class="hold-transition sidebar-mini layout-fixed">
  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v9.0&appId=749751495614026&autoLogAppEvents=1" nonce="JUf8uuB4"></script>
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav" style="width:100%;">
            <li class="nav-item" style="margin-right: auto;">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>

            <li class="nav-item" style="margin: 0 auto;">
                <?php if($_SERVER['REQUEST_URI'] == URLROOT.'/user/timeline?' . $_SESSION['user']['user_id']):?>
                    <h3 class="text-center">TIMELINE</h3>
                <?php elseif($_SERVER['REQUEST_URI'] == URLROOT.'/user/home'):?>
                    <h3 class="text-center">HOME</h3>
                <?php endif;?>
            </li>

            <?php if(isset($_SESSION['user']['user_type'])):?>
            <li class="nav-item dropdown" style="margin-left:auto">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <?php echo $_SESSION['user']['username'];?>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="../index">
                        Logout
                    </a>

                </div>
            </li>
            <?php endif;?>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background:  #333232!important">
        <!-- Brand Logo -->
        <a href="" class="brand-link d-flex justify-content-center">
            <!-- <img src="" alt="" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
            <span class="brand-text font-weight-light"><img src="../public/img/libertadLogo2.svg" alt="logo" style="height:60px"></span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">

            <!-- Sidebar Menu -->
            <nav class="mt-2 side-nav">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <?php if(!isset($_SESSION['user']['user_type'])):?>
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Home
                            </p>
                        </a>
                    </li>

                    <li class="nav-item mb-2">
                        <a href="login" class="nav-link">
                            <i class="nav-icon fas fa-bolt"></i>
                            <p>
                                Login
                            </p>
                        </a>
                    </li>

                    <li class="nav-item mb-2">
                        <a href="register" class="nav-link">
                            <i class="nav-icon fas fa-bolt"></i>
                            <p>
                                Register
                            </p>
                        </a>
                    </li>

                    <?php elseif($_SESSION['user']['user_type'] == 'user'):?>

                    <li class="nav-item mb-2">
                        <a href="../user/home" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Home
                            </p>
                        </a>
                    </li>  

                    <li class="nav-item mb-2">
                        <a href="../user/timeline?<?php echo $_SESSION['user']['user_id'];?>" class="nav-link">
                            <i class="nav-icon fas fa-bolt"></i>
                            <p>
                                Timeline
                            </p>
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="../profile?<?php echo $_SESSION['user']['user_id'];?>" class="nav-link ">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                                Profile
                            </p>
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="../index" class="nav-link ">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </li>

                    <?php elseif($_SESSION['user']['user_type'] == 'admin'):?>
                    <li class="nav-item mb-2">
                        <a href="../admin/dashboard" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>

                    <li class="nav-item mb-2">
                        <a href="../admin/home" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Posts
                            </p>
                        </a>
                    </li>  
                    
                    <li class="nav-item mb-2">
                        <a href="../profile?<?php echo $_SESSION['user']['user_id'];?>" class="nav-link ">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                                Profile
                            </p>
                        </a>
                    </li>

                    <li class="nav-item mb-2">
                        <a href="../index" class="nav-link ">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </li>
                    <?php endif;?>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
