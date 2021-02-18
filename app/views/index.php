<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo URLROOT?>/public/css/style.css">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat&display=swap" rel="stylesheet">


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    
    
</head>
<body>
    <header class="">
        <nav class="navbar navbar-dark navbar-expand-lg bg-dark">
            <div class="container">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="<?php echo URLROOT . '/login';?>" class="nav-link">Login</a>
                    </li>

                    <li class="nav-item">
                        <a href="<?php echo URLROOT . '/register';?>" class="nav-link">Register</a>
                    </li>
                </ul>
            </div>
            
        </nav>
    </header>
    
    <div class="container">
        <section class="my-5">
            <div class="d-flex justify-content-center">
                <div id="intro-text">
                    <h1 class="text-red bebasNeue" >LIBERTAD</h1>
                    <h3 class="bebasNeue">SAFE SPACE FOR EVERY PUPIAN</h3>
                    <h5 class="montserrat">Enter as <a href="home" class="text-yellow">guest</a> or as <a href="user" class="text-yellow">user</a></h5>
                </div>

                <div class="ml-auto">
                    <img src="img/undraw_Work_chat_.svg" alt="undraw_work_chat" width="500px">
                </div>
                
            </div>
        </section>

        <section class="my-5">
            <h2>Express yourself freely</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="circle"></div>
                    <div class="card">
                        <div class="card-body">
                            <h3>John Doe</h3>
                            <small>March 20, 2021, 5:25pm</small>

                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint eius consequuntur corrupti, eaque voluptates voluptatibus?</p>

                            <button>Comment</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="circle"></div>
                    <div class="card">
                        <div class="card-body">
                            <h3>Jane Doe</h3>
                            <small>March 20, 2021, 5:25pm</small>

                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint eius consequuntur corrupti, eaque voluptates voluptatibus?</p>

                            <button>Comment</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="circle"></div>
                    <div class="card">
                        <div class="card-body">
                            <h3>Anonymous</h3>
                            <small>March 20, 2021, 5:25pm</small>

                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint eius consequuntur corrupti, eaque voluptates voluptatibus?</p>

                            <button>Comment</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="my-5">
            <div>
                <img src="img/undraw_personal_opinions_g3kr.svg" alt="undraw_personal_opinions" width="500px">
            </div>

            <div>
                <div>
                    <p>Be a part</p>
                    <p>of the</p>
                    <h4>discussion</h4>
                </div>
                <a href="user">Join us</a>
            </div>
        </section>
    </div>

    <footer class="">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h2>Libertad</h2>
                    <h3>A SAFE SPACE FOR PUPIANS</h3>
                    <p>All rights reserved &copy; <?php echo date('Y');?></p>
                </div>

                <div class="col-md-4">
                    <ul>
                        <li>
                            <a href="<?php echo URLROOT . '/home';?>">Home</a>
                        </li>

                        <li>
                            <a href="<?php echo URLROOT . '/about';?>">About</a>
                        </li>

                        <li>
                            <a href="<?php echo URLROOT . '/login';?>">Login</a>
                        </li>

                        <li>
                            <a href="<?php echo URLROOT . '/register';?>">Register</a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-4">
                    <div class="mx-auto">
                        <h5>Contact Us</h5>
                        <form action="" class="form" novalidate>
                            <div class="form-group">
                                <input type="text" name="" id="" class="form-control">
                            </div>

                            <div class="form-group">
                                <input type="email" name="" id="" class="form-control">
                            </div>
                            <div class="form-group">
                                <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <input type="submit" value="Send" class="btn btn-block btn-primary">
                        </form>
                    </div>     
                </div>
            </div>
        </div>
    </footer>
    
</body>
</html>