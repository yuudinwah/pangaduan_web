<?php
class Database
{
    private $host = "localhost";
    private $dbname = "pengaduan";
    private $username = "root";
    private $password = "11111118";
    public $conn;

    public function connection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $e) {
            echo "Connection error : " . $e->getMessage();
        }
        return $this->conn;
    }
}
