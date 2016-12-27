<?php

use Illuminate\Database\Seeder;

class DataTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('data_types')->delete();

        \DB::table('data_types')->insert(
            array(
                array('id' => '4', 'name' => 'users', 'slug' => 'users', 'display_name_singular' => 'مستخدم', 'display_name_plural' => 'المستخدمين', 'icon' => 'voyager-person', 'model_name' => 'TCG\\Voyager\\Models\\User', 'description' => '', 'created_at' => '2016-01-27 19:43:51', 'updated_at' => '2016-12-27 12:41:35'),
                array('id' => '6', 'name' => 'menus', 'slug' => 'menus', 'display_name_singular' => 'القائمة', 'display_name_plural' => 'القوائم', 'icon' => 'voyager-list', 'model_name' => 'TCG\\Voyager\\Models\\Menu', 'description' => '', 'created_at' => '2016-01-27 19:43:51', 'updated_at' => '2016-12-27 11:51:10'),
                array('id' => '8', 'name' => 'roles', 'slug' => 'roles', 'display_name_singular' => 'دور', 'display_name_plural' => 'الأدوار', 'icon' => 'voyager-lock', 'model_name' => 'TCG\\Voyager\\Models\\Role', 'description' => '', 'created_at' => '2016-10-21 22:09:45', 'updated_at' => '2016-12-27 12:12:21'),
                array('id' => '9', 'name' => 'courses', 'slug' => 'courses', 'display_name_singular' => 'دورة', 'display_name_plural' => 'الدورات', 'icon' => 'voyager-receipt', 'model_name' => 'App\\Models\\Course', 'description' => '', 'created_at' => '2016-12-05 16:53:50', 'updated_at' => '2016-12-27 12:42:13'),
                array('id' => '10', 'name' => 'students', 'slug' => 'students', 'display_name_singular' => 'طالب', 'display_name_plural' => 'الطلاب', 'icon' => 'voyager-study', 'model_name' => 'App\\Models\\Student', 'description' => '', 'created_at' => '2016-12-10 16:02:56', 'updated_at' => '2016-12-27 12:41:11'),
                array('id' => '11', 'name' => 'supervisors', 'slug' => 'supervisors', 'display_name_singular' => 'مشرف', 'display_name_plural' => 'المشرفين', 'icon' => 'voyager-group', 'model_name' => 'App\\Models\\Supervisor', 'description' => '', 'created_at' => '2016-12-11 16:33:40', 'updated_at' => '2016-12-27 12:41:21'),
                array('id' => '13', 'name' => 'courses_fields', 'slug' => 'courses-fields', 'display_name_singular' => 'مجال دورة', 'display_name_plural' => 'مجال الدورات', 'icon' => 'voyager-milestone', 'model_name' => 'App\\Models\\Course_Field', 'description' => '', 'created_at' => '2016-12-11 22:09:20', 'updated_at' => '2016-12-27 12:39:19'),
                array('id' => '14', 'name' => 'courses_types', 'slug' => 'courses-types', 'display_name_singular' => 'نوع دورة', 'display_name_plural' => 'أنواع الدورات', 'icon' => 'voyager-categories', 'model_name' => 'App\\Models\\Course_Type', 'description' => '', 'created_at' => '2016-12-11 22:12:35', 'updated_at' => '2016-12-27 12:39:29'),
                array('id' => '15', 'name' => 'qualifications', 'slug' => 'qualifications', 'display_name_singular' => 'مؤهل', 'display_name_plural' => 'المؤهلات', 'icon' => 'voyager-certificate', 'model_name' => 'App\\Models\\Qualification', 'description' => '', 'created_at' => '2016-12-11 22:14:59', 'updated_at' => '2016-12-27 12:39:51'),
                array('id' => '16', 'name' => 'regions', 'slug' => 'regions', 'display_name_singular' => 'منطقة', 'display_name_plural' => 'المناطق', 'icon' => 'voyager-down-circled', 'model_name' => 'App\\Models\\Region', 'description' => '', 'created_at' => '2016-12-11 22:15:29', 'updated_at' => '2016-12-27 12:39:59'),
                array('id' => '17', 'name' => 'specializations', 'slug' => 'specializations', 'display_name_singular' => 'تخصص', 'display_name_plural' => 'التخصصات', 'icon' => 'voyager-bolt', 'model_name' => 'App\\Models\\Specialization', 'description' => '', 'created_at' => '2016-12-11 22:16:17', 'updated_at' => '2016-12-27 12:40:39'),
                array('id' => '19', 'name' => 'permissions', 'slug' => 'permissions', 'display_name_singular' => 'صلاحية', 'display_name_plural' => 'الصلاحيات', 'icon' => 'voyager-eye', 'model_name' => 'App\\Models\\Permission', 'description' => '', 'created_at' => '2016-12-12 08:36:48', 'updated_at' => '2016-12-27 12:39:40'),
                array('id' => '20', 'name' => 'roles_permissions', 'slug' => 'roles-permissions', 'display_name_singular' => 'توزيع صلاحيات', 'display_name_plural' => 'توزيع الصلاحيات', 'icon' => 'voyager-wand', 'model_name' => 'App\\Models\\Role_Permission', 'description' => '', 'created_at' => '2016-12-12 08:41:22', 'updated_at' => '2016-12-27 12:40:28'),
                array('id' => '21', 'name' => 'venues', 'slug' => 'venues', 'display_name_singular' => 'مكان دورة', 'display_name_plural' => 'أماكن الدورات', 'icon' => 'voyager-thumb-tack', 'model_name' => 'App\\Models\\Venue', 'description' => '', 'created_at' => '2016-12-14 15:48:43', 'updated_at' => '2016-12-27 12:41:46')
            )
        );


    }
}
