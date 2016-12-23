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

use App\Models\Course;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('test', function () {
    return \App\Models\Student::all();
    return Course::with('students')->get();
});

Route::get('/home', 'HomeController@index');

Route::get('admin/studentsR/{region_id}', 'StudentBreadController@getStudentByRegion');


//Route::get('admin/venuesR/{region_id}', 'VenueBreadController@getVenuesByRegion');

Route::get('admin/coursesRY/{region_id}', 'CourseBreadController@getSNByRegion');

Route::group(['middleware' => ['web', 'admin.user'], 'prefix' => 'admin'], function () {

    Route::get('students/report', 'StudentBreadController@getReport')->name('admin.students.report');
    Route::get('courses/report', 'CourseBreadController@getReport')->name('admin.courses.report');
    Route::get('supervisors/report', 'SupervisorBreadController@getReport')->name('admin.supervisors.report');


    if (env('DB_CONNECTION') !== null && Schema::hasTable('data_types')):
        foreach (TCG\Voyager\Models\DataType::all() as $dataTypes):
            if ($dataTypes->slug == 'courses') {
                Route::resource($dataTypes->slug, '\App\Http\Controllers\CourseBreadController');
            } elseif ($dataTypes->slug == 'students') {
                Route::resource($dataTypes->slug, '\App\Http\Controllers\StudentBreadController');
            } elseif ($dataTypes->slug == 'supervisors' || $dataTypes->slug == 'teachers') {
                Route::resource($dataTypes->slug, '\App\Http\Controllers\SupervisorBreadController');
            } elseif ($dataTypes->slug == 'roles-permissions') {
                Route::resource($dataTypes->slug, '\App\Http\Controllers\RolePermissionBreadController');
            } else {
                Route::resource($dataTypes->slug, '\TCG\Voyager\Http\Controllers\VoyagerBreadController');
            }
        endforeach;
    endif;
});