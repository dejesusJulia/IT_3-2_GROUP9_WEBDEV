<?php 

class Category extends Model{

    // NAME OF PROPERTIES
    public $colName;
    protected $columns = [
        'post_id', 'tag_id'
    ];   
    protected $table = 'categories';

    # SELECT ALL POSTS BY TAG
    public function selectAllPostByTag($categ){
        $this->db->query('SELECT 
        ca.category_id, 
        ca.tag_id, 
        p.post_id, 
        p.body, 
        p.img, 
        p.show_author, 
        p.created_at, 
        p.user_id, 
        u.username 
        FROM categories ca 
        INNER JOIN posts p USING (post_id) 
        INNER JOIN users u USING (user_id) 
        WHERE ca.tag_id = :tag_id 
        ORDER BY p.created_at DESC
        ');

        $this->db->bind(':tag_id', $categ);
        $results = $this->db->resultSet();
        return $results;
    }

    # SELECT USER POSTS BY TAG
    public function selectPostByTag($categ, $userId){
        $this->db->query('SELECT 
        ca.category_id, 
        ca.tag_id, 
        p.post_id, 
        p.body, 
        p.img, 
        p.show_author, 
        p.created_at, 
        p.user_id, 
        u.username 
        FROM categories ca 
        INNER JOIN posts p USING (post_id) 
        INNER JOIN users u USING (user_id) 
        WHERE ca.tag_id = :tag_id AND p.user_id = :user_id 
        ORDER BY p.created_at DESC
        ');

        $this->db->bind(':tag_id', $categ);
        $this->db->bind(':user_id', $userId);
        $results = $this->db->resultSet();
        return $results;

    }

    # SELECT TAG IDS AND POST COUNT OF EACH
    public function selectPostCount(){
        $this->db->query('SELECT tag_id, COUNT(post_id) AS postCount FROM ' . $this->table . ' GROUP BY tag_id');
        $results = $this->db->resultSet();
        return $results;
    }
    
    # SELECT BY CATEGORY ID BY POST AND TAG
    public function selectCategoryId($postId, $tagId){
        $this->db->query('SELECT category_id FROM ' . $this->table . ' WHERE post_id = :post_id AND tag_id = :tag_id');
        $this->db->bind(':post_id', $postId);
        $this->db->bind(':tag_id', $tagId);
        $result = $this->db->resultSingle();
        return $result;
    }

    # JOIN CATEGORIES AND TAGS TABLE
    public function joinCategoriesTags(){
        $this->db->query('SELECT 
        c.category_id, 
        c.post_id, 
        c.tag_id, 
        t.tag_name 
        FROM categories c INNER JOIN tags t
        ON c.tag_id = t.tag_id
        ');
        $results = $this->db->resultSet();
        return $results;
    }

    # TAGS OF A CERTAIN POST
    public function joinTagsOfPost($postId){
        $this->db->query("SELECT 
        ca.category_id, 
        ca.post_id, 
        ca.tag_id, 
        t.tag_name 
         FROM categories ca 
         INNER JOIN tags t USING (tag_id) 
         WHERE post_id =:post_id");
        $this->db->bind(':post_id', $postId);
        $results = $this->db->resultSet();
        return $results;
    }

    # SELECT TAGS OF A CERTAIN POST (TAG ID ONLY)
    public function tagIdOfPost($postId){
        $this->db->query('SELECT tag_id FROM ' . $this->table . ' WHERE post_id =:post_id');
        $this->db->bind(':post_id', $postId);
        $results = $this->db->resultSet();
        return $results;
    }

    # INSERT POST CATEGORY
    public function insertCategory($category){
        $this->db->query('INSERT INTO ' . $this->table . '(post_id, tag_id) VALUES(:post_id, :tag_id)');
        $this->db->bind(':post_id', $category[0]);
        $this->db->bind(':tag_id', $category[1]);
        $this->db->executes();

    }

    # DELETE POST CATEGORY BY CATEGORY ID
    public function deleteCategory($categId){
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE category_id =:category_id');
        $this->db->bind(':category_id', $categId);
        $this->db->executes();
    }

    # COMPARE TAGS
    public function compareTags($prevArray, $currArray, $postId){
        $prevCtr = count($prevArray);
        $currCtr = count($currArray);
        $newTags = [
            'toDelete' => [],
            'toDelCtr' => 0,
            'toAdd' => [], 
            'toAddCtr' => 0
        ];
        $prevArrTags = [];

        // SCAN FOR TAGS TO BE DELETED
        for ($i=0; $i < $prevCtr; $i++) { 
            $prevArrTags[$i] = $prevArray[$i]['tag_id'];
            // IF NOT ON NEWLY POSTED TAGS
            if(!in_array($prevArray[$i]['tag_id'], $currArray)){
                $newTags['toDelete'][] = $prevArray[$i]['category_id'];
                $newTags['toDelCtr']++;
            }
        }

        // SCAN FOR TAGS TO BE ADDED
        for ($j=0; $j < $currCtr; $j++) { 
            if(!in_array($currArray[$j],$prevArrTags)){
                $newTags['toAdd'][] = $currArray[$j];
                $newTags['toAddCtr']++;
            }
        }

        // return $newTags;
        
        # DELETE TAGS
        if($newTags['toDelCtr'] > 0){
            for($k = 0; $k < $newTags['toDelCtr']; $k++){
                $this->deleteCategory($newTags['toDelete'][$k]);
            }
        }
        

        # ADD TAGS
        if($newTags['toAddCtr'] > 0){
            for ($l=0; $l < $newTags['toAddCtr']; $l++) { 
                $this->insertCategory([$postId, $newTags['toAdd'][$l]]);
            }
        }
        

    }

}