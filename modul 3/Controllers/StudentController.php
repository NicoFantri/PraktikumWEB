<?php
namespace App\Controllers;

use App\Models\Student;
use App\Helpers\Validator;

class StudentController {
    public function showStudentInfo(
        string $name, 
        int $age, 
        string $course, 
        string $studentID,
        string $major,
        string $email,
        int $semester
    ): void {
        if (!Validator::validateAge($age)) {
            throw new \InvalidArgumentException("Usia harus antara 17 hingga 30 tahun.");
        }

        $student = new Student($name, $age, $studentID, $major, $email, $semester);
        $student->setCourse($course);

        echo $student;
    }
}
?>
