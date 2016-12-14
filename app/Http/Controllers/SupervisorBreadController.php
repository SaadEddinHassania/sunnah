<?php

namespace App\Http\Controllers;

use App\Models\Qualification;
use App\Models\Region;
use App\Models\Role;
use App\Models\Specialization;
use App\Models\Supervisor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Models\DataType;

class SupervisorBreadController extends Controller
{

    public $role_id;
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
        $slug = $request->segment(2);

        if ($slug == 'teachers') {
            $this->role_id = 3;
            $slug = 'supervisors';
        }

        // GET THE DataType based on the slug
        $dataType = DataType::where('slug', '=', $slug)->first();

        if ($request->segment(2) == 'teachers') {
            $dataType->display_name_plural = 'Teachers';
            $dataType->display_name_singular = 'Teacher';
            $dataType->slug = 'teachers';

            if (Auth::user()->can('view_teacher_global', Supervisor::class)) {
                $dataTypeContent = Supervisor::join('users', 'users.id', 'user_id')
//                ->where('users.is_deleted', '=', 0)
                    ->where('role_id', '=', $this->role_id)
                    ->select('users.name', 'users.email', 'supervisors.*')
                    ->get();
            } elseif (Auth::user()->can('view_teacher_local', Supervisor::class)) {
                $dataTypeContent = Supervisor::where('region_id', '=', User::getRegion())
                    ->join('users', 'users.id', 'user_id')
                    ->where('role_id', '=', $this->role_id)
                    ->where('users.is_deleted', '=', 0)
                    ->select('users.name', 'users.email', 'supervisors.*')
                    ->get();
            } else {
                return redirect('admin')
                    ->with([
                        'message' => "sorry, You don't have permission",
                        'alert-type' => 'error',
                    ]);
            }
        } else {
            // Next Get the actual content from the MODEL that corresponds to the slug DataType
            if (Auth::user()->can('view_global', Supervisor::class)) {
                $dataTypeContent = Supervisor::join('users', 'users.id', 'user_id')
//                ->where('users.is_deleted', '=', 0)
                    ->select('users.name', 'users.email', 'supervisors.*')
                    ->get();
            } elseif (Auth::user()->can('view_local', Supervisor::class)) {
                $dataTypeContent = Supervisor::where('region_id', '=', User::getRegion())
                    ->join('users', 'users.id', 'user_id')
                    ->where('users.is_deleted', '=', 0)
                    ->select('users.name', 'users.email', 'supervisors.*')
                    ->get();
            } else {
                return redirect('admin')
                    ->with([
                        'message' => "sorry, You don't have permission",
                        'alert-type' => 'error',
                    ]);
            }
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

        if ($slug == 'teachers') {
            $this->role_id = 3;
            $slug = 'supervisors';
        }

        $dataType = DataType::where('slug', '=', $slug)->first();

        if ($request->segment(2) == 'teachers') {
            $dataType->display_name_plural = 'Teachers';
            $dataType->display_name_singular = 'Teacher';
            $dataType->slug = 'teachers';
        }

        $dataTypeContent = (strlen($dataType->model_name) != 0)
            ? call_user_func([$dataType->model_name, 'find'], $id)
            : DB::table($dataType->name)->where('id', $id)->first(); // If Model doest exist, get data from table name

        if ($request->segment(2) == 'teachers') {
            $this->authorize('view_teacher', $dataTypeContent);
        } else {
            $this->authorize('view', $dataTypeContent);
        }

        $dataTypeContent = $dataTypeContent->join('users', 'users.id', 'user_id')
            ->select('users.name', 'users.email', 'supervisors.*')
            ->where('users.id', '=', $dataTypeContent->user_id)
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

        if ($slug == 'teachers') {
            $this->role_id = 3;
            $slug = 'supervisors';
        }

        $dataType = DataType::where('slug', '=', $slug)->first();
        $dataTypeContent = (strlen($dataType->model_name) != 0)
            ? call_user_func([$dataType->model_name, 'find'], $id)
            : DB::table($dataType->name)->where('id', $id)->first(); // If Model doest exist, get data from table name

        if ($request->segment(2) == 'teachers') {
            $dataType->display_name_plural = 'Teachers';
            $dataType->display_name_singular = 'Teacher';
            $dataType->slug = 'teachers';
            $this->authorize('update_teacher', $dataTypeContent);
        } else {
            $this->authorize('update', $dataTypeContent);
        }

        $dataTypeContent = $dataTypeContent->join('users', 'users.id', $slug . '.user_id')
            ->where('users.id', '=', $dataTypeContent->user_id)
            ->select('users.name', 'users.email', 'users.password', $slug . '.*')
            ->first();

        if (Auth::user()->can('update_role', Supervisor::class)) {
            $role = Role::toDropDown();
        } else {
            $role = [getNameById('role', $dataTypeContent->role_id)];
        }

        $options_ = array(
            'specialization' => Specialization::toDropDown(),
            'qualification' => Qualification::toDropDown(),
            'role' => $role,
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

        if ($slug == 'teachers') {
            $this->role_id = 3;
            $slug = 'supervisors';
        }

        $dataType = DataType::where('slug', '=', $slug)->first();
        $data = call_user_func([$dataType->model_name, 'find'], $id);

        if ($request->segment(2) == 'teachers') {
            $dataType->display_name_plural = 'Teachers';
            $dataType->display_name_singular = 'Teacher';
            $dataType->slug = 'teachers';
        }

        if ($request->segment(2) == 'teachers') {
            $this->authorize('update_teacher', $data);
        } else {
            $this->authorize('update', $data);
        }
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

        $slug = $request->segment(2);

        if ($slug == 'teachers') {
            $this->role_id = 3;
            $slug = 'supervisors';
            $this->authorize('create_teacher', Supervisor::class);
        } else {
            $this->authorize('create', Supervisor::class);
        }

        $dataType = DataType::where('slug', '=', $slug)->first();


        if ($request->segment(2) == 'teachers') {
            $dataType->display_name_plural = 'Teachers';
            $dataType->display_name_singular = 'Teacher';
            $dataType->slug = 'teachers';
        }

        if (Auth::user()->can('create_teacher_global', Supervisor::class)) {
            $region = Region::toDropDown();
        } else {
            $region = [getNameById('region', \App\User::getRegion())];
        }

        $options_ = array(
            'specialization' => Specialization::toDropDown(),
            'qualification' => Qualification::toDropDown(),
            'region' => $region,
            'role' => ['Teacher']
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
        $slug = $request->segment(2);

        if ($slug == 'teachers') {
            $this->role_id = 3;
            $slug = 'supervisors';
            $this->authorize('create_teacher', Supervisor::class);
        } else {
            $this->authorize('create', Supervisor::class);
        }

        $dataType = DataType::where('slug', '=', $slug)->first();

        if ($request->segment(2) == 'teachers') {
            $dataType->display_name_plural = 'Teachers';
            $dataType->display_name_singular = 'Teacher';
            $dataType->slug = 'teachers';
        }

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

        if ($slug == 'teachers') {
            $this->role_id = 3;
            $slug = 'supervisors';
        }

        $dataType = DataType::where('slug', '=', $slug)->first();

        $data = call_user_func([$dataType->model_name, 'find'], $id);

        $user_id = $data->user_id;

        if ($request->segment(2) == 'teachers') {
            $dataType->display_name_plural = 'Teachers';
            $dataType->display_name_singular = 'Teacher';
            $dataType->slug = 'teachers';
        }

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
        error_log('Data= ' . $data);
        if (isset($data->user_id)) {
            $user_data = User::find($data->user_id);
            $region_id = $data->region_id;
            $role_id = $request->input('role_id');
        } else {
            $user_data = User::where('email', '=', $request->input('email'))
                ->where('is_deleted', '=', 1)
                ->first();
            if (!isset($user_data->id))
                $user_data = new User;

            if ($request->segment(2) == 'teachers') {
                $role_id = 3;

                if (Auth::user()->can('create_teacher_global', Supervisor::class)) {
                    $region_id = $request->input('region_id');
                } else {
                    $region_id = User::getRegion();
                }
            } else {
                $role_id = $request->input('role_id');

                if (Auth::user()->can('create_global', Supervisor::class)) {
                    $region_id = $request->input('region_id');
                } else {
                    $region_id = User::getRegion();
                }
            }
        }

        foreach ($rows as $row) {
//            $options = json_decode($row->details);
//            if (isset($options->rule)) {
//                $rules[$row->field] = $options->rule;
//            }

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

        DB::transaction(function () use ($data, $user_data, $region_id, $role_id) {
            $user_data->save();

            $data->user_id = $user_data->id;
            $data->region_id = $region_id;
            $data->role_id = $role_id;
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
}
