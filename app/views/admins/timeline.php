<?php include_once '../app/views/includes/header.php';?>
    
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
                    <?php if($data == null):?>
                      <div class="d-flex flex-column align-items-center">
                        <img src="../public/img/undraw_my_feed.svg" alt="You have no posts" width="75%">
                        <h3>You have no posts yet. Add a <a href="../user/home">new post</a></h3>
                      </div>

                    <?php else:?>
                    <!-- ALL POSTS -->
                    <?php foreach($data as $post):?>
                    <div class="card shadow p-3 m-2">
                        <div class="row post">
                            <div class="post-image">
                                <img src="../public/<?php echo $_SESSION['user']['avatar'];?>" class="rounded-circle profile-image" width="50" alt="profle">
                            </div>
                            <div class="post-content p-2">
                                 <div>
                                    <h5><?php echo $post->show_author == false ? 'Anonymous' : $_SESSION['user']['username'];?></h5>

                                    <small><?php echo date('Y F j h:i:s a', strtotime($post->created_at));?></small>

                                    <p><?php echo $post->body;?></p>

                                    <?php if($post->img !== null):?>
                                        <div>
                                            <img src="<?php echo $post->img;?>" alt="..." width="50" class="img-fluid">
                                        </div>

                                    <?php endif;?>

                                    <a class="px-2" href="../admin/edit-post?<?php echo $post->post_id;?>">
                                        <i class="fas fa-edit"></i>
                                        Edit
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="event.preventDefault();if(confirm('Do you want to delete this post?')){
                                    document.getElementById('admin-post-delete-<?php echo $post->post_id;?>').submit()
                                    }">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>

                                    <form action="../admin/post-delete?<?php echo $post->post_id;?>" method="post" id="admin-post-delete-<?php echo $post->post_id;?>" style="display: none;"></form>

                                   
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


</body>

</html>