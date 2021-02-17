<?php

class Filter{

    public array $requestData = [];
    public array $errorData = [];
    public string $email = '';
    public string $match = '';
    public array $errors = [];
    public string $err = '';

    # FILTER FOR USER DATA INPUT
    public function inputFilter($request, $errors){
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

                case 'avatar': 
                    $avatar = '';
                    $this->errors[$key]['errors'] = [$avatar];
                    break; 

                case 'body': 
                    $this->errors[$key]['errors'] = [$this->requiredString($value)];
                    break;

                case 'img': 
                    $this->errors[$key]['errors'] = [$this->imageFilter($value)];
                    break; 

                case 'comment_body': 
                    $this->errors[$key]['errors'] = [$this->requiredString($value)];
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
        $maxsize = 2097152;
        // allowed extensions
        $extensions = ['image/jpeg', 'image/jpg', 'image/png'];

        if($img !== ''){
            // dissect image filename
            $imgArr = explode(':', $img);
            if(!in_array($imgArr[0], $extensions)){
                $error = 'This file format is not valid';
            
            }else if(intval($imgArr[1]) > $maxsize){
                $error = 'File is too big';
            }else if(intval($imgArr[2]) > 0){
                $error = 'File upload error';
            }
        }
        
        return $error;
    }

    // UPLOAD IMAGE
    public function imageUpload($tempName, $extension){
        $newName = uniqid('', true) . "." . $extension;
        $newDestination = "../public/img/posts/" . $newName;
        move_uploaded_file($tempName, $newDestination);

        return $newDestination;
    }

    // REPLACE IMAGE
    public function imageReplace($newImg, $oldImg){
        $msg = '';
        if($oldImg !== null){
            $oldImg = str_replace('../public/', '', $oldImg);
            if(!unlink($oldImg)){
                $msg = 'error in deleting old image';
            }else{
                $msg = $this->imageUpload($newImg[0], $newImg[1]);
            }
        }else{
            $msg = $this->imageUpload($newImg[0], $newImg[1]);
        }
        return $msg;
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