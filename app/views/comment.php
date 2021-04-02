<?php
include_once '../app/views/includes/header.php';
?>
        <main>  
            <div class="container p-3">
                <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                    <div class="shadow-lg p-3 mb-3 bg-white rounded">
                        <div class="d-flex">
                            <div style="flex: 1;">
                                <img src="../public/<?php echo $data['post']->avatar;?>" alt="..." width="60">
                            </div>
                            <div style="flex: 11; padding:0 5px;">
                                <!-- USERNAME -->
                                <h3><?php echo $data['post']->show_author == false ? 'Anonymous' : $data['post']->username;?></h3>

                                <!-- TIMESTAMP -->
                                <small style="font-size: 1rem;">
                                    <?php echo $data['post']->created_at;?>
                                </small>

                                <!-- COMMENT BODY -->
                                <p style="font-size: 1.25rem;">
                                    <?php echo $data['post']->body;?>
                                </p>

                                <!-- IMAGE -->
                                <?php if($data['post']->img !== null):?>
                                <figure>
                                    <img src="<?php echo $data['post']->img;?>" alt="..." class="img-fluid">
                                </figure>
                                <?php endif;?>
                                
                                <!-- FIX TAG DATA IN BACK END -->
                                <div>
                                <?php foreach($data['categs'] as $categ):?>
                                <?php if($categ->post_id == $data['post']->post_id):?>
                                    <span class="badge badge-dark"><?php echo $categ->tag_name;?></span>
                                <?php endif;?>
                                <?php endforeach;?>
                                </div>
                            </div>            
                        </div>  
                    </div>

                    <!-- ADD COMMENT -->
                    <div class="shadow-lg p-3 mb-3 bg-white rounded">
                        <div class="d-flex mb-3">
                            <div style="flex: 1;">
                                <img src="../public/<?php echo $_SESSION['user']['avatar'];?>" alt="..." width="60">
                            </div>
                            <div style="flex: 11;">
                                <form action="../<?php echo $_SESSION['user']['user_type'];?>/comment?<?php echo $data['post']->post_id;?>" method="post" novalidate>
                                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['user_id'];?>">

                                    <input type="hidden" name="post_id" value="<?php echo $data['post']->post_id;?>">
                
                                    <div class="form-group">
                                        <textarea name="comment_body" id="" cols="30" rows="3" class="form-control" placeholder="What's on your mind?"></textarea>
                
                                        <!-- ERROR HANDLER -->
                                        <?php if(isset($data['errors']['comment_body']['errors'][0])):?>
                                        <small class="text-danger">
                                            <?php echo $data['errors']['comment_body']['errors'][0];?>
                                        </small>
                                        <?php endif;?>
                                    </div>
                
                                    
                                    <div class="form-row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" name="show_author" id="show" class="custom-control-input">
                                                    <label for="show" class="custom-control-label">Show username</label>
                                                </div>
                                            </div>
                                        </div>
                
                                        <div class="col-6 d-flex justify-content-end">
                                            <div class="form-group">
                                                <input type="submit" name="addComment" value="Add Comment" class="btn btn-primary">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <hr class="mx-3 mb-4">

                        <!-- ALL COMMENTS -->
                        <?php if($data['comments'] == null):?>
                            <div class="my-2 bg-dark rounded p-3 text-white text-center">
                                <strong>No comments yet.</strong>
                            </div>
                        <?php else:?>
                        <?php foreach($data['comments'] as $comment):?>
                        <div class="d-flex my-2">
                            <div style="flex: 1;">
                                <img src="../public/<?php echo $comment->avatar ?? ''?>" alt="..." width="60">
                            </div>
                            <div style="flex: 11;">
                                <!-- USERNAME -->
                                <h5><?php echo $comment->show_author == true?$comment->username : 'Anonymous';?></h5>

                                <!-- TIMESTAMP -->
                                <small><?php echo date('Y F j h:i:s a', strtotime($comment->created_at));?></small>

                                <!-- COMMENT BODY -->
                                <p><?php echo $comment->comment_body;?></p> 

                                <div class="d-flex">
                                    <a href="comment-edit?<?php echo $comment->comment_id;?>" class="mr-2">
                                        <i class='bx bx-edit-alt'></i>
                                        <small>Edit</small>
                                    </a>
    
                                    <a href="#" class="mr-2" onclick="event.preventDefault();if(confirm('Do you want to delete your comment <?php echo $comment->comment_id;?> in this post?')){
                                        document.getElementById('comment-delete-<?php echo $comment->comment_id;?>').submit();
                                    }">
                                        <i class='bx bxs-trash' ></i>
                                        <small>Delete</small>
                                    </a>
    
                                    <form action="../<?php echo $_SESSION['user']['user_type'];?>/comment-delete?<?php echo $data['post']->post_id;?>" method="post" style="display: none;" id="comment-delete-<?php echo $comment->comment_id;?>">
                                        <input type="hidden" name="comment_id" value="<?php echo $comment->comment_id;?>">
                                    </form>
                                </div>        
                            </div>       
                        </div>
                        <?php endforeach;?>
                        <?php endif;?>
                    </div>

                </div>
            </div>
            
            <i class='bx bx-up-arrow-circle scroll-to-top' onclick="backToTop()"></i>
        </main>

        <!--===== MAIN JS =====-->
        <script src="assets/js/main.js"></script>
        <script src="assets/js/custom.js"></script>
    </body>
</html>