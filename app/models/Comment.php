<?php

class Comment extends Model{

    public $colName;
    public $inputs = [];
    protected $columns = [
        'comment_body'
    ];

    protected $table = 'comments';
}