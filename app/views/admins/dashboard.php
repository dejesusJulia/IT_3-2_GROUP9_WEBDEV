<?php
include_once '../app/views/includes/dash.php';
?>
    Dashboard to.
    <ul>
        <li><?php echo 'Posts: ' . $data['postCount'];?></li>
        <li><?php echo 'Users: ' . $data['userCount'];?></li>
    </ul>
    <a href="../index">Logout</a>
</body>
</html>