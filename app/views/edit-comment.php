<?php
include_once '../app/views/includes/header.php';
?>
        <main>  
            <div class="container p-3">
                <?php if(isset($_SESSION['successMsg'])):?>
                <div class="col-8 offset-2 alert alert-success alert-dismissible fade show" role="alert" style="width: inherit;">
                    <strong><?php echo $_SESSION['successMsg'];?></strong>
                    <button class="close" data-dismiss="alert">&times;</button>
                </div>
                <?php unset($_SESSION['successMsg']);?>

                <?php elseif(isset($_SESSION['errorMsg'])):?>
                <div class=" col-8 offset-2 alert alert-danger alert-dismissible fade show" role="alert" style="width: inherit;">
                    <strong><?php echo $_SESSION['errorMsg'];?></strong>
                    <button class="close" data-dismiss="alert">&times;</button>
                </div>
                <?php unset($_SESSION['errorMsg']);?>
                <?php endif;?>
                
                <div class="col-8 offset-2 bg-secondary p-3 mb-2 rounded text-white">
                    <h4 class="text-center">Update Comment</h4>
                </div>

                <!-- COMMENT -->
                <div class="col-8 offset-2">
                    <!-- FORM -->
                    <div class="shadow-lg p-3 mb-5 bg-white rounded">
                        <div class="d-flex">
                            <div style="flex: 1;">
                                <img src="../public/<?php echo $_SESSION['user']['avatar'];?>" alt="..." width="50">
                            </div>

                            <div style="flex: 11;">
                                <form action="../<?php echo $_SESSION['user']['user_type'];?>/comment-edit?<?php echo $data['comment']->comment_id;?>" method="post" novalidate>
                                    <!-- USER ID -->
                                    <input type="hidden" name="user_id" value="<?php echo $data['comment']->user_id;?>">

                                    <!-- POST ID -->
                                    <input type="hidden" name="post_id" value="<?php echo $data['comment']->post_id;?>">
            
                                    <!-- COMMENT BODY -->
                                    <div class="form-group">
                                        <textarea name="comment_body" id="comment-body" cols="30" rows="3" class="form-control" placeholder="Your post here"><?php echo $data['comment']->comment_body;?></textarea>

                                        <!-- ERROR HANDLER -->
                                        <?php if(isset($data['err']['comment_body']['errors'][0])):?>
                                        <small class="text-danger">
                                            <?php echo $data['err']['comment_body']['errors'][0];?>
                                        </small>
                                        <?php endif;?>
                                    </div>
            
                                    <!-- SWITCH ANON -->
                                    <div class="form-row">
                                        <div class="col-6">
                                            <div class="form-group">
                                            <?php
                                            $checkAttr = $data['comment']->show_author == true ? 'checked' : '';
                                            ?>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" name="show_author" id="show" class="custom-control-input" <?php echo $checkAttr;?>>
                                                    <label for="show" class="custom-control-label">Show author</label>
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class="col-6 d-flex justify-content-end">
                                            <div class="form-group">
                                                <input type="submit" value="Update" class="btn btn-primary btn-sm" name="updateComment">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
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