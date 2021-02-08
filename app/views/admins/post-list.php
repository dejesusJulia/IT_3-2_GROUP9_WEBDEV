<?php
include_once '../app/views/includes/dash.php';
?>
    <table class="table table-striped">
        <thead>
            <th>ID</th>
            <th>BODY</th>
            <th>AUTHOR</th>
            <th>MODIFY</th>
        </thead>

        <tbody>
            <?php
                foreach($data as $col):
            ?>
            <tr>
                <td><?php echo $col->post_id?></td>
                <td><?php echo $col->body?></td>
                <td><?php echo $col->show_author == false ? 'anonymous' : $col->username ;?></td>

                <td>
                    <a href="post-view?<?php echo $col->post_id;?>">View</a>
                    <a href="post-delete?<?php echo $col->post_id;?>">Delete</a>
                </td>
            </tr>
            <?php
                endforeach;
            ?>
        </tbody>
    </table>
</body>
</html>