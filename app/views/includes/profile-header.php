<?php
$home = '';
if($_SESSION['user']['user_type'] == 'admin'){
    $home = 'admin/home';
}else if($_SESSION['user']['user_type'] == 'user'){
    $home = 'user/home';
}else{
    header('Location: home');
    die();
}
$male = 'img/avatar/male_avatar.png';
$female = 'img/avatar/female_avatar.png';
$maleAttr = '';
$femaleAttr = '';
if($data['data']->avatar == $male){
    $maleAttr = 'checked';
}else{
    $femaleAttr = 'checked';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME;?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <nav>  
            <ul>
                <li>
                    <a href="<?php echo $home;?>">Home</a>
                </li>

                <?php if($_SESSION['user']['user_type'] == 'user'):?>
                <li>
                    <a href="user/timeline?<?php echo $_SESSION['user']['user_id'];?>">Timeline</a>
                </li>
                <li>
                    <a href="profile?<?php echo $_SESSION['user']['user_id'];?>">Profile</a>
                </li>
                <?php elseif($_SESSION['user']['user_type'] == 'admin'):?>
                <li>
                    <a href="admin/dashboard">Dashboard</a>
                </li>    
                <?php endif;?>

                <li>
                    <a href="index">Logout</a>
                </li>
            </ul>            
        </nav>
    </header>