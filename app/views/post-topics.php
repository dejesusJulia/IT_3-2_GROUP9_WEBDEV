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
                                
                                    <a href="../posts/topics?<?php echo $tag->tag_name;?>">
                                        <?php echo $tag->tag_name;?>
                                    </a>
                                </div>
                                <?php endforeach;?>
                            <?php endif;?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9 col-md-9 col-sm-12 order-lg-1 order-md-1 order-sm-2">
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