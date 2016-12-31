<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('permissions')->delete();

        \DB::table('permissions')->insert(
            array(
                array('id' => '1', 'display_name' => 'عرض معلومات الطلاب', 'func_name' => 'view', 'policy_name' => 'StudentPolicy', 'created_at' => '2016-12-12 18:56:09', 'updated_at' => '2016-12-27 18:06:01'),
                array('id' => '2', 'display_name' => 'تعديل معلومات الطلاب', 'func_name' => 'update', 'policy_name' => 'StudentPolicy', 'created_at' => '2016-12-12 18:56:40', 'updated_at' => '2016-12-27 18:05:49'),
                array('id' => '3', 'display_name' => 'إضافة طلاب جدد', 'func_name' => 'create', 'policy_name' => 'StudentPolicy', 'created_at' => '2016-12-12 12:50:14', 'updated_at' => '2016-12-27 18:05:06'),
                array('id' => '4', 'display_name' => 'حذف طلاب', 'func_name' => 'delete', 'policy_name' => 'StudentPolicy', 'created_at' => '2016-12-12 18:58:48', 'updated_at' => '2016-12-27 18:06:20'),
                array('id' => '5', 'display_name' => 'عرض معلومات مدرسين', 'func_name' => 'view_teacher', 'policy_name' => 'SupervisorPolicy', 'created_at' => '2016-12-12 19:20:24', 'updated_at' => '2016-12-27 18:06:48'),
                array('id' => '6', 'display_name' => 'تعديل معلومات مدرسين', 'func_name' => 'update_teacher', 'policy_name' => 'SupervisorPolicy', 'created_at' => '2016-12-12 19:20:54', 'updated_at' => '2016-12-27 18:07:02'),
                array('id' => '7', 'display_name' => 'إضافة مدرسين جدد', 'func_name' => 'create_teacher', 'policy_name' => 'SupervisorPolicy', 'created_at' => '2016-12-12 19:28:21', 'updated_at' => '2016-12-27 18:08:24'),
                array('id' => '8', 'display_name' => 'حذف مدرسين', 'func_name' => 'delete_teacher', 'policy_name' => 'SupervisorPolicy', 'created_at' => '2016-12-12 19:22:22', 'updated_at' => '2016-12-27 18:07:17'),
                array('id' => '9', 'display_name' => 'عرض معلومات مشرفين', 'func_name' => 'view', 'policy_name' => 'SupervisorPolicy', 'created_at' => '2016-12-12 19:30:04', 'updated_at' => '2016-12-27 18:09:56'),
                array('id' => '10', 'display_name' => 'تعديل معلومات مشرفين', 'func_name' => 'update', 'policy_name' => 'SupervisorPolicy', 'created_at' => '2016-12-12 19:23:31', 'updated_at' => '2016-12-27 18:07:52'),
                array('id' => '11', 'display_name' => 'إضافة مشرفين جدد', 'func_name' => 'create', 'policy_name' => 'SupervisorPolicy', 'created_at' => '2016-12-12 19:23:07', 'updated_at' => '2016-12-27 18:07:36'),
                array('id' => '12', 'display_name' => 'حذف مشرفين', 'func_name' => 'delete', 'policy_name' => 'SupervisorPolicy', 'created_at' => '2016-12-12 19:23:53', 'updated_at' => '2016-12-27 18:08:05'),
                array('id' => '13', 'display_name' => 'تعديل أدوار المشرفين', 'func_name' => 'update_role', 'policy_name' => 'SupervisorPolicy', 'created_at' => '2016-12-13 19:56:15', 'updated_at' => '2016-12-27 18:09:10'),
                array('id' => '14', 'display_name' => 'عرض معلومات الدورات', 'func_name' => 'view', 'policy_name' => 'CoursePolicy', 'created_at' => '2016-12-14 06:25:47', 'updated_at' => '2016-12-27 18:09:39'),
                array('id' => '15', 'display_name' => 'تعديل معلومات الدورات', 'func_name' => 'update', 'policy_name' => 'CoursePolicy', 'created_at' => '2016-12-14 06:26:08', 'updated_at' => '2016-12-27 18:10:26'),
                array('id' => '16', 'display_name' => 'إضافة دورات جديدة', 'func_name' => 'create', 'policy_name' => 'CoursePolicy', 'created_at' => '2016-12-14 06:26:27', 'updated_at' => '2016-12-27 18:10:54'),
                array('id' => '17', 'display_name' => 'حذف دورات', 'func_name' => 'delete', 'policy_name' => 'CoursePolicy', 'created_at' => '2016-12-14 06:26:47', 'updated_at' => '2016-12-27 18:11:07'),
                array('id' => '18', 'display_name' => 'إدارة التخصصات', 'func_name' => 'specializations', 'policy_name' => 'SpecializationsPolicy', 'created_at' => '2016-12-14 12:34:11', 'updated_at' => '2016-12-27 18:11:46'),
                array('id' => '19', 'display_name' => 'إدارة المؤهلات العلمية', 'func_name' => 'qualifications', 'policy_name' => 'QualificationsPolicy', 'created_at' => '2016-12-14 12:39:02', 'updated_at' => '2016-12-27 18:12:03'),
                array('id' => '20', 'display_name' => 'إدارة مجال الدورات', 'func_name' => 'courses-fields', 'policy_name' => 'Courses_FieldsPolicy', 'created_at' => '2016-12-14 13:52:12', 'updated_at' => '2016-12-27 18:12:33'),
                array('id' => '21', 'display_name' => 'إدارة المناطق', 'func_name' => 'regions', 'policy_name' => 'RegionPolicy', 'created_at' => '2016-12-14 14:27:12', 'updated_at' => '2016-12-27 18:13:09'),
                array('id' => '22', 'display_name' => 'إدارة صلاحيات الأدوار', 'func_name' => 'roles_permissions', 'policy_name' => 'RolePermissionsPolicy', 'created_at' => '2016-12-14 16:34:23', 'updated_at' => '2016-12-27 19:04:30'),
                array('id' => '23', 'display_name' => 'إدارة أماكن الدورات', 'func_name' => 'venues', 'policy_name' => 'VenuesPolicy', 'created_at' => '2016-12-14 17:12:47', 'updated_at' => '2016-12-27 18:13:55'),
                array('id' => '24', 'display_name' => 'عرض الدورات الخاصة به فقط', 'func_name' => 'view_concerning', 'policy_name' => 'CoursePolicy', 'created_at' => '2016-12-20 20:35:11', 'updated_at' => '2016-12-27 18:14:25'),
                array('id' => '25', 'display_name' => 'تعديل الدورات الخاصة به فقط', 'func_name' => 'update_concerning', 'policy_name' => 'CoursePolicy', 'created_at' => '2016-12-20 20:35:25', 'updated_at' => '2016-12-27 18:14:47'),
                array('id' => '26', 'display_name' => 'إضافة دورات خاصة به فقط', 'func_name' => 'create_concerning', 'policy_name' => 'CoursePolicy', 'created_at' => '2016-12-20 20:35:37', 'updated_at' => '2016-12-27 18:15:10'),
                array('id' => '27', 'display_name' => 'حذف دورات خاصة به فقط', 'func_name' => 'delete_concerning', 'policy_name' => 'CoursePolicy', 'created_at' => '2016-12-20 20:35:51', 'updated_at' => '2016-12-27 18:15:25'),
                array('id' => '28', 'display_name' => 'ادارة الأدوار', 'func_name' => 'roles', 'policy_name' => 'RolePolicy', 'created_at' => '2016-12-27 14:37:39', 'updated_at' => '2016-12-27 14:37:39'),
                array('id' => '29', 'display_name' => 'استخراج التقارير', 'func_name' => 'reports', 'policy_name' => 'ReportPolicy', 'created_at' => '2016-12-27 14:58:02', 'updated_at' => '2016-12-27 14:58:02')
            )
        );
    }
}
