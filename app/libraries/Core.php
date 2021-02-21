<?php

class Core{

    protected $routes = [];
    public $params = [];
    protected $callback;
    protected $controller;

    // GET CURRENT URL
    public function getURL(){
        return $_GET['url'] ?? '';
    }

    // GET CURRENT REQUEST METHOD
    public function requestMethod(){
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    // GET METHOD
    public function get($path, $callback){
        $this->routes['get']['path'] = $path;
        $this->routes['get'][$path] = $callback;
        return $this->routes;

    }

    // POST
    public function post($path, $callback){
        $this->routes['post']['path'] = $path;
        $this->routes['post'][$path] = $callback;
        return $this->routes;
    }

    // PARAMTER BREAKDOWN
    public function paramBreakdown(){
        $url = $_SERVER['REQUEST_URI'];
        $get = '';
        if(strpos($url, '?') !== false){
            $get = substr($url, strpos($url, '?')+1);
        }
        return $get;
    }

    // EXECUTE GET/POST 
    public function run(){
        $url = $this->getURL();
        $request = $this->requestMethod();
        $this->params[0] = $this->paramBreakdown();
        $controller = '';

        if($url == ''){
            $this->controller = ['Pages', 'index'];

        }else if($request == 'get' && isset($this->routes['get'][$url])){
            // IF GET REQUEST IS CALLED         
            $this->callback = $this->routes['get'][$url];
            $this->controller = explode('@', $this->callback);

        }else if($request == 'post' && isset($this->routes['post'][$url])){
            // IF POST REQUEST IS CALLED
            $this->callback = $this->routes['post'][$url];
            $this->controller = explode('@', $this->callback);

        }

        // require controller
        if(file_exists('../app/controllers/' . $this->controller[0] . '.php')){
            require_once '../app/controllers/' . $this->controller[0] . '.php';
            $controller = new $this->controller[0];
            $function = $this->controller[1];
            
        }else{
            $defaultController = 'Pages';
            require_once '../app/controllers/' . $defaultController . '.php';
            $controller = new $defaultController;
            $function = 'notFound';
        }
        
        call_user_func_array(array($controller, $function), $this->params);
    }

}