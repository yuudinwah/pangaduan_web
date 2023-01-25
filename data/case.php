<?php
class CaseModel
{
    public $id;
    public $userID;
    public $name;
    public $email;
    public $title;
    public $detail;
    public $status;
    public $createdAt;
    public $updatedAt;

    private $conn;
    private $table = "cases";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    function add()
    {
        $query = "INSERT INTO
                " . $this->table . "
            SET
               id=:id, userID=:userID, name=:name, email=:email, title=:title, detail=:detail";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam('id', $this->id);
        $stmt->bindParam('userID', $this->userID);
        $stmt->bindParam('name', $this->name);
        $stmt->bindParam('email', $this->email);
        $stmt->bindParam('title', $this->title);
        $stmt->bindParam('detail', $this->detail);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function delete()
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function fetch()
    {
        $query = "SELECT * FROM " . $this->table . " p order by p.createdAt desc";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function get()
    {
        $query = "SELECT * FROM " . $this->table . " p          
                WHERE
                    p.id = ?
                LIMIT
                0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $case = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $case['id'];
        $this->userID = $case['userID'];
        $this->name = $case['name'];
        $this->email = $case['email'];
        $this->title = $case['title'];
        $this->detail = $case['detail'];
        $this->status = $case['status'];
        $this->createdAt = $case['createdAt'];
        $this->updatedAt = $case['updatedAt'];
        
    }

    function update()
    {
        $query = "UPDATE
                " . $this->table . "
            SET
                id=:id, name=:name, email=:email, title=:title, detail=:detail, status=:status, updatedAt=:updatedAt
            WHERE
                id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam('id', $this->id);
        $stmt->bindParam('name', $this->name);
        $stmt->bindParam('email', $this->email);
        $stmt->bindParam('title', $this->title);
        $stmt->bindParam('detail', $this->detail);
        $stmt->bindParam('status', $this->status);
        $stmt->bindParam('updatedAt', $this->updatedAt);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
