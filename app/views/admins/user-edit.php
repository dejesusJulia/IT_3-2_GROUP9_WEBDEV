<?php include_once '../app/views/includes/dash.php';?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <div class="row m-5">
                    <div class="col-6 offset-3">
                    <!-- ALERT MESSAGES -->
                    <?php if(isset($data['successMsg'])):?>
                    <div class="alert alert-success">
                        <?php echo $data['successMsg'] ?? '';?>
                    </div>
                    <?php unset($data['successMsg']);?>
                    <?php elseif(isset($data['errorMsg'])):?>
                    <div class="alert alert-danger">
                        <?php echo $data['errorMsg'] ?? '';?>
                    </div>
                    <?php unset($data['errorMsg']);?>
                    <?php endif;?>

                        <div class="card">
                            <div class="card-body">
                                <form action="user-edit?<?php echo $data['userData']->user_id;?>" method="post" class="form">
                                    <div class="form-group row">
                                        <label for="name" class="col-form-label col-sm-2">Name</label>
                                        <div class="col-sm-10">
                                            <p><?php echo $data['userData']->username;?></p>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-form-label col-sm-2">Email</label>
                                        <div class="col-sm-10">
                                            <p><?php echo $data['userData']->user_email;?></p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <select name="user_type" id="userType" class="custom-select">
                                            <option value="<?php echo $data['user'];?>" <?php echo $data['user'] == $data['userData']->user_type? 'selected': '';?>>User</option>

                                            <option value="<?php echo $data['admin'];?>" <?php echo $data['admin'] == $data['userData']->user_type? 'selected': '';?>>Admin</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" value="Update" class="btn btn-primary" name="updateUserType">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; <?php echo SITENAME . ' ' . date('Y');?></div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer> 
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo URLROOT;?>/public/js/scripts.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
            
    <script src="<?php echo URLROOT;?>/public/assets/demo/datatables-demo.js"></script>
    <script src="<?php echo URLROOT;?>/public/assets/demo/chart-area-demo.js"></script>
    <script src="<?php echo URLROOT;?>/public/assets/demo/chart-bar-demo.js"></script>
        
    </body>
</html>
      