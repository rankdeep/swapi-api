<?php
Class dbObj{
    var $servername = "localhost";
    var $username = "root";
    var $password = "";
    var $dbname = "myswapi_db";
    var $conn;
    function getConnstring() {
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->servername . ";dbname=" . $this->dbname, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>