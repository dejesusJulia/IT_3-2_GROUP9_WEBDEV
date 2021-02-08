<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hey</h1>
    <h2><?php echo $data['message'] ?? '';?></h2>
    <form action="profile?<?php echo $data['data']->user_id;?>" method="post" novalidate>
        <input type="text" name="username" id="username" value="<?php echo $data['data']->username ?? $_POST['username'];?>"><br>
        <small>
        <?php echo $data['username']['errors']['0'] ?? '';?>
        </small>
        <br>

        <input type="email" name="user_email" id="email" value="<?php echo $data['data']->user_email ?? $_POST['user_email'];?>"><br>
        <small>
        <?php echo $data['user_email']['errors']['0'] ?? '';?>
        </small>
        <br>
        <input type="submit" value="Update" name="update">
    </form>

</body>
</html>