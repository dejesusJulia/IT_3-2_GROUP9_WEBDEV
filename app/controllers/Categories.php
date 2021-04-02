<?php
class Categories extends Controller{

    public function __construct()
    {   
        $this->categoryModel = $this->model('Category');
        $this->tagModel = $this->model('Tag');
    }

    # GUEST HOME
    public function selectAllByTag($tagName){
        session_start();
        $tags = $this->tagModel->all();
        $categs = $this->categoryModel->joinCategoriesTags();
        $tag = $this->tagModel->getTagId($tagName);
        $posts = $this->categoryModel->selectAllPostByTag((int)$tag->tag_id); 
        $data = [
            'tags' => $tags,
            'posts' => $posts, 
            'categs' => $categs
        ];

        $this->view('post-topics', $data);
    }

    # USER HOME
    public function selectAllByTagUser($tagName){
        session_start();
        if(!isset($_SESSION['user']['user_type'])){
            header('Location: ../home');
            die();
        }else if($_SESSION['user']['user_type'] == 'admin'){
            header("Location: ../admin/home");
            die();
        }

        $tags = $this->tagModel->all();
        $categs = $this->categoryModel->joinCategoriesTags();
        $tag = $this->tagModel->getTagId($tagName);
        $posts = $this->categoryModel->selectAllPostByTag((int)$tag->tag_id); 
        $data = [
            'tags' => $tags,
            'posts' => $posts, 
            'categs' => $categs
        ];

        $this->view('post-topics', $data);
    }

    # USER TIMELINE
    public function selectByTagUser($tagName){
        session_start();
        if(!isset($_SESSION['user']['user_type'])){
            header('Location: ../home');
            die();
        }else if($_SESSION['user']['user_type'] == 'admin'){
            header("Location: ../admin/home");
            die();
        }

        $userId = $_SESSION['user']['user_id'];
        $tags = $this->tagModel->all();
        $categs = $this->categoryModel->joinCategoriesTags();
        $tag = $this->tagModel->getTagId($tagName);
        $posts = $this->categoryModel->selectPostByTag((int)$tag->tag_id, $userId); 
        $data = [
            'tags' => $tags,
            'posts' => $posts, 
            'categs' => $categs
        ];

        $this->view('my-post-topics', $data);
    }

    # ADMIN HOME
    public function selectAllByTagAdmin($tagName){
        session_start();
        if(!isset($_SESSION['user']['user_type'])){
            header('Location: ../home');
            die();
        }else if($_SESSION['user']['user_type'] == 'user'){
            header("Location: ../user/home");
            die();
        }
        
        $tags = $this->tagModel->all();
        $categs = $this->categoryModel->joinCategoriesTags();
        $tag = $this->tagModel->getTagId($tagName);
        $posts = $this->categoryModel->selectAllPostByTag((int)$tag->tag_id); 
        $data = [
            'tags' => $tags,
            'posts' => $posts, 
            'categs' => $categs
        ];

        $this->view('post-topics', $data);
    }

    # ADMIN TIMELINE
    public function selectByTagAdmin($tagName){
        session_start();
        if(!isset($_SESSION['user']['user_type'])){
            header('Location: ../home');
            die();
        }else if($_SESSION['user']['user_type'] == 'user'){
            header("Location: ../user/home");
            die();
        }
        $userId = $_SESSION['user']['user_id'];
        $tags = $this->tagModel->all();
        $categs = $this->categoryModel->joinCategoriesTags();
        $tag = $this->tagModel->getTagId($tagName);
        $posts = $this->categoryModel->selectPostByTag((int)$tag->tag_id, $userId); 
        $data = [
            'tags' => $tags,
            'posts' => $posts, 
            'categs' => $categs
        ];

        $this->view('my-post-topics', $data);
    }
}