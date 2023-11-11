<?php
$host="localhost";
$username="root";
$password="";
$database="project_database";
class DatabaseConnection {
    private $conn;
    public function __construct($host,$username,$password,$database)
    {
        $this->conn=new mysqli($host,$username,$password,$database);
        if ($this->conn->connect_error) {
            die ("Connection Failed");
        }
    }
    public function getConnection(){
        return $this->conn;
    }
    public function executeQuery($sql) {
        return mysqli_query($this->conn, $sql);
    }
}
$db=new DatabaseConnection($host,$username,$password,$database);
?>