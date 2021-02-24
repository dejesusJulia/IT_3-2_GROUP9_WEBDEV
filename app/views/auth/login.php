<?php include_once '../app/views/includes/auth-header.php';?>

<div class="container mt-5">
    <div class="row my-5">
        <div class="col-4 offset-4">
            <div class="d-flex justify-content-center">
                <img src="img/undraw_Login.svg" alt="..0" width="300px">
            </div>   
        </div>
    </div>

    <div class="row my-5">
        <div class="col-4 offset-4">
            <!-- ERROR MESSAGE -->
            <?php if(isset($data['message'])):?>
                <div class="alert alert-danger">
                    <strong><?php echo $data['message'];?></strong>
                </div>  
            <?php 
            unset($data['message']);
            endif;
            ?>

            <!-- LOGIN FORM -->
            <form action="login" method="post" id="loginform" onsubmit="">
                <div class="form-group">
                    <input type="text" name="user_email" id="user-email" placeholder="email" class="form-control">
                    <?php if(isset($data['user_email']['errors']['0'])):?>
                        <small class="invalid-feedback">
                        <?php echo $data['user_email']['errors']['0'];?>
                        </small>
                    <?php endif;?>
                </div>
                
                <div class="form-group">
                    <input type="password" name="password" id="user-pass" placeholder="password" class="form-control">
                    <?php if(isset($data['password']['errors']['0'])):?>
                        <small class="invalid-feedback">
                        <?php echo $data['password']['errors']['0'];?>
                        </small>
                    <?php endif;?>
                </div>
                
                <input type="submit" value="login" name="login" id="submit" class="btn btn-primary btn-block">
            </form>
        </div>
    </div>
</div>

</body>
</html>