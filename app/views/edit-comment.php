<?php include_once '../app/views/includes/comment-header.php';?>
    
    <!-- POST -->
    <div class="container mx-auto">
        
        <div class="col-6 offset-3">
        
        <?php if(isset($_SESSION['successMsg'])):?>
            <p><?php echo $_SESSION['successMsg'];?></p>
        <?php unset($_SESSION['successMsg']);?>

        <?php elseif(isset($_SESSION['errorMsg'])):?>
            <p><?php echo $_SESSION['errorMsg'];?></p>
        <?php unset($_SESSION['errorMsg']);?>
        <?php else:?>
            <p></p>
        <?php endif;?>
            <div class="my-2">
                <div class="card m-1">
                 <!-- EDIT COMMENT FORM -->
                    <div class="card-body">
                        <form action="../<?php echo $_SESSION['user']['user_type'];?>/comment-edit?<?php echo $data['comment']->comment_id;?>" method="post">

                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['user_id'];?>">

                            <input type="hidden" name="post_id" value="<?php echo $data['comment']->post_id;?>">

                            <div class="form-group">
                                <textarea name="comment_body" cols="30" rows="3" class="form-control"><?php echo $data['comment']->comment_body;?></textarea>
                                <small>
                                    <?php echo '';?>
                                </small>
                            </div>     

                            <input type="submit" value="Update Comment" name="updateComment">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>