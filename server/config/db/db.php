<?php
// here the it is connected to database with mysqli connection
$db=mysqli_connect('localhost:3309','root','','SEMS');
if(!$db){
die("Mysql failed" . mysqli_connect_error());
}
?>