<?php

class Comments extends Controller{

    public function __construct()
    {
        $this->commentModel = $this->model('comment');
    }
}