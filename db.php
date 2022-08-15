<?php
include "Config.php";

class Database{
    
    private $host=DB_Host;
    private $username=DB_Username;
     private $password=DB_Password;
    private $dbname=DB_Name;
    public $conn;

   public function Connect(){
       $dsn="mysql:host=".$this->host.";dbname=".$this->dbname;
       $this->conn=new PDO($dsn, $this->username, $this->password);
       $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
       return $this->conn;
   }
}