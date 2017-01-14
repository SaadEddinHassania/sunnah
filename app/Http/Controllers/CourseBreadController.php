<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseField;
use App\Models\CourseUser;
use App\Models\CourseType;
use App\Models\Region;
use App\Models\Student;
use App\Models\Supervisor;
use App\Models\Teacher;
use App\Models\Venue;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;
use TCG\Voyager\Models\DataType;

class CourseBreadController extends Controller
{
    //***************************************
    //               ____
    //              |  _ \
    //              | |_) |
    //              |  _ <
    //              | |_) |
    //              |____/
    //
    //      Browse our Data Type (B)READ
    //
    //****************************************

    public function index(Request $request)
    {
        // GET THE SLUG, ex. 'posts', 'pages', etc.
        $slug = $request->segment(2);

        // GET THE DataType based on the slug
        $dataType = DataType::where('slug', '=', $slug)->first();

        // Next Get the actual content from the MODEL that corresponds to the slug DataType
        if (Auth::user()->can('view_global', Course::class)) {
            $dataTypeContent = Course::all();
        } elseif (Auth::user()->can('view_local', Course::class)) {
            $dataTypeContent = Course::where('region_id', '=', User::getRegion())->get();
        } elseif (Auth::user()->can('view_concerning', Course::class)) {
            $dataTypeContent = Course::where('supervisor_id', Auth::user()->id)
                ->orWhere('teacher_id', Auth::user()->id)
                ->get();
        } else {
            return redirect('admin')
                ->with([
                    'message' => "sorry, You don't have permission",
                    'alert-type' => 'error',
                ]);
        }

        $view = 'voyager::bread.browse';

        if (view()->exists("admin.$slug.browse")) {
            $view = "admin.$slug.browse";
        } elseif (view()->exists("voyager::$slug.browse")) {
            $view = "voyager::$slug.browse";
        }

        return view($view, compact('dataType', 'dataTypeContent'));
    }

    //***************************************
    //                _____
    //               |  __ \
    //               | |__) |
    //               |  _  /
    //               | | \ \
    //               |_|  \_\
    //
    //  Read an item of our Data Type B(R)EAD
    //
    //****************************************

    public function show(Request $request, $id)
    {
        $slug = $request->segment(2);
        $dataType = DataType::where('slug', '=', $slug)->first();

        $dataTypeContent = (strlen($dataType->model_name) != 0)
            ? call_user_func([$dataType->model_name, 'find'], $id)
            : DB::table($dataType->name)->where('id', $id)->first(); // If Model doest exist, get data from table name

        $this->authorize('view', $dataTypeContent);

        $students = Student::getStudentsByCourse($dataTypeContent->id);

        return view('admin.courses.read', compact('dataType', 'dataTypeContent', 'students'));
    }

    //***************************************
    //                ______
    //               |  ____|
    //               | |__
    //               |  __|
    //               | |____
    //               |______|
    //
    //  Edit an item of our Data Type BR(E)AD
    //
    //****************************************

    public function edit(Request $request, $id)
    {
        $slug = $request->segment(2);
        $dataType = DataType::where('slug', '=', $slug)->first();
        $dataTypeContent = (strlen($dataType->model_name) != 0)
            ? call_user_func([$dataType->model_name, 'find'], $id)
            : DB::table($dataType->name)->where('id', $id)->first(); // If Model doest exist, get data from table name

        $this->authorize('update', $dataTypeContent);

        if (Auth::user()->can('update_concerning', Course::class) && !User::isAdmin()) {
            if (Auth::user()->supervisor->role->name == 'teacher') {
                $teachers = [Auth::user()->name];
                $supervisors = Supervisor::toDropDown();
            } else {
                $teachers = Teacher::toDropDown();
                $supervisors = [Auth::user()->name];
            }
        } else {
            $teachers = Teacher::toDropDown();
            $supervisors = Supervisor::toDropDown();
        }

        $options_ = array(
            'supervisor' => $supervisors,
            'teacher' => $teachers,
            'region' => [getNameById('region', $dataTypeContent->region_id)],
            'venue' => Venue::toDropDown(),
            'field' => CourseField::toDropDown(),
            'type' => CourseType::toDropDown(),
            'students' => Student::getStudentsByCourse($dataTypeContent->id)->toArray()
        );
        $options_ = json_encode($options_);

        $view = 'voyager::bread.edit-add';

        if (view()->exists("admin.$slug.edit-add")) {
            $view = "admin.$slug.edit-add";
        } elseif (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }

        return view($view, compact('dataType', 'dataTypeContent', 'options_'));


    }

    // POST BR(E)AD
    public function update(Request $request, $id)
    {
        $slug = $request->segment(2);
        $dataType = DataType::where('slug', '=', $slug)->first();
        $data = call_user_func([$dataType->model_name, 'find'], $id);

        $this->authorize('update', $data);

        $this->insertUpdateData($request, $slug, $dataType->editRows, $data);

        return redirect()
            ->route("{$dataType->slug}.index")
            ->with([
                'message' => "تم تعديل الدورة بنجاح",
                'alert-type' => 'success',
            ]);
    }

    //***************************************
    //
    //                   /\
    //                  /  \
    //                 / /\ \
    //                / ____ \
    //               /_/    \_\
    //
    //
    // Add a new item of our Data Type BRE(A)D
    //
    //****************************************

    public function create(Request $request)
    {

        $this->authorize('create', Course::class);

        $slug = $request->segment(2);
        $dataType = DataType::where('slug', '=', $slug)->first();

        if (Auth::user()->can('create_global', Student::class)) {
            $region = Region::toDropDown();
        } else {
            $region = [getNameById('region', User::getRegion())];
        }

        if (User::isAdmin() || !Auth::user()->can('create_concerning', Course::class)) {
            $teachers = Teacher::toDropDown();
            $supervisors = Supervisor::toDropDown();
        } elseif (Auth::user()->can('create_concerning', Course::class)) {
            if (Auth::user()->supervisor->role->name == 'teacher') {
                $teachers = [Auth::user()->name];
                $supervisors = Supervisor::toDropDown();
            } else {
                $teachers = Teacher::toDropDown();
                $supervisors = [Auth::user()->name];
            }
        }

        $options_ = array(
            'supervisor' => $supervisors,
            'teacher' => $teachers,
            'region' => $region,
            'venue' => Venue::toDropDown(),
            'field' => CourseField::toDropDown(),
            'type' => CourseType::toDropDown()
        );
        $options_ = json_encode($options_);

        $view = 'voyager::bread.edit-add';

        if (view()->exists("admin.$slug.edit-add")) {
            $view = "admin.$slug.edit-add";
        } elseif (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }

        return view($view, compact('dataType', 'options_'));

    }

// POST BRE(A)D
    public function store(Request $request)
    {
        $this->authorize('create', Course::class);

        $slug = $request->segment(2);
        $dataType = DataType::where('slug', '=', $slug)->first();

        if (function_exists('voyager_add_post')) {
            $url = $request->url();
            voyager_add_post($request);
        }

        $data = new $dataType->model_name();

        $this->insertUpdateData($request, $slug, $dataType->addRows, $data);

        return redirect()
            ->route("{$dataType->slug}.index")
            ->with([
                'message' => "تم اضافة الدورة بنجاح",
                'alert-type' => 'success',
            ]);
    }

//***************************************
//                _____
//               |  __ \
//               | |  | |
//               | |  | |
//               | |__| |
//               |_____/
//
//         Delete an item BREA(D)
//
//****************************************

    public function destroy(Request $request, $id)
    {

        $slug = $request->segment(2);
        $dataType = DataType::where('slug', '=', $slug)->first();

        $data = call_user_func([$dataType->model_name, 'find'], $id);

        $this->authorize('delete', $data);

        foreach ($dataType->deleteRows as $row) {
            if ($row->type == 'image') {
                $this->deleteFileIfExists('/uploads/' . $data->{$row->field});

                $options = json_decode($row->details);

                if (isset($options->thumbnails)) {
                    foreach ($options->thumbnails as $thumbnail) {
                        $ext = explode('.', $data->{$row->field});
                        $extension = '.' . $ext[count($ext) - 1];

                        $path = str_replace($extension, '', $data->{$row->field});

                        $thumb_name = $thumbnail->name;

                        $this->deleteFileIfExists('/uploads/' . $path . '-' . $thumb_name . $extension);
                    }
                }
            }
        }

        $data = $data->destroy($id)
            ? [
                'message' => "تم حذف الدورة بنجاح",
                'alert-type' => 'success',
            ]
            : [
                'message' => "نأسف حدثت بعض المشاكل في حذف هذه الدورة",
                'alert-type' => 'error',
            ];

        return redirect()->route("{$dataType->slug}.index")->with($data);

    }

    public function insertUpdateData($request, $slug, $rows, $data)
    {
        $rules = [];

        if (isset($data->id)) {
            $region_id = $data->region_id;
            $check_function = 'update_concerning';
        } else {
            if (Auth::user()->can('create_global', Student::class)) {
                $region_id = $request->input('region_id');
            } else {
                $region_id = User::getRegion();
            }
            $check_function = 'create_concerning';
        }

        if (Auth::user()->can($check_function, Course::class) && !User::isAdmin()) {
            if (Auth::user()->supervisor->role->name == 'teacher') {
                $teacher_id = Auth::user()->id;
                $supervisor_id = $request->input('supervisor_id');
            } else {
                $teacher_id = $request->input('teacher_id');
                $supervisor_id = Auth::user()->id;
            }
        } else {
            $teacher_id = $request->input('teacher_id');
            $supervisor_id = $request->input('supervisor_id');
        }

        foreach ($rows as $row) {
            $options = json_decode($row->details);
            if (isset($options->rule)) {
                $rules[$row->field] = $options->rule;
            }

            $content = $this->getContentBasedOnType($request, $slug, $row);
            if ($content === null) {
                if (isset($data->{$row->field})) {
                    $content = $data->{$row->field};
                }
                if ($row->field == 'password') {
                    $content = $data->{$row->field};
                }
            }

            $data->{$row->field} = $content;
        }

        $this->validate($request, $rules);

        $data->teacher_id = $teacher_id;
        $data->supervisor_id = $supervisor_id;
        $data->region_id = $region_id;

        DB::transaction(function () use ($data, $request) {
            $data->save();

            $course_id = $data->id;
            $students = $request->input('students_ids');

            if (isset($students)) {
                foreach ($students as $id) {
                    CourseUser::updateOrCreate(
                        ['course_id' => $course_id, 'user_id' => $id,]
                    );

                    CourseUser::where('course_id', '=', $course_id)
                        ->where('user_id', '=', $id)
                        ->update([
                            'status' => $request->input('students_grade')[$id][1],
                            'grade' => $request->input('students_grade')[$id][0]
                        ]);
                }
            }
        });

    }

    public function getContentBasedOnType(Request $request, $slug, $row)
    {
        $content = null;
        switch ($row->type) {
            /********** PASSWORD TYPE **********/
            case 'password':
                $pass_field = $request->input($row->field);

                if (isset($pass_field) && !empty($pass_field)) {
                    return bcrypt($request->input($row->field));
                }
                break;

            /********** CHECKBOX TYPE **********/
            case 'checkbox':
                $checkBoxRow = $request->input($row->field);

                if (isset($checkBoxRow)) {
                    return 1;
                }

                $content = 0;
                break;

            /********** FILE TYPE **********/
            case 'file':
                $file = $request->file($row->field);
                $filename = Str::random(20);
                $path = $slug . '/' . date('F') . date('Y') . '/';

                $fullPath = $path . $filename . '.' . $file->getClientOriginalExtension();

                Storage::put(config('voyager.storage.subfolder') . $fullPath, (string)$file, 'public');

                return $fullPath;
            // no break

            /********** IMAGE TYPE **********/
            case 'image':
                if ($request->hasFile($row->field)) {
                    $storage_disk = 'local';
                    $file = $request->file($row->field);
                    $filename = Str::random(20);

                    $path = $slug . '/' . date('F') . date('Y') . '/';
                    $fullPath = $path . $filename . '.' . $file->getClientOriginalExtension();

                    $options = json_decode($row->details);

                    if (isset($options->resize) && isset($options->resize->width) && isset($options->resize->height)) {
                        $resize_width = $options->resize->width;
                        $resize_height = $options->resize->height;
                    } else {
                        $resize_width = 1800;
                        $resize_height = null;
                    }

                    $image = Image::make($file)
                        ->resize($resize_width, $resize_height, function (Constraint $constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        })
                        ->encode($file->getClientOriginalExtension(), 75);

                    Storage::put(config('voyager.storage.subfolder') . $fullPath, (string)$image, 'public');

                    if (isset($options->thumbnails)) {
                        foreach ($options->thumbnails as $thumbnails) {
                            if (isset($thumbnails->name) && isset($thumbnails->scale)) {
                                $scale = intval($thumbnails->scale) / 100;
                                $thumb_resize_width = $resize_width;
                                $thumb_resize_height = $resize_height;
                                if ($thumb_resize_width != 'null') {
                                    $thumb_resize_width = $thumb_resize_width * $scale;
                                }
                                if ($thumb_resize_height != 'null') {
                                    $thumb_resize_height = $thumb_resize_height * $scale;
                                }
                                $image = Image::make($file)
                                    ->resize($thumb_resize_width, $thumb_resize_height, function (Constraint $constraint) {
                                        $constraint->aspectRatio();
                                        $constraint->upsize();
                                    })
                                    ->encode($file->getClientOriginalExtension(), 75);
                            } elseif (isset($options->thumbnails) && isset($thumbnails->crop->width) && isset($thumbnails->crop->height)) {
                                $crop_width = $thumbnails->crop->width;
                                $crop_height = $thumbnails->crop->height;
                                $image = Image::make($file)
                                    ->fit($crop_width, $crop_height)
                                    ->encode($file->getClientOriginalExtension(), 75);
                            }

                            Storage::put(config('voyager.storage.subfolder') . $path . $filename . '-' . $thumbnails->name . '.' . $file->getClientOriginalExtension(),
                                (string)$image, 'public');
                        }
                    }

                    return $fullPath;
                }
                break;

            /********** ALL OTHER TEXT TYPE **********/
            default:
                return $request->input($row->field);
            // no break
        }

        return $content;
    }

    public function generate_views(Request $request)
    {
        //$dataType = DataType::where('slug', '=', $slug)->first();
    }

    private function deleteFileIfExists($path)
    {
        if (Storage::exists($path)) {
            Storage::delete($path);
        }
    }

    public function getSNByRegion($region_id)
    {
        return Course::where('region_id', '=', $region_id)
            ->where('year', '=', date('Y'))
            ->max('sn') + 1;
    }

    public function reportCourses(Request $request)
    {
        if (Gate::denies('reports')) {
            return redirect('admin')->with([
                'message' => "نأسف لا تمتلك صلاحيات",
                'alert-type' => 'error',
            ]);
        }

        $slug = $request->segment(2);

        $dataType = DataType::where('slug', '=', $slug)->first();
        $toReport = array();
        $modelName = $dataType->model_name;
        $dataTypeContent = $modelName::all();

        //courses
        foreach ($dataTypeContent as $data) {
            $c = array();
            foreach ($dataType->browseRows as $row) {
                if ($row->type == 'select_dropdown') {
                    $c[$row->display_name] = getNameById($row->field, $data->{$row->field});
                } elseif ($row->field == 'sn') {
                    $c[$row->display_name] = $data->{'year'} . '-' . $data->{$row->field};
                } else {
                    $c[$row->display_name] = $data->{$row->field};
                }
            }
            $c['Number of Students'] = CourseUser::where('course_id', $data->id)->count();
            $toReport[] = $c;
        }

        Excel::create($slug, function ($excel) use ($slug, $toReport) {

            $excel->setTitle($slug);
            $excel->getDefaultStyle()
                ->getAlignment()
                ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
                ->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $excel->sheet($slug, function ($sheet) use ($toReport) {
                $sheet->setRightToLeft(true);
                $sheet->freezeFirstRow();
                $sheet->setAutoSize(true);
                $sheet->setHeight(1, 20);
                $sheet->fromArray($toReport);
            });

        })->download('xls');
    }

    public function getCourseReport(Request $request)
    {
        if (Gate::denies('reports')) {
            return redirect('admin')->with([
                'message' => "نأسف لا تمتلك صلاحيات",
                'alert-type' => 'error',
            ]);
        }

        $slug = $request->segment(2);
        $id = $request->input('id');

        $dataType = DataType::where('slug', '=', $slug)->first();
        $course = array();
        $modelName = $dataType->model_name;
        $data = $modelName::find($id);

        $c = array();
        foreach ($dataType->browseRows as $row) {
            if ($row->type == 'select_dropdown') {
                $c[$row->display_name] = getNameById($row->field, $data->{$row->field});
            } elseif ($row->field == 'sn') {
                $c[$row->display_name] = $data->{'year'} . '-' . $data->{$row->field};
            } else {
                $c[$row->display_name] = $data->{$row->field};
            }
        }
        $c['Number of Students'] = $data->users->count();
        $course[] = $c;

        $students = array();

        foreach ($data->users as $student) {
            $s = array();
            $d = CourseUser::whereCourse_id($data->id)->whereUser_id($student->id)->first();
            $status = $d->status;
            $grade = $d->grade;
            if ($status == 1) {
                $status = 'اختبر';
            } elseif ($status == 2) {
                $status = 'شارك';
            } elseif ($status == 3) {
                $status = 'لم يشارك';
            } else {
                $status = '';
            }
            $s['الاسم'] = $student->name;
            $s['حالة الطالب'] = $status;
            $s['علامة الطالب'] = $grade;
            $students[] = $s;
        }
//        dd($students);

        Excel::create($course[0]['name'], function ($excel) use ($course, $students) {

            $excel->setTitle($course[0]['name']);
            $excel->getDefaultStyle()
                ->getAlignment()
                ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
                ->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $excel->sheet($course[0]['name'], function ($sheet) use ($course, $students) {
                $sheet->setRightToLeft(true);
//                $sheet->freezeFirstRow();
                $sheet->fromArray($course);
                $sheet->setHeight(1, 20);

                $sheet->row(3, array('الطﻻب'));
//                $sheet->cells('A3:C3', function ($cells) {
//                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
//                });
                $sheet->mergeCells('A3:C3');
                $sheet->getStyle('A3:C3')->getAlignment()->applyFromArray(
                    array('horizontal' => 'center')
                );

                $sheet->appendRow(array_keys($students[0]));
                $sheet->setHeight(4, 20);
                $sheet->setFreeze('A5');
                $sheet->rows($students);
            });

        })->download('xls');
    }

    public function reports(Request $request)
    {
        if (Gate::denies('reports')) {
            return redirect('admin')->with([
                'message' => "نأسف لا تمتلك صلاحيات",
                'alert-type' => 'error',
            ]);
        }

        $col = $request->input('col');
        $value = $request->input('value');

        $slug = $request->segment(2);

        $dataType = DataType::where('slug', '=', $slug)->first();
        $courses = array();
        $modelName = $dataType->model_name;
        $dataTypeContent = $modelName::where($col, $value)->get();

        if (count($dataTypeContent) == 0) {
            return redirect('admin/courses/reports')
                ->with([
                    'message' => "ليس لديك دورات مع هذه الخيارات",
                    'alert-type' => 'info',
                ]);
        }

        foreach ($dataTypeContent as $data) {
            $c = array();
            foreach ($dataType->browseRows as $row) {
                if ($row->type == 'select_dropdown') {
                    $c[$row->display_name] = getNameById($row->field, $data->{$row->field});
                } elseif ($row->field == 'sn') {
                    $c[$row->display_name] = $data->{'year'} . '-' . $data->{$row->field};
                } else {
                    $c[$row->display_name] = $data->{$row->field};
                }
            }
            $c['Number of Students'] = $data->users->count();
            $courses[] = $c;
        }

        Excel::create($slug, function ($excel) use ($slug, $courses) {

            $excel->setTitle($slug);
            $excel->getDefaultStyle()
                ->getAlignment()
                ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
                ->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $excel->sheet($slug , function ($sheet) use ($courses) {
                $sheet->setRightToLeft(true);
                $sheet->freezeFirstRow();
                $sheet->setHeight(1, 20);
                $sheet->fromArray($courses);
            });

        })->download('xls');
    }

    public function reportCoursesByDate(Request $request)
    {
        if (Gate::denies('reports')) {
            return redirect('admin')->with([
                'message' => "نأسف ليس لديك صلاحيات",
                'alert-type' => 'error',
            ]);
        }

        $from = $request->input('from');
        $to = $request->input('to');

        $slug = $request->segment(2);

        $dataType = DataType::where('slug', '=', $slug)->first();
        $courses = array();
        $modelName = $dataType->model_name;
        $dataTypeContent = $modelName::whereBetween('start_date', [$from, $to])->get();

//        dd(count($dataTypeContent));

        if (count($dataTypeContent) == 0) {
            return redirect('admin/courses/reports')
                ->with([
                    'message' => "لا يوجد دورات بين هذين التاريخين",
                    'alert-type' => 'error',
                ]);
        }

        foreach ($dataTypeContent as $data) {
            $c = array();
            foreach ($dataType->browseRows as $row) {
                if ($row->type == 'select_dropdown') {
                    $c[$row->display_name] = getNameById($row->field, $data->{$row->field});
                } elseif ($row->field == 'sn') {
                    $c[$row->display_name] = $data->{'year'} . '-' . $data->{$row->field};
                } else {
                    $c[$row->display_name] = $data->{$row->field};
                }
            }
            $c['Number of Students'] = $data->users->count();
            $courses[] = $c;
        }

        Excel::create($slug, function ($excel) use ($slug, $courses) {

            $excel->setTitle($slug);
            $excel->getDefaultStyle()
                ->getAlignment()
                ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
                ->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $excel->sheet($slug , function ($sheet) use ($courses) {
                $sheet->setRightToLeft(true);
                $sheet->freezeFirstRow();
                $sheet->setHeight(1, 20);
                $sheet->fromArray($courses);
            });

        })->download('xls');
    }
}

