<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseField;
use App\Models\CourseUser;
use App\Models\CourseType;
use App\Models\Region;
use App\Models\Role_Permission;
use App\Models\RoleCourseStutes;
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
        if (Auth::user()->is_admin) {
            $dataTypeContent = Course::all();
        } elseif (Auth::user()->can('view_global', Course::class)) {
            $dataTypeContent = Course::where('status_id', '>=', RoleCourseStutes::where('role_id', Auth::user()->supervisor->role_id)->value('status_id'))->get();
        } elseif (Auth::user()->can('view_local', Course::class)) {
            $dataTypeContent = Course::where('region_id', '=', User::getRegion())
                ->where('status_id', '>=', RoleCourseStutes::where('role_id', Auth::user()->supervisor->role_id)->value('status_id'))
                ->get();
        } elseif (Auth::user()->can('view_concerning', Course::class)) {
            $dataTypeContent = Course::where('supervisor_id', Auth::user()->id)
                ->orWhere('teacher_id', Auth::user()->id)
                ->where('status_id', '>=', RoleCourseStutes::where('role_id', Auth::user()->supervisor->role_id)->value('status_id'))
                ->get();
        } else {
            return redirect('admin')
                ->with([
                    'message' => "sorry, You don't have permission",
                    'alert-type' => 'error',
                ]);
        }

        $user_status_id = RoleCourseStutes::where('role_id', Auth::user()->supervisor->role_id)->value('status_id');
        $view = 'voyager::bread.browse';

        if (view()->exists("admin.$slug.browse")) {
            $view = "admin.$slug.browse";
        } elseif (view()->exists("voyager::$slug.browse")) {
            $view = "voyager::$slug.browse";
        }

        return view($view, compact('dataType', 'dataTypeContent', 'user_status_id'));
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
            $status_id = $data->status_id;
            if ($request->input('migrate')) {
                $status_id = $data->status_id + 1;
            }
            $check_function = 'update_concerning';
        } else {
            if (Auth::user()->can('create_global', Student::class)) {
                $region_id = $request->input('region_id');
            } else {
                $region_id = User::getRegion();
            }
            $status_id = 1;
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
        $data->status_id = $status_id;

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

    public function show_reports()
    {

        if (Gate::denies('reports')) {
            return redirect('admin')->with([
                'message' => "نأسف لا تمتلك صلاحيات",
                'alert-type' => 'error',
            ]);
        }


        if (!User::isAdmin()) {
            $is_global = Role_Permission::join('permissions', 'permissions.id', 'roles_permissions.permission_id')
                ->where('role_id', '=', Auth::user()->supervisor->role_id)
                ->where('func_name', '=', 'reports')
                ->where('global', '1')
                ->exists();
            if ($is_global) {
                $courses = Course::toDropDown();
                $regions = Region::toDropDown();
            } else {
                $courses = Course::where('region_id', Auth::user()->supervisor->region_id)->pluck('name', 'id');
                $regions = Region::where('id', Auth::user()->supervisor->region_id)->pluck('name', 'id');
            }
        } else {
            $courses = Course::toDropDown();
            $regions = Region::toDropDown();
        }
        $course_types = CourseField::toDropDown();

        return view('admin.courses.reports', compact('courses', 'regions', 'course_types'));
    }

    public function reports(Request $request)
    {

        if (Gate::denies('reports')) {
            return redirect('admin')->with([
                'message' => "نأسف لا تمتلك صلاحيات",
                'alert-type' => 'error',
            ]);
        }

        $cols = $request->input('col');
        $from = $request->input('from');
        $to = $request->input('to');

        $slug = $request->segment(2);

        $dataType = DataType::where('slug', '=', $slug)->first();
        $courses = array();
        $modelName = $dataType->model_name;

        foreach ($cols as $col_name => $col_value) {
            if ($col_value) {
                if (isset($dataTypeContent)) {
                    $dataTypeContent = $dataTypeContent->where($col_name, $col_value);
                } else {
                    $dataTypeContent = $modelName::where($col_name, $col_value)->get();
                }
            }
        }

        if ($from && $to) {
            if (isset($dataTypeContent)) {
                $dataTypeContent = $dataTypeContent->whereBetween('start_date', [$from, $to]);
            } else {
                $dataTypeContent = $modelName::whereBetween('start_date', [$from, $to])->get();
            }
        }

        if (!isset($dataTypeContent)) {
            if (!User::isAdmin()) {
                $is_global = Role_Permission::join('permissions', 'permissions.id', 'roles_permissions.permission_id')
                    ->where('role_id', '=', Auth::user()->supervisor->role_id)
                    ->where('func_name', '=', 'reports')
                    ->where('global', '1')
                    ->exists();
                if ($is_global) {
                    $dataTypeContent = $modelName::all();
                } else {
                    $dataTypeContent = $modelName::where('region_id', Auth::user()->supervisor->region_id)->get();
                }
            } else {
                $dataTypeContent = $modelName::all();
            }

        }

        if (count($dataTypeContent) == 0) {
            return redirect('admin/courses/reports')
                ->with([
                    'message' => "ليس لديك دورات مع هذه الخيارات",
                    'alert-type' => 'info',
                ]);
        }

        $report_cols = [
            'م' => null,
            'الرقم التسلسلي' => null,
            'اسم الدورة' => null,
            'الكتاب' => null,
            'اسم المدرس' => null,
            'نوع الدورة' => null,
            'بداية الدورة' => null,
            'نهاية الدورة' => null,
            'الشهر' => null,
            'عدد الساعات' => null,
            'عدد الطلاب' => null,
            'عدد النقاط' => null,
            'وزن الدورة' => null,
            'مكان الدورة' => null,
            'المنطقة' => null
        ];

        $field_cols = [
            'index' => 'م',
            'sn' => 'الرقم التسلسلي',
            'name' => 'اسم الدورة',
            'book' => 'الكتاب',
            'teacher_id' => 'اسم المدرس',
            'field_id' => 'نوع الدورة',
            'start_date' => 'بداية الدورة',
            'finish_date' => 'نهاية الدورة',
            'month' => 'الشهر',
            'hours' => 'عدد الساعات',
            'students' => 'عدد الطلاب',
            'rating' => 'عدد النقاط',
            'weight ' => 'وزن الدورة',
            'venue_id' => 'مكان الدورة',
            'region_id' => 'المنطقة'
        ];

        $report_std_cols = [
            'تاريخ الإصدار' => null,
            'رقم الشهادة' => null,
            'الاسم رباعيا' => null,
            'اسم الدورة' => null,
            'مدرس الدورة' => null,
            'ساعات الدورة' => null,
            'درجة الامتحان' => null,
            'التقدير' => null,
            'بداية الدورة' => null,
            'نهاية الدورة' => null,
        ];

        $field_std_cols = [
            'release_date' => 'تاريخ الإصدار',
            'sn_cert' => 'رقم الشهادة',
            'std_name' => 'الاسم رباعيا',
            'name' => 'اسم الدورة',
            'teacher_id' => 'مدرس الدورة',
            'hours' => 'ساعات الدورة',
            'degree' => 'درجة الامتحان',
            'grading' => 'التقدير',
            'start_date' => 'بداية الدورة',
            'finish_date' => 'نهاية الدورة',
        ];

        foreach ($dataTypeContent as $index => $data) {
            $c = $report_cols;
            $fields = $field_cols;
            if ($cols['id']) {
                $c = $report_std_cols;
                $fields = $field_std_cols;
            }
            foreach ($dataType->browseRows as $row) {
                if (!isset($fields[$row->field])) {
                    continue;
                }

                if ($row->type == 'select_dropdown') {
                    $c[$fields[$row->field]] = getNameById($row->field, $data->{$row->field});
                } elseif ($row->field == 'sn') {
                    $c[$fields[$row->field]] = $data->{'year'} . '-' . $data->{$row->field};
                } else {
                    if ($row->field == 'finish_date' && !$cols['id']) {
                        $c[$fields['month']] = date("m", strtotime($data->{$row->field}));
                    }
                    $c[$fields[$row->field]] = $data->{$row->field};
                }
            }
            if (!$cols['id']) {
                $c[$fields['index']] = $index + 1;
                $c[$fields['students']] = $data->users->count();
                $courses[] = $c;
            } else {
                array_splice($c, 2, 0, "ف/ج/غ");
                foreach ($data->users as $student) {
                    $c[$fields['sn_cert']] = '1';
                    $c[0] = 'ف/ج/غ';
                    $c[$fields['std_name']] = $student->name;
                    $c[$fields['degree']] = CourseUser::whereCourse_id($data->id)->whereUser_id($student->id)->first()->grade;
                    $courses[] = $c;
                }
                break;
            }
        }

        if ($cols['id']) {
            $course_name = $courses[0][$fields['name']];
            Excel::create($course_name, function ($excel) use ($courses, $course_name, $fields) {

                $excel->setTitle($course_name);
                $excel->getDefaultStyle()
                    ->getAlignment()
                    ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
                    ->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);

                $excel->sheet($course_name, function ($sheet) use ($courses, $course_name, $fields) {
                    $sheet->setRightToLeft(true);

                    $sheet->appendRow(array());

                    $sheet->mergeCells('A2:K2');
                    $sheet->row(2, array('بيانات الطلاب - ' . $course_name));
                    $sheet->setHeight(2, 29);

                    $sheet->appendRow(array(''));

                    $sheet->mergeCells('B4:C4');
                    $sheet->row(4, array_keys($courses[0]));
                    $sheet->setHeight(4, 40);
                    $sheet->setFreeze('A5');

                    $sheet->rows($courses);

                    //style
                    $sheet->getStyle('A2:K4')->getAlignment()->applyFromArray(
                        array('horizontal' => 'center')
                    );

                    $sheet->setBorder('A2:K2', \PHPExcel_Style_Border::BORDER_HAIR);
                    $sheet->getStyle('A2:K2')->applyFromArray(
                        array(
                            'fill' => array(
                                'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('rgb' => 'fc9191')
                            ),
                            'font' => array(
                                'name' => 'Hacen Liner Screen Bd',
                                'size' => 9,
                            ),
                            'borders' => array(
                                'allborders' => [
                                    'color' => array('rgb' => '000000'),
                                ],
                            )
                        )
                    );

                    $sheet->setBorder('A4:C4', \PHPExcel_Style_Border::BORDER_HAIR);
                    $sheet->getStyle('A4:C4')->applyFromArray(
                        array(
                            'fill' => array(
                                'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('rgb' => 'ced6e3')
                            ),
                            'font' => array(
                                'name' => 'Hacen Liner Screen Bd',
                                'size' => 9
                            ),
                            'borders' => array(
                                'allborders' => [
                                    'color' => array('rgb' => '000000'),
                                ],
                            )
                        )
                    );

                    $sheet->setBorder('D4:K4', \PHPExcel_Style_Border::BORDER_HAIR);
                    $sheet->getStyle('D4:K4')->applyFromArray(
                        array(
                            'fill' => array(
                                'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('rgb' => '000000')
                            ),
                            'font' => array(
                                'name' => 'Hacen Liner Screen Bd',
                                'size' => 9,
                                'color' => array('rgb' => 'FFFFFF')
                            ),
                            'borders' => array(
                                'allborders' => [
                                    'color' => array('rgb' => 'AAAAAA'),
                                ],
                            )
                        )
                    );

                    $sheet->getStyle('A5:K' . (count($courses) + 4))->applyFromArray(
                        array(
                            'font' => array(
                                'name' => 'Times New Roman',
                                'size' => 9,
                            ),
                        )
                    );
                });

            })->download('xls');
        } else {

            Excel::create('الدورات', function ($excel) use ($courses) {

                $excel->setTitle('الدورات');
                $excel->getDefaultStyle()
                    ->getAlignment()
                    ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
                    ->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);

                $excel->sheet('الدورات', function ($sheet) use ($courses) {
                    $sheet->setRightToLeft(true);
                    $sheet->getStyle('B2:O2')->applyFromArray(
                        array(
                            'font' => array(
                                'name' => 'Hacen Liner Screen Bd',
                                'size' => 10,
                            ),
                        )
                    );

                    $sheet->row(1, array('', 'دار القرآن الكريم والسنة - دائرة السنة النبوية'));
                    $sheet->setHeight(1, 20);
                    $sheet->mergeCells('B1:O1');
                    $sheet->getStyle('B1:O3')->getAlignment()->applyFromArray(
                        array('horizontal' => 'center')
                    );

                    $sheet->row(2, array('', 'بيانات الدورات'));
                    $sheet->setHeight(2, 17);
                    $sheet->mergeCells('B2:O2');
                    $sheet->getStyle('B2:O2')->getAlignment()->applyFromArray(
                        array('horizontal' => 'center')
                    );

                    $sheet->row(3, array('', ''));
                    $sheet->setHeight(3, 17);
                    $sheet->mergeCells('B3:O3');
                    $sheet->getStyle('B3:O3')->getAlignment()->applyFromArray(
                        array('horizontal' => 'center')
                    );

                    $sheet->appendRow(array_keys($courses[0]));
                    $sheet->setHeight(4, 45);
                    $sheet->setBorder('A4:O4', 'thin');
                    $sheet->getStyle('A4:O4')->applyFromArray(
                        array(
                            'fill' => array(
                                'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('rgb' => '000000')
                            ),
                            'font' => array(
                                'name' => 'Hacen Liner Screen Bd',
                                'size' => 10,
                                'color' => array('rgb' => 'FFFFFF')
                            ),
                            'borders' => array(
                                'allborders' => [
                                    'color' => array('rgb' => 'AAAAAA'),
                                ],
                            ),
                        )
                    );
                    $sheet->setFreeze('A5');
                    $sheet->rows($courses);
                    $sheet->setHeight(5, 18);

                    $count = count($courses);
                    $sheet->setBorder('A5:O' . ($count + 4), 'thin');
                    $sheet->getStyle('A5:O' . ($count + 4))->applyFromArray(
                        array(
                            'font' => array(
                                'name' => 'Hacen Liner Screen Bd',
                                'size' => 9,
                                'color' => array('rgb' => '000000')
                            ),
                        )
                    );

                    $sheet->getStyle('B5:B' . ($count + 4))->applyFromArray(
                        array(
                            'fill' => array(
                                'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('rgb' => 'fc9191')
                            )
                        )
                    );

                    $sheet->getStyle('O5:O' . ($count + 4))->applyFromArray(
                        array(
                            'fill' => array(
                                'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('rgb' => 'fc9191')
                            )
                        )
                    );

//                    $sheet->setWidth(array(
//                        'A' => 3,
//                        'B' => 7,
//                        'C' => 20,
//                        'D' => 20,
//                        'E' => 20,
//                        'F' => 7,
//                        'G' => 7,
//                        'H' => 7,
//                        'I' => 7,
//                        'J' => 7,
//                        'K' => 7,
//                        'L' => 7,
//                        'M' => 7,
//                        'N' => 11,
//                        'O' => 10,
//                    ));
                    $sheet->setAutoSize(false);

//                    $sheet->freezeFirstRow();
//                    $sheet->setHeight(1, 20);
//                    $sheet->fromArray($courses);
                });

            })->download('xls');
        }
    }
}

