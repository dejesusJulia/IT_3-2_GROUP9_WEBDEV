<?php

class Auth{

    protected $auth = '';
    public $type;
    public string $hash = '';

    // FOR VERIFYING USER CREDENTIALS
    public function verifyCredentials($credentials){
        $user = '';
        $this->hash = $credentials['password'];
        if(password_verify($credentials['input'], $this->hash)){
           $user = $this->identifyUserType($credentials['user_type'],$credentials['user_id']);
        }else{
            $user = 'Invalid password';
        } 
        return $user;
    }

    // VERIFYING USER TYPE
    public function identifyUserType($userType, $userId){
        $this->type = $userType;
        switch($this->type){
            case 'user': 
                $this->auth = 'user/timeline?' . $userId;
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

    
}