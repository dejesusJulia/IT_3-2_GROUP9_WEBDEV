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
                    <?php if(isset($_SESSION['successMsg'])):?>

                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>
                        <?php echo $_SESSION['successMsg'];?>
                      </strong>
                      <button class="close" data-dismiss="alert">&times;</button>
                    </div>

                    <?php unset($_SESSION['successMsg']);?>
                    <?php elseif(isset($_SESSION['errorMsg'])):?>

                    <div class="alert alert-danger alert-dismissible fade show">
                      <strong>
                        <?php echo $_SESSION['errorMsg'];?>
                      </strong>
                      <button class="close" data-dismiss="alert">&times;</button>
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
                                 <form action="../admin/edit-post?<?php echo $data['post']->post_id;?>" method="post" enctype="multipart/form-data" novalidate>
                                    <!-- POST -->
                                    <div class="form-group">
                                    <textarea name="body" id="post-body" cols="30" rows="3" class="form-control" style="border: 0;" placeholder="What's on your mind?"><?php echo $data['post']->body;?></textarea>
                                    <!-- ERROR HANDLER BODY -->
                                    <?php if(isset($data['err']['body']['errors'][0])):?>
                                        <small class="text-danger">
                                        <?php echo $data['err']['body']['errors'][0];?>
                                        </small>
                                    <?php endif;?>
                                    </div>

                                    <hr>
                                    <div class="form-row">
                                    <div class="col-6">
                                        <div class="form-group" id="img-group-a">
                                        <input type="file" name="img" id="form-img-a" hidden>
                                            <label for="form-img-a" id="img-lbl" class="btn btn-danger btn-sm">
                                                Photo
                                            </label>

                                            <span id="img-name-a" class="text-muted"></span> 
                                            <!-- ERROR HANDLER IMG -->
                                            <?php if(isset($data['err']['img']['errors'][0])):?>
                                            <small class="text-danger">
                                            <?php echo $data['err']['img']['errors'][0];?>  
                                            </small>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                    </div>
                                    
                                    <input type="hidden" name="user_id" value="<?php echo $data['post']->user_id;?>">
                                    
                                    <div class="form-row">
                                      <div class="col-6">
                                          <div class="form-group">
                                          <select class="form-control" name="show_author" id="showAuthor">
                                          <?php
                                          $anon = 'anonymous'; $user = 'user';
                                          ?>
                                              <option value="<?php echo $anon;?>" <?php echo $data['post']->show_author == false ? 'selected' : '';?>>Anonymous</option>

                                              <option value="<?php echo $user;?>" <?php echo $data['post']->show_author == true ? 'selected' : '';?>><?php echo $_SESSION['user']['username'];?></option>
                                          </select>
                                          </div>
                                      </div>

                                      <div class="col-6 d-flex justify-content-end">
                                          <div class="form-group">
                                            <input type="submit" value="Update post" class="btn btn-block btn-c-blue" name="update-post">
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
  <script>
    var imgA = document.getElementById('img-group-a');

    imgA.addEventListener('change', showFileA);

    function showFileA(e){
        var fileName = document.getElementById('form-img-a').files[0].name;
        document.getElementById('img-name-a').innerText = fileName;
    }
  </script>

</body>

</html>