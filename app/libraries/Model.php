<?php
require_once 'Database.php';
class Model{

    protected $db;
    public $filter;
    protected $tbl;
    protected $columnName;
    public array $inputHandler = [];
    protected array $tables = [
        'users', 'posts', 'comments'
    ];

    public function __construct()
    {
        $this->db = new Database();
    }
   
    # READ
    protected function selectAll($table){
        $this->tbl = $table;
        $this->db->query("SELECT * FROM $this->tbl");
        $result = $this->db->resultSet();

        return $result;
    }

    protected function selectOne($table, $columnName, $value){
        $this->tbl = $table;
        $this->columnName = $columnName;
        $this->db->query("SELECT * FROM $this->tbl WHERE " .$this->columnName . ' = :' . $this->columnName);
        $this->db->bind(":$this->columnName", $value);
        $result = $this->db->resultSingle();

        return $result;
    }

    protected function selectMany($table, $columnName, $value){
        $this->tbl = $table;
        $this->columnName = $columnName;
        $this->db->query("SELECT * FROM $this->tbl WHERE $this->columnName " . "=:$this->columnName");
        $this->db->bind(":$this->columnName", $value);
        $results = $this->db->resultSet();

        return $results;
    }

    # JOIN USERS AND POSTS TABLE
    public function joinUserPost(){
        $this->db->query("SELECT posts.body, posts.img, posts.show_author, posts.created_at, users.username FROM posts, users WHERE posts.user_id = users.user_id ORDER BY created_at DESC");
        $result = $this->db->resultSet();

        return $result;
    }
    
    // SET UP ERROR HANDLER
    public function errorHandler($columns){
        $this->inputHandler = array_fill_keys($columns, [
            'errors' => []
        ]);
        return $this->inputHandler;
    }





    

}