<?php

class Comments extends Controller{

    public function __construct()
    {
        $this->commentModel = $this->model('comment');
    }

    # ADD USER COMMENT
    public function addUserComment($i){
        // code here
    }

    # ADD ADMIN COMMENT
    public function addAdminComment($i){
        // code here
    }

    # UPDATE USER COMMENT
    public function updateUserComment($i){
        // code
    }

    # UPDATE ADMIN COMMENT
    public function updateAdminComment($i){
        // code
    }

    # DELETE USER COMMENT 
    public function deleteUserComment($i){
        // code
    }

    # DELETE COMMENT (FOR ADMIN)
    public function deleteComment($i){
        
    }
}