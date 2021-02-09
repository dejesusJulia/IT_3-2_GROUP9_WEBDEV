<?php
session_start();
if($_SESSION['user_type'] == 'admin'){
    include_once '../app/views/includes/dash.php';
}else if($_SESSION['user_type'] == 'user'){
    include_once '../app/views/includes/header.php';
}else{
    header('Location: home');
}
?>
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