<?php
require 'Traits/InfoTrait.php'; // Load trait first
require 'Models/Person.php'; // Load Person model
require 'Models/Student.php'; // Load Student model
require 'Controllers/StudentController.php'; // Load controller
require 'Helpers/Validator.php'; // Load validator

use App\Controllers\StudentController;

// Inisialisasi Controller dan Tampilkan Info Mahasiswa
$studentController = new StudentController();

try {
    $studentController->showStudentInfo(
        "nico", 
        21, 
        "Pemrograman Website", 
        "202210370311083", // studentID
        "Teknik Informatika", // major
        "nicnic@example.com", // email
        5 // semester
    );
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
