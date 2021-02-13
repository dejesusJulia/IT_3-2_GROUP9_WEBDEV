<?php include_once '../app/views/includes/timeline-header.php';?>

    <div class="container mx-auto">
        <div class="col-8 offset-2">
            <?php foreach($data as $post):?>
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <img src="<?php echo $post->img;?>" alt="..." class="mr-3" style="width: 100px;">
                        <div class="media-body">
                            <h5 class="mt-0"><?php echo $post->show_author == false ? 'Anonymous' : $_SESSION['user']['username'];?></h5>
                            
                            <p><?php echo $post->body;?></p>
                            <small><?php echo $post->created_at;?></small>
                            <small><a href="../user/edit-post?<?php echo $post->post_id;?>">Edit</a></small>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
        hjhjh
    </div>
</body>
</html>