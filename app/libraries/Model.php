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
    public function joinUserPostSingle($postId){
        $this->db->query('SELECT 
        p.post_id, 
        p.body, 
        p.img, 
        p.show_author, 
        p.created_at, 
        u.username, 
        u.avatar 
         FROM posts p INNER JOIN users u USING (user_id) WHERE post_id =:post_id');
        $this->db->bind(':post_id', $postId);
        $result = $this->db->resultSingle();
        return $result;
    }

    # JOIN USERS AND COMMENTS TABLE OF A CERTAIN POST
    public function joinUserCommentsOfPost($postId){
        $this->db->query('SELECT
        c.comment_id,
        c.comment_body,
        c.show_author, 
        c.created_at, 
        u.user_id,
        u.username, 
        u.avatar
         FROM comments c 
         INNER JOIN users u USING (user_id) 
         WHERE post_id =:post_id 
         ORDER BY c.created_at DESC');
        $this->db->bind(':post_id', $postId);
        $results = $this->db->resultSet();
        return $results;
    }

    # COUNT POSTS OF A TAG THRU CATEGORIES
    // public function joinTagsCategories(){
    //     $this->db->query('SELECT 
    //     t.tag_id, 
    //     t.tag_name, 
    //     COUNT(c.post_id) AS postCount 
    //     FROM tags t INNER JOIN categories c 
    //     GROUP BY t.tag_id');

    //     $results = $this->db->resultSet();
    //     return $results;
    // }

    # LIKES OF A POST
    public function joinPostLikes(){
        $this->db->query('SELECT 
        p.post_id, 
        p.body, 
        p.img, 
        p.show_author, 
        p.created_at, 
        l.like_id
         FROM posts p INNER JOIN likes l  
         ON p.post_id = l.post_id 
         ORDER BY p.created_at DESC
        ');
        $result = $this->db->resultSet();

        return $result;
    }
    
    # SET UP ERROR HANDLER
    public function errorHandler($columns){
        $this->inputHandler = array_fill_keys($columns, [
            'errors' => []
        ]);
        return $this->inputHandler;
    }





    

}