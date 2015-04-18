<?php

class User {

    public static function isValid()
    {
        if(isset($_SESSION['user']))
        {
            return true;
        }
        return false;
    }

}