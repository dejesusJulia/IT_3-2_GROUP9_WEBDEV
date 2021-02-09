<?php

class Post extends Model{

    // NAME OF PROPERTIES IN DB
    public $colName;
    public $inputs = [];
    protected $columns = [
        'body', 'user_id', 'show_author'
    ];
    protected $nullable = [
        'img'
    ];
    protected $table = 'posts';

    // SELECT ALL POSTS
    public function all(){
        $posts = $this->selectAll($this->table);
        return $posts;
    }
    
    public function getOne($value){
        $this->colName = $this->columns[0];
        $post = $this->selectOne($this->table, $this->colName, $value);
        return $post;
    }

    public function getPost($value){
        $this->colName = 'post_id';
        $post = $this->selectOne($this->table, $this->colName, $value);
        return $post;
    }

    # INSERT SINGLE POST W/O IMG
    public function insertOne($post){
        $this->db->query('INSERT INTO ' . $this->table . '(body, user_id, show_author) VALUES(:body, :user_id, :show_author)');

        $this->db->bind(":body", $post['body']);
        $this->db->bind(":user_id", $post['user_id']);
        $this->db->bind(":show_author", $post['show_author']);
        $this->db->executes();
    }

    # INSERT SINGLE POST W IMG
    public function insertOneWithImg($post){
        $this->db->query('INSERT INTO ' . $this->table . '(body, img, user_id, show_author) VALUES(:body, :img, :user_id, :show_author)');

        $this->db->bind(":body", $post['body']);
        $this->db->bind(":img", $post['img']);
        $this->db->bind(":user_id", $post['user_id']);
        $this->db->bind(":show_author", $post['show_author']);
        $this->db->executes();
    }

    # DELETE POST
    public function deletePost($post){
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE post_id = :post_id');
        $this->db->bind(':post_id', $post);
        $this->db->executes();
    }

    # UPDATE POST
    public function updateSelf($post){
        $this->db->query('UPDATE ' . $this->table . ' SET body=:body, img=:img WHERE post_id =:post_id');

        $this->db->bind(":body", $post['body']);
        $this->db->bind(":img", $post['img']);
        $this->db->bind(":post_id", $post['post_id']);
        $this->db->executes();
    }

    // ERROR HANDLER
    public function postErrors(){
        return $this->errorHandler([$this->columns[0], $this->nullable[0]]);
    }    
}