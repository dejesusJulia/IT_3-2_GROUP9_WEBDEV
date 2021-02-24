<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME;?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo URLROOT?>/public/css/style-landing.css">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat&display=swap" rel="stylesheet">

    <style>
        .bebasNeue { font-family: Bebas Neue;}
        .montserrat { font-family: 'Montserrat', sans-serif;}
        .logo{
            /* width: 100%;
            height: 100%; */
            margin: 0 auto;
            background-position: center;
            position: relative;
        }
        .logo img{
            width: 450px;
            /* height: 350px; */
            display: block;
            margin: 0 auto;
            z-index: 0;
        }
        .quote{
            font-size: 40px;
            text-align: center;
            color: #33190B;
            font-family: 'Bebas Neue', cursive;
            position: relative;
            z-index: 10;
            top: -10px;
        }
        .e-btn-group{
            padding: 0 30px;
        }

        .e-links{
            font-size: 15px;
            font-weight: 10px;
            width: 400px;
            padding: 10px 30px;
            cursor: pointer;
            display: block;
            margin: 5px auto;
            background-color: rgb(245, 245, 245);
            border: 0;
            outline: none;
            border-radius: 5px;
        }
        .e-links:hover{
            background-color: rgb(236, 236, 236);
        }
    </style>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</head>
<body>
    <header class="">
        <nav class="navbar navbar-dark navbar-expand-lg bg-dark">
            <div class="container">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="<?php echo URLROOT . '/index';?>" class="nav-link">Go back</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <section class="container mx-auto">
        <div class="logo">
            <img src="img/libertadLogo2.svg" alt="" >
        </div>
        <div class="quote">
            <p>
                A SAFE SPACE FOR EVERY PUPIAN
            </p>
        </div>

        <div class="e-btn-group">
            <a href="register" class="e-links text-center">Create an account</a>
            <a href="login" class="e-links text-center">I already have an account</a>      
        </div>


        
    </section>
</body>
</html>