<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME?></title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo URLROOT?>/public/css/style-landing.css">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat&display=swap" rel="stylesheet">


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
     
</head>
<body onresize="resizeFunc()">
    <!-- NAVIGATION -->
    <header class="">
        <nav class="navbar navbar-dark navbar-expand-lg bg-dark">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#landingNav" aria-controls="landingNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="landingNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="<?php echo URLROOT . '/login';?>" class="nav-link">login</a>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo URLROOT . '/register';?>" class="nav-link">register</a>
                        </li>
                    </ul>
                </div>
            </div> 
        </nav>
    </header>
    
    <!-- FIRST SECTION -->
    <div class="container">
        <section id="intro-section" class="section py-5 my-5">
            <div class="d-flex fc justify-content-center">
                <div id="intro-text">
                    <h1 class="text-red bebasNeue" >LIBERTAD</h1>
                    <h3 class="bebasNeue">SAFE SPACE FOR EVERY PUPIAN</h3>
                    <h5 class="montserrat">Enter as <a href="home" class="text-yellow">guest</a> or as <a href="user" class="text-yellow">user</a></h5>
                </div>

                <div id="illusOne" class="ml-auto">
                    <img src="img/undraw_Work_chat_.svg" alt="undraw_work_chat" class="img-fluid" width="500px">
                </div>
                
            </div>
        </section>

        <!-- SECOND SECTION -->
        <section id="express-section" class="section my-5">
            <p class="fs-4em">Express yourself <span class="text-red font-weight-bold">freely</span></p>
            <div class="row py-5">
                <div class="col-md-4">
                    <div class="d-flex justify-content-center">
                        <img src="img/avatar/male_avatar.png" alt="..." class="img-fluid border-dark border-circle avatar">
                    </div>
                    
                    <div class="card position-relative" style="z-index: 0;">
                        <div class="card-body">
                            <h3 class="mt-5 text-center">John Doe</h3>
                            <small class="date">March 20, 2021, 5:25pm</small>

                            <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint eius consequuntur corrupti, eaque voluptates voluptatibus?</p>

                            <div class="w-100 d-flex justify-content-center">
                                <button class="montserrat font-weight-bold btn btn-yellow my-3 fs-1em">Comment</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="d-flex justify-content-center">
                        <img src="img/avatar/female_avatar.png" alt="..." class="img-fluid border-dark border-circle avatar">
                    </div>
                    
                    <div class="card position-relative" style="z-index: 0;">
                        <div class="card-body">
                            <h3 class="mt-5 text-center">Jane Doe</h3>
                            <small class="date">March 20, 2021, 5:25pm</small>

                            <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint eius consequuntur corrupti, eaque voluptates voluptatibus?</p>

                            <div class="w-100 d-flex justify-content-center">
                                <button class="montserrat font-weight-bold btn btn-yellow my-3 fs-1em">Comment</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="d-flex justify-content-center">
                        <img src="img/avatar/male_avatar.png" alt="..." class="img-fluid border-dark border-circle avatar">
                    </div>
                    <div class="card position-relative" style="z-index: 0;">
                        <div class="card-body">
                            <h3 class="mt-5 text-center">Anonymous</h3>
                            <small class="date">March 20, 2021, 5:25pm</small>

                            <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint eius consequuntur corrupti, eaque voluptates voluptatibus?</p>

                            <div class="w-100 d-flex justify-content-center">
                                <button class="montserrat font-weight-bold btn btn-yellow my-3 fs-1em">Comment</button>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- THIRD SECTION -->
        <section class="section my-5 py-5">
            <div id="illusTwo" class="d-flex fc justify-content-center">
                <div class="mx-auto">
                    <img src="img/undraw_personal_opinions_g3kr.svg" alt="undraw_personal_opinions" width="500px" class="img-fluid">
                </div>

                <div class="py-5">
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <p class="montserrat fs-4em">Be a part</p>
                        <p class="montserrat fs-4em">of the</p>
                        <h4 class="montserrat fs-4em text-red font-weight-bolder">discussion</h4>
                        <a href="user" class="montserrat font-weight-bold btn btn-yellow my-3 fs-1p5em">JOIN US</a>
                    </div>
                    
                </div>
            </div>
            
        </section>
    </div>

    <!-- FOOTER -->
    <footer class="">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill="#333232" fill-opacity="1" d="M0,224L40,213.3C80,203,160,181,240,176C320,171,400,181,480,197.3C560,213,640,235,720,250.7C800,267,880,277,960,282.7C1040,288,1120,288,1200,266.7C1280,245,1360,203,1400,181.3L1440,160L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path>
    </svg>
    <div class="footer-content">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h1 class="text-white bebasNeue">Libertad</h1>
                    <h3 class="text-yellow bebasNeue">A SAFE SPACE FOR PUPIANS</h3>
                    <p class="text-white">All rights reserved &copy; <?php echo date('Y');?></p>
                </div>

                <div class="col-md-4">
                    <ul class="list-unstyled align-items-center">
                        <li>
                            <a class="text-white" href="<?php echo URLROOT . '/home';?>" class="text">Home</a>
                        </li>

                        <li>
                            <a class="text-white" href="<?php echo URLROOT . '/about';?>">Guest</a>
                        </li>

                        <li>
                            <a class="text-white" href="<?php echo URLROOT . '/login';?>">Login</a>
                        </li>

                        <li>
                            <a class="text-white" href="<?php echo URLROOT . '/register';?>">Register</a>
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
    </div>
        
    </footer>
    <script src="<?php echo URLROOT;?>/public/js/landing-script.js"></script>
</body>
</html>