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

    # AUTH PAGE
    public function userAuth(){
        $this->view('auth-page');
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
        // $posts holds all the post of one user
        $posts = $this->postModel->getUserPost($i);
        $this->view('users/timeline', $posts);
    }

    # REDIRECT HOME FOR USER
    public function userHome(){
        session_start();
        // TO RESTRICT ACCESS FOR USERS
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
        $comments = $this->commentModel->all();
        $data = [
            'postCount' => count($posts),
            'userCount' => count($users),
            'commentCount' => count($comments),
        ];
        $this->view('admins/dashboard', $data);
        
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
    public function updateUserTypes($i){
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
        session_start();
        if(!isset($_SESSION['user']['user_type'])){
            header('Location: ../home');
            die();
        }else if($_SESSION['user']['user_type'] == 'user'){
            header('Location: ../user/home');
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

    # USER PAGES - EDIT COMMENT PAGE
    public function userCommentEdit($i){
        session_start();
        if(!isset($_SESSION['user']['user_type'])){
            header('Location: ../home');
            die();
        }else if($_SESSION['user']['user_type'] == 'admin'){
            header('Location: ../admin/home');
            die();
        }
        $comment = $this->commentModel->getComment($i);
        $data = [
            'comment' => $comment
        ];
        $this->view('edit-comment', $data);
    }

    # ADMIN PAGES - EDIT COMMENT PAGE
    public function adminCommentEdit($i){
        session_start();
        if(!isset($_SESSION['user']['user_type'])){
            header('Location: ../home');
            die();
        }else if($_SESSION['user']['user_type'] == 'user'){
            header('Location: ../user/home');
            die();
        }
        $comment = $this->commentModel->getComment($i);
        $data = [
            'comment' => $comment
        ];
        $this->view('edit-comment', $data);
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