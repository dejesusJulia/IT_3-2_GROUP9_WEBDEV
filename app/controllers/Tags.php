<?php

class Tags extends Controller{
    public function __construct()
    {
        $this->tagModel = $this->model('Tag');
        $this->categoryModel = $this->model('Category');
    }

    # CREATE NEW TAG/TOPIC
    public function addTag(){
        session_start();
        $tags = $this->tagModel->all();
        $postCount = $this->categoryModel->selectPostCount();

        // ERROR HANDLER
        $errors = $this->tagModel->tagErrors();
        if(isset($_POST['add-tag'])){
            $request = $_POST;
            array_pop($request);
            $keys = array_keys($request);

            // FILTER
            $errors = $this->filter()->inputFilter($request, $errors);
            $ctr = $this->filter()->errorCounter($errors, $keys);

            // IF THERE ARE NO ERRORS
            if($ctr == 0){
                $newTag = [
                    'tag_name' => filter_var($_POST['tag_name'], FILTER_SANITIZE_STRING)
                ];

                // CHECK IF TAG ALREADY EXISTS
                if($this->tagModel->getTagId($newTag['tag_name']) == null){
                    // ADD TAG
                    if($this->tagModel->insertTag($newTag['tag_name'])){
                        $_SESSION['successMsg'] = 'New tag successfully added';
                        header('Location: ../admin/tag-list');
                        die();
                    }else{
                        $_SESSION['errorMsg'] = 'Error in adding tag';
                    }
                }else{
                    $_SESSION['errorMsg'] = 'Tag already exists';
                }
                
            }
        }
        $data= [
            'tags' => $tags, 
            'postCount' => $postCount, 
            'errors' => $errors
        ];
        $this->view('admins/tag-list', $data);
    }

    # UPDATE TAG
    public function updateTag($i){
        session_start();
        $tag  = $this->tagModel->getTag($i);
        $errors = $this->tagModel->tagErrors();

        // IF SUBMITTED
        if(isset($_POST['updateTag'])){
            $request = $_POST;
            array_pop($request);
            $keys = array_keys($request);

            $errors = $this->filter()->inputFilter($request, $errors);
            $ctr = $this->filter()->errorCounter($errors, $keys);

            // IF THERE ARE NO ERRORS
            if($ctr == 0){
                $request['tag_id'] = $i;

                if($this->tagModel->updateTag($request)){
                    $_SESSION['successMsg'] = 'Tag successfully updated!';
                    header("Location: ../admin/tag-edit?$i");
                    die();
                }else{
                    $_SESSION['errorMsg'] = 'Tag update failed.';
                    header("Location: ../admin/tag-edit?$i");
                    die();
                }
            }
        }

        $data = [
            'tag' => $tag, 
            'errors' => $errors
        ];
        $this->view('admins/tag-list', $data);
    }

    # DELETE TAG
    public function destroyTag($i){
        session_start();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($this->tagModel->deleteTag($i)){
                $_SESSION['successMsg'] = 'Post deleted';
                header('Location: ../admin/tag-list');
                die();
            }else{
                $_SESSION['errorMsg'] = 'Post not deleted';
                header('Location: ../admin/tag-list');
                die();
            }
        }
    }
}