<?php include_once '../app/views/includes/timeline-header.php';?>
    
    <div class="container mx-auto">
        <div class="col-6 offset-3">        
            <form action="../user/edit-post?<?php echo $data->post_id;?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <textarea name="body" id="body" cols="30" rows="10" placeholder="body" class="form-control"><?php echo $data->body;?></textarea>
                </div>

                <div>
                    <input type="file" name="img" id="img">
                </div>

                <input type="hidden" name="user_id" value="<?php echo $data->user_id;?>">

                <div class="form-group">
                    <select name="show_author" id="showAuthor">
                    <?php
                    $anon = 'anonymous'; $user = 'user';
                    ?>
                        <option value="<?php echo $anon;?>" <?php echo $data->show_author == false ? 'selected' : '';?>>Anonymous</option>

                        <option value="<?php echo $user;?>" <?php echo $data->show_author == true ? 'selected' : '';?>><?php echo $_SESSION['user']['username'];?></option>
                    </select>
                </div>

                <div>
                    <input type="submit" value="Update" name="update-post">
                </div>
            </form>
        </div>
    </div>
</body>
</html>