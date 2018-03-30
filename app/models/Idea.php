<?php

class Idea extends \Eloquent {
	protected $table='ideas';

	protected $fillable = ['category_id','title','description','date','number_like','created_at','updated_at'];

	public $timestamps = true;
}