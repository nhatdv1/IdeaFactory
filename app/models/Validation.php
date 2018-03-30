<?php

class Validation extends \Eloquent
{
    protected $fillable = [];

    public static function check_Valid($val1, $val2)
    {
        $validator = Validator::make([
            'val1' => $val1, 'val2' => $val2
        ], [
            'val1' => 'required', 'val2' => 'required'
        ]);
        if ($validator->passes()) return true;
        else return false;
    }

    public static function check_Valid3($val1, $val2, $val3)
    {
        $validator = Validator::make([
            'val1' => $val1, 'val2' => $val2, 'val3' => $val3
        ], [
            'val1' => 'required', 'val2' => 'required', 'val3' => 'required'
        ]);
        if ($validator->passes()) return true;
        else return false;
    }
}