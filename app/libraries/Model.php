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
   
    // READ
    protected function selectAll($table){
        $this->tbl = $table;
        $this->db->query("SELECT * FROM $this->tbl");
        $result = $this->db->resultSet();

        return $result;
    }

    protected function selectOne($table, $columnName, $value){
        $this->tbl = $table;
        $this->columnName = $columnName;
        $this->db->query("SELECT * FROM $this->table WHERE " .$this->columnName . ' = :' . $this->columnName);
        $this->db->bind(":$this->columnName", $value);
        $result = $this->db->resultSingle();

        return $result;
    }

    public function joinUserPost(){
        $this->db->query("SELECT posts.body, posts.img, posts.show_author, posts.created_at, users.username FROM posts, users WHERE posts.user_id = users.user_id");
        $result = $this->db->resultSet();

        return $result;
    }

    // DELETE ONE
    protected function destroy($item, $table){
        $this->tbl = $table;
        $this->db->query('DELETE FROM ' . $this->tbl . ' WHERE id = :id');
        $this->db->bind(':id', $item);
        $this->db->executes();
    }
    
    // SET UP ERROR HANDLER
    public function errorHandler($columns){
        $this->inputHandler = array_fill_keys($columns, [
            'errors' => []
        ]);
        return $this->inputHandler;
    }





    

}