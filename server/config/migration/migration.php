<?php 

include '../db/db.php';
// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Create student table
$studentTableSql = "CREATE TABLE IF NOT EXISTS student (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    Full_name VARCHAR(255) NOT NULL,
    age varchar(30) NOT NULL,
    grade ENUM('10', '11', '12') NOT NULL,
    phone_number VARCHAR(50),
    adress VARCHAR(255),
    password VARCHAR(255) NOT NULL,
    profile_image VARCHAR(255) DEFAULT '../../Assets/Student/default.png'
)";

if ($db->query($studentTableSql) === TRUE) {
    echo "Table student created successfully<br>";
} else {
    echo "Error creating student table: " . $db->error . "<br>";
}

// Create profesor table
$profesorTableSql = "CREATE TABLE IF NOT EXISTS profesor (
   Id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) UNIQUE NOT NULL,
    full_name VARCHAR(255) NOT NULL CHECK (LENGTH(full_name) >= 3),
    age INT NOT NULL,
    phone_number VARCHAR(255),
    adress VARCHAR(255),
    profile_image VARCHAR(255) DEFAULT '../../Assets/Profesor/default.png',
    password VARCHAR(255) NOT NULL
)";

if ($db->query($profesorTableSql) === TRUE) {
    echo "Table profesor created successfully<br>";
} else {
    echo "Error creating profesor table: " . $db->error . "<br>";
}

$insertStudentSql = $db->prepare("INSERT INTO student (email, Full_name, age, grade, phone_number, adress, password, profile_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

$insertStudentSql->bind_param(
    "ssisssss",
    $email, 
    $full_name, 
    $age, 
    $grade, 
    $phone_number, 
    $adress, 
    $password, 
    $profile_image
);

// Sample data for student table
$students = [
    ['email1@example.com', 'John Doe', 20, 3, '1234567890', '123 Elm Street', password_hash('password1', PASSWORD_BCRYPT), '../../Assets/Student/default.png'],
    ['email2@example.com', 'Jane Smith', 22, 4, '0987654321', '456 Oak Avenue', password_hash('password2', PASSWORD_BCRYPT), '../../Assets/Student/default.png']
];

foreach ($students as $student) {
    [$email, $full_name, $age, $grade, $phone_number, $adress, $password, $profile_image] = $student;
    if ($insertStudentSql->execute() === TRUE) {
        echo "New record created successfully in student table<br>";
    } else {
        echo "Error: " . $insertStudentSql->error . "<br>";
    }
}

// Insert data into profesor table
$insertProfesorSql = $db->prepare("INSERT INTO profesor (email, full_name, age, phone_number, adress, password, profile_image) VALUES (?, ?, ?, ?, ?, ?, ?)");

$insertProfesorSql->bind_param(
    "ssissss",
    $email, 
    $full_name, 
    $age, 
    $phone_number, 
    $adress, 
    $password, 
    $profile_image
);

// Sample data for profesor table
$profesors = [
    ['prof1@example.com', 'Dr. Alice', 45, '1112223333', '789 Maple Road', password_hash('password3', PASSWORD_BCRYPT),'../../Assets/Student/default.png'],
    ['prof2@example.com', 'Dr. Bob', 50, '4445556666', '101 Pine Lane', password_hash('password4', PASSWORD_BCRYPT), '../../Assets/Student/default.png']
];

foreach ($profesors as $profesor) {
    [$email, $full_name, $age, $phone_number, $adress, $password, $profile_image] = $profesor;
    if ($insertProfesorSql->execute() === TRUE) {
        echo "New record created successfully in profesor table<br>";
    } else {
        echo "Error: " . $insertProfesorSql->error . "<br>";
    }
}

// Close statements
$insertStudentSql->close();
$insertProfesorSql->close();

// Close connection
$db->close();
?>