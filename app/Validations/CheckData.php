<?php

namespace App\Validations;

class CheckData
{
    function pass_check(string $pass): bool
    {
        if (preg_match('/[a-zA-Z]/', $pass) && preg_match('/\d/', $pass)) {
            return true;
        } else {
            return false;
        }
    }
    function price_check(string $price): bool
    {
        if (preg_match('/\d/', $price)) {
            return true;
        } else {
            return false;
        }
    }
}
