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
                    <?php if(isset($_SESSION['successMsg'])):?>
                    <div class="alert alert-success">
                      <strong>
                        <?php echo $_SESSION['successMsg'];?>
                      </strong>
                    </div>
                    <?php unset($_SESSION['successMsg']);?>
                    <?php elseif(isset($_SESSION['errorMsg'])):?>
                    <div class="alert alert-danger">
                      <strong>
                        <?php echo $_SESSION['errorMsg'];?>
                      </strong>
                    </div>
                    <?php unset($_SESSION['errorMsg']);?>
                    <?php endif;?>
                    <!-- POST -->
                    <div class="card shadow p-3 m-2">
                        <div class="row post">
                            <div class="post-image">
                                <img src="../public/<?php echo $_SESSION['user']['avatar'];?>" class="rounded-circle profile-image" width="50" alt="profle">
                            </div>
                            <div class="post-content p-2">
                                <div>
                                 <form action="../<?php echo $_SESSION['user']['user_type'];?>/comment-edit?<?php echo $data['comment']->comment_id;?>" method="post" novalidate>

                                    <input type="hidden" name="user_id" value="<?php echo $data['comment']->user_id;?>">

                                    <input type="hidden" name="post_id" value="<?php echo $data['comment']->post_id;?>">

                                    <!-- POST -->
                                    <div class="form-group">
                                    <textarea name="comment_body" id="post-body" cols="30" rows="3" class="form-control" style="border: 0;" placeholder="What's on your mind?"><?php echo $data['comment']->comment_body;?></textarea>
                                    <!-- ERROR HANDLER BODY -->
                                    <?php if(isset($data['err']['comment_body']['errors'][0])):?>
                                        <small class="text-danger">
                                        <?php echo $data['err']['comment_body']['errors'][0];?>
                                        </small>
                                    <?php endif;?>
                                    </div>

                                    <div class="form-row">
                                      <div class="col-6">
                                        <div class="form-group">
                                          <select name="show_author" id="showauthor" class="form-control">
                                            <?php
                                            $anon = 'anonymous'; $user = 'user';
                                            ?>

                                            <option value="<?php echo $anon;?>" <?php echo $data['comment']->show_author == false ? 'selected' : '';?>>Anonymous</option>

                                            <option value="<?php echo $user;?>" <?php echo $data['comment']->show_author == true ? 'selected' : '';?>><?php echo $_SESSION['user']['username'];?></option>
                                          </select>
                                        </div>
                                      </div>

                                      <div class="col-6 d-flex justify-content-end">
                                        <div class="form-group">
                                          <input type="submit" name="updateComment" value="Update comment" class="btn btn-blocl btn-c-blue">
                                        </div>
                                      </div>
                                    </div>
                                    
                                   
                                    
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
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

    
    