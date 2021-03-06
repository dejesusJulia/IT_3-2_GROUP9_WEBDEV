<?php include_once '../app/views/includes/header.php';?>
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
                            <?php if(isset($_SESSION['user']['user_type'])):?>
                                <div class="col-lg-6 col-md-12 col-sm-4">
                                    <a href="../<?php echo $_SESSION['user']['user_type'];?>/home">All</a>
                                </div>

                                <?php foreach($data['tags'] as $tag):?>
                                <div class="col-lg-6 col-md-12 col-sm-4">
                                
                                    <a href="../<?php echo $_SESSION['user']['user_type'];?>/posts?<?php echo $tag->tag_name;?>">
                                        <?php echo $tag->tag_name;?>
                                    </a>
                                </div>
                                <?php endforeach;?>

                            <?php else:?>
                                <div class="col-lg-6 col-md-12 col-sm-4">
                                    <a href="home">All</a>
                                </div>

                                <?php foreach($data['tags'] as $tag):?>
                                <div class="col-lg-6 col-md-12 col-sm-4">
                                
                                    <a href="posts/topics?<?php echo $tag->tag_name;?>">
                                        <?php echo $tag->tag_name;?>
                                    </a>
                                </div>
                                <?php endforeach;?>
                            <?php endif;?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9 col-md-9 col-sm-12 order-lg-1 order-md-1 order-sm-2">
                        <?php if(isset($_SESSION['user']['user_type'])):?>
                        <div class="shadow-lg p-3 mb-3 bg-white rounded">
                            <div class="d-flex">
                                <div style="flex: 1;">
                                    <img src="../public/<?php echo $_SESSION['user']['avatar'];?>" alt="..." width="50">
                                </div>
                                <div style="flex: 11;">
                                    <form action="../user/home" method="post" novalidate enctype="multipart/form-data">
                                        <!-- TEXT BODY -->
                                        <div class="form-group">
                                            <textarea name="body" id="post-body" cols="30" rows="3" class="form-control" placeholder="What's on your mind?" style="border: 0;"><?php echo $_POST['body'] ?? ''?></textarea>
                                            
                                            <!-- ERROR HANDLER -->
                                            <?php if(isset($data['err']['body']['errors'][0])):?>
                                            <small class="text-danger">
                                                <?php echo $data['err']['body']['errors'][0];?>
                                            </small>
                                            <?php endif;?>
                                        </div>
                    
                                        <!-- IMAGE UPLOAD -->
                                        <div class="form-group" id="img-group">
                                            <input type="file" name="img" id="form-img" hidden>
                                            <label for="form-img" class="btn btn-sm btn-primary">Photo</label>

                                            <span class="text-mute" id="img-name"></span>
                    
                                            <!-- ERROR HANDLER -->
                                            <?php if(isset($data['err']['img']['errors'][0])):?>
                                            <small class="text-danger">
                                                <?php echo $data['err']['img']['errors'][0];?>  
                                            </small>
                                            <?php endif;?>
                                        </div>
                    
                                        <!-- TAG CHECKBOXES -->
                                        <div class="form-group">
                                            <?php foreach($data['tags'] as $tags):?>
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="tagName[]" id="<?php echo $tags->tag_id;?>" class="form-check-input" value="<?php echo $tags->tag_id;?>">

                                                <label for="<?php echo $tags->tag_id;?>" class="form-check-label"><?php echo $tags->tag_name;?></label>
                                            </div>
                                            <?php endforeach;?>

                                            <br>
                                            <?php if(isset($data['cbErr'])):?>
                                            <small class="text-danger">
                                                <?php echo $data['cbErr'];?>
                                            </small>
                                            <?php endif;?>
                                        </div>
                    
                                        <!-- HIDDEN USER ID -->
                                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['user_id'];?>">
                    
                                        <!-- SWITCH FOR ANON -->
                                        <div class="form-row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" name="show_author" id="show" class="custom-control-input">
                                                        <label for="show" class="custom-control-label">Show username</label>
                                                    </div>
                                                </div>
                                            </div>
                    
                                            <!-- SUBMIT -->
                                            <div class="col-6 d-flex justify-content-end">
                                                <div class="form-group">
                                                    <input type="submit" name="add-post" value="Add Post" class="btn btn-primary">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php endif?>

                        <!-- ALL POSTS -->
                        <?php foreach($data['posts'] as $post):?>
                        <div class="shadow-lg p-3 mb-3 bg-white rounded">
                            <div class="d-flex">
                                <div style="flex: 1;">
                                <?php if(isset($_SESSION['user']['user_type'])):?>
                                    <img src="../public/<?php echo $post->avatar ?? ''?>" alt="..." width="50">
                                <?php else:?>  
                                    <img src="public/<?php echo $post->avatar ?? ''?>" alt="..." width="50">
                                <?php endif;?>
                                </div>

                                <div style="flex: 11;">
                                    <!-- USERNAME -->
                                    <h5><?php echo $post->show_author == false ? 'Anonymous' : $post->username?></h5>

                                    <!-- TIMESTAMP -->
                                    <small><?php echo date('Y F j h:i:s a', strtotime($post->created_at));?></small>

                                    <!-- BODY -->
                                    <p><?php echo $post->body;?></p>

                                    <!-- IMAGE -->
                                    <?php
                                    if($post->img !== null):
                                        if(isset($_SESSION['user']['user_type'])):
                                    ?>
                                    <figure>
                                        <img src="<?php echo $post->img;?>" alt="..." class="img-fluid">
                                    </figure>
                                    <?php else:?>
                                    <figure>
                                        <img src="<?php echo str_replace('../public/', '', $post->img);?>" alt="..." class="img-fluid">
                                    </figure>
                                    <?php 
                                    endif;
                                    endif;
                                    ?>

                                    <!-- LIKE AND COMMENT -->
                                    <?php
                                    if(isset($_SESSION['user']['user_type'])):
                                    ?>
                                    <div class="d-flex">
                                        
                                        <!-- <a href="#" class="mr-2">
                                            <i class='bx bx-like like-btn'></i> -->
                                        <?php
                                        // foreach($data['likes'] as $likes):
                                        ?>
                                        <?php
                                        // if($likes->post_id == $post->post_id):
                                        ?>
                                            <!-- <small> -->
                                            <?php
                                            // echo $likes->postLikeCount;
                                            ?>
                                            <!-- </small> -->
                                        
                                        <?php
                                        //   endif;
                                        //   endforeach;
                                        ?>
                                        <!-- </a> -->
                                        
                                        <a href="<?php echo '../' . $_SESSION['user']['user_type'] . '/comment?' . $post->post_id;?>" class="mr-2">
                                            <i class='bx bx-comment-add' ></i>
                                        </a>
                                    </div>
                                    <?php endif;?>

                                    <!-- TAGS -->
                                    
                                    <div>
                                      <?php foreach($data['categs'] as $categs):?>
                                      <?php if($categs->post_id == $post->post_id):?>
                                        <span class="badge badge-dark"><?php echo $categs->tag_name;?></span>
                                      <?php endif;?>
                                      <?php endforeach;?>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>
                    
                </div>  
            </div>
            
            <i class='bx bx-up-arrow-circle scroll-to-top' onclick="backToTop()"></i>
        </main>

        <!--===== MAIN JS =====-->
        <script src="<?php echo URLROOT;?>/public/js/main.js"></script>
        <script src="<?php echo URLROOT;?>/public/js/forms.js"></script>
        <script src="<?php echo URLROOT;?>/public/js/custom.js"></script>
        
    </body>
</html>