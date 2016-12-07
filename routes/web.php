<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('admin/studentsR/{region_id}', 'StudentBreadController@getStudentByRegion');

//Route::get('admin/venuesR/{region_id}', 'VenueBreadController@getVenuesByRegion');

Route::get('admin/coursesRY/{region_id}', 'CourseBreadController@getSNByRegion');
