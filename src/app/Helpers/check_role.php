<?php

if (!function_exists('check_role')) {
    /**
     *
     */
    function check_role($presentation, array $roles) {

        if (!$presentation or empty($roles))
            return false;

        $userRole = $presentation->pivot->role;

        if (!in_array($userRole, $roles))
            return false;

        return true;
    }
}