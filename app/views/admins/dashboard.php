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
                           <div class="col-xl-3 col-md-6">
                               <div class="card bg-primary text-white mb-4">
                                   <div class="card-body"><?php echo $data['userCount'];?></div>
                                   <div class="card-footer">Default Users</div>
                               </div>
                           </div>

                           <div class="col-xl-3 col-md-6">
                               <div class="card bg-warning text-white mb-4">
                                   <div class="card-body"><?php echo $data['postCount'];?></div>
                                   <div class="card-footer">Posts</div>
                               </div>
                           </div>

                           <div class="col-xl-3 col-md-6">
                               <div class="card bg-danger text-white mb-4">
                                   <div class="card-body"><?php echo $data['commentCount'];?></div>
                                   <div class="card-footer">Comments</div>
                               </div>
                           </div>

                           <div class="col-xl-3 col-md-6">
                               <div class="card bg-success text-white mb-4">
                                   <div class="card-body"><?php echo $data['adminCount'];?></div>
                                   <div class="card-footer">Admin</div>
                               </div>
                           </div>
                       </div> 

                       <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-pie mr-1"></i>
                                        Post Authors
                                    </div>
                                    <div class="card-body">
                                        <canvas id="myPieChart" width="100%" height="40" class="chartjs-render-monitor"></canvas>
                                        <input type="number" id="nonAnon" style="display: none;" value="<?php echo (int)$data['nonAnonPost'];?>">

                                        <input type="number" id="anon" style="display: none;" value="<?php echo (int)$data['anonPost'];?>">
                                    </div>    
                                </div>
                            </div>
                            
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar mr-1"></i>
                                        Post Views
                                    </div>
                                    <div class="card-body">
                                        <canvas id="myAreaChart" width="100%" height="40"></canvas>
                                        <input type="hidden" id="wkOne" value="<?php echo $data['weekOne'];?>">

                                        <input type="hidden" id="wkTwo" value="<?php echo $data['weekTwo'];?>">

                                        <input type="hidden" id="wkThree" value="<?php echo $data['weekThree'];?>">

                                        <input type="hidden" id="wkFour" value="<?php echo $data['weekFour'];?>">
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
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo URLROOT;?>/public/js/scripts.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        
        <script src="<?php echo URLROOT;?>/public/assets/demo/datatables-demo.js"></script>
        <script src="<?php echo URLROOT;?>/public/assets/demo/chart-pie-demo.js"></script>
        <script src="<?php echo URLROOT;?>/public/assets/demo/chart-area-demo.js"></script>
        
    </body>
</html>
      