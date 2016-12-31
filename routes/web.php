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
use JasperPHP\JasperPHP;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('testc', function () {

//        λ jasperstarter process c:\laragon\www\daralquran\vendor\cossou\jasperphp\examples\hello_world.jrxml -t xml --xml-xpath /Course/Students/Student --data-file c:\laragon\www\daralquran\vendor\cossou\jasperphp\examples\newfile.xml -f pdf
//        jasperstarter process c:\laragon\www\daralquran\vendor\cossou\jasperphp\examples\hello_world.jrxml --xml-xpath c:\laragon\www\daralquran\vendor\cossou\jasperphp\examples\newfile.xml -f pdf
//    $course = Course::find($id);
//    $students = $course->students()->get();
//
//    $xml = new XMLWriter();
//    $xml->openMemory();
//    $xml->startDocument();
//    $xml->startElement('Course');
//    $xml->writeElement('date', Carbon::now()->toDateString());
//    $xml->writeElement('number', $course->number);
//    $xml->writeElement('course_type', $course->courseType()->first()->name);
//    $xml->writeElement('hours', $course->hours);
//    $xml->writeElement('start_date', $course->start_date);
//    $xml->writeElement('finish_date', $course->finish_date);
//    $xml->startElement('Students');
//    foreach ($students as $student) {
//        $xml->startElement('Student');
//        $xml->writeElement('name', $student->name);
//        $xml->writeElement('placeOfBirth', $student->placeOfBirth);
//        $xml->writeElement('dob', $student->dob);
//        $xml->writeElement('rating', Rating::find($students->first()->pivot->rating_id)->name);
//        $xml->endElement();
//    }
//    $xml->endElement();
//    $xml->endElement();
//    $xml->endDocument();
//
//    $content = $xml->outputMemory();
//    $xml = null;
//
//    Storage::disk('local')->put('reports/xmls/'.$course->courseType->id.'-'.$course->number.'.xml', $content);

//    $xml_path = storage_path('app\\reports\\xmls\\'.$course->courseType->id.'-'.$course->number.'.xml');
    $xml_path = storage_path('app\\reports\\xmls\\5-38.xml');

//    $output_path = storage_path('app\\reports\\pdfs\\'.$course->courseType->id.'-'.$course->number);
    $output_path = storage_path('app\\reports\\pdfs\\5-38');
    $jasper = new JasperPHP;

    $jasper->processXML(
//        storage_path('app\\reports\\jrxmls\\'.$course->courseType->id.'.jrxml'),
        storage_path('app\\reports\\jrxmls\\5.jrxml'),
        $output_path,
        array("pdf"),
        $xml_path,
        '/Course/Students/Student'
    )->execute();
    $headers = array(
        'Content-Type: application/pdf',
    );


    return \Response::make(file_get_contents($output_path.'.pdf'), 200, [
        'Content-Type' => 'application/pdf',
//        'Content-Disposition' => 'inline; filename="'.$course->courseType->id.'-'.$course->number.'.pdf'.'"'
        'Content-Disposition' => 'inline; filename="5-38.pdf'.'"'
    ]);
//        return response()->download($output_path.'.pdf', $course->id.'-'.$course->number.'.pdf', $headers);
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