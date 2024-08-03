<?php
include "../../server/auth.php";
include '../../server/config/db/db.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "hyri";
$email=$_POST['email'];
$password=$_POST['password'];
$auth=new Auth($db);
$auth->logIn($email,$password);
if(isset($_SESSION['role'])){
    echo "hyri2";
if($_SESSION['role']=='profesor'){
    header('Location: ../Profesor.php');

}

if($_SESSION['role']=='student'){
    header('Location: ../Student.php');

}

}

}

?>