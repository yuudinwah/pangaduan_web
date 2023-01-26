<?php
class LogModel
{
    public $id;
    public $userID;
    public $action;
    public $detail;
    public $createdAt;

    private $conn;
    private $table = "logs";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    function add()
    {
        $query = "INSERT INTO
                " . $this->table . "
            SET 
                userID=:userID, action=:action, detail=:detail";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam("userID", $this->userID);
        $stmt->bindParam("action", $this->action);
        $stmt->bindParam("detail", $this->detail);

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

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $user['id'];
        $this->userID = $user['userID'];
        $this->action = $user['action'];
        $this->detail = $user['detail'];
        $this->createdAt = $user['createdAt'];
    }

    function update()
    {
        $query = "UPDATE
                " . $this->table . "
            SET
                userID=:userID, action=:action, detail=:detail
            WHERE
                id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam('id', $this->id);
        $stmt->bindParam('userID', $this->userID);
        $stmt->bindParam('action', $this->action);
        $stmt->bindParam('detail', $this->detail);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}