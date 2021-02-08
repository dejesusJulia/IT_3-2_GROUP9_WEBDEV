<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Login</h1>
<h2><?php echo $data['message'] ?? '';?></h2>
    <form action="login" method="post" id="loginform" onsubmit="">
        <input type="text" name="user_email" id="user-email" placeholder="email"><br>
        <small id="email">
        <?php echo $data['user_email']['errors']['0'] ?? '';?>
        </small><br>
        
        <input type="password" name="password" id="user-pass" placeholder="password"><br>
        <small id="pass">
        <?php echo $data['password']['errors']['0'] ?? '';?>
        </small><br>
        
        <input type="submit" value="login" name="login" id="submit">
    </form>

    <h2><?php echo $data['ee'] ?? '';?></h2>

    <script>
        var email = document.querySelector('#email').value;
        var pass = document.querySelector('#pass').value;
        var submit = document.querySelector('#submit');
        // submit.addEventListener('click', funky);

        // function funky(e){
        //     if(email !== '' || pass !== ''){
        //     e.preventDefault();
        //     }
        // }
        
        // function submit(e){
        //     e.preventDefault();
        //     console.log('stop!!');
        // }
    </script>
</body>
</html>