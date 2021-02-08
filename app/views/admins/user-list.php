<?php
include_once '../app/views/includes/dash.php';
?>
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
            ?>
            <tr>
                <td><?php echo $col->user_id;?></td>
                <td><?php echo $col->username;?></td>
                <td><?php echo $col->user_email;?></td>
                <td><?php echo $col->user_type;?></td>
                <td>
                    <a href="user-edit?<?php echo $col->user_id;?>">Edit</a>
                    <a href="user-delete">Delete</a>
                </td>
            </tr>
            <?php
                endforeach;
            ?>
        </tbody>
    </table>

    <?php var_dump($_SESSION['user']);?>
</body>
</html>