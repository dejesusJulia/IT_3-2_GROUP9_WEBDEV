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

        if($url == ''){
            $this->controller = ['Pages', 'index'];

        }else if($request == 'get'){
            // IF GET REQUEST IS CALLED         
            $this->callback = $this->routes['get'][$url];
            $this->controller = explode('@', $this->callback);

        }else if($request == 'post'){
            // IF POST REQUEST IS CALLED
            $this->callback = $this->routes['post'][$url];
            $this->controller = explode('@', $this->callback);
        }

        // require controller
        require_once '../app/controllers/' . $this->controller[0] . '.php';
        $controller = new $this->controller[0];
        $function = $this->controller[1];

        // if($get !== ''){
        //     $this->params[0] = $get;
        // }
        call_user_func_array(array($controller, $function), $this->params);
    }

}