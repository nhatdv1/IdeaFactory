<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});


Route::post('register', array('as'=>'register','uses'=>'APIController@register'));

Route::post('login', array('as'=>'login','uses'=>'APIController@login'));

Route::post('logout',array('as'=>'logout','uses'=>'APIController@logout'));

Route::post('register_device',array('as'=>'register_device','uses'=>'APIController@register_device'));

Route::get('categories', array('as'=>'categories','uses'=>'APIController@get_categories'));

Route::resource('idea', 'IdeaController');

Route::put('update_idea_like/{id}',array('as'=>'idea_like.update','uses'=>'IdeaController@update_idea_like'));

Route::get('getDataUser/{id}','APIController@getDataUser');
