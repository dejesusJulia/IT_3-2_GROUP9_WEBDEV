<?php 
/* CONTROLS ALL VIEWS ON GET REQUEST*/
class Pages extends Controller{
    public function __construct()
    {
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
        $this->commentModel = $this->model('Comment');
    }

    # LANDING PAGE
    public function index(){  
        $this->view('index');
    }

    # LOGIN PAGE
    public function login(){
        $this->view('auth/login');
    }

    # REGISTER PAGE
    public function register(){
        $this->view('auth/register');
    }

    # HOME PAGE
    public function home(){
        session_start();
        $posts = $this->postModel->joinUserPost();
        $data = ['posts' => $posts];
        $this->view('home', $data);
    }

    # DEFAULT USER TIMELINE
    public function userTimeline($i){
        session_start();
        $posts = $this->postModel->getUserPost($i);
        $this->view('users/timeline', $posts);
    }

    # REDIRECT HOME FOR USER
    public function userHome(){
        session_start();

        if(!isset($_SESSION['user']['user_type'])){
            header('Location: ../home');
            die();
        }else if($_SESSION['user']['user_type'] == 'admin'){
            header('Location: ../admin/home');
            die();
        }
        $posts = $this->postModel->joinUserPost();
        $data = ['posts' => $posts];
        $this->view('home', $data);
    }

    # USER PAGES - EDIT POST
    public function editPost($i){
        session_start();
        if(!isset($_SESSION['user']['user_type'])){
            header('Location: ../home');
            die();
        }else if($_SESSION['user']['user_type'] == 'admin'){
            header('Location: ../admin/home');
            die();
        }
        $post = $this->postModel->getPost($i);
        $this->view('users/edit-post', $post);
    }
    
    # REDIRECT HOME FOR ADMIN
    public function adminHome(){
        session_start();

        if(!isset($_SESSION['user']['user_type'])){
            header('Location: ../home');
            die();
        }else if($_SESSION['user']['user_type'] == 'user'){
            header('Location: ../user/home');
            die();
        }
        $posts = $this->postModel->joinUserPost();
        $data = ['posts' => $posts];
        $this->view('home', $data);
    }

    # ADMIN DASHBOARD/HOME
    public function dash(){
        session_start();

        if(!isset($_SESSION['user']['user_type'])){
            header('Location: ../home');
            die();
        }else if($_SESSION['user']['user_type'] == 'user'){
            header('Location: ../user/home');
            die();
        }
        $posts = $this->postModel->all();
        $users = $this->userModel->all();
        $data = [
            'postCount' => count($posts),
            'userCount' => count($users)
        ];
        $this->view('admins/dashboard', $data);
        
    }   

    # ADMIN PAGE - POST LIST
    public function postList(){
        session_start();
        if(!isset($_SESSION['user']['user_type'])){
            header('Location: ../home');
            die();
        }else if($_SESSION['user']['user_type'] == 'user'){
            header('Location: ../user/home');
            die();
        }
        $posts = $this->postModel->joinUserPost();
        $this->view('admins/post-list', $posts);
    }
    
    # ADMIN PAGE - USER LIST
    public function userList(){
        session_start();

        if(!isset($_SESSION['user']['user_type'])){
            header('Location: ../home');
            die();
        }else if($_SESSION['user']['user_type'] == 'user'){
            header('Location: ../user/home');
            die();
        }
        $users = $this->userModel->all();
        $this->view('admins/user-list', $users);
    }  

    # UPDATE USER TYPE GET REQUEST
    public function editUserType($i){
        session_start();
        if(!isset($_SESSION['user']['user_type'])){
            header('Location: home');
            die();
        }else if($_SESSION['user']['user_type'] == 'user'){
            header('Location: ../user/home');
            die();
        }
        $user = $this->userModel->getUser($i);
        $data = [
            'userData' => $user,
            'user' => 'user',
            'admin' => 'admin',
            
        ];
        $this->view('admins/user-edit', $data);
    }

    # USER PAGES - COMMENT PAGE
    public function userComment($i){
        session_start();
        if(!isset($_SESSION['user']['user_type'])){
            header('Location: ../home');
            die();
        }else if($_SESSION['user']['user_type'] == 'admin'){
            header('Location: ../admin/home');
            die();
        }
        $post = $this->postModel->joinUserPostSingle($i, $_SESSION['user']['user_id']);
        $comments = $this->commentModel->joinUserCommentsOfPost($i);
        $data = [
            'post' => $post,
            'comments' => $comments
        ];
        $this->view('comment', $data);
    }

    # ADMIN PAGES - COMMENT PAGE
    public function adminComment($i){
        // add comment
        session_start();
        if(!isset($_SESSION['user']['user_type'])){
            header('Location: home');
            die();
        }else if($_SESSION['user']['user_type'] == 'user'){
            header('Location: ../user/home');
            die();
        }
        $data = [
            'postId' => $i
        ];
        $this->view('comment', $data);
    }
    
    # PROFILE PAGE
    public function profile($i){
        session_start();
        $data['data'] = $this->userModel->getUser($i);
    
        $this->view('profile', $data);
    }

    # LOG OUT
    public function logout(){
        session_start();
        session_destroy();
        $this->view('index');  
    }

}