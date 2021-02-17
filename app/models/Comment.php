<?php

class Comment extends Model{

    public $colName;
    public $inputs = [];
    protected $columns = [
        'user_id', 'post_id', 'comment_body'
    ];

    protected $table = 'comments';

    # SELECT ALL COMMENTS
    public function all(){
        $comments = $this->selectAll($this->table);
        return $comments;
    }

    # SELECT SINGLE COMMENT
    public function getComment($value){
        $this->colName = 'comment_id';
        $comment = $this->selectOne($this->table, $this->colName, $value);
        return $comment;
    }

    # GET COMMENTS OF ONE POST
    public function getPostComments($postId){
        $this->colName = $this->columns[1];
        $comments = $this->selectMany($this->table, $this->colName, $postId);
        return $comments;
    }

    # INSERT ONE COMMENT
    public function insertOne($comment){
        $this->db->query('INSERT INTO '. $this->table . '(user_id, post_id, comment_body) VALUES(:user_id, :post_id, :comment_body)');
        $this->db->bind(':user_id', $comment['user_id']);
        $this->db->bind(':post_id', $comment['post_id']);
        $this->db->bind(':comment_body', $comment['comment_body']);
        $this->db->executes();
    }

    # DELETE POST
    public function deleteComment($comment){
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE comment_id = :comment_id');
        $this->db->bind(':comment_id', $comment);
        $this->db->executes();
    }

    # UPDATE POST
    public function updateComment($comment){
        $this->db->query('UPDATE ' . $this->table . ' SET(comment_body = :comment_body) WHERE comment_id = :comment_id');
        $this->db->bind(':comment_body', $comment['comment_body']);
        $this->db->bind(':comment_id', $comment['comment_id']);
        $this->db->executes();
    }

    # ERROR HANDLER
    public function postErrors(){
        return $this->errorHandler([$this->columns[2]]);
    }
}