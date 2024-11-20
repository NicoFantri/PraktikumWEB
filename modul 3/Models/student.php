<?php
namespace App\Models;

use App\Traits\InfoTrait;

class Student extends Person {
    use InfoTrait;

    private string $studentID;
    private string $major;
    private string $email;
    private int $semester;
    private string $course;

    public function __construct(
        string $name, 
        int $age, 
        string $studentID,
        string $major,
        string $email,
        int $semester
    ) {
        parent::__construct($name, $age);
        $this->studentID = $studentID;
        $this->major = $major;
        $this->email = $email;
        $this->semester = $semester;
    }

    public function setCourse(string $course): void {
        $this->course = $course;
    }

    // Menghitung Angkatan Mahasiswa berdasarkan Umur
    public function calculateEnrollmentYear(): int {
        $currentYear = (int)date("Y");
        return $currentYear - ($this->age - 18); // Anggapan usia masuk kuliah 18 tahun
    }

    public function __toString(): string {
        return "{$this->getInfo()}<br>" .
               "ID Mahasiswa: {$this->studentID}<br>" .
               "Program Studi: {$this->major}<br>" .
               "Email: {$this->email}<br>" .
               "Kursus yang Diambil: {$this->course}<br>" .
               "Semester: {$this->semester}<br>" .
               "Angkatan: {$this->calculateEnrollmentYear()}";
    }
}
?>
