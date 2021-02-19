<?php include_once '../app/views/includes/dash.php';?>


<div class="container mx-auto">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
            <!-- ALERT MESSAGES -->
                <?php if(isset($data['successMsg'])):?>
                <div class="alert alert-success">
                    <?php echo $data['successMsg'] ?? '';?>
                </div>
                <?php elseif(isset($data['errorMsg'])):?>
                <div class="alert alert-danger">
                    <?php echo $data['errorMsg'] ?? '';?>
                </div>
                <?php endif;?>

                <!-- FORM -->
                <form action="user-edit?<?php echo $data['userData']->user_id;?>" method="post" class="form">
                    <div class="form-group row">
                        <label for="name" class="col-form-label col-sm-2">Name</label>
                        <div class="col-sm-10">
                            <p><?php echo $data['userData']->username;?></p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-form-label col-sm-2">Email</label>
                        <div class="col-sm-10">
                            <p><?php echo $data['userData']->user_email;?></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <select name="user_type" id="userType" class="custom-select">
                            <option value="<?php echo $data['user'];?>" <?php echo $data['user'] == $data['userData']->user_type? 'selected': '';?>>User</option>

                            <option value="<?php echo $data['admin'];?>" <?php echo $data['admin'] == $data['userData']->user_type? 'selected': '';?>>Admin</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Update" class="btn btn-primary" name="updateUserType">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<pre>
<?php var_dump($_SESSION['user']);?>
</pre>

    
</body>
</html>