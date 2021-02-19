<?php
include_once '../app/views/includes/dash.php';
?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Admin</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">User-List</li>
                    </ol>
                <div class="card m-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        All users
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <th>ID</th>
                                    <th>USERNAME</th>
                                    <th>USER EMAIL</th>
                                    <th>USER TYPE</th>
                                    <th>MODIFY</th>
                                </thead>

                                <tfoot>
                                    <th>ID</th>
                                    <th>USERNAME</th>
                                    <th>USER EMAIL</th>
                                    <th>USER TYPE</th>
                                    <th>MODIFY</th>
                                </tfoot>

                                <tbody>
                                <?php
                                    foreach($data as $col):
                                    if($col->user_id !== $_SESSION['user']['user_id']):
                                ?>
                                <tr>
                                    <td><?php echo $col->user_id;?></td>
                                    <td><?php echo $col->username;?></td>
                                    <td><?php echo $col->user_email;?></td>
                                    <td><?php echo $col->user_type;?></td>
                                    <td>
                                    <a href="user-edit?<?php echo $col->user_id;?>">
                                        <i class="fas fa-users-cog"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="event.preventDefault();
                                    if(confirm('Do you want to delete <?php echo $col->username;?>?')){
                                    document.getElementById('user-delete-<?php echo $col->user_id;?>').submit()
                                    }"><i class="fas fa-trash"></i></button>

                                    <form action="../admin/user-delete?<?php echo $col->user_id;?>" method="post" id="user-delete-<?php echo $col->user_id;?>" style="display: none;"></form>
                                    </td>
                                </tr>
                                <?php else:?>
                                <tr>
                                    <td><?php echo $col->user_id;?></td>
                                    <td><?php echo $col->username;?></td>
                                    <td><?php echo $col->user_email;?></td>
                                    <td><?php echo $col->user_type;?></td>
                                    <td>
                                    <a href="../profile?<?php echo $col->user_id;?>">
                                        <i class="fas fa-user-cog"></i>
                                    </a>
                                    </td>
                                </tr>
                                <?php
                                    endif;
                                    endforeach;
                                ?>
                                </tbody>
                            </table>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo URLROOT;?>/public/js/scripts.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo URLROOT;?>/public/assets/demo/datatables-demo.js"></script>
    </body>
</html>



