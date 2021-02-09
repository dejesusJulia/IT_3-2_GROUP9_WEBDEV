<?php
class Users extends Controller{

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    # PROFILE PAGE
    public function profile($i){
        $data['data'] = $this->userModel->getUser($i);

        $this->view('profile', $data);
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

    # LOGIN POST
    public function login(){
        $errors = $this->userModel->loginErrors();
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $data = $_POST;
            array_pop($data);
            $keys = array_keys($data);

            // FILTER
            $errors = $this->filter()->userFilter($data, $errors);
            $ctr = $this->filter()->errorCounter($errors, $keys);

            // IF THERE ARE NO MORE ERRORS
            if($ctr == 0){
                $email = $this->userModel->getOne($data['user_email']);

                // IF EMAIL DOES NOT EXIST
                if($email ==  null){
                    // return error message
                    $errors['message'] = 'Account does not exist';
                }else{
                    // IF ACCOUNT IS AUTHENTICATED
                    $auth = $this->auth()->verifyCredentials($data['password'], $email->password, $email->user_type);

                    // IF PASSWORD IS VALID
                    if($auth !== 'Invalid password'){
                        session_start();
                        $_SESSION['user'] = [
                            'user_type' => $email->user_type,
                            'user_id' => $email->user_id,
                            'username' => $email->username
                        ];
                        header("Location: $auth");
                        exit();
                    }else{
                        // IF PASSWORD IS INVALID
                        $errors['message'] = 'Invalid Password';
                    }
                }
               
            }
        }
        $this->view('auth/login', $errors);  
    }

    # REGISTER POST
    public function register(){
        // set error handler
        $errors = $this->userModel->userErrors(); 
        
        // IF SUBMITTED
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $data = $_POST;
            array_pop($data);
            $keys = array_keys($data);

            // FILTER
            $errors = $this->filter()->userFilter($data, $errors);
            $ctr = $this->filter()->errorCounter($errors, $keys);
            
            // IF THERE ARE NO ERRORS IN FILTER
            if($ctr == 0){
                $this->userModel->insertOne($data); // INSERT DATA              
                $errors['message'] = '<p>Success! You may now <a href=\"login\">Login</a>';
                    
            }
        }
        $this->view('auth/register', $errors);
        
    }

    # UPDATE PROFILE
    public function updateProfile($i){
        $errors['err'] = $this->userModel->userErrors(); 

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $data = $_POST; 
            array_pop($data);
            $keys = array_keys($data);

            // FILTER
            $errors = $this->filter()->userFilter($data, $errors);
            $ctr = $this->filter()->errorCounter($errors, $keys);
            
            if($ctr == 0){
                $data['user_id'] = $i;
                $this->userModel->updateSelf($data); // INSERT DATA              
                $errors['message'] = '<p>Udpate success!</p>';
                    
            }
        }

        $this->view('profile', $errors);
    }

    # UPDATE USER TYPE POST REQUEST
    public function updateUserTypes($i){
        session_start();
        // var_dump($_POST);
        // $data['post'] = $_POST;
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $request['user_type'] = $_POST['user_type'];
            $request['user_id'] = $i;
            // $this->userModel->updateUserType($request);
            if($this->userModel->updateUserType($request)){
                $data['successMsg'] = '<p>Profile updated!</p>';
            }else{
                $data['errorMsg'] = '<p>Profile not updated!</p>';
            }
            
        }
        $data['userData'] = $this->userModel->getUser($i);
        $data['user'] = 'user';
        $data['admin'] = 'admin';
        $this->view('admins/user-edit', $data);
    }

    public function userDestroy($i){
        session_start();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($this->userModel->deleteUser($i)){
                $_SESSION['successMsg'] = 'User deleted!';
                header('Location: ../admin/user-list');
                die();
            }else{
                $_SESSION['errorMsg'] = 'User not deleted.';
                header('Location: ../admin/user-list');
                die();
            }
        }
    }


}