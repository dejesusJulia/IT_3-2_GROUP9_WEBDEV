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

    # SELECT ALL POSTS
    public function all(){
        $posts = $this->selectAll($this->table);
        return $posts;
    }

    # SELECT POST BY POST_ID
    public function getPost($postId){
        $this->colName = 'post_id';
        $post = $this->selectOne($this->table, $this->colName, $postId);
        return $post;
    }

    # SELECT POST BY USER_ID
    public function getUserPost($userId){
        $this->colName = $this->columns[1];
        $posts = $this->selectMany($this->table, $this->colName, $userId);
        return $posts;
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
        $msg = false;
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE post_id = :post_id');
        $this->db->bind(':post_id', $post);
        if($this->db->executes()){
            $msg = true;
        }
        return $msg;
    }

    # UPDATE POST IWTH IMAGE
    public function updateWithImage($post){
        $this->db->query('UPDATE ' . $this->table . ' SET body=:body, img=:img, show_author=:show_author WHERE post_id =:post_id');

        $this->db->bind(":body", $post['body']);
        $this->db->bind(":img", $post['img']);
        $this->db->bind(":show_author", $post['show_author']);
        $this->db->bind(":post_id", $post['post_id']);
        $this->db->executes();
    }

    # UPDATE POST WITHOUT IMAGE
    public function updateNoImage($post){
        $this->db->query('UPDATE ' . $this->table . ' SET body=:body, show_author=:show_author WHERE post_id =:post_id');

        $this->db->bind(":body", $post['body']);
        $this->db->bind(":show_author", $post['show_author']);
        $this->db->bind(":post_id", $post['post_id']);
        $this->db->executes();
    }

    // ERROR HANDLER
    public function postErrors(){
        return $this->errorHandler([$this->columns[0], $this->nullable[0]]);
    }    
}