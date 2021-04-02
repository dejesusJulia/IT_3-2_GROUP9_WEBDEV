<?php include_once '../app/views/includes/dash.php';?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Admin</h1>
                <ol class="breadcrumb my-4">
                    <li class="breadcrumb-item">
                        <a href="../admin/user-list">User List</a>
                    </li>
                    <li class="breadcrumb-item">Edit User</li>
                </ol>
                <div class="row m-5">
                    <div class="col-4 offset-4">
                    <!-- ALERT MESSAGES -->
                    <?php if(isset($_SESSION['successMsg'])):?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo $_SESSION['successMsg'] ?? '';?>
                        <button class="close" data-dismiss="alert">&times;</button>
                    </div>
                    <?php unset($_SESSION['successMsg']);?>

                    <?php elseif(isset($_SESSION['errorMsg'])):?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $_SESSION['errorMsg'] ?? '';?>
                        <button class="close" data-dismiss="alert">&times;</button>
                    </div>
                    <?php unset($_SESSION['errorMsg']);?>
                    <?php endif;?>

                        <div class="card">
                            <div class="card-body">
                                <form action="../admin/tag-edit?<?php echo $data['tagData']->tag_id;?>" method="post" class="form">

                                    <div class="form-group">
                                        <label for="tag-name">Description</label>
                                        <input type="text" name="tag_name" id="tag-name" class="form-control" placeholder="e.g., funny" value="<?php echo $data['tagData']->tag_name;?>">
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" value="Update" class="btn btn-primary btn-block" name="updateTag">
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
      