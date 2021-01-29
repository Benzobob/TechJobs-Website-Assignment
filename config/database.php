<?php
// used to get mysql database connection
class Database{
 
    // specify your own database credentials
    private $host = "sql2.freesqldatabase.com";
    private $db_name = "sql2227593";
    private $username = "sql2227593";
    private $password = "tG3*zC3*";
    public $conn;
 
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>