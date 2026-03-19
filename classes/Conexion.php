<?php
class Database
{
    private $servername;
    private $username;
    private$password;
    private $dbname;
    public function __construct(){
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "bloque";
    }
    public function conectar(){
        try {
            $conn = new PDO("mysql:host=$this->servername;dbname=,$this->dbname", $this->username, $this->password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }catch (PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
    }
}