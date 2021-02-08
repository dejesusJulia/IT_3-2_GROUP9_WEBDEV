<?php 
/* CONTROLS ALL VIEWS WITHOUT POST REQUEST*/
class Pages extends Controller{
    public function __construct()
    {
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
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
        $posts = $this->postModel->joinUserPost();
        $this->view('home', $posts);
    }

    # DEFAULT USER TIMELINE
    public function defaultHome(){
        session_start();
        $this->view('users/timeline');
    }

    # REDIRECT HOME FOR USER
    public function userHome(){
        $this->view('home');
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

    # LOG OUT
    public function logout(){
        session_start();
        session_destroy();
        $this->view('index');  
    }

}