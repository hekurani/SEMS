<?php
// path/to/your/php/handler.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Assuming you have database connection $db already set up
    include '../../server/config/db/db.php'; // Include your database connection file
    include '../../server/Profesor.php';
    include '../../server/Entity/Student.entity.php';
    include './email.php';


    $fullName = $_POST['full_name'];
    $age = $_POST['age'];
    $grade = $_POST['grade'];
    $phoneNumber = $_POST['phone_number'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $adress = $_POST['adress'];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);



    // Handle file upload
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profile_image']['tmp_name'];
        $fileName = $_FILES['profile_image']['name'];
        $fileSize = $_FILES['profile_image']['size'];
        $fileType = $_FILES['profile_image']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        $uploadFileDir = '../../Assets/Student/';
        $dest_path = $uploadFileDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $profileImage = $dest_path;
        } else {
            $profileImage = null; // Handle file upload error
        }
    } else {
        $profileImage = null; // No file uploaded
    }

    $profesor = new Profesor($db);
    $student = new StudentEntity( 1,$email, $fullName, $age, $phoneNumber, $adress, $profileImage, $hashedPassword, $grade);
 
    if($profesor->createStudent($student)){
        sendEmail( $email, "Welcome to the University", "You're default passowrd is ". $password." you can change it once yo're logged In, good luck with your studies!","no-reply");
         header('Location: ../Profesor.php');
    }
    echo print_r($profesor);
    
    $db->close();
    error_reporting(E_ALL);
ini_set('display_errors', 1);
}


?>
