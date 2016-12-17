<?php

namespace App\Http\Controllers;

use App\Models\Qualification;
use App\Models\Region;
use App\Models\Specialization;
use App\Models\Student;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use TCG\Voyager\Models\DataType;

class StudentBreadController extends Controller
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
        if (Auth::user()->can('view_global', Student::class)) {
            $dataTypeContent = Student::join('users', 'users.id', 'user_id')
//                ->where('users.is_deleted', '=', 0)
                ->select('users.name', 'users.email', 'students.*')
                ->get();
        } elseif (Auth::user()->can('view_local', Student::class)) {
            $dataTypeContent = Student::where('region_id', '=', User::getRegion())
                ->join('users', 'users.id', 'user_id')
                ->where('users.is_deleted', '=', 0)
                ->select('users.name', 'users.email', 'students.*')
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

        $dataTypeContent = $dataTypeContent->join('users', 'users.id', 'user_id')
            ->select('users.name', 'users.email', 'students.*')
            ->first();

        return view('admin.courses.read', compact('dataType', 'dataTypeContent'));
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

        $dataTypeContent = $dataTypeContent->join('users', 'users.id', $slug . '.user_id')
            ->where('users.id', '=', $dataTypeContent->user_id)
            ->select('users.name', 'users.email', 'users.password', 'students.*')
            ->first();

        $options_ = array(
            'specialization' => Specialization::toDropDown(),
            'qualification' => Qualification::toDropDown(),
            'region' => [getNameById('region', $dataTypeContent->region_id)]
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
                'message' => "Successfully Updated {$dataType->display_name_singular}",
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

        $this->authorize('create', Student::class);

        $slug = $request->segment(2);
        $dataType = DataType::where('slug', '=', $slug)->first();

        if (Auth::user()->can('create_global', Student::class)) {
            $region = Region::toDropDown();
        } else {
            $region = [getNameById('region', User::getRegion())];
        }

        $options_ = array(
            'specialization' => Specialization::toDropDown(),
            'qualification' => Qualification::toDropDown(),
            'region' => $region
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
        $this->authorize('create', Student::class);

        $slug = $request->segment(2);
        $dataType = DataType::where('slug', '=', $slug)->first();

        $data = new $dataType->model_name();

        $this->insertUpdateData($request, $slug, $dataType->addRows, $data);

        return redirect()
            ->route("{$dataType->slug}.index")
            ->with([
                'message' => "Successfully Added New {$dataType->display_name_singular}",
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

        $user_id = $data->user_id;

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

        $data =
            [
                'message' => "Successfully Deleted {$dataType->display_name_singular}",
                'alert-type' => 'success',
            ];

        User::where('id', '=', $user_id)
            ->update(['is_deleted' => 1]);

        return redirect()->route("{$dataType->slug}.index")->with($data);

    }

    public function insertUpdateData($request, $slug, $rows, $data)
    {
        $rules = [];
        if (isset($data->user_id)) {
            $user_data = User::find($data->user_id);
            $region_id = $data->region_id;
        } else {
            $user_data = User::where('email', '=', $request->input('email'))
                ->where('is_deleted', '=', 1)
                ->first();
            if ($user_data === null)
                $user_data = new User;

            if (Auth::user()->can('create_global', Student::class)) {
                $region_id = $request->input('region_id');
            } else {
                $region_id = User::getRegion();
            }
        }

        foreach ($rows as $row) {

            error_log($row->field);
            if (!array_key_exists($row->field, ['name' => '', 'email' => '', 'password' => ''])) {
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
            } else {
                $content = $this->getContentBasedOnType($request, 'users', $row);
                if ($content === null) {
                    if (isset($data->{$row->field})) {
                        $content = $user_data->{$row->field};
                    }
                    if ($row->field == 'password') {
                        $content = $user_data->{$row->field};
                    }
                }

                $user_data->{$row->field} = $content;
            }
        }

        $this->validate($request, $rules);

        $user_data->is_deleted = 0;

        DB::transaction(function () use ($data, $user_data, $region_id) {
            $user_data->save();

            $data->user_id = $user_data->id;
            $data->region_id = $region_id;
            $data->save();
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

            /********** DATE TYPE **********/
            case 'date':

                $date = $request->input($row->field);

                if (isset($date)) {

                    if ($date == '') {
                        return null;
                    }

                    return $date;
                }

                return null;
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

    public function getStudentByRegion($region_id)
    {
        return Student::join('users', 'students.user_id', 'users.id')
            ->where('region_id', '=', $region_id)
            ->pluck('students.user_id', 'users.name');
    }

    public function getReport()
    {
//        $students = Student::join('users', 'students.user_id', '=', 'users.id')->get();


//        return $studentsColl;
//        return;
        Excel::create('Filename', function ($excel) {

            $excel->setTitle('Our new awesome title');

            $excel->sheet('Sheetname', function ($sheet) {
                $sheet->setRightToLeft(true);
                $students = Student::with('user')->get()->except('dob');

                foreach ($students as $key => $student) {
                    $student = collect($student);

                    $students[$key] = $student->except(['user.id'])->collapse()->merge($student)->except('user');
                }
                $sheet->fromArray(
                    $students
                );

            });

        })->export('xlsx');
    }
}
