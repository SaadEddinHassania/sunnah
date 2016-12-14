<?php

use Illuminate\Database\Seeder;

class MenuItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        $prefix = config('voyager.routes.prefix', 'admin');

        \DB::table('menu_items')->delete();

        \DB::table('menu_items')->insert(
            array(
                array('id' => '1', 'menu_id' => '2', 'title' => 'Dashboard', 'url' => '/admin', 'target' => '_self', 'icon_class' => 'voyager-boat', 'color' => NULL, 'parent_id' => NULL, 'order' => '1', 'created_at' => '2016-05-31 22:17:38', 'updated_at' => '2016-06-01 20:24:01'),
                array('id' => '8', 'menu_id' => '2', 'title' => 'Courses', 'url' => '\\admin\\courses', 'target' => '_self', 'icon_class' => 'voyager-receipt', 'color' => '#000000', 'parent_id' => NULL, 'order' => '5', 'created_at' => '2016-12-07 00:10:59', 'updated_at' => '2016-12-14 16:45:04'),
                array('id' => '9', 'menu_id' => '3', 'title' => 'Courses', 'url' => '\\admin\\courses', 'target' => '_self', 'icon_class' => 'voyager-receipt', 'color' => '#000000', 'parent_id' => NULL, 'order' => '2', 'created_at' => '2016-12-09 11:50:28', 'updated_at' => '2016-12-14 16:25:06'),
                array('id' => '10', 'menu_id' => '3', 'title' => 'Students', 'url' => '\\admin\\students', 'target' => '_self', 'icon_class' => 'voyager-study', 'color' => '#000000', 'parent_id' => NULL, 'order' => '3', 'created_at' => '2016-12-09 11:51:11', 'updated_at' => '2016-12-14 16:25:06'),
                array('id' => '11', 'menu_id' => '4', 'title' => 'Courses', 'url' => '\\admin\\courses', 'target' => '_self', 'icon_class' => 'voyager-receipt', 'color' => '#000000', 'parent_id' => NULL, 'order' => '2', 'created_at' => '2016-12-09 12:28:49', 'updated_at' => '2016-12-14 16:26:03'),
                array('id' => '12', 'menu_id' => '4', 'title' => 'Students', 'url' => '\\admin\\students', 'target' => '_self', 'icon_class' => 'voyager-study', 'color' => '#000000', 'parent_id' => NULL, 'order' => '4', 'created_at' => '2016-12-09 12:29:12', 'updated_at' => '2016-12-14 16:26:03'),
                array('id' => '13', 'menu_id' => '4', 'title' => 'Teacher', 'url' => '\\admin\\teachers', 'target' => '_self', 'icon_class' => 'voyager-pen', 'color' => '#000000', 'parent_id' => NULL, 'order' => '3', 'created_at' => '2016-12-09 12:29:46', 'updated_at' => '2016-12-14 16:26:03'),
                array('id' => '14', 'menu_id' => '2', 'title' => 'Specializations', 'url' => '\\admin\\specializations', 'target' => '_self', 'icon_class' => 'voyager-bolt', 'color' => '#000000', 'parent_id' => NULL, 'order' => '8', 'created_at' => '2016-12-11 22:20:48', 'updated_at' => '2016-12-14 16:23:09'),
                array('id' => '15', 'menu_id' => '2', 'title' => 'Qualifications', 'url' => '\\admin\\qualifications', 'target' => '_self', 'icon_class' => 'voyager-certificate', 'color' => '#000000', 'parent_id' => NULL, 'order' => '9', 'created_at' => '2016-12-11 22:21:31', 'updated_at' => '2016-12-14 16:23:09'),
                array('id' => '16', 'menu_id' => '2', 'title' => 'Courses Fields', 'url' => '\\admin\\courses-fields', 'target' => '_self', 'icon_class' => 'voyager-milestone', 'color' => '#000000', 'parent_id' => NULL, 'order' => '10', 'created_at' => '2016-12-11 22:23:40', 'updated_at' => '2016-12-14 16:23:09'),
                array('id' => '17', 'menu_id' => '2', 'title' => 'Courses Types', 'url' => '\\admin\\courses-types', 'target' => '_self', 'icon_class' => 'voyager-categories', 'color' => '#000000', 'parent_id' => NULL, 'order' => '11', 'created_at' => '2016-12-11 22:25:30', 'updated_at' => '2016-12-14 16:23:09'),
                array('id' => '18', 'menu_id' => '2', 'title' => 'Regions', 'url' => '\\admin\\regions', 'target' => '_self', 'icon_class' => 'voyager-location', 'color' => '#000000', 'parent_id' => NULL, 'order' => '6', 'created_at' => '2016-12-11 22:30:29', 'updated_at' => '2016-12-14 16:45:04'),
                array('id' => '19', 'menu_id' => '2', 'title' => 'Supervisors', 'url' => '\\admin\\supervisors', 'target' => '_self', 'icon_class' => 'voyager-group', 'color' => '#000000', 'parent_id' => NULL, 'order' => '2', 'created_at' => '2016-12-14 15:36:34', 'updated_at' => '2016-12-14 15:39:58'),
                array('id' => '20', 'menu_id' => '2', 'title' => 'Permissions', 'url' => '/admin/roles-permissions', 'target' => '_self', 'icon_class' => 'voyager-params', 'color' => '#000000', 'parent_id' => NULL, 'order' => '4', 'created_at' => '2016-12-14 15:43:10', 'updated_at' => '2016-12-14 16:45:04'),
                array('id' => '21', 'menu_id' => '2', 'title' => 'Venues', 'url' => '/admin/venues', 'target' => '_self', 'icon_class' => 'voyager-thumb-tack', 'color' => '#000000', 'parent_id' => NULL, 'order' => '7', 'created_at' => '2016-12-14 15:51:08', 'updated_at' => '2016-12-14 16:45:04'),
                array('id' => '22', 'menu_id' => '1', 'title' => 'Dashboard', 'url' => '/admin', 'target' => '_self', 'icon_class' => 'voyager-boat', 'color' => NULL, 'parent_id' => NULL, 'order' => '1', 'created_at' => '2016-05-31 22:17:38', 'updated_at' => '2016-06-01 20:24:01'),
                array('id' => '23', 'menu_id' => '1', 'title' => 'Courses', 'url' => '\\admin\\courses', 'target' => '_self', 'icon_class' => 'voyager-receipt', 'color' => '#000000', 'parent_id' => NULL, 'order' => '8', 'created_at' => '2016-12-07 00:10:59', 'updated_at' => '2016-12-14 16:13:24'),
                array('id' => '24', 'menu_id' => '1', 'title' => 'Specializations', 'url' => '\\admin\\specializations', 'target' => '_self', 'icon_class' => 'voyager-bolt', 'color' => '#000000', 'parent_id' => NULL, 'order' => '11', 'created_at' => '2016-12-11 22:20:48', 'updated_at' => '2016-12-14 16:13:24'),
                array('id' => '25', 'menu_id' => '1', 'title' => 'Qualifications', 'url' => '\\admin\\qualifications', 'target' => '_self', 'icon_class' => 'voyager-certificate', 'color' => '#000000', 'parent_id' => NULL, 'order' => '12', 'created_at' => '2016-12-11 22:21:31', 'updated_at' => '2016-12-14 16:13:24'),
                array('id' => '26', 'menu_id' => '1', 'title' => 'Courses Fields', 'url' => '\\admin\\courses-fields', 'target' => '_self', 'icon_class' => 'voyager-milestone', 'color' => '#000000', 'parent_id' => NULL, 'order' => '13', 'created_at' => '2016-12-11 22:23:40', 'updated_at' => '2016-12-14 16:13:24'),
                array('id' => '27', 'menu_id' => '1', 'title' => 'Courses Types', 'url' => '\\admin\\courses-types', 'target' => '_self', 'icon_class' => 'voyager-categories', 'color' => '#000000', 'parent_id' => NULL, 'order' => '14', 'created_at' => '2016-12-11 22:25:30', 'updated_at' => '2016-12-14 16:13:24'),
                array('id' => '28', 'menu_id' => '1', 'title' => 'Regions', 'url' => '\\admin\\regions', 'target' => '_self', 'icon_class' => 'voyager-location', 'color' => '#000000', 'parent_id' => NULL, 'order' => '9', 'created_at' => '2016-12-11 22:30:29', 'updated_at' => '2016-12-14 16:13:24'),
                array('id' => '29', 'menu_id' => '1', 'title' => 'Supervisors', 'url' => '\\admin\\supervisors', 'target' => '_self', 'icon_class' => 'voyager-group', 'color' => '#000000', 'parent_id' => NULL, 'order' => '6', 'created_at' => '2016-12-14 15:36:34', 'updated_at' => '2016-12-14 16:13:27'),
                array('id' => '30', 'menu_id' => '1', 'title' => 'Roles Permissions', 'url' => '/admin/roles-permissions', 'target' => '_self', 'icon_class' => 'voyager-params', 'color' => '#000000', 'parent_id' => NULL, 'order' => '4', 'created_at' => '2016-12-14 15:43:10', 'updated_at' => '2016-12-14 16:06:38'),
                array('id' => '31', 'menu_id' => '1', 'title' => 'Venues', 'url' => '/admin/venues', 'target' => '_self', 'icon_class' => 'voyager-thumb-tack', 'color' => '#000000', 'parent_id' => NULL, 'order' => '10', 'created_at' => '2016-12-14 15:51:08', 'updated_at' => '2016-12-14 16:13:24'),
                array('id' => '32', 'menu_id' => '1', 'title' => 'Permissions', 'url' => '/admin/permissions', 'target' => '_self', 'icon_class' => 'voyager-key', 'color' => '#000000', 'parent_id' => NULL, 'order' => '3', 'created_at' => '2016-12-14 16:04:08', 'updated_at' => '2016-12-14 16:06:37'),
                array('id' => '33', 'menu_id' => '1', 'title' => 'Roles', 'url' => '/admin/roles', 'target' => '_self', 'icon_class' => 'voyager-lock', 'color' => '#000000', 'parent_id' => NULL, 'order' => '2', 'created_at' => '2016-12-14 16:06:13', 'updated_at' => '2016-12-14 16:06:24'),
                array('id' => '34', 'menu_id' => '1', 'title' => 'Students', 'url' => '/admin/students', 'target' => '_self', 'icon_class' => 'voyager-study', 'color' => '#000000', 'parent_id' => NULL, 'order' => '7', 'created_at' => '2016-12-14 16:08:44', 'updated_at' => '2016-12-14 16:13:27'),
                array('id' => '35', 'menu_id' => '1', 'title' => 'Users', 'url' => '/admin/users', 'target' => '_self', 'icon_class' => 'voyager-person', 'color' => '#000000', 'parent_id' => NULL, 'order' => '5', 'created_at' => '2016-12-14 16:13:18', 'updated_at' => '2016-12-14 16:13:27'),
                array('id' => '36', 'menu_id' => '2', 'title' => 'Students', 'url' => '/admin/students', 'target' => '_self', 'icon_class' => 'voyager-study', 'color' => '#000000', 'parent_id' => NULL, 'order' => '3', 'created_at' => '2016-12-14 16:23:06', 'updated_at' => '2016-12-14 16:23:14'),
                array('id' => '37', 'menu_id' => '3', 'title' => 'Dashboard', 'url' => '/admin', 'target' => '_self', 'icon_class' => 'voyager-boat', 'color' => '#000000', 'parent_id' => NULL, 'order' => '1', 'created_at' => '2016-12-14 16:25:03', 'updated_at' => '2016-12-14 16:25:06'),
                array('id' => '38', 'menu_id' => '4', 'title' => 'Dashboard', 'url' => '/admin', 'target' => '_self', 'icon_class' => 'voyager-boat', 'color' => '#000000', 'parent_id' => NULL, 'order' => '1', 'created_at' => '2016-12-14 16:26:00', 'updated_at' => '2016-12-14 16:26:03')
            )
        );


    }
}
