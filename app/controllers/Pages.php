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
        $users = $this->userModel->allUserTypeOf('user');
        $admins = $this->userModel->allUserTypeOf('admin');
        $comments = $this->commentModel->all();
        $nonAnon = $this->postModel->getAnonPosts(1);
        $anon = $this->postModel->getAnonPosts(0);

        $weekOne = date('Y-m-d h:i:s', strtotime('February 01 2021 12:00 am'));
        $weekOnePosts = 0;
        
        $weekTwo = date('Y-m-d h:i:s', strtotime('February 08 2021 12:00 am'));
        $weekTwoPosts = 0;

        $weekThree = date('Y-m-d h:i:s', strtotime('February 22 2021 12:00 am'));
        $weekThreePosts = 0;
        foreach($posts as $post){
            if($post->created_at == $weekOne && $post->created_at < $weekTwo){
                $weekOnePosts++;
            }else if($post->created_at == $weekTwo && $post->created_at < $weekThree){
                $weekTwoPosts++;
            }else{
                $weekThreePosts++;
            }
        }

        $data = [
            'postCount' => count($posts),
            'userCount' => count($users),
            'commentCount' => count($comments),
            'adminCount' => count($admins),
            'nonAnonPost' => $nonAnon->total,
            'anonPost' => $anon->total,
            'weekOne' => $weekOnePosts,
            'weekTwo' => $weekTwoPosts,
            'weekThree' => $weekThreePosts,
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

    # 404 NOT FOUND
    public function notFound(){
        $this->view('page-404');
    }

}