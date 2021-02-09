<?php 

class Posts extends Controller{
    public function __construct()
    {
        $this->postModel = $this->model('Post');
    }

    public function addPost(){
        echo '<pre>';
        var_dump($_POST); 
        echo '</pre>';  
        
        echo '<pre>';
        var_dump($_FILES); 
        echo '</pre>'; 
    }

    public function updatePost(){
        // code
    }
    

}