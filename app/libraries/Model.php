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
        $this->db->query("SELECT * FROM $this->tbl WHERE $this->columnName " . "=:$this->columnName ORDER BY created_at DESC");
        $this->db->bind(":$this->columnName", $value);
        $results = $this->db->resultSet();

        return $results;
    }

    # JOIN USERS AND POSTS TABLE (MULTIPLE ROWS)
    public function joinUserPost(){
        $this->db->query("SELECT 
        p.post_id, 
        p.body, 
        p.img, 
        p.show_author, 
        p.created_at, 
        u.username, 
        u.avatar 
        FROM posts p INNER JOIN users u
        ON p.user_id = u.user_id 
        ORDER BY created_at DESC");
        $result = $this->db->resultSet();

        return $result;
    }

    # JOIN USERS AND POSTS TABLE (SINGLE ROW)
    // public function joinUserPostSingle($postId){
    //     $this->db->query("SELECT 
    //     p.post_id, 
    //     p.body, 
    //     p.img, 
    //     p.show_author, 
    //     p.created_at, 
    //     u.username, 
    //     u.avatar 
    //     FROM posts p INNER JOIN users u
    //     ON p.user_id = u.user_id
    //     INNER JOIN(
    //         SELECT username
    //         FROM users
    //         WHERE user_id
    //     )
    //     ");
    //     $result = $this->db->resultSingle();
    //     return $result;
    // }
    
    # SET UP ERROR HANDLER
    public function errorHandler($columns){
        $this->inputHandler = array_fill_keys($columns, [
            'errors' => []
        ]);
        return $this->inputHandler;
    }





    

}