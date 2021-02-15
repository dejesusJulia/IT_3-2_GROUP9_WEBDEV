<?php
include_once '../app/views/includes/dash.php';
?>
<div class="container mx-auto">
    <div class="col-8 offset-2">
        <?php if(isset($_SESSION['successMsg'])):?>
            <div class="alert alert-success">
                <p><?php echo $_SESSION['successMsg'];?></p>
            </div>
            <?php unset($_SESSION['successMsg']);?>
        <?php elseif(isset($_SESSION['errorMsg'])):?>
            <div class="alert alert-success">
                <p><?php echo $_SESSION['errorMsg'];?></p>
            </div>
            <?php unset($_SESSION['errorMsg']);?>
        <?php 
        endif;?>
        <table class="table table-striped">
            <thead>
                <th>ID</th>
                <th>USERNAME</th>
                <th>USER EMAIL</th>
                <th>USER TYPE</th>
                <th>MODIFY</th>
            </thead>

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
                        <a href="user-edit?<?php echo $col->user_id;?>">Edit</a>
                        <button class="btn btn-danger" onclick="event.preventDefault();
                        if(confirm('Do you want to delete <?php echo $col->username;?>?')){
                            document.getElementById('user-delete-<?php echo $col->user_id;?>').submit()
                            }">Delete</button>

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
                        <a href="../profile?<?php echo $col->user_id;?>">Edit profile</a>
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
</body>
</html>