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
                 <!-- ADD COMMENT -->
                    <div class="card-body">
                        <form action="../<?php echo $_SESSION['user']['user_type'];?>/comment?<?php echo $data['post']->post_id;?>" method="post">
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['user_id'];?>">

                            <input type="hidden" name="post_id" value="<?php echo $data['post']->post_id;?>">

                            <div class="form-group">
                                <textarea name="comment_body" id="" cols="30" rows="3" class="form-control"></textarea>
                            </div>     

                            <input type="submit" value="Add Comment" name="addComment">
                        </form>
                    </div>
                </div>

                <?php if($data['comments'] == null):?>
                <div class="card m-1">               
                    <div class="card-body">                   
                        <h5 class="text-center">No comments yet</h5>
                    </div>
                </div> 

                <?php else:?>
                    <?php foreach($data['comments'] as $comments):?>
                    <div class="card m-1">
                
                    <div class="card-body">
                    
                        <div class="media">
                            <img src="../public/<?php echo $comments->avatar;?>" alt="..." style="width: 50px;">

                            <div class="media-body">
                                <h5><?php echo $comments->username;?></h5>
                                <p><?php echo $comments->comment_body;?></p>
                                
                            </div>
                        </div>  
                    </div>
                    <div class="card-footer">
                        <small><?php echo $comments->created_at;?></small>
                        <?php if($_SESSION['user']['user_id'] == $comments->user_id):?>
                        <a href="comment-edit?<?php echo $comments->comment_id;?>">Edit</a>

                        <button class="btn btn-danger btn-sm" onclick="event.preventDefault();if(confirm('Do you want to delete your comment in this post?')){
                            document.getElementById('comment-delete-<?php echo $comments->comment_id;?>').submit();
                        }">Delete</button>

                        <form id="comment-delete-<?php echo $comments->comment_id;?>" action="../<?php echo $_SESSION['user']['user_type'];?>/comment-delete?<?php echo $data['post']->post_id;?>" method="post" style="display: none;">
                            <input type="hidden" name="comment_id" value="<?php echo $comments->comment_id;?>">
                        </form>
                        <?php endif;?>
                    </div>
                    <?php endforeach;?>
                </div> 
                    
                <?php endif;?>
            </div>
        </div>
    </div>
    
</body>
</html>