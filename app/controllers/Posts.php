<?php 
/* CONTROLS ALL POSTS TABLE RELATED POST REQUEST*/
class Posts extends Controller{
    public function __construct()
    {
        $this->postModel = $this->model('Post');
    }

    # CREATE POST
    public function addPost(){
        $posts = $this->postModel->joinUserPost();
        $errors = $this->postModel->postErrors();

        // ON SUBMIT
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $img = [];  // ARRAY FOR IMAGE
            $showAuthor = $_POST['show_author'] == 'on' ? true : false;
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
            $errors = $this->filter()->postFilter($toFilter, $errors);
            $ctr = $this->filter()->errorCounter($errors, $keys);
            
            // IF THERE ARE NO ERRORS
            if($ctr == 0){     
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
                    $this->postModel->insertOneWithImg($post);
                }else{
                    // INSERT DATA W/O TO TABLE
                    $this->postModel->insertOne($post);
                }
                header('Location: ../user/home'); 
                die();
            }
        }

        // PASS VARIABLES
        $data = [
            'posts' => $posts,
            'err' => $errors
        ];
        $this->view('home', $data);
    }

    public function updatePost($i){
        $oldPost = $this->postModel->getPost($i);
        $errors = $this->postModel->postErrors();
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $img = [];
            $showAuthor = $_POST['show_author'] == 'on' ? true : false;
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
            $errors = $this->filter()->postFilter($toFilter, $errors);
            $ctr = $this->filter()->errorCounter($errors, $keys);
            echo $i;
            if($ctr == 0){
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
                    $this->postModel->updateWithImage($post);
                }else{
                    // INSERT DATA W/O TO TABLE
                    $this->postModel->updateNoImage($post);
                }
                header('Location: ../user/edit-post?'.$i); 
                die();
            }
        }
        $this->view('users/edit-post', $errors);
    }

    public function postDestroy($i){
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
    

}