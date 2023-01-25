<?php
class TokenModel
{
    public $id;
    public $userID;
    public $token;
    public $expiredAt;
    public $createdAt;

    private $conn;
    private $table = "tokens";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    function add()
    {
        $query = "INSERT INTO
                " . $this->table . "
            SET
                id=:id, userID=:userID, token=:token, expiredAt=:expiredAt";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam('id', $this->id);
        $stmt->bindParam('userID', $this->userID);
        $stmt->bindParam('token', $this->token);
        $stmt->bindParam('expiredAt', $this->expiredAt);

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
                    p.token = ?
                LIMIT
                0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->token);

        $stmt->execute();

        $case = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $case['id'];
        $this->userID = $case['userID'];
        $this->token = $case['token'];
        $this->expiredAt = $case['expiredAt'];
        $this->createdAt = $case['createdAt'];
    }

    function update()
    {
        $query = "UPDATE
                " . $this->table . "
            SET
                id=:id, userID=:userID, token=:token, expiredAt=:expiredAt, createdAt=:createdAt
            WHERE
                id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam('id', $this->id);
        $stmt->bindParam('userID', $this->userID);
        $stmt->bindParam('token', $this->token);
        $stmt->bindParam('expiredAt', $this->expiredAt);
        $stmt->bindParam('createdAt', $this->createdAt);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
