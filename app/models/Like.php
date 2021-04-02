<?php 

class Like extends Model{

    // NAME OF PROPERTIES
    public $colName;
    protected $columns = [
        'post_id', 'user_id'
    ];

    protected $table = 'likes';

    # SELECT LIKE OF A SPECIFIC POST
    // public function joinPostLikes(){
    //     $this->db->query("SELECT 
    //     p.post_id, 
    //     p.body, 
    //     p.img,
    //     p.show_author,
    //     p.created

    //     ");
    // }

    # COUNT LIKES
    public function countPostLikes(){
        $this->db->query('SELECT COUNT(like_id) AS postLikeCount, post_id FROM ' . $this->table . ' GROUP BY post_id');
        $postLikes = $this->db->resultSet();

        return $postLikes;
    }
    
}