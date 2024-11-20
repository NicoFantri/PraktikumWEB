<?php
namespace App\Models;

// Abstract Class
abstract class Event {
    protected $name;
    protected $date;

    abstract public function displayInfo();

    public function setName($name) {
        $this->name = $name;
    }

    public function setDate($date) {
        $this->date = $date;
    }
}