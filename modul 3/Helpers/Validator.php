<?php
namespace App\Helpers;

class Validator {
    public static function validateAge(int $age): bool {
        return $age >= 17 && $age <= 30;
    }
}
?>
