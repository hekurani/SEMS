<?php

class Student {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function updateProfile($id, $fullname, $age, $address) {
        $sql = "UPDATE student SET full_name = ?, age = ?, adress = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bind_param("sssi", $fullname, $age, $address, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

        $stmt->close();
    }
    
}
?>
