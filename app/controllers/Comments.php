<?php

class Comments extends Controller{

    public function __construct()
    {
        $this->commentModel = $this->model('Comment');
        $this->postModel = $this->model('Post');
    }

    # ADD USER COMMENT
    public function addUserComment($i){
        session_start();
        $post = $this->postModel->joinUserPostSingle($i, $_SESSION['user']['user_id']);
        $comments = $this->commentModel->joinUserCommentsOfPost($i);
        $errors = $this->commentModel->commentErrors();

        // ON SUBMIT
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $data = $_POST;
            array_pop($data);
            $keys = array_keys($data);

            // FILTER
            $errors = $this->filter()->inputFilter($data, $errors);
            $ctr = $this->filter()->errorCounter($errors, $keys);

            // IF THERE ARE NO ERRORS
            if($ctr == 0){
                $this->commentModel->insertOne($data);
                header('Location: ../user/comment?' . $i);
                die();
            }
            
        }
        $data = [
            'post' => $post,
            'comments' => $comments,
            'errors' => $errors
        ];

        $this->view('comment', $data);
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