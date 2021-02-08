<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Register</h1>

    <h2><?php echo $data['message'] ?? '';?></h2>
    <form action="" method="post" novalidate>
        <input type="text" name="username" id="user-name" placeholder="username"><br>
        <small>
        <?php echo $data['username']['errors']['0'] ?? '';?>
        </small><br>
        
        <input type="email" name="user_email" id="user-email" placeholder="email"><br>
        <small>
        <?php echo $data['user_email']['errors']['0'] ?? '';?>
        </small><br>
        
        <input type="password" name="password" id="user-pass" placeholder="password"><br>
        <small>
        <?php echo $data['password']['errors']['0'] ?? '';?>
        </small><br>
       
        <input type="password" name="confirmPassword" id="userpassC" placeholder="confirm password"><br>
        <small>
        <?php echo $data['confirmPassword']['errors']['0'] ?? '';?>
        </small><br>

        <input type="submit" value="Submit" name="register">
    </form>
   

</body>
</html>