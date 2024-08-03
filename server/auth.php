<?php
class Auth {
    protected $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function logIn($email, $password) {
   
        $sql = "SELECT * FROM student WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        echo $email;
        echo "pass ".$password;
        print_r($result);
        if ($result->num_rows > 0) {
            echo "hyri2";
            $user = $result->fetch_assoc();
          
            if (password_verify($password, $user['password'])) {
               
                $_SESSION['user_id'] = $user['Id'];
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['role'] = 'student';

                $stmt->close();
                return; 
            }
        }
        
       
        $sql2 = "SELECT * FROM profesor WHERE email = ?";
        $stmt2 = $this->conn->prepare($sql2);
        $stmt2->bind_param("s", $email);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        
        if ($result2->num_rows > 0) {
            $user = $result2->fetch_assoc();
         
            if (password_verify($password, $user['password'])) {
              
                $_SESSION['user_id'] = $user['Id'];
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['role'] = 'profesor';
            }
        }
        
       
        $stmt->close();
        $stmt2->close();
    }
    


    
     function getProfile($id) {
        $sql = "SELECT * FROM student WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
           
            return $row;
        } else {
            return null;
        }

        $stmt->close();
    }
   static function isAuth(){
        
if (!isset($_SESSION['user_id'])) {
    header("Location: auth.php");
    exit(); 
}
    }
 static   function logOut(){
    session_start();
    $_SESSION = array();
    header("Location: login.php");
    }
    static function protectRoute($role) {
       
    
      

        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] !== $role) {
                if ($_SESSION['role'] === 'profesor') {
                    header('Location: Profesor.php');
                } else {
                    header('Location: Student.php');
                }
                exit(); 
            }
        }
    }
    
}
?>
