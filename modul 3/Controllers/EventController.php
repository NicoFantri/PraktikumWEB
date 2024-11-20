<?php
namespace App\Controllers;

use App\Models\LiveEvent;
use App\Models\OnlineEvent;

class EventController {
    public function run() {
        $liveEvent = new LiveEvent();
        $liveEvent->setName("Konser Musik");
        $liveEvent->setDate("10 Juni 2023");
        $liveEvent->setLocation("Gedung Serbaguna");
        echo $liveEvent->displayInfo() . ". " . $liveEvent->promote() . "\n";

        $onlineEvent = new OnlineEvent();
        $onlineEvent->setName("Webinar Teknologi");
        $onlineEvent->setDate("15 Juli 2023");
        $onlineEvent->setPlatform("Zoom");
        echo $onlineEvent->displayInfo() . ". " . $onlineEvent->promote() . " dan " . $onlineEvent->share() . "\n";
    }
}