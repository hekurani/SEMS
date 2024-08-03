<?php
include "../../server/auth.php";
include '../../server/config/db/db.php';
session_start();
Auth::logOut();
header('Location: ../auth.php');