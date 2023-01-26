<?php
class AccountModel
{
    public $id;
    public $name;
    public $email;
    public $username;
    public $password;
    public $handphone;
    public $status;
    public $createdAt;
    public $updatedAt;

    private $conn;
    private $table = "users";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    function getEmail()
    {
        $query = "SELECT * FROM " . $this->table . " p          
                WHERE
                    p.email = ?
                LIMIT
                0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->email);

        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $user['id'];
        $this->name = $user['name'];
        $this->email = $user['email'];
        $this->username = $user['username'];
        $this->password = $user['password'];
        $this->handphone = $user['handphone'];
        $this->status = $user['status'];
        $this->createdAt = $user['createdAt'];
        $this->updatedAt = $user['updatedAt'];
    }

    function signin()
    {
        $query = "SELECT * FROM " . $this->table . " p          
                WHERE
                    p.email = ?
                LIMIT
                0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->email);

        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $user['id'];
        $this->name = $user['name'];
        $this->email = $user['email'];
        $this->username = $user['username'];
        $this->password = $user['password'];
        $this->handphone = $user['handphone'];
        $this->status = $user['status'];
        $this->createdAt = $user['createdAt'];
        $this->updatedAt = $user['updatedAt'];
    }

    function signup()
    {
        $query = "INSERT INTO
                " . $this->table . "
            SET  id=:id,  name=:name,  email=:email,  username=:username,  password=:password,  handphone=:handphone,  status=:status";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam("id", $this->id);
        $stmt->bindParam("name", $this->name);
        $stmt->bindParam("email", $this->email);
        $stmt->bindParam("username", $this->username);
        $stmt->bindParam("password", $this->password);
        $stmt->bindParam("handphone", $this->handphone);
        $stmt->bindParam("status", $this->status);

        if ($stmt->execute()) {
            $query = "SELECT * FROM " . $this->table . " p          
                WHERE
                    p.email = ?
                LIMIT
                0,1";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->email);

            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $user['id'];

            $query = "INSERT INTO
            usersRoles
            SET 
            userID=:userID, roleID=3";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam("userID", $user['id']);

            $stmt->execute();
            return true;
        }

        return false;
    }

    function signout()
    {
    }
}