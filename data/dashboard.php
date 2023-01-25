<?php
class DashboardModel
{
    public $userID;
    public $waiting;
    public $process;
    public $end;
    public $total;
    public $users;

    private $conn;
    private $table = "cases";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    function get()
    {
        $query = "SELECT count(*) as data FROM " . $this->table . " p WHERE p.status = 'Menunggu' LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->waiting = $data['data'];

        $query = "SELECT count(*) as data FROM " . $this->table . " p WHERE p.status = 'Proses' LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->process = $data['data'];

        $query = "SELECT count(*) as data FROM " . $this->table . " p WHERE p.status = 'Selesai' LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->end = $data['data'];

        $query = "SELECT count(*) as data FROM " . $this->table . " p LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->total = $data['data'];

        $query = "SELECT count(*) as data FROM users p LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->users = $data['data'];
    }

    function getWithID()
    {
        $query = "SELECT count(*) as data FROM " . $this->table . " p WHERE p.status = 'Menunggu' && p.userID = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->userID);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->waiting = $data['data'];

        $query = "SELECT count(*) as data FROM " . $this->table . " p WHERE p.status = 'Proses' && p.userID = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->userID);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->process = $data['data'];

        $query = "SELECT count(*) as data FROM " . $this->table . " p WHERE p.status = 'Selesai' && p.userID = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->userID);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->end = $data['data'];

        $query = "SELECT count(*) as data FROM " . $this->table . " p where p.userID = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->userID);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->total = $data['data'];
    }
}