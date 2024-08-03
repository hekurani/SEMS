
<?php 
   include '../../server/config/db/db.php'; // Include your database connection file
   include '../../server/Profesor.php';
   include '../../server/Entity/Student.entity.php';

if (isset($_GET['student_id'])) {
    $studentId = $_GET['student_id'];
    // Sanitize and use $studentId as needed
    $studentId = htmlspecialchars($studentId, ENT_QUOTES, 'UTF-8');

    // Now you can use $studentId for further processing
    echo "Student ID: " . $studentId;#
    $profesor = new Profesor($db);
    if($profesor->deleteStudent($studentId)){
    header('Location: ../Profesor.php');
    
}

}