<?php

class FlashedData
{
    // flashed data is part of the FlashedData class, no longer just a global variable
    public static $data = null;
 
    public static function getFlashedData()
    {
        if (static::$data === null) {
            static::$data = [];
 
            if (isset($_SESSION['flashed_data'])) {
                static::$data = $_SESSION['flashed_data'];
                unset($_SESSION['flashed_data']);
            }
        }
 
        return static::$data;
    }
}
 
/**
 * gets the value submitted in the previous request by its name
 * 
 * allows to pass an optional second argument which is returned 
 * if such an element does not exist in old data
 */
function old($name, $default_value = null)
{
    $flashed_data = FlashedData::getFlashedData(); 
 
    if (isset($flashed_data[$name])) {
        return $flashed_data[$name];
    } else {
        return $default_value;
    }
}