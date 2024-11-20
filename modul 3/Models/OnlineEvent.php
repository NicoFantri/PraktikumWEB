<?php
namespace App\Models;

use App\Traits\Promotable;
use App\Traits\Shareable;

class OnlineEvent extends Event {
    use Promotable, Shareable;

    protected $platform;

    public function setPlatform($platform) {
        $this->platform = $platform;
    }

    public function displayInfo() {
        return "Acara Online: " . $this->name . " pada " . $this->date . " di platform " . $this->platform;
    }
}