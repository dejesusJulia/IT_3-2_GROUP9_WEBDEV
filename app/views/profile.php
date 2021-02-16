<?php include_once '../app/views/includes/shared-header.php';?>
    <div class="container mx-auto">
        <div class="col-6 offset-3">
        <h2><?php echo $data['message'] ?? '';?></h2>
            <form action="profile?<?php echo $data['data']->user_id;?>" method="post" novalidate>
                <div class="form-group">
                    <input type="text" name="username" id="username" value="<?php echo $data['data']->username ?? $_POST['username'];?>" class="form-control">
                    <small>
                    <?php echo $data['username']['errors']['0'] ?? '';?>
                    </small>
                </div>               
                
                <div class="form-group">
                    <input type="email" name="user_email" id="email" value="<?php echo $data['data']->user_email ?? $_POST['user_email'];?>" class="form-control">
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
                
                <input type="submit" value="Update" name="update">
            </form>
        </div>
    </div>
    
    
</body>
</html>
