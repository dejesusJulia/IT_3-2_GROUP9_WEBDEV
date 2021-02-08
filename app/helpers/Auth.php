<?php

class Auth{

    protected $auth = '';
    public $id;
    public string $hash = '';

    // FOR VERIFYING USER CREDENTIALS
    public function verifyCredentials($input, $password, $type){
        $user = '';
        $this->hash = $password;
        if(password_verify($input, $this->hash)){
           $user = $this->identifyUserType($type);
        }else{
            $user = 'Invalid password';
        } 
        return $user;
    }

    // VERIFYING USER TYPE
    public function identifyUserType($userType){
        $this->id = $userType;
        switch($this->id){
            case 'user': 
                $this->auth = 'user/timeline';
                break;
            case 'admin': 
                $this->auth = 'admin/dashboard';
                break;
            default: 
                $this->auth = null;
                break;
        }

        return $this->auth;
    }

    // restrict pages with variables
    public function restrictGet($param){
        $page = '';
        if($param == ''){
            $page = 'home';
        }
        return $page;
    }

    
}