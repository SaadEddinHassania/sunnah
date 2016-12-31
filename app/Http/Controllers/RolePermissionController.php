<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Course_Field;
use App\Models\CourseUser;
use App\Models\Course_Type;
use App\Models\Permission;
use App\Models\Region;
use App\Models\Role;
use App\Models\Role_Permission;
use App\Models\Student;
use App\Models\Supervisor;
use App\Models\Teacher;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\User;

class RolePermissionController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('roles_permissions', Role_Permission::class);

        $slug = $request->segment(2);

        $dataType = DataType::where('slug', '=', $slug)->first();

        $roles = Role::toDropDown();

        return view('admin.roles-permissions.index', compact('dataType', 'roles'));
    }

    public function tablePermissions($role_id)
    {
        $this->authorize('roles_permissions', Role_Permission::class);

        $policies = [
            'StudentPolicy' => 'الطلاب',
            'SupervisorPolicy' => 'المشرفين',
            'CoursePolicy' => 'الدورات',
            'SpecializationsPolicy' => 'التخصصات',
            'QualificationsPolicy' => 'المؤهلات العلمية',
            'Courses_FieldsPolicy' => 'مجال الدورات',
            'Courses_TypePolicy' => 'أنواع الدورات',
            'RegionPolicy' => 'المناطق',
            'RolePermissionsPolicy' => 'صلاحيات الأدوار',
            'VenuesPolicy' => 'أماكن الدورات',
            'RolePolicy' => 'الأدوار',
            'ReportPolicy' => 'التقارير'
        ];
        $role_permissions = Role::find($role_id)->permissions->pluck('id')->toArray();

        $tbody = '';
        $tbody .= '
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>الحالة</th>
                    <th>كل المناطق</th>
                </tr>
            </thead>';
        $tbody .= '<tbody>';
        foreach (Permission::all()->groupBy('policy_name') as $policy => $permissions) {
            $tbody .= '<tr>';
            $tbody .= '<th class="label-default" colspan="3" style ="text-align: center">' . $policies[$policy] . '</th>';
            $tbody .= '</tr>';
            foreach ($permissions as $permission) {
                $tbody .= '<tr>';
                $tbody .= '<td class="no-sort no-click">' . $permission->display_name . '</td>';
                $tbody .= '<td class="no-sort no-click">';
                $tbody .= '<input type="checkbox" onchange="unckeckGlobal(this)" id="status_' . $permission->id . '" name="permissions[' . $permission->id . '][]"';
                if (in_array($permission->id, $role_permissions)) {
                    $tbody .= 'checked';
                }
                $tbody .= '></td >';
                $tbody .= '<td class="no-sort no-click" >';
                $tbody .= '<input type = "checkbox" id="global_' . $permission->id . '" name="permissions[' . $permission->id . '][]"';
                if (Role_Permission::where('role_id', $role_id)->where('permission_id', $permission->id)->value('global')) {
                    $tbody .= 'checked="checked"';
                }
                if (!in_array($permission->id, $role_permissions)) {
                    $tbody .= 'disabled="disabled"';
                }
                $tbody .= '></td></tr>';
            }
        }
        $tbody .= '</tbody>';
        return $tbody;
    }

    public function update(Request $request)
    {
        $this->authorize('roles_permissions', Role_Permission::class);

        $role_id = $request->input('role_id');

        $permissions = $request->input('permissions');

        foreach ($permissions as $key => $permission) {
            $role_permission = new Role_Permission();
            $role_permission->role_id = $role_id;
            $role_permission->permission_id = $key;
            if (Role_Permission::where('role_id', $role_id)->where('permission_id', $key)->exists()) {
                $global = 0;
                if (count($permission) > 1) {
                    $global = 1;
                }
                Role_Permission::where('role_id', $role_id)
                    ->where('permission_id', $key)
                    ->update(['global' => $global]);
                continue;
            }
            if (count($permission) > 1) {
                $role_permission->global = 1;
            }

            $role_permission->save();
        }

        foreach (Role::find($role_id)->permissions->pluck('id')->toArray() as $permission) {
            if (!array_key_exists($permission, $permissions)) {
                Role_Permission::where('role_id', $role_id)
                    ->where('permission_id', $permission)
                    ->delete();
            }
        }

        return redirect()
            ->route("admin.roles-permissions.index")
            ->with([
                'message' => "تم حفظ التعديلات",
                'alert-type' => 'success',
            ]);

    }
}

