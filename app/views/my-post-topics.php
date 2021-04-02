<?php
    include_once '../app/views/includes/header.php';
?>
        <main> 
            <div class="container p-3">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 order-lg-2 order-md-2 order-sm-1">
                        <div class="shadow-lg p-3 mb-5 bg-white rounded">
                            <h6>
                                <i class='bx bx-category-alt'></i>
                                Categories
                            </h6>
                            
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-4">
                                    <a href="../<?php echo $_SESSION['user']['user_type'];?>/timeline?<?php echo $_SESSION['user']['user_id'];?>">All</a>
                                </div>

                                <?php foreach($data['tags'] as $tag):?>
                                <div class="col-lg-6 col-md-12 col-sm-4">
                                    <a href="../<?php echo $_SESSION['user']['user_type'];?>/timeline/posts?<?php echo $tag->tag_name;?>">
                                        <?php echo $tag->tag_name;?>
                                    </a>
                                </div>
                                <?php endforeach;?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9 col-md-9 col-sm-12 order-lg-1 order-md-1 order-sm-2">
                    
                        <!-- ALL POSTS -->
                        <?php if($data['posts'] == null):?>
                        <div class="shadow-lg p-3 mb-3 bg-white rounded">
                          <h3>You have no posts yet. Add a <a href="../user/home">new post</a></h3>
                        </div>

                        <?php else:?>  
                        <?php foreach($data['posts'] as $post):?>
                        <div class="shadow-lg p-3 mb-3 bg-white rounded">
                            <div class="d-flex">
                                <div style="flex: 1;">
                                    <img src="../public/<?php echo $_SESSION['user']['avatar'];?>" alt="..." width="50">
                                </div>

                                <div style="flex: 11;">
                                    <!-- USERNAME -->
                                    <h5><?php echo $post->show_author == false ? 'Anonymous' : $_SESSION['user']['username'];?></h5>

                                    <!-- TIMESTAMP -->
                                    <small><?php echo date('Y F j h:i:s a', strtotime($post->created_at));?></small>

                                    <!-- BODY -->
                                    <p><?php echo $post->body;?></p>

                                    <!-- IMAGE -->
                                    <?php if($post->img !== null):?>
                                    <figure>
                                        <img src="<?php echo $post->img;?>" alt="..." class="img-fluid" width="50">
                                    </figure>
                                    <?php endif;?>

                                    <div class="d-flex">
                                        <a href="../user/edit-post?<?php echo $post->post_id;?>" class="mr-2">
                                            <i class='bx bx-edit-alt'></i>
                                            <small>Edit</small>
                                        </a>

                                        <a href="#" class="mr-2" onclick="event.preventDefault();if(confirm('Do you want to delete this post?')){
                                        document.getElementById('post-delete-<?php echo $post->post_id;?>').submit()
                                        }">
                                            <i class='bx bxs-trash' ></i>
                                            <small>Delete</small>
                                        </a>

                                        <form action="../user/post-delete?<?php echo $post->post_id;?>" id="post-delete-<?php echo $post->post_id;?>" style="display: none;" method="post"></form>
                                    </div>

                                    
                                    <div>
                                    <?php foreach($data['categs'] as $categs):?>
                                    <?php if($categs->post_id == $post->post_id):?>
                                        <span class="badge badge-dark">
                                            <?php echo $categs->tag_name;?>
                                        </span>
                                    <?php endif;?>
                                    <?php endforeach;?>
                                    </div>
                                    
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
        <script src="<?php echo URLROOT;?>/public/js/main.js"></script>
        <script src="<?php echo URLROOT;?>/public/js/custom.js"></script>
    </body>
</html>