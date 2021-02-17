<?php include_once '../app/views/includes/comment-header.php';?>
    
    <!-- POST -->
    <div class="container mx-auto">
        <div class="col-8 offset-2">

            <div class="media m-5">
                <img src="../public/<?php echo $data['post']->avatar;?>" alt="" style="width: 75px;">
                <div class="media-body">        
                    <h3 class="mt-0"><?php echo $data['post']->show_author == false ? 'Anonymous' : $data['post']->username;?></h5>

                    <p><?php echo $data['post']->body;?></p>

                    <?php if($data['post']->img !== null):?>
                    <img src="<?php echo $data['post']->img;?>" alt="...">
                    <?php endif;?>

                    <small><?php echo $data['post']->created_at;?></small>
                </div>
            </div>
            
        </div>

        <div class="col-6 offset-3">
            <div class="my-2">
                <div class="card m-1">
                 <!-- ADD COMMENT -->
                    <div class="card-body">
                        <form action="" method="post">
                            <input type="hidden" name="user_id" value="">

                            <input type="hidden" name="post_id" value="">

                            <div class="form-group">
                                <textarea name="comment_body" id="" cols="30" rows="3" class="form-control"></textarea>
                            </div>     

                            <input type="submit" value="Add Comment" name="addComment">
                        </form>
                    </div>
                </div>

                <div class="card m-1">
                    <div class="card-body">
                        <div class="media">
                            <img src="" alt="">

                            <div class="media-body">
                                <h5></h5>
                                <p></p>
                                <small></small>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    
</body>
</html>