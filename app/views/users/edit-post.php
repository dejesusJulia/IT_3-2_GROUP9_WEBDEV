<?php include_once '../app/views/includes/timeline-header.php';?>
    
    <form action="../user/edit-post" method="post" enctype="multipart/form-data">
        <div>
            <textarea name="body" id="body" cols="30" rows="10" placeholder="body"><?php echo $data->body;?></textarea>
        </div>

        <div>
            <input type="file" name="img" id="img">
        </div>

        <input type="hidden" name="user_id" value="<?php echo $data->user_id;?>">

        <div>
            <select name="show_author" id="showAuthor">
            <?php
            $anon = 0; $user = 1;
            ?>
                <option value="<?php echo $anon;?>" <?php echo $anon == $data->show_author ? 'selected' : '';?>>Anonymous</option>

                <option value="<?php echo $user;?>" <?php echo $user == $data->show_author ? 'selected' : '';?>><?php echo $_SESSION['user']['username'];?></option>
            </select>
        </div>

        <div>
            <input type="submit" value="Update" name="update-post">
        </div>
    </form>
</body>
</html>