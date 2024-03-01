<?php

class Validate
{
    function validate_string($value){
        $validate_101 = strip_tags($value);
        if (preg_match('/^[a-zA-Z0-9]+$/', $validate_101)) {
            return $validate_101;
        } else {
            return false;
        }
    }
}