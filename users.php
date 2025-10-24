<?php
require_once "database.php";
class User
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($name, $email, $phone, $address)
    {
        $sql = "INSERT INTO user_reg(name,email,phone,address) VALUES (?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $email, $phone, $address);
        return $stmt->execute();
    }
    public function read()
    {
        $sql = "SELECT * FROM user_reg";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function readOne($id)
    {
        $sql = "SELECT * FROM user_reg WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    public function update($id, $name, $email, $phone, $address)
    {
        $sql = "UPDATE user_reg SET name=?,email=?,phone=?,address=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssi", $name, $email, $phone, $address, $id);
        return $stmt->execute();
    }
    public function delete($id)
    {
        $sql = "DELETE FROM user_reg WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    public function emailExists($email, $id = null)
    {
        if ($id) {
            $sql = "SELECT id FROM user_reg WHERE email = ? AND id != ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("si", $email, $id);
        } else {
            $sql = "SELECT id FROM user_reg WHERE email = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $email);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }
}
