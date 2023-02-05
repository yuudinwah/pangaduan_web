<?php
class UserRoleModel
{
    public $id;
    public $userID;
    public $roleID;
    public $createdAt;

    private $conn;
    private $table = "usersRoles";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    function add()
    {
        $query = "INSERT INTO
                " . $this->table . "
            SET 
                userID=:userID, roleID=:roleID";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam("userID", $this->userID);
        $stmt->bindParam("roleID", $this->roleID);

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

    function fetch($userID)
    {
        $query = "SELECT p.name as roleName FROM " . $this->table . " uR, roles p where p.id = uR.roleID AND uR.userID = " . $userID;
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
        $this->roleID = $user['roleID'];
        $this->createdAt = $user['createdAt'];
    }

    function update()
    {
        $query = "UPDATE
                " . $this->table . "
            SET
                id=:id, name=:name, email=:email, username=:username, password=:password, handphone=:handphone, status=:status, createdAt=:createdAt, updatedAt=:updatedAt
            WHERE
                id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam('id', $this->id);
        $stmt->bindParam('userID', $this->userID);
        $stmt->bindParam('roleID', $this->roleID);
        $stmt->bindParam('createdAt', $this->createdAt);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}