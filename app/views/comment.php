<?php
$home = '';
if($_SESSION['user']['user_type'] == 'admin'){
    $home = 'admin/home';
}else if($_SESSION['user']['user_type'] == 'user'){
    $home = 'user/home';
}else{
    header('Location: home');
    die();
}
include_once '../app/views/includes/header.php';
?>
    
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
        
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->

      <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-sm-12 mx-auto">
                    <div class="row post">
                        <div class="post-image">
                            <img src="../public/<?php echo $data['post']->avatar;?>" alt="user avatar" class="rounded-circle profile-image" width="60">
                        </div>
                        <div class="post-content p-2">
                            <div>
                                <h3><?php echo $data['post']->show_author == false ? 'Anonymous' : $data['post']->username;?></h3>
                                <small><?php echo $data['post']->created_at;?></small>

                                <p><?php echo $data['post']->body;?></p>

                                <?php if($data['post']->img !== null):?>
                                <div>
                                    <img src="<?php echo $data['post']->img;?>" alt="post image">
                                </div>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>

                    <!-- ADD COMMENT -->
                    <div class="card shadow p-3 m-2">
                        <div class="row post">
                            <div class="post-image">
                                <img src="../public/<?php echo $_SESSION['user']['avatar'];?>" alt=".." class="rounded-circle profile-image" width="50">
                            </div>

                            <div class="post-content pr-2 pt-2">
                                <div>
                                    <form action="../<?php echo $_SESSION['user']['user_type'];?>/comment?<?php echo $data['post']->post_id;?>" method="post" enctype="multipart/form-data" novalidate>

                                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['user_id'];?>">

                                        <input type="hidden" name="post_id" value="<?php echo $data['post']->post_id;?>">

                                        <div class="form-group">
                                            <textarea name="comment_body" id="" cols="30" rows="2" class="form-control"></textarea>
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
                                                    <label class="custom-control-label" for="show">show user</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-6 d-flex justify-content-end">
                                                <div class="form-group">
                                                    <input type="submit" value="Add Comment" name="addComment" class="btn btn-sm btn-block btn-c-blue">
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ALL COMMENTS -->
                    <?php if($data['comments'] == null):?>
                        <div class="d-flex flex-column align-items-center">
                            <img src="../public/img/undraw_public_discussion.svg" alt="No comments yet" width="50%">
                            <h5>No comments yet</h5>
                        </div>
                    
                    <?php else:?>    
                    <?php foreach($data['comments'] as $comment):?>
                    <div class="card shadow p-3 m-2">
                        <div class="row post">
                            <div class="post-image">   
                                <img src="../public/<?php echo $comment->avatar ?? ''?>" class="rounded-circle profile-image" width="50" alt="profle">       
                            </div>
                            <div class="post-content p-2">
                                 <div>
                                    <h5><?php echo $comment->show_author == true?$comment->username : 'Anonymous';?></h5>

                                    <small><?php echo date('Y F j h:i:s a', strtotime($comment->created_at));?></small>

                                    <p><?php echo $comment->comment_body;?></p>

                                    <?php if($_SESSION['user']['user_id'] == $comment->user_id):?>

                                    <a href="comment-edit?<?php echo $comment->comment_id;?>">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <button class="btn btn-sm btn-danger" onclick="event.preventDefault();if(confirm('Do you want to delete your comment in this post?')){
                                        document.getElementById('comment-delete-<?php echo $comment->comment_id;?>').submit();
                                    }">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    <form id="comment-delete-<?php echo $comment->comment_id;?>" action="../<?php echo $_SESSION['user']['user_type'];?>/comment-delete?<?php echo $data['post']->post_id;?>" method="post" style="display: none;">
                                        <input type="hidden" name="comment_id" value="<?php echo $comment->comment_id;?>">
                                    </form>
                                    <?php endif;?>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>

                    <?php endif;?>
                </div>
            </div>

        </div><!-- /.container-fluid -->
      </section>

      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; <?php echo date('Y');?> <span class="text-info"></span>LIBERTAD</span></strong>
      All rights reserved.

    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="<?php echo URLROOT;?>/public/assets/js/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo URLROOT;?>/public/assets/js/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo URLROOT;?>/public/assets/js/bootstrap.bundle.min.js"></script>

  <!-- overlayScrollbars -->
  <script src="<?php echo URLROOT;?>/public/assets/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo URLROOT;?>/public/assets/js/adminlte.js"></script>

  <script src="<?php echo URLROOT;?>/public/js/home-script.js"></script>

</body>

</html>