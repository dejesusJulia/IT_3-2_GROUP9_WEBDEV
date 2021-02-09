<?php

class User extends Model{

    // NAME OF PROPERTIES IN DB
    public $colName;
    public $inputs = [];
    protected $columns = [
        'username', 'user_email', 'password', 'confirmPassword'
    ];
    protected $nullable = [
        'user_type' => 'user'
    ];
    protected $table = 'users';

    # SELECT ALL USERS
    public function all(){
        $users = $this->selectAll($this->table);
        return $users;
    }

    // THIS FUNCTION IS YET TO BE TESTED. SIMILAR TO getUser()
    public function getOne($value){
        $this->colName = $this->columns[1];
        $user = $this->selectOne($this->table, $this->colName, $value);
        return $user;
    }

    # GET USER BY ID
    public function getUser($value){
        $this->colName = 'user_id';
        $user = $this->selectOne($this->table, $this->colName, $value);
        return $user;
    }

    # INSERT SINGLE USER 
    public function insertOne($user){
        $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);

        $this->db->query('INSERT INTO ' . $this->table . '(username, user_email, user_type, password) VALUES(:username, :user_email, :user_type, :password)');

        $this->db->bind(":username", filter_var($user['username'], FILTER_SANITIZE_STRING));
        $this->db->bind(":user_email", $user['user_email']);
        $this->db->bind(":user_type", $this->nullable['user_type']);
        $this->db->bind(":password", $user['password']);
        $this->db->executes();

    }

    # UPDATE PROFILE
    public function updateSelf($user){
        $this->db->query('UPDATE ' . $this->table . ' SET username=:username, user_email=:user_email WHERE user_id =:user_id');

        $this->db->bind(":username", $user['username']);
        $this->db->bind(":user_email", $user['user_email']);
        $this->db->bind(":user_id", $user['user_id']);
        $this->db->executes();
    }

    # UPDATE USER TYPE
    public function updateUserType($user){
        $msg = false;
        $this->db->query('UPDATE ' . $this->table . ' SET user_type=:user_type WHERE user_id =:user_id');

        $this->db->bind(":user_type", $user['user_type']);
        $this->db->bind(":user_id", $user['user_id']);
        if($this->db->executes()){
            $msg = true;
        }
        return $msg;
    }

    # DELETE USER 
    public function deleteUser($user){
        $msg = false;
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user);
        if($this->db->executes()){
            $msg = true;
        }
        return $msg;
    }

    # ERROR HANDLER FOR REGISTER
    public function userErrors(){
        return $this->errorHandler($this->columns);
    }

    # ERROR HANDLER FOR LOGIN
    public function loginErrors(){
        $requirements = [$this->columns[1], $this->columns[2]];
        return $this->errorHandler($requirements);
    }


}