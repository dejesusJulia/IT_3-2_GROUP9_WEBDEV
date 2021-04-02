<?php
include_once '../app/views/includes/header.php';
?>
        <main>  
            <div class="container p-3">
                <!-- ALERTS -->
                <?php if(isset($_SESSION['successMsg'])):?>
                <div class="col-8 offset-2 alert alert-success alert-dismissible fade show" role="alert" style="width: inherit;">
                    <strong><?php echo $_SESSION['successMsg'];?></strong>
                    <button class="close" data-dismiss="alert">&times;</button>
                </div>
                <?php unset($_SESSION['successMsg']);?>

                <?php elseif(isset($_SESSION['errorMsg'])):?>
                <div class=" col-8 offset-2 alert alert-danger alert-dismissible fade show" role="alert" style="width: inherit;">
                    <strong><?php echo $_SESSION['errorMsg'];?>.</strong>
                    <button class="close" data-dismiss="alert">&times;</button>
                </div>
                <?php unset($_SESSION['errorMsg']);?>
                
                <?php endif;?>

                <!-- UPDATE FORM -->
                <div class="col-8 offset-2 bg-secondary p-3 mb-2 rounded text-white">
                    <h4 class="text-center">Update Post</h4>
                </div>

                <div class="col-8 offset-2">
                    <!-- FORM -->
                    <div class="shadow-lg p-3 mb-5 bg-white rounded">
                        <div class="row no-gutters">
                            <div class="col-md-6">
                                <div>
                                    <img src="<?php echo $data['post']->img ?? URLROOT . '/public/img/image-placeholder-icon-19.jpg';?>" alt="post image" width="90%" id="img-edit-show">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <form action="../user/edit-post?<?php echo $data['post']->post_id;?>" method="post" novalidate enctype="multipart/form-data">
                                    <!-- BODY -->
                                    <div class="form-group">
                                        <textarea name="body" id="body" cols="30" rows="3" class="form-control" placeholder="Your post here"><?php echo $data['post']->body;?></textarea>

                                        <!-- ERROR HANDLER -->
                                        <?php if(isset($data['err']['body']['errors'][0])):?>
                                        <small class="text-danger">
                                            <?php echo $data['err']['body']['errors'][0];?>
                                        </small>
                                        <?php endif;?>
                                    </div>

                                    <!-- IMAGE -->
                                    <div class="form-group" id="img-edit-group">
                                        <input type="file" name="img" id="edit-img" hidden>

                                        <label for="edit-img" class="btn btn-danger btn-sm">Photo</label>
   
                                        <span class="text-muted" id="img-edit-name"><?php echo str_replace('../public/img/posts/', '', $data['post']->img) ?? '';?></span>
                                       
                                        <!-- ERROR HANDLER -->
                                        <?php if(isset($data['err']['img']['errors'][0])):?>
                                        <small class="text-danger">
                                            <?php echo $data['err']['img']['errors'][0];?>
                                        </small>
                                        <?php endif;?>
                                    </div>

                                    <div class="form-group">
                                        <?php foreach($data['tags'] as $tags):?>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" name="tagName[]" id="<?php echo $tags->tag_id;?>" class="form-check-input" value="<?php echo $tags->tag_id;?>" <?php echo in_array($tags->tag_id, $data['categs']) ? 'checked': '';?>>

                                            <label for="<?php echo $tags->tag_id;?>" class="form-check-label"><?php echo $tags->tag_name;?></label>
                                        </div>
                                        <?php endforeach;?>
                                        <?php if(isset($data['cbErr'])):?>
                                            <small class="text-danger">
                                                <?php echo $data['cbErr'];?>
                                            </small>
                                        <?php endif;?>
                                    </div>

                                    <input type="hidden" name="user_id" value="<?php echo $data['post']->user_id;?>">

                                    <div class="form-row">
                                        <div class="col-6">
                                            <div class="form-group">
                                            <?php
                                                $checkAttr = $data['post']->show_author == true ? 'checked' : '';
                                            ?>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" name="show_author" id="show" class="custom-control-input" <?php echo $checkAttr;?>>
                                                    <label for="show" class="custom-control-label">Show author</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6 d-flex justify-content-end">
                                            <div class="form-group">
                                                <input type="submit" value="Update" class="btn btn-primary btn-sm" name="update-post">
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!--===== MAIN JS =====-->
        <script src="<?php echo URLROOT;?>/public/js/main.js"></script>
        <script src="<?php echo URLROOT;?>/public/js/custom.js"></script>
        <script>
            var imgEdit = document.getElementById('img-edit-group');
            imgEdit.addEventListener('change', showFileEdit);
            function showFileEdit(e){
                var imgFile = document.getElementById('edit-img');
                var fileName = document.getElementById('edit-img').files[0].name; 
                var reader = new FileReader();
                reader.onload = function(){
                    document.getElementById('img-edit-show').src = reader.result;
                    document.getElementById('img-edit-name').innerText = fileName;
                }
                reader.readAsDataURL(e.target.files[0]);

            }
        </script>
    </body>
</html>