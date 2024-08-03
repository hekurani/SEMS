<?php
session_start();
include "../../server/Student.php";
include '../../server/config/db/db.php';

$fullname=$_POST['Full_name'];
$age=$_POST['age'];
$adress=$_POST['adress'];
echo "adress ".$adress;
$id=$_SESSION['user_id'];
$student=new Student($db);
if($student->updateProfile($id, $fullname, $age, $adress)){
    header('Location: ../Student.php');
}

