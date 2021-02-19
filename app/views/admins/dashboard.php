<?php
include_once '../app/views/includes/dash.php';
?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Admin</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">Dashboard</li>
                        </ol>
                       <div class="row">
                           <div class="col-xl-4 col-md-6">
                               <div class="card bg-primary text-white mb-4">
                                   <div class="card-body"><?php echo $data['userCount'];?></div>
                                   <div class="card-footer">Users</div>
                               </div>
                           </div>

                           <div class="col-xl-4 col-md-6">
                               <div class="card bg-warning text-white mb-4">
                                   <div class="card-body"><?php echo $data['postCount'];?></div>
                                   <div class="card-footer">Posts</div>
                               </div>
                           </div>

                           <div class="col-xl-4 col-md-6">
                               <div class="card bg-danger text-white mb-4">
                                   <div class="card-body"><?php echo $data['commentCount'];?></div>
                                   <div class="card-footer">Comments</div>
                               </div>
                           </div>
                       </div> 

                       <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area mr-1"></i>
                                        Area Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar mr-1"></i>
                                        Bar Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo URLROOT;?>/public/js/scripts.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo URLROOT;?>/public/assets/demo/datatables-demo.js"></script>
    </body>
</html>


<?php
// include_once '../app/views/includes/dash-foot.php';
?>       