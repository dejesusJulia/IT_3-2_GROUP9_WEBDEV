<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- ===== CSS ===== -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <link rel="stylesheet" href="<?php echo URLROOT;?>/public/css/users-style.css">

         <!-- ===== BOX ICONS ===== -->
         <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />

         <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
        <title>Sidebar menu responsive</title>
    </head>
    <body id="body-pd">
        <header class="header" id="header">
            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle"></i>
            </div>

            <div class="header__img">
                <img src="" alt="">
            </div>
        </header>

        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a href="#" class="nav__logo">
                        <i class='bx bx-layer nav__logo-icon'></i>
                        <span class="nav__logo-name">Libertad</span>
                    </a>

                    <div class="nav__list">
                    <?php if(!isset($_SESSION['user']['user_type'])):?>
                        <a href="home" class="nav__link">
                            <i class='bx bx-home nav__icon' ></i>
                            <span class="nav__name">Home</span>
                        </a>

                        <a href="login" class="nav__link">
                            <i class='bx bx-user nav__icon' ></i>
                            <span class="nav__name">Login</span>
                        </a>

                        <a href="register" class="nav__link">
                            <i class='bx bx-user nav__icon' ></i>
                            <span class="nav__name">Register</span>
                        </a>

                    <?php elseif($_SESSION['user']['user_type'] == 'user'):?>
                        <a href="home" class="nav__link">
                            <i class='bx bx-home nav__icon' ></i>
                            <span class="nav__name">Home</span>
                        </a>

                        <a href="timeline?<?php echo $_SESSION['user']['user_id'];?>" class="nav__link">
                            <i class='bx bx-spreadsheet nav__icon' ></i>
                            <span class="nav__name">Timeline</span>
                        </a>

                        <a href="../profile?<?php echo $_SESSION['user']['user_id'];?>" class="nav__link">
                            <i class='bx bx-user nav__icon' ></i>
                                    
                            <span class="nav__name">Profile</span>
                        </a>

                    <?php elseif($_SESSION['user']['user_type'] == 'admin'):?>
                        <a href="../admin/dashboard" class="nav__link">
                            <i class='bx bx-tachometer nav__icon'></i>
                            <span class="nav__name">Dashboard</span>
                        </a>

                        <a href="#" class="nav__link active">
                            <i class='bx bx-home nav__icon' ></i>
                                <span class="nav__name">Home</span>
                            </a>

                        <a href="../admin/timeline?<?php echo $_SESSION['user']['user_id'];?>" class="nav__link">
                            <i class='bx bx-spreadsheet nav__icon' ></i>
                            <span class="nav__name">Timeline</span>
                        </a>
                        
                        <a href="../profile?<?php echo $_SESSION['user']['user_id'];?>" class="nav__link">
                            <i class='bx bx-user nav__icon' ></i>
                                    
                            <span class="nav__name">Profile</span>
                        </a>
                    </div>
                    <?php endif;?>
                </div>

                <?php if(isset($_SESSION['user']['user_type'])):?>
                
                <a href="../index" class="nav__link">
                    <i class='bx bx-log-out nav__icon' ></i>
                    <span class="nav__name">Log Out</span>
                </a>
                <?php endif;?>
            </nav>
        </div>