<?php
class Conexion
{
    private $servername;
    private $username;
    private$password;
    private $dbname;
    public function __construct(){
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "mdm_db";
    }
    public function conectar() {
            $conn = new PDO("mysql:host=$this->servername;dbname=,$this->dbname", $this->username, $this->password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    }
}