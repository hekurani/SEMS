<?php
// include_once('C:\xampp\htdocs\SEMS\server\Entity\Student.entity.php');
class Profesor {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    function createStudent($student) {
        try {
            $sql = "INSERT INTO student (email, Full_name, age, grade, phone_number, adress, password, profile_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);

            $email = $student->getEmail();
            $full_name = $student->getFullName();
            $age = $student->getAge();
            $grade = $student->getGrade();
            $phone_number = $student->getPhoneNumber();
            $address = $student->getAddress();
            $password = password_hash($student->getPassword(), PASSWORD_BCRYPT); // Hash the password
            $profile_image = $student->getProfileImage();

            if ($this->isProfessor($email)) {
                return false;
            }

            $stmt->bind_param("sssissss", $email, $full_name, $age, $grade, $phone_number, $address, $password, $profile_image);

            if ($stmt->execute()) {
                echo "executed";
                return true;
            } else {
                echo "Error: " . $stmt->error;
                return false;
            }

            $stmt->close();
        } catch (Exception $e) {
            // Handle any errors that occurred
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    private function isProfessor($email) {
        $sql = "SELECT Id FROM profesor WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        $exists = $result->num_rows > 0;

        $stmt->close();
        
        return $exists;
    }

    function getStudents() {
        $sql = "SELECT * FROM student";
        $result = $this->conn->query($sql);

        $students = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $students[] = new StudentEntity(
                    $row['Id'],
                    $row['email'],
                    $row['Full_name'],
                    $row['age'],
                    $row['phone_number'],
                    $row['adress'],
                    $row['profile_image'],
                    $row['password'],
                    $row['grade']
                );
            }
        }

        return $students;
    }

    function deleteStudent($id) {
        $sql = "DELETE FROM student WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

        $stmt->close();
    }

    function updateStudent($id, $email) {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format";
            return false;
        }

        $sql = "UPDATE student SET email = ? WHERE Id = ?";

        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("si", $email, $id);

            if ($stmt->execute()) {
                echo "Student email updated successfully.";
            } else {
                echo "Error updating record: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error preparing statement: " . $this->conn->error;
        }
    }
}
?>
