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
                <?php if(isset($_SESSION['user']['user_type'])):?>
                  <div class="card shadow p-3 m-2">
                    <div class="row post">
                      <div class="post-image">
                        <img src="../public/<?php echo $_SESSION['user']['avatar'];?>" alt="profile" class="rounded-circle profile-image" width="50">
                      </div>
                      <!-- ADD POST FORM -->
                      <div class="post-content pr-2 pt-2">
                        <div>
                          <form action="../user/home" method="post" enctype="multipart/form-data" novalidate>
                            <div class="form-group">
                              <textarea name="body" id="post-body" cols="30" rows="3" class="form-control" style="border: 0;" placeholder="What's on your mind?"><?php echo $_POST['body'] ?? ''?></textarea>

                              <?php if(isset($data['err']['body']['errors'][0])):?>
                                <small class="text-danger">
                                  <?php echo $data['err']['body']['errors'][0];?>
                                </small>
                              <?php endif;?>
                            </div>
                            <hr>
                            <div class="form-row">
                              <div class="col-6">
                                <div class="form-group">
                                  <input type="file" name="img" id="form-img" hidden>
                                    <label for="form-img" id="img-lbl" class="btn btn-danger btn-sm">
                                        Photo
                                    </label>

                                    <span id="img-name" class="text-muted"></span>

                                    <?php if(isset($data['err']['img']['errors'][0])):?>
                                    <small class="text-danger">
                                    <?php echo $data['err']['img']['errors'][0];?>  
                                    </small>
                                    <?php endif;?>
                                </div>
                              </div>
                            </div>
                            
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['user_id'];?>">
                            
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
                                  <input type="submit" value="Add Post" class="btn btn-block btn-sm btn-c-blue" name="add-post">
                                </div>
                              </div>
                            </div>

                          </form>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endif?>

                    <!-- ALL POSTS -->
                    <?php foreach($data['posts'] as $post):?>
                    <div class="card shadow p-3 m-2">
                        <div class="row post">
                            <div class="post-image">
                                <?php if(isset($_SESSION['user']['user_type'])):?>
                                    <img src="../public/<?php echo $post->avatar ?? ''?>" class="rounded-circle profile-image" width="50" alt="profle">
                                <?php else:?>
                                    <img src="public/<?php echo $post->avatar ?? ''?>" class="rounded-circle p-1 profile-image" width="50" alt="profle">
                                <?php endif;?>   
                            </div>
                            <div class="post-content p-2">
                                 <div>
                                    <h5><?php echo $post->show_author == false ? 'Anonymous' : $post->username?></h5>

                                    <small><?php echo date('Y F j h:i:s a', strtotime($post->created_at));?></small>

                                    <p><?php echo $post->body;?></p>

                                    <?php if($post->img !== null):?>
                                      <?php if(isset($_SESSION['user']['user_type'])):?>
                                        <div>
                                            <img src="<?php echo $post->img;?>" alt="..." width="50%" class="img-fluid">
                                        </div>
                                      <?php else:?>
                                        <div>
                                            <img src="<?php echo str_replace('../public/', '', $post->img);?>" alt="..." width="50%" class="img-fluid">
                                        </div>
                                    <?php endif;?>
                                    <?php endif;?>

                                    <?php if(isset($_SESSION['user']['user_type'])):?>

                                    <a href="<?php echo '../' . $_SESSION['user']['user_type'] . '/comment?' . $post->post_id;?>">Add Comment &plus;</a>

                                    <?php endif;?>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
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