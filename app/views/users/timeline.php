<?php include_once '../app/views/includes/timeline-header.php';?>

<h1 class="text-center m-1 p-2">Timeline</h1>
    <div class="container mx-auto">
        <div class="col-8 offset-2">
            <?php foreach($data as $post):?>
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <img src="../public/<?php echo $_SESSION['user']['avatar'];?>" alt="..." class="mr-3" style="width: 100px;">
                        <div class="media-body">
                            <h5 class="mt-0"><?php echo $post->show_author == false ? 'Anonymous' : $_SESSION['user']['username'];?></h5>
                            
                            <p><?php echo $post->body;?></p>
                            <?php if($post->img !== null):?>
                            <img src="<?php echo $post->img;?>" alt="..." class="mr-3" style="width: 100px;">
                            <?php endif;?>
                        </div>
                    </div>

                    <div class="card-footer">
                        <small><?php echo date('Y F j h:i:s a', strtotime($post->created_at));?></small>
                            <small>
                            <a href="../user/edit-post?<?php echo $post->post_id;?>">Edit</a>
                            </small>
                            <small>
                                <button class="btn btn-danger btn-sm" onclick="event.preventDefault();if(confirm('Do you want to delete this post?')){
                                    document.getElementById('post-delete-<?php echo $post->post_id;?>').submit()
                                }">Delete</button>
                            </small>

                            <form action="../user/post-delete?<?php echo $post->post_id;?>" method="post" id="post-delete-<?php echo $post->post_id;?>" style="display: none;"></form>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>

    </div>
</body>
</html>