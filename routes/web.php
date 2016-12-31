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

    Route::post('courses/report-all', 'CourseBreadController@reportCourses')->name('admin.courses.all_report');
    Route::get('supervisors/report', 'SupervisorBreadController@getReport')->name('admin.supervisors.report');
    Route::post('courses/course-report/', 'CourseBreadController@getCourseReport')->name('admin.courses.c_report');
    Route::post('courses/reports/date/', 'CourseBreadController@reportCoursesByDate')->name('admin.courses.d_report');

    Route::get('courses/reports/', function () {
        return view('admin.courses.reports');
    })->middleware('can:reports');

    Route::get('students/reports/', function () {
        return view('admin.students.reports');
    })->middleware('can:reports');

    Route::get('supervisors/reports/', function () {
        return view('admin.supervisors.reports');
    })->middleware('can:reports');

    Route::get('roles_p', function () {
        return view('admin.roles-permissions.index');
    });

    Route::post('courses/reports/', 'CourseBreadController@reports')->name('admin.courses.reports');
    Route::post('students/reports/', 'StudentBreadController@reports')->name('admin.students.reports');
    Route::post('supervisors/reports/', 'SupervisorBreadController@reports')->name('admin.supervisors.reports');


    if (env('DB_CONNECTION') !== null && Schema::hasTable('data_types')):
        foreach (TCG\Voyager\Models\DataType::all() as $dataTypes):
            if ($dataTypes->slug == 'courses') {
                Route::resource($dataTypes->slug, '\App\Http\Controllers\CourseBreadController');
            } elseif ($dataTypes->slug == 'students') {
                Route::resource($dataTypes->slug, '\App\Http\Controllers\StudentBreadController');
            } elseif ($dataTypes->slug == 'supervisors' || $dataTypes->slug == 'teachers') {
                Route::resource($dataTypes->slug, '\App\Http\Controllers\SupervisorBreadController');
            } elseif ($dataTypes->slug == 'roles-permissions') {
                Route::get('roles-permissions/', 'RolePermissionController@index')->name('admin.roles-permissions.index');
                Route::get('roles-permissions/tbody/{role_id}', 'RolePermissionController@tablePermissions');
                Route::post('roles-permissions/update/', 'RolePermissionController@update')->name('admin.roles-permissions.update');
            } else {
                Route::resource($dataTypes->slug, '\TCG\Voyager\Http\Controllers\VoyagerBreadController');
            }
        endforeach;
    endif;
});