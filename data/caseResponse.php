<?php
class CaseResponseModel
{
    public $id;
    public $caseID;
    public $userID;
    public $response;
    public $createdAt;
    public $updatedAt;

    private $conn;
    private $table = "caseResponses";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    function add()
    {
        $query = "INSERT INTO
                " . $this->table . "
            SET
            id=:id, caseID=:caseID, userID=:userID, response=:response";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam('id', $this->id);
        $stmt->bindParam('caseID', $this->caseID);
        $stmt->bindParam('userID', $this->userID);
        $stmt->bindParam('response', $this->response);

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
        $query = "SELECT * FROM " . $this->table . " p where p.caseID = ? order by p.createdAt desc";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->caseID);
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

        $this->id=$case['id'];
        $this->caseID=$case['caseID'];
        $this->userID=$case['userID'];
        $this->response=$case['response'];
        $this->createdAt=$case['createdAt'];
        $this->updatedAt=$case['updatedAt'];
        
    }

    function update()
    {
        $query = "UPDATE
                " . $this->table . "
            SET
                id=:id, caseID=:caseID, userID=:userID, response=:response, updatedAt=:updatedAt
            WHERE
                id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam('id', $this->id);
        $stmt->bindParam('caseID', $this->caseID);
        $stmt->bindParam('userID', $this->userID);
        $stmt->bindParam('response', $this->response);
        $stmt->bindParam('updatedAt', $this->updatedAt);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
