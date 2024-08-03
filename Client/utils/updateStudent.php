<?php
   // Assuming you have database connection $db already set up
   include '../../server/config/db/db.php'; // Include your database connection file
   include '../../server/Profesor.php';
   include '../../server/Entity/Student.entity.php';

if (isset($_GET['student_id'])) {
    $studentId = $_GET['student_id'];
    $email= $_GET['email'];
    // Sanitize and use $studentId as needed
    $studentId = htmlspecialchars($studentId, ENT_QUOTES, 'UTF-8');

    // Now you can use $studentId for further processing
    echo "Student ID: " . $studentId;#
    $profesor = new Profesor($db);
    $profesor->updateStudent($studentId,$email);
    header('Location: ../Profesor.php');

}

