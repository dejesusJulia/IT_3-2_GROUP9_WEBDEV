<?php

class Controller{

    public function model($model){
        // require model file
        require_once '../app/models/' . $model . '.php';

        // instantiate model
        return new $model();
    }

    public function view($view, $data = []){
        // check for the file to load the view
        if(file_exists('../app/views/' . $view . '.php')){
            require_once '../app/views/' . $view . '.php';
        }else{
            die('View does not exist');
        }
    }

    public function filter(){
        require_once '../app/helpers/Filter.php';
        return new Filter();
    }

    public function auth(){
        require_once '../app/helpers/Auth.php';
        return new Auth();
    }
}