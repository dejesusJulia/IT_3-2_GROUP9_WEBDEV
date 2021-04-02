<?php
include_once '../app/views/includes/dash.php';
?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Admin</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item">Tags List</li>
                </ol>

                <div class="row">
                    <!-- TIPS -->
                    <div class="col-md-6">
                        <div class="card m-4">
                            <div class="card-header bg-warning text-dark">
                                <h4><i class="fas fa-info-circle"></i> Tips</h4>
                            </div>
                            <div class="card-body">
                                <p>Do not enter already existing tag</p>
                            </div>
                        </div>
                    </div>

                    <!-- FORM TO ADD NEW TAG -->
                    <div class="col-md-6">
                        <div class="card m-4">
                            <div class="card-header">
                                Add new tag
                            </div>
                            
                            <div class="card-body">
                                <form action="../admin/tag-list" method="post">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" name="tag_name" id="tag-name" class="form-control">
                                            <div class="input-group-append">
                                                <input type="submit" value="Add tag" class="btn btn-primary" name="add-tag">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>    
                </div>

                <!-- ALERTS -->
                <?php if(isset($_SESSION['successMsg'])):?>
                <div class="alert alert-success fade show alert-dismissible">
                    <strong><?php echo $_SESSION['successMsg'];?></strong>
                    <button class="close" data-dismiss="alert">&times;</button>
                </div>
                <?php unset($_SESSION['successMsg']);?>
                
                <?php elseif(isset($_SESSION['errorMsg'])):?>
                <div class="alert alert-danger fade show alert-dismissible">
                    <strong><?php echo $_SESSION['errorMsg'];?></strong>
                    <button class="close" data-dismiss="alert">&times;</button>
                </div>
                <?php unset($_SESSION['errorMsg']);?>
                <?php endif;?>

                <!-- TABLE -->
                <div class="card m-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        All tags/topics
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <th>ID</th>
                                    <th>DESCRIPTION</th>
                                    <th>POSTS</th>
                                    <th>MODIFY</th>
                                </thead>

                                <tfoot>
                                    <th>ID</th>
                                    <th>DESCRIPTION</th>
                                    <th>POSTS</th>
                                    <th>MODIFY</th>
                                </tfoot>

                                <tbody>
                                <?php
                                    foreach($data['tags'] as $col):
                                ?>
                                <tr>
                                    <td><?php echo $col->tag_id;?></td>
                                    <td><?php echo $col->tag_name;?></td>
                                    <!-- IF TAG HAS NO ASSOCIATED POST YET -->
                                    <?php 
                                    if(!in_array($col->tag_id, array_column($data['postCount'], 'tag_id'))):
                                    ?>
                                    <td>0</td>

                                    <!-- IF TAG HAS POST ASSOCIATED  -->
                                    <?php 
                                    elseif(in_array($col->tag_id, array_column($data['postCount'], 'tag_id'))):
                                        foreach($data['postCount'] as $count):
                                            if($count->tag_id == $col->tag_id && $count->postCount !== null):
                                    ?>
                                    <td><?php echo $count->postCount;?></td>
                                    <?php 
                                    elseif($count->tag_id !== $col->tag_id && $count->postCount == null):?>
                                    <td>0</td>
                                    <?php
                                    endif;
                                    endforeach; 
                                    endif;
                                    ?>

                                    <td>
                                    <a href="../admin/tag-edit?<?php echo $col->tag_id;?>">
                                        <i class="fas fa-users-cog"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="event.preventDefault();
                                    if(confirm('Do you want to delete the tag <?php echo $col->tag_name;?>?')){
                                    document.getElementById('tag-delete-<?php echo $col->tag_id;?>').submit()
                                    }"><i class="fas fa-trash"></i></button>

                                    <form action="../admin/tag-delete?<?php echo $col->tag_id;?>" method="post" id="tag-delete-<?php echo $col->tag_id;?>" style="display: none;"></form>
                                    </td>

                                </tr>

                                <?php
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
    </body>
</html>



