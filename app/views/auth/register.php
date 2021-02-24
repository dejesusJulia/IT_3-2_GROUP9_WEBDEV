<?php include_once '../app/views/includes/auth-header.php';?>

    <div class="container">
        <div class="row my-3">
            <div class="col-4 offset-4">
                <div class="d-flex justify-content-center">
                    <img src="img/undraw_enter.svg" alt="..0" width="200px">
                </div>   
            </div>
        </div>
        <div class="row my-5">
            <div class="col-4 offset-4">
                <form action="register" method="post" novalidate>
                    <div class="form-group">
                        <input type="text" name="username" id="user-name" placeholder="username" class="form-control">
                        <?php if(isset($data['username']['errors']['0'])):?>
                        <small class="invalid-feedback">
                        <?php echo $data['username']['errors']['0'] ;?>
                        </small>
                        <?php endif;?>
                    </div>
                    
                    <div class="form-group">
                        <input type="email" name="user_email" id="user-email" placeholder="email" class="form-control">
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
                    
                    <div class="form-group">
                        <input type="password" name="confirmPassword" id="userpassC" placeholder="confirm password" class="form-control">
                        <?php if(isset($data['confirmPassword']['errors']['0'])):?>
                        <small class="text-danger">
                        <?php echo $data['confirmPassword']['errors']['0'];?>
                        </small>
                        <?php endif;?>
                    </div>
                    
                    <div class="form-group">
                        <label for="">Choose avatar:</label>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="male" name="avatar" class="custom-control-input" name="male" checked value="img/avatar/male_avatar.png">
                            <label class="custom-control-label" for="male"><img src="img/avatar/male_avatar.png" alt="..." style="width: 25px;">Male</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="female" name="avatar" class="custom-control-input" value="img/avatar/female_avatar.png">
                            <label class="custom-control-label" for="female"><img src="img/avatar/female_avatar.png" alt="..." style="width: 25px;">Female</label>
                        </div>
                    </div>

                    <input type="submit" value="Register" name="register" class="btn btn-block btn-primary">
                </form>
            </div>
        </div>
    </div>
</body>
</html>