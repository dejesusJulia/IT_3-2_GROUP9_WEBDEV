<?php 
/* CONTROLS ALL POSTS TABLE RELATED POST REQUEST*/
class Posts extends Controller{
    public function __construct()
    {
        $this->postModel = $this->model('Post');
        $this->likeModel = $this->model('Like');
        $this->categoryModel = $this->model('Category');
        $this->tagModel = $this->model('Tag');
    }

    # CREATE POST
    public function addPost(){
        session_start();
        $posts = $this->postModel->joinUserPost();
        $likes = $this->likeModel->countPostLikes();
        $categs = $this->categoryModel->joinCategoriesTags();
        $tags = $this->tagModel->all();

        // ERROR HANDLER
        $errors = $this->postModel->postErrors();
        $cbErr = '';

        // ON SUBMIT
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // ARRAY FOR IMAGE 
            $img = [];
            // ARRAY FOR CATEGORIES
            $categ = []; $categCtr = 0;

            if(!isset($_POST['tagName'])){
                $cbErr = 'Please check one of the boxes';
            }else{
                $categ = $_POST['tagName'];
                $categCtr = count($categ);
            }
            $showAuthor = false;
            if(isset($_POST['show_author'])){
                $showAuthor = $_POST['show_author'] == 'on' ? true : false;
            }
            // INPUT TO FILTER
            $toFilter = [
                'body' => $_POST['body']
            ];
            if($_FILES['img']['name'] !== ''){
                // FILTER FILE TYPE, SIZE, AND UPLOAD ERROR
                $img['typeSizeError'] = $_FILES['img']['type'] . ':' . strval($_FILES['img']['size']) . ':' .strval($_FILES['img']['error']);
                // SAVE TEMP NAME
                $img['tmp'] = $_FILES['img']['tmp_name'];
                // GET EXTENSION
                $getExt = explode('.', $_FILES['img']['name']);
                $img['ext'] = end($getExt);
                // ADD TO FILTER
                $toFilter['img'] = $img['typeSizeError'];
            }
            $keys = array_keys($toFilter);

            // CALL FILTER FUNCTION
            $errors = $this->filter()->inputFilter($toFilter, $errors);
            $ctr = $this->filter()->errorCounter($errors, $keys);
            
            // IF THERE ARE NO ERRORS, PROCEED TO DB
            if($ctr == 0 && $cbErr == ''){     
                $post = [
                    'body' => filter_var($_POST['body'], FILTER_SANITIZE_STRING),
                    'user_id' => $_POST['user_id'],
                    'show_author' => $showAuthor
                ];

                if($_FILES['img']['name'] !== ''){
                    $imgLoc = $this->filter()->imageUpload($img['tmp'], $img['ext']);
                    // ADD TO POST 
                    $post['img'] = $imgLoc;
                    // INSERT DATA W/ IMAGE TO TABLE 
                    if($this->postModel->insertOneWithImg($post)){
                        $postID = $this->postModel->getPostId($post['body']);
                        for($i = 0; $i < $categCtr; $i++){ 
                            $this->categoryModel->insertCategory([$postID->post_id, $categ[$i]]);
                        }
                    }

                }else{
                    // INSERT DATA W/O TO TABLE
                    if($this->postModel->insertOne($post)){
                        $postID = $this->postModel->getPostId($post['body']);
                        for($i = 0; $i < $categCtr; $i++){ 
                            $this->categoryModel->insertCategory([$postID->post_id, $categ[$i]]);
                        }
                    }                   
                }
            
                header('Location: ../user/home'); 
                die();
            }
        }

        // PASS VARIABLES
        $data = [
            'err' => $errors,
            'cbErr' => $cbErr, 
            'posts' => $posts, 
            'likes' => $likes, 
            'categs' => $categs, 
            'tags' => $tags
        ];
        $this->view('home', $data);
    }

    # UPDATE POST
    public function updatePost($i){
        session_start();
        $oldPost = $this->postModel->getPost($i);
        $tags = $this->tagModel->all();
        $categories = $this->categoryModel->joinTagsOfPost($i);
        
        $categArr = [];

        foreach($categories as $c){
            $categArr[] = [
                'category_id' => (int)$c->category_id, 
                'tag_id' => (int)$c->tag_id
            ];
           
        }

        // ERROR HANDLERS
        $errors = $this->postModel->postErrors();
        $cbErr = '';

        // ON CLICK
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $img = [];
            $showAuthor = false;
            $updatedCateg = [];
            // CHECK FOR POST TAG
            if(!isset($_POST['tagName'])){
                $cbErr = 'Please check one of the boxes';

            }else{
                $newCategs = $_POST['tagName'];
                $updatedCateg = array_map('intval', $newCategs);
            }

            if(isset($_POST['show_author'])){
                $showAuthor = $_POST['show_author'] == 'on' ? true : false;
            }
            $toFilter = [
                'body' => $_POST['body']
            ];

            if($_FILES['img']['name'] !== ''){
                // FILTER FILE TYPE, SIZE, AND UPLOAD ERROR
                $img['typeSizeError'] = $_FILES['img']['type'] . ':' . strval($_FILES['img']['size']) . ':' .strval($_FILES['img']['error']);
                // SAVE TEMP NAME
                $img['tmp'] = $_FILES['img']['tmp_name'];
                // GET EXTENSION
                $getExt = explode('.', $_FILES['img']['name']);
                $img['ext'] = end($getExt);
                // ADD TO FILTER
                $toFilter['img'] = $img['typeSizeError'];
            }
            $keys = array_keys($toFilter);

            // CALL FILTER FUNCTION
            $errors = $this->filter()->inputFilter($toFilter, $errors);
            $ctr = $this->filter()->errorCounter($errors, $keys);

            // IF THERE ARE NO ERRORS
            if($ctr == 0 && $cbErr == ''){
                $post = [
                    'body' => filter_var($_POST['body'], FILTER_SANITIZE_STRING),
                    'show_author' => $showAuthor,
                    'post_id' => $i
                ];

                
                if($_FILES['img']['name'] !== ''){
                    $imgLoc = $this->filter()->imageReplace([$img['tmp'], $img['ext']], $oldPost->img);
                    // ADD TO POST 
                    $post['img'] = $imgLoc;

                    // INSERT DATA W/ IMAGE TO TABLE 
                    if($this->postModel->updateWithImage($post)){
                        $this->categoryModel->compareTags($categArr, $updatedCateg, $post['post_id']);

                        $_SESSION['successMsg'] = 'Post updated!';

                    }else{
                        $_SESSION['errorMsg'] = 'Post update failed';

                    }
                       
                }else{
                    // INSERT DATA W/O IMAGE TO TABLE
                    if($this->postModel->updateNoImage($post)){
                        $this->categoryModel->compareTags($categArr, $updatedCateg, $post['post_id']);
                        $_SESSION['successMsg'] = 'Post updated!';
                    }else{
                        $_SESSION['errorMsg'] = 'Post update failed';
                    }
                
                }

                header('Location: ../user/edit-post?'.$i); 
                die();
            }
        }

        $data = [
            'err' => $errors,
            'post' => $oldPost,
            'tags' => $tags, 

        ];
        $this->view('users/edit-post', $data);
    }

    public function destroyPost($i){
        session_start();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($this->postModel->deletePost($i)){
                $_SESSION['successMsg'] = 'Post deleted';
                header('Location: ../user/timeline?'.$_SESSION['user']['user_id']);
                die();
            }else{
                $_SESSION['errorMsg'] = 'User not deleted';
                header('Location: ../user/timeline?');
                die();
            }
        }
    }

    # ADMIN UPDATE POST
    public function adminUpdatePost($i){
        session_start();
        $oldPost = $this->postModel->getPost($i);
        $tags = $this->tagModel->all();
        $categories = $this->categoryModel->joinTagsOfPost($i);
        
        $categArr = [];

        foreach($categories as $c){
            $categArr[] = [
                'category_id' => (int)$c->category_id, 
                'tag_id' => (int)$c->tag_id
            ];
           
        }

        // ERROR HANDLERS
        $errors = $this->postModel->postErrors();
        $cbErr = '';
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $img = [];
            $showAuthor = false;
            $updatedCateg = [];
            // CHECK FOR POST TAG
            if(!isset($_POST['tagName'])){
                $cbErr = 'Please check one of the boxes';

            }else{
                $newCategs = $_POST['tagName'];
                $updatedCateg = array_map('intval', $newCategs);
            }

            if(isset($_POST['show_author'])){
                $showAuthor = $_POST['show_author'] == 'on' ? true : false;
            }
            $toFilter = [
                'body' => $_POST['body']
            ];

            if($_FILES['img']['name'] !== ''){
                // FILTER FILE TYPE, SIZE, AND UPLOAD ERROR
                $img['typeSizeError'] = $_FILES['img']['type'] . ':' . strval($_FILES['img']['size']) . ':' .strval($_FILES['img']['error']);
                // SAVE TEMP NAME
                $img['tmp'] = $_FILES['img']['tmp_name'];
                // GET EXTENSION
                $getExt = explode('.', $_FILES['img']['name']);
                $img['ext'] = end($getExt);
                // ADD TO FILTER
                $toFilter['img'] = $img['typeSizeError'];
            }
            $keys = array_keys($toFilter);

            // CALL FILTER FUNCTION
            $errors = $this->filter()->inputFilter($toFilter, $errors);
            $ctr = $this->filter()->errorCounter($errors, $keys);

            if($ctr == 0 && $cbErr == ''){
                $post = [
                    'body' => filter_var($_POST['body'], FILTER_SANITIZE_STRING),
                    'show_author' => $showAuthor,
                    'post_id' => $i
                ];

                if($_FILES['img']['name'] !== ''){
                    $imgLoc = $this->filter()->imageReplace([$img['tmp'], $img['ext']], $oldPost->img);
                    // ADD TO POST 
                    $post['img'] = $imgLoc;

                    // INSERT DATA W/ IMAGE TO TABLE 
                    if($this->postModel->updateWithImage($post)){
                        $this->categoryModel->compareTags($categArr, $updatedCateg, $post['post_id']);
                        $_SESSION['successMsg'] = 'Post updated!';

                    }else{
                        $_SESSION['errorMsg'] = 'Post update failed';
                    }
                       
                }else{
                    // INSERT DATA W/O TO TABLE
                    if($this->postModel->updateNoImage($post)){
                        $this->categoryModel->compareTags($categArr, $updatedCateg, $post['post_id']);
                        $_SESSION['successMsg'] = 'Post updated!';

                    }else{
                        $_SESSION['errorMsg'] = 'Post update failed';
                    }
                
                }


                header('Location: ../admin/edit-post?'.$i); 
                die();
            }
        }

        $data = [
            'err' => $errors,
            'post' => $oldPost,
            'tags' => $tags, 

        ];
        $this->view('admins/edit-post', $data);
    }

    # ADMIN DELETE POST
    public function adminDestroyPost($i){
        session_start();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($this->postModel->deletePost($i)){
                $_SESSION['successMsg'] = 'Post deleted';
                header('Location: ../admin/timeline?'.$_SESSION['user']['user_id']);
                die();
            }else{
                $_SESSION['errorMsg'] = 'Post not deleted';
                header('Location: ../admin/timeline?');
                die();
            }
        }
    }
    

}