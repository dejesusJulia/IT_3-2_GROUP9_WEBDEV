<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</head>
<body>
<h1>Register</h1>

    <h2><?php echo $data['message'] ?? '';?></h2>
    <form action="" method="post" novalidate class="col-6">
        <div class="form-group">
            <input type="text" name="username" id="user-name" placeholder="username" class="form-control">
            <small>
            <?php echo $data['username']['errors']['0'] ?? '';?>
            </small>
        </div>
        
        <div class="form-group">
            <input type="email" name="user_email" id="user-email" placeholder="email" class="form-control">
            <small>
            <?php echo $data['user_email']['errors']['0'] ?? '';?>
            </small>
        </div>
        
        <div class="form-group">
            <input type="password" name="password" id="user-pass" placeholder="password" class="form-control">
            <small>
            <?php echo $data['password']['errors']['0'] ?? '';?>
            </small>
        </div>
        
        <div class="form-group">
            <input type="password" name="confirmPassword" id="userpassC" placeholder="confirm password" class="form-control">
            <small>
            <?php echo $data['confirmPassword']['errors']['0'] ?? '';?>
            </small>
        </div>
        
        <div class="form-group">
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="male" name="avatar" class="custom-control-input" name="male" checked value="img/avatar/male_avatar.png">
                <label class="custom-control-label" for="male"><img src="img/avatar/male_avatar.png" alt="..." style="width: 25px;">Male</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="female" name="avatar" class="custom-control-input" value="img/avatar/female_avatar.png">
                <label class="custom-control-label" for="female"><img src="img/avatar/female_avatar.png" alt="..." style="width: 25px;">Female</label>
            </div>
        </div>

        <input type="submit" value="Submit" name="register">
    </form>
   

</body>
</html>