<?php include_once '../app/views/includes/dash.php';?>
    
    <div class="card">
        <div class="card-body">
            <form action="" method="post" class="form">
                <div class="form-group row">
                    <label for="name" class="col-form-label col-sm-2">Name</label>
                    <div class="col-sm-10">
                        <p>Name here</p>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-form-label col-sm-2">Email</label>
                    <div class="col-sm-10">
                        <p>Email here</p>
                    </div>
                </div>

                <div class="form-group">
                    <select name="user_type" id="userType" class="custom-select">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
            </form>
        </div>
    </div>
</body>
</html>