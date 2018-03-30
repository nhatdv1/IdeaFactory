<?php

class Device extends \Eloquent {
	protected $table='devices';

	protected $fillable = ['deviceType', 'deviceName', 'screenWidth', 'screenHeight', 'created_at', 'updated_at'];

	public $timestamps = false;
}