<?php

class Category extends \Eloquent
{
    protected $table = 'categorys';

    protected $fillable = ['category', 'created_at', 'updated_at'];

    public $timestamps = false;

    public static function check_category($id)
    {
        $category_id = DB::table('categorys')->lists('id');
        if (in_array($id, $category_id)) return true;
        else return false;
    }
}