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
                array('id' => '4', 'name' => 'users', 'slug' => 'users', 'display_name_singular' => 'User', 'display_name_plural' => 'Users', 'icon' => 'voyager-person', 'model_name' => 'TCG\\Voyager\\Models\\User', 'description' => '', 'created_at' => '2016-01-27 19:43:51', 'updated_at' => '2016-02-03 02:07:20'),
                array('id' => '6', 'name' => 'menus', 'slug' => 'menus', 'display_name_singular' => 'Menu', 'display_name_plural' => 'Menus', 'icon' => 'voyager-list', 'model_name' => 'TCG\\Voyager\\Models\\Menu', 'description' => '', 'created_at' => '2016-01-27 19:43:51', 'updated_at' => '2016-06-29 00:09:35'),
                array('id' => '8', 'name' => 'roles', 'slug' => 'roles', 'display_name_singular' => 'Role', 'display_name_plural' => 'Roles', 'icon' => 'voyager-lock', 'model_name' => 'TCG\\Voyager\\Models\\Role', 'description' => '', 'created_at' => '2016-10-21 22:09:45', 'updated_at' => '2016-10-21 22:09:45'),
                array('id' => '9', 'name' => 'courses', 'slug' => 'courses', 'display_name_singular' => 'Course', 'display_name_plural' => 'Courses', 'icon' => 'voyager-receipt', 'model_name' => 'App\\Models\\Course', 'description' => '', 'created_at' => '2016-12-05 16:53:50', 'updated_at' => '2016-12-05 16:53:50'),
                array('id' => '10', 'name' => 'students', 'slug' => 'students', 'display_name_singular' => 'Student', 'display_name_plural' => 'Students', 'icon' => 'voyager-study', 'model_name' => 'App\\Models\\Student', 'description' => '', 'created_at' => '2016-12-10 16:02:56', 'updated_at' => '2016-12-10 16:02:56'),
                array('id' => '11', 'name' => 'supervisors', 'slug' => 'supervisors', 'display_name_singular' => 'Supervisor', 'display_name_plural' => 'Supervisors', 'icon' => 'voyager-pen', 'model_name' => 'App\\Models\\Supervisor', 'description' => '', 'created_at' => '2016-12-11 16:33:40', 'updated_at' => '2016-12-11 16:33:40'),
                array('id' => '13', 'name' => 'courses_fields', 'slug' => 'courses-fields', 'display_name_singular' => 'Courses Field', 'display_name_plural' => 'Courses Fields', 'icon' => 'voyager-milestone', 'model_name' => 'App\\Models\\Course_Field', 'description' => '', 'created_at' => '2016-12-11 22:09:20', 'updated_at' => '2016-12-11 22:10:57'),
                array('id' => '14', 'name' => 'courses_types', 'slug' => 'courses-types', 'display_name_singular' => 'Courses Type', 'display_name_plural' => 'Courses Types', 'icon' => 'voyager-categories', 'model_name' => 'App\\Models\\Course_Type', 'description' => '', 'created_at' => '2016-12-11 22:12:35', 'updated_at' => '2016-12-11 22:13:11'),
                array('id' => '15', 'name' => 'qualifications', 'slug' => 'qualifications', 'display_name_singular' => 'Qualification', 'display_name_plural' => 'Qualifications', 'icon' => 'voyager-certificate', 'model_name' => 'App\\Models\\Qualification', 'description' => '', 'created_at' => '2016-12-11 22:14:59', 'updated_at' => '2016-12-11 22:14:59'),
                array('id' => '16', 'name' => 'regions', 'slug' => 'regions', 'display_name_singular' => 'Region', 'display_name_plural' => 'Regions', 'icon' => 'voyager-location', 'model_name' => 'App\\Models\\Region', 'description' => '', 'created_at' => '2016-12-11 22:15:29', 'updated_at' => '2016-12-11 22:15:29'),
                array('id' => '17', 'name' => 'specializations', 'slug' => 'specializations', 'display_name_singular' => 'Specialization', 'display_name_plural' => 'Specializations', 'icon' => 'voyager-bolt', 'model_name' => 'App\\Models\\Specialization', 'description' => '', 'created_at' => '2016-12-11 22:16:17', 'updated_at' => '2016-12-11 22:16:17'),
                array('id' => '19', 'name' => 'permissions', 'slug' => 'permissions', 'display_name_singular' => 'Permission', 'display_name_plural' => 'Permissions', 'icon' => 'voyager-eye', 'model_name' => 'App\\Models\\Permission', 'description' => '', 'created_at' => '2016-12-12 08:36:48', 'updated_at' => '2016-12-12 08:36:48'),
                array('id' => '20', 'name' => 'roles_permissions', 'slug' => 'roles-permissions', 'display_name_singular' => 'Roles Permission', 'display_name_plural' => 'Roles Permissions', 'icon' => 'voyager-wand', 'model_name' => 'App\\Models\\Role_Permission', 'description' => '', 'created_at' => '2016-12-12 08:41:22', 'updated_at' => '2016-12-12 08:41:22'),
                array('id' => '21', 'name' => 'venues', 'slug' => 'venues', 'display_name_singular' => 'Venue', 'display_name_plural' => 'Venues', 'icon' => 'voyager-thumb-tack', 'model_name' => 'App\\Models\\Venue', 'description' => '', 'created_at' => '2016-12-14 15:48:43', 'updated_at' => '2016-12-14 15:48:43')
            )
        );


    }
}
