<?php

class Database{

    private $dbHost = DB_HOST;
    private $dbUser = DB_USER;
    private $dbPass = DB_PASS;
    private $dbName = DB_NAME;

    private $statement;
    private $dbHandler;
    private $error;

    public function __construct()
    {
        $conn = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,

        );

        try{

            $this->dbHandler = new PDO($conn, $this->dbUser, $this->dbPass, $options);

        }catch(PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    // allows to write queries
    public function query($sql){
        $this->statement = $this->dbHandler->prepare($sql);
    }

    public function bind($parameter, $value, $type = null){
        switch(is_null($type)){
            case is_int($value): 
                $type = PDO::PARAM_INT;
                break;

            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value): 
                $type = PDO::PARAM_NULL;
                break;
    
            default:
                $type = PDO::PARAM_STR;
        }

        $this->statement->bindValue($parameter, $value, $type);
    }

    // execute prepared statement
    public function executes(){
        return $this->statement->execute();
    }

    // return an array
    public function resultSet(){
        $this->executes();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    // return a specific row as an object
    public function resultSingle(){
        $this->executes();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    // gets the row count
    public function rowcount(){
        return $this->statement->rowCount();
    }
}