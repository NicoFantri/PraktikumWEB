<?php
namespace App\Traits;

trait InfoTrait {
    public function getInfo(): string {
        return "{$this->name}, umur {$this->age} tahun";
    }
}
?>
