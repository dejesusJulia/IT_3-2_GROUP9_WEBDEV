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

    # SELECT POSTS BY USER_ID
    public function getUserPost($userId){
        $this->colName = $this->columns[1];
        $posts = $this->selectMany($this->table, $this->colName, $userId);
        return $posts;
    }

    # SELECT POST ID BY BODY
    public function getPostId($postBody){
        $this->db->query('SELECT post_id FROM ' . $this->table . ' WHERE body = :body');
        $this->db->bind(':body', $postBody);
        $result = $this->db->resultSingle();
        return $result;
    }

    # SELECT POSTS BY ANONIMITY
    public function getAnonPosts($anon){
        $this->db->query('SELECT COUNT(*) AS total FROM ' . $this->table . ' WHERE show_author = :show_author');
        $this->db->bind(':show_author', $anon);
        $result = $this->db->resultSingle();
        return $result;
    }

    # SELECT ALL POSTS OF THE CURRENT MONTH
    public function getMonthlyPosts(){
        $year = date('Y');
        $month = date('m');
        $this->db->query('SELECT created_at FROM ' . $this->table . ' WHERE year(created_at) = :yearN');
        $this->db->bind(':yearN', $year);
        $results = $this->db->resultSet();
        return $results;
    }

    # INSERT SINGLE POST W/O IMG
    public function insertOne($post){
        $flag = false;
        $this->db->query('INSERT INTO ' . $this->table . '(body, user_id, show_author) VALUES(:body, :user_id, :show_author)');
        $this->db->bind(":body", $post['body']);
        $this->db->bind(":user_id", $post['user_id']);
        $this->db->bind(":show_author", $post['show_author']);
        if($this->db->executes()){
            $flag = true;
        }
        return $flag;
    }

    # INSERT SINGLE POST W IMG
    public function insertOneWithImg($post){
        $flag = false;
        $this->db->query('INSERT INTO ' . $this->table . '(body, img, user_id, show_author) VALUES(:body, :img, :user_id, :show_author)');
        $this->db->bind(":body", $post['body']);
        $this->db->bind(":img", $post['img']);
        $this->db->bind(":user_id", $post['user_id']);
        $this->db->bind(":show_author", $post['show_author']);
        if($this->db->executes()){
            $flag = true;
        }
        return $flag;
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

    # UPDATE POST WITH IMAGE
    public function updateWithImage($post){
        $msg = false;
        $this->db->query('UPDATE ' . $this->table . ' SET body=:body, img=:img, show_author=:show_author WHERE post_id =:post_id');

        $this->db->bind(":body", $post['body']);
        $this->db->bind(":img", $post['img']);
        $this->db->bind(":show_author", $post['show_author']);
        $this->db->bind(":post_id", $post['post_id']);
        if($this->db->executes()){
            $msg = true;
        }
        return $msg;
    }

    # UPDATE POST WITHOUT IMAGE
    public function updateNoImage($post){
        $msg = false;
        $this->db->query('UPDATE ' . $this->table . ' SET body=:body, show_author=:show_author WHERE post_id =:post_id');

        $this->db->bind(":body", $post['body']);
        $this->db->bind(":show_author", $post['show_author']);
        $this->db->bind(":post_id", $post['post_id']);
        if($this->db->executes()){
            $msg = true;
        }
        return $msg;
    }

    // ERROR HANDLER
    public function postErrors(){
        return $this->errorHandler([$this->columns[0], $this->nullable[0]]);
    }    
}