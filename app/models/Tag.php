<?php 

class Tag extends Model{

    // NAME OF PROPERTIES
    public $colName;
    protected $columns = [
        'tag_name'
    ];
    protected $table = 'tags';

    # SELECT ALL TAGS
    public function all(){
        $tags = $this->selectAll($this->table);
        return $tags;
    }

    # SELECT TAG BY ID
    public function getTag($tagId){
        $this->colName = 'tag_id';
        $tag = $this->selectOne($this->table, $this->colName, $tagId);
        return $tag;
    }

    # SELECT TAG BY NAME
    public function getTagId($tagName){
        $this->colName = 'tag_name';
        $tag = $this->selectOne($this->table, $this->colName, $tagName);

        return $tag;
    }

    # INSERT TAG
    public function insertTag($tag){
        $flag = false;
        $this->db->query('INSERT INTO ' . $this->table . '(tag_name) VALUES(:tag_name)');

        $this->db->bind(':tag_name', $tag);

        if($this->db->executes()){
            $flag = true;
        }

        return $flag;
    }

    # UPDATE TAG
    public function updateTag($tag){
        $flag = false;
        $this->db->query('UPDATE ' . $this->table . ' SET tag_name=:tag_name WHERE tag_id=:tag_id');

        $this->db->bind(':tag_name', $tag['tag_name']);
        $this->db->bind(':tag_id', $tag['tag_id']);

        if($this->db->executes()){
            $flag = true;
        }

        return $flag;
    }

    # DELETE TAG
    public function deleteTag($tagId){
        $flag = false;
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE tag_id=:tag_id');
        $this->db->bind('tag_id', $tagId);

        if($this->db->executes()){
            $flag = true;
        }

        return $flag;
    }

    # ERROR HANDLER
    public function tagErrors(){
        return $this->errorHandler([$this->columns[0]]);
    }
    
}