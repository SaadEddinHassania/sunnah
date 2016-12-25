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
                array('id' => '1', 'display_name' => 'Create Students', 'func_name' => 'create', 'policy_name' => 'StudentPolicy', 'created_at' => '2016-12-12 12:50:14', 'updated_at' => '2016-12-12 18:58:14'),
                array('id' => '2', 'display_name' => 'View Students', 'func_name' => 'view', 'policy_name' => 'StudentPolicy', 'created_at' => '2016-12-12 18:56:09', 'updated_at' => '2016-12-12 18:56:09'),
                array('id' => '3', 'display_name' => 'Update Students', 'func_name' => 'update', 'policy_name' => 'StudentPolicy', 'created_at' => '2016-12-12 18:56:40', 'updated_at' => '2016-12-14 16:26:41'),
                array('id' => '4', 'display_name' => 'Delete Students', 'func_name' => 'delete', 'policy_name' => 'StudentPolicy', 'created_at' => '2016-12-12 18:58:48', 'updated_at' => '2016-12-12 18:58:48'),
                array('id' => '5', 'display_name' => 'View Teacher', 'func_name' => 'view_teacher', 'policy_name' => 'SupervisorPolicy', 'created_at' => '2016-12-12 19:20:24', 'updated_at' => '2016-12-12 19:20:24'),
                array('id' => '6', 'display_name' => 'Update Teachers', 'func_name' => 'update_teacher', 'policy_name' => 'SupervisorPolicy', 'created_at' => '2016-12-12 19:20:54', 'updated_at' => '2016-12-14 16:26:53'),
                array('id' => '7', 'display_name' => 'Delete Teachers', 'func_name' => 'delete_teacher', 'policy_name' => 'SupervisorPolicy', 'created_at' => '2016-12-12 19:22:22', 'updated_at' => '2016-12-12 19:22:22'),
                array('id' => '8', 'display_name' => 'Create Supervisors', 'func_name' => 'create', 'policy_name' => 'SupervisorPolicy', 'created_at' => '2016-12-12 19:23:07', 'updated_at' => '2016-12-12 19:23:07'),
                array('id' => '9', 'display_name' => 'update Supervisors', 'func_name' => 'update', 'policy_name' => 'SupervisorPolicy', 'created_at' => '2016-12-12 19:23:31', 'updated_at' => '2016-12-14 16:27:24'),
                array('id' => '10', 'display_name' => 'Delete Supervisors', 'func_name' => 'delete', 'policy_name' => 'SupervisorPolicy', 'created_at' => '2016-12-12 19:23:53', 'updated_at' => '2016-12-12 19:23:53'),
                array('id' => '11', 'display_name' => 'Create Teachers', 'func_name' => 'create_teacher', 'policy_name' => 'SupervisorPolicy', 'created_at' => '2016-12-12 19:28:21', 'updated_at' => '2016-12-12 19:28:21'),
                array('id' => '12', 'display_name' => 'View Supervisors', 'func_name' => 'view', 'policy_name' => 'SupervisorPolicy', 'created_at' => '2016-12-12 19:30:04', 'updated_at' => '2016-12-12 19:30:04'),
                array('id' => '13', 'display_name' => 'update supervisor roles', 'func_name' => 'update_role', 'policy_name' => 'SupervisorPolicy', 'created_at' => '2016-12-13 19:56:15', 'updated_at' => '2016-12-13 19:56:15'),
                array('id' => '14', 'display_name' => 'View Courses', 'func_name' => 'view', 'policy_name' => 'CoursePolicy', 'created_at' => '2016-12-14 06:25:47', 'updated_at' => '2016-12-14 06:25:47'),
                array('id' => '15', 'display_name' => 'Update Courses', 'func_name' => 'update', 'policy_name' => 'CoursePolicy', 'created_at' => '2016-12-14 06:26:08', 'updated_at' => '2016-12-14 06:26:08'),
                array('id' => '16', 'display_name' => 'Create Courses', 'func_name' => 'create', 'policy_name' => 'CoursePolicy', 'created_at' => '2016-12-14 06:26:27', 'updated_at' => '2016-12-14 06:26:27'),
                array('id' => '17', 'display_name' => 'Delete Courses', 'func_name' => 'delete', 'policy_name' => 'CoursePolicy', 'created_at' => '2016-12-14 06:26:47', 'updated_at' => '2016-12-14 06:26:47'),
                array('id' => '18', 'display_name' => 'Manage Specializations', 'func_name' => 'specializations', 'policy_name' => 'SpecializationsPolicy', 'created_at' => '2016-12-14 12:34:11', 'updated_at' => '2016-12-14 12:34:11'),
                array('id' => '19', 'display_name' => 'Manage Qualifications', 'func_name' => 'qualifications', 'policy_name' => 'QualificationsPolicy', 'created_at' => '2016-12-14 12:39:02', 'updated_at' => '2016-12-14 12:39:02'),
                array('id' => '20', 'display_name' => 'Manage Courses Fields', 'func_name' => 'courses-fields', 'policy_name' => 'Courses_FieldsPolicy', 'created_at' => '2016-12-14 13:52:12', 'updated_at' => '2016-12-14 13:52:12'),
                array('id' => '21', 'display_name' => 'Manage Courses Types', 'func_name' => 'courses-types', 'policy_name' => 'Courses_TypePolicy', 'created_at' => '2016-12-14 14:25:30', 'updated_at' => '2016-12-14 14:25:30'),
                array('id' => '22', 'display_name' => 'Manage Regions', 'func_name' => 'regions', 'policy_name' => 'RegionPolicy', 'created_at' => '2016-12-14 14:27:12', 'updated_at' => '2016-12-14 14:27:12'),
                array('id' => '23', 'display_name' => 'Manage Permissions', 'func_name' => 'roles_permissions', 'policy_name' => 'RolePermissionsPolicy', 'created_at' => '2016-12-14 16:34:23', 'updated_at' => '2016-12-14 16:34:23'),
                array('id' => '24', 'display_name' => 'Manage Venues', 'func_name' => 'venues', 'policy_name' => 'VenuesPolicy', 'created_at' => '2016-12-14 17:12:47', 'updated_at' => '2016-12-14 17:12:47'),
                array('id' => '25', 'display_name' => 'View Courses Only concerning him', 'func_name' => 'view_concerning', 'policy_name' => 'CoursePolicy', 'created_at' => '2016-12-20 20:35:11', 'updated_at' => '2016-12-20 20:35:11'),
                array('id' => '26', 'display_name' => 'Update Courses Only concerning him', 'func_name' => 'update_concerning', 'policy_name' => 'CoursePolicy', 'created_at' => '2016-12-20 20:35:25', 'updated_at' => '2016-12-20 20:35:25'),
                array('id' => '27', 'display_name' => 'Create Courses Only concerning him', 'func_name' => 'create_concerning', 'policy_name' => 'CoursePolicy', 'created_at' => '2016-12-20 20:35:37', 'updated_at' => '2016-12-20 20:35:37'),
                array('id' => '28', 'display_name' => 'Delete Courses Only concerning him', 'func_name' => 'delete_concerning', 'policy_name' => 'CoursePolicy', 'created_at' => '2016-12-20 20:35:51', 'updated_at' => '2016-12-20 20:35:51')
            )
        );
    }
}
