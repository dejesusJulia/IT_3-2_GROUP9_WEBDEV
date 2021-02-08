<?php

class Filter{

    public array $requestData = [];
    // public array $requestPost = [];
    public array $errorData = [];
    public string $email = '';
    public string $match = '';
    public array $errors = [];
    // public array $postErrors = [];
    public string $err = '';

    // FILTER FOR USERS INPUT
    public function userFilter($request, $errors){
        $this->requestData = $request;
        $this->errors = $errors;

        // IF THERE IS A 'CONFIRM PASSWORD' FIELD
        if(array_key_exists('confirmPassword', $this->requestData)){
            // SET MATCH TO PASSWORD
            $this->match = $this->requestData['password'];
        }

        // LOOP THROUGH FIELDS TO LOOK FOR ERROR
        foreach($this->requestData as $key => $value){
            switch ($key) {
                case 'username':
                    $this->errors[$key]['errors'] = [$this->requiredString($value)];
                    break;

                case 'user_email':
                    $this->errors[$key]['errors'] = [$this->emailField($value)];
                    break;
                
                case 'password':
                    $this->errors[$key]['errors'] = [$this->passwordField($value)];
                    break;

                case 'confirmPassword':
                    $cpErr = '';
                    $cpassErr = $this->passwordField($value);
                    if($cpassErr == ''){
                        $cpErr = $this->matchFields($value);
                    }else{
                        $cpErr = $cpassErr;
                    }
                    $this->errors[$key]['errors'] = [$cpErr];
                    break;

                default:
                    // code
                    break;
            }
        }
        return $this->errors;
    }
    
    // FILTER FOR POST INPUT
    public function postFilter($request, $errors){
        $this->requestData = $request;
        $this->errors = $errors;

        foreach($this->requestData as $key => $value){
            switch ($key) {
                case 'body':
                    $this->errors[$key]['errors'] = [$this->requiredString($value)];
                    break;
                
                case 'img':
                    $this->errors[$key]['errors'] = [$this->imageFilter($value)];
                    break;    
                default:
                    # code...
                    break;
            }
        }

        return $this->errors;
    }


    // VALIDATION FOR REQUIRED FIELDS
    public function requiredString($string){
        $error = '';
        if($string == ''){
            $error = 'This field is required';
        }
        return $error;
    }

    // VALIDATION FOR EMAILS
    public function emailField($email){
        $this->email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $error = $this->requiredString($this->email);
        if($error !== ''){
            $this->err = $error;
        }else if(filter_var($this->email, FILTER_VALIDATE_EMAIL) === false){
            $this->err = 'Please enter a valid email';
        }

        return $this->err;
    }

    // VALIDATION FOR PASSWORD
    public function passwordField($password){
        $error = $this->requiredString($password);
        if($error == ''){
            if(!preg_match('/^(?=.*[A-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[$@_.])(?!.*[|&])\S{8,12}$/', $password)){
                $error = 'This field must be 8 to 12 characters with at least one number, one upper case letter,  and one special symbol ($, @, _, or .) except | and &';
            }
        }
        return $error;
    }

    // VALIDATION FOR MATCHING FIELDS
    public function matchFields($match2){
        $error = '';
        if($this->match !== $match2){
            $error = 'This field does not match with the field above';
        }

        return $error;
    }

    // VALIDATION FOR IMAGES
    public function imageFilter($img){
        $error = '';
        $extensions = ['.jpeg', '.jpg', '.png'];
        if(!in_array($img, $extensions)){
            $error = 'This file format is not valid';
        }
        return $error;
    }

    // ERROR COUNTER
    public function errorCounter($errors, $keys){
        $ctr = 0;   // error counter
        for($i=0; $i < count($keys); $i++){
            foreach($errors[$keys[$i]] as $key => $value){
                // IF ERROR ARRAY IS NOT EMPTY
                if($value[0] !== ''){
                    $ctr++; // COUNT ERROR
                }
            }
        }
        return $ctr;
    }


}