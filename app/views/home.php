<?php session_start();?>
<?php include_once '../app/views/includes/header.php';?>
    
    <section class="container mx-auto">
        <?php if(isset($_SESSION['user']['user_type'])):?>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <form action="../home" method="post" class="form">
                        <div class="form-group">
                            <input type="text" name="title" id="title" placeholder="title" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <textarea name="body" id="body" cols="30" rows="5" placeholder="post body" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="file" name="img" id="img">
                        </div>
                        
                        
                        <div class="form-row">
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="show" name="showUser">
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

        <?php foreach($data as $post):?>
        <div class="card">
            <div class="card-body">
                <div class="media">
                    <img src="<?php echo $post->img ?? ''?>" class="mr-3" alt="...">
                    <div class="media-body">
                        <h5 class="mt-0"><?php echo $post->show_author == false ? 'Anonymous' : $post->username?></h5>
                        
                        <p><?php echo $post->body;?></p>
                        <small><?php echo $post->created_at;?></small>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;?>

    </section>
    
</body>
</html>