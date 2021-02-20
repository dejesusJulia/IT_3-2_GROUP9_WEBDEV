<?php include_once '../app/views/includes/profile-header.php';?>
    <div class="container my-5">
        <div class="row my-5">
            <div class="col-4 offset-4">
                <img src="img/undraw_personal_information.svg" alt="mg/undraw_personal_information.svg" width="300px">
            </div>
        </div>

        <div class="row my-5">
            <div class="col-4 offset-4 mx-auto">
                <form action="profile?<?php echo $data['data']->user_id;?>" method="post" novalidate>
                    <div class="form-group">
                        <input type="text" name="username" id="username" value="<?php echo $data['data']->username ?? $_POST['username'];?>" class="form-control" placeholder="username">
                        <small>
                        <?php echo $data['username']['errors']['0'] ?? '';?>
                        </small>
                    </div>               
                    
                    <div class="form-group">
                        <input type="email" name="user_email" id="email" value="<?php echo $data['data']->user_email ?? $_POST['user_email'];?>" class="form-control" placeholder="user@email.com">
                        <small>
                        <?php echo $data['user_email']['errors']['0'] ?? '';?>
                        </small>
                    </div>
                    
                    <div class="form-group">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="male" name="avatar" class="custom-control-input" name="male" value="<?php echo $male;?>" <?php echo $maleAttr;?>>

                            <label class="custom-control-label" for="male"><img src="<?php echo $male;?>" alt="..." style="width: 25px;">Male</label>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="female" name="avatar" class="custom-control-input" value="<?php echo $female;?>" <?php echo $femaleAttr;?>>

                            <label class="custom-control-label" for="female"><img src="<?php echo $female;?>" alt="..." style="width: 25px;">Female</label>
                        </div>
                    </div>
                    
                    <input type="submit" value="Update" name="update" class="btn btn-block btn-primary">
                </form>
            </div>
        </div>
    </div>
    
    
    
</body>
</html>
