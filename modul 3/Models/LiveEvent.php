<?php
namespace App\Models;

use App\Traits\Promotable;

class LiveEvent extends Event {
    use Promotable;

    protected $location;

    public function setLocation($location) {
        $this->location = $location;
    }

    public function displayInfo() {
        return "Acara Live: " . $this->name . " pada " . $this->date . " di " . $this->location;
    }
}