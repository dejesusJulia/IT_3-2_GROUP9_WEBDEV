<?php
/* POST REQUESTS FOR COMMENTS */
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
        if(isset($_POST['addComment'])){
            $data = $_POST;
            array_pop($data);
            $keys = array_keys($data);

            // FILTER
            $errors = $this->filter()->inputFilter($data, $errors);
            $ctr = $this->filter()->errorCounter($errors, $keys);

            // IF THERE ARE NO ERRORS
            if($ctr == 0){
                if($this->commentModel->insertOne($data)){
                    header('Location: ../user/comment?' . $i);
                die();
                }else{
                    $data['errorMsg'] = 'Error in adding comment';
                }                
                
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
        session_start();
        $post = $this->postModel->joinUserPostSingle($i, $_SESSION['user']['user_id']);
        $comments = $this->commentModel->joinUserCommentsOfPost($i);
        $errors = $this->commentModel->commentErrors();

        // ON SUBMIT
        if(isset($_POST['addComment'])){
            $data = $_POST;
            array_pop($data);
            $keys = array_keys($data);

            // FILTER
            $errors = $this->filter()->inputFilter($data, $errors);
            $ctr = $this->filter()->errorCounter($errors, $keys);

            // IF THERE ARE NO ERRORS
            if($ctr == 0){
                if($this->commentModel->insertOne($data)){
                    header('Location: ../admin/comment?' . $i);
                    die();
                }else{
                    $data['errorMsg'] = 'Error in adding comment';
                }  
                
            }

        }

        $data = [
            'post' => $post,
            'comments' => $comments,
            'errors' => $errors
        ];

        $this->view('comment', $data);
    }

    # UPDATE USER COMMENT
    public function updateUserComment($i){
        session_start();
        $comment = $this->commentModel->getComment($i);
        $errors = $this->commentModel->commentErrors();
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){            
            $request = [
                'comment_body' => $_POST['comment_body']
            ];
            $keys = array_keys($request);

            // FILTER
            $errors = $this->filter()->inputFilter($request, $errors);
            $ctr = $this->filter()->errorCounter($errors, $keys);
            if($ctr == 0){
                $request['comment_id'] = $i;
                if($this->commentModel->updateComment($request)){
                    header('Location: ../user/comment?'. $_POST['post_id']);
                    die();

                }else{
                    $data['errorMsg'] = 'Error in adding comment';
                }
                
            }

        }
        $data = [
            'comment' => $comment,
            'errors' => $errors
        ];
        
        $this->view('edit-comment', $data);
    }

    # UPDATE ADMIN COMMENT
    public function updateAdminComment($i){
        session_start();
        $comment = $this->commentModel->getComment($i);
        $errors = $this->commentModel->commentErrors();
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){            
            $request = [
                'comment_body' => $_POST['comment_body']
            ];
            $keys = array_keys($request);

            // FILTER
            $errors = $this->filter()->inputFilter($request, $errors);
            $ctr = $this->filter()->errorCounter($errors, $keys);
            if($ctr == 0){
                $request['comment_id'] = $i;
                if($this->commentModel->updateComment($request)){
                    header('Location: ../admin/comment?'. $_POST['post_id']);
                    die();

                }else{
                    $data['errorMsg'] = 'Error in adding comment';
                }
                
            }

        }
        $data = [
            'comment' => $comment,
            'errors' => $errors
        ];
        
        $this->view('edit-comment', $data);
    }

    # DELETE USER COMMENT 
    public function destroyUserComment($i){
        session_start();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $commentId = $_POST['comment_id'];
            if($this->commentModel->deleteComment($commentId)){
                $_SESSION['successMsg'] = 'Comment deleted';
                header('Location: ../user/comment?' . $i);
                die();
            }else{
                $_SESSION['errorMsg'] = 'User not deleted';
                header('Location: ../user/comment?' . $i);
                die();
            }  
        }
    }

    # DELETE ADMIN COMMENT
    public function destroyAdminComment($i){
        session_start();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $commentId = $_POST['comment_id'];
            if($this->commentModel->deleteComment($commentId)){
                $_SESSION['successMsg'] = 'Comment deleted';
                header('Location: ../admin/comment?' . $i);
                die();
            }else{
                $_SESSION['errorMsg'] = 'Comment not deleted';
                header('Location: ../admin/comment?' . $i);
                die();
            }  
        }
        
    }
}