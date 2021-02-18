<?php include_once '../app/views/includes/header.php';?>
    
    <section class="container mx-auto">
        <?php if(isset($_SESSION['user']['user_type'])):?>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <form action="../user/home" method="post" class="form" enctype="multipart/form-data" novalidate>
                        
                        <div class="form-group">
                            <textarea name="body" id="body" cols="30" rows="5" placeholder="post body" class="form-control"><?php echo $_POST['body'] ?? '';?></textarea>
                        </div>
                        <?php echo $data['err']['body']['errors'][0] ?? '';?>

                        <div class="form-group">
                            <input type="file" name="img" id="img">
                        </div>
                        <?php echo $data['err']['img']['errors'][0] ?? '';?>
                        
                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['user_id'];?>">

                        <div class="form-row">
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="show" name="show_author">
                                        <label class="custom-control-label" for="show">show user</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <input type="submit" value="Post" name="add-post" class="btn btn-block btn-danger">
                                </div>
                            </div>
                        </div>             
                    </form>
                </div>
            </div>
        </div>
        <?php endif;?>

        <?php foreach($data['posts'] as $post):?>
        <div class="card">
            <div class="card-body">

                <div class="media">
                    <img src="../public/<?php echo $post->avatar ?? ''?>" class="mr-3" alt="asd" style="width:100px;">
                    <div class="media-body">
                        <h5 class="mt-0"><?php echo $post->show_author == false ? 'Anonymous' : $post->username?></h5>
                        
                        <p><?php echo $post->body;?></p>

                        <?php if($post->img !== null):?>
                        <img src="<?php echo $post->img ?? ''?>" class="mr-3" alt="..." style="width:100px;">
                        <?php endif;?>


                        <small><?php echo date('Y F j h:i:s a', strtotime($post->created_at));?></small>

                        <?php if(isset($_SESSION['user']['user_type'])):?>
                        <p>
                            <small>
                                <a href="<?php echo '../' . $_SESSION['user']['user_type'] . '/comment?' . $post->post_id;?>">Comment</a>
                            </small>
                        </p>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </section>   
</body>
</html>