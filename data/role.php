<?php
class CaseModel
{
    public $id;
    public $name;
    public $status;
    public $createdAt;
    public $updatedAt;

    private $conn;
    private $table = "roles";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    function add()
    {
        $query = "INSERT INTO
                " . $this->table . "
            SET
                id=:id, name=:name, status=:status";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam('id', $this->id);
        $stmt->bindParam('name', $this->name);
        $stmt->bindParam('status', $this->status);

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
        $query = "SELECT * FROM " . $this->table;
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
        $this->name = $case['name'];
        $this->status = $case['status'];
        $this->createdAt = $case['createdAt'];
        $this->updatedAt = $case['updatedAt'];
    }

    function update()
    {
        $query = "UPDATE
                " . $this->table . "
            SET
                id=:id, name=:name, status=:status, createdAt=:createdAt, updatedAt=:updatedAt
            WHERE
                id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam('id', $this->id);
        $stmt->bindParam('name', $this->name);
        $stmt->bindParam('status', $this->status);
        $stmt->bindParam('createdAt', $this->createdAt);
        $stmt->bindParam('updatedAt', $this->updatedAt);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
