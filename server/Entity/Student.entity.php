<?php
class StudentEntity {
    private $id;
    private $email;
    private $full_name;
    private $age;
    private $phone_number;
    private $address;
    private $profile_image;
    private $password;
    private $grade;

    // Constructor
    public function __construct($id, $email, $full_name, $age, $phone_number, $address, $profile_image, $password, $grade) {
        $this->id = $id;
        $this->email = $email;
        $this->full_name = $full_name;
        $this->age = $age;
        $this->phone_number = $phone_number;
        $this->address = $address;
        $this->profile_image = $profile_image;
        $this->password = $password;
        $this->grade = $grade;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getFullName() {
        return $this->full_name;
    }

    public function getAge() {
        return $this->age;
    }

    public function getPhoneNumber() {
        return $this->phone_number;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getProfileImage() {
        return $this->profile_image;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getGrade() {
        return $this->grade;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setFullName($full_name) {
        $this->full_name = $full_name;
    }

    public function setAge($age) {
        $this->age = $age;
    }

    public function setPhoneNumber($phone_number) {
        $this->phone_number = $phone_number;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function setProfileImage($profile_image) {
        $this->profile_image = $profile_image;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setGrade($grade) {
        $this->grade = $grade;
    }
}
?>