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
                array('id' => '22', 'menu_id' => '1', 'title' => 'لوحة التحكم', 'url' => '/admin', 'target' => '_self', 'icon_class' => 'voyager-boat', 'color' => '#000000', 'parent_id' => NULL, 'order' => '1', 'created_at' => '2016-05-31 22:17:38', 'updated_at' => '2016-12-27 12:04:09'),
                array('id' => '23', 'menu_id' => '1', 'title' => 'الدورات', 'url' => '/admin/courses', 'target' => '_self', 'icon_class' => 'voyager-receipt', 'color' => '#000000', 'parent_id' => NULL, 'order' => '8', 'created_at' => '2016-12-07 00:10:59', 'updated_at' => '2016-12-27 12:04:09'),
                array('id' => '24', 'menu_id' => '1', 'title' => 'التخصصات', 'url' => '/admin/specializations', 'target' => '_self', 'icon_class' => 'voyager-bolt', 'color' => '#000000', 'parent_id' => NULL, 'order' => '11', 'created_at' => '2016-12-11 22:20:48', 'updated_at' => '2016-12-27 12:04:09'),
                array('id' => '25', 'menu_id' => '1', 'title' => 'المؤهلات', 'url' => '/admin/qualifications', 'target' => '_self', 'icon_class' => 'voyager-certificate', 'color' => '#000000', 'parent_id' => NULL, 'order' => '12', 'created_at' => '2016-12-11 22:21:31', 'updated_at' => '2016-12-27 12:04:09'),
                array('id' => '26', 'menu_id' => '1', 'title' => 'مجال الدورات', 'url' => '/admin/courses-fields', 'target' => '_self', 'icon_class' => 'voyager-milestone', 'color' => '#000000', 'parent_id' => NULL, 'order' => '13', 'created_at' => '2016-12-11 22:23:40', 'updated_at' => '2016-12-27 12:04:09'),
                array('id' => '27', 'menu_id' => '1', 'title' => 'أنواع الدورات', 'url' => '/admin/courses-types', 'target' => '_self', 'icon_class' => 'voyager-categories', 'color' => '#000000', 'parent_id' => NULL, 'order' => '14', 'created_at' => '2016-12-11 22:25:30', 'updated_at' => '2016-12-27 12:04:09'),
                array('id' => '28', 'menu_id' => '1', 'title' => 'المناطق', 'url' => '/admin/regions', 'target' => '_self', 'icon_class' => 'voyager-down-circled', 'color' => '#000000', 'parent_id' => NULL, 'order' => '9', 'created_at' => '2016-12-11 22:30:29', 'updated_at' => '2016-12-27 17:40:24'),
                array('id' => '29', 'menu_id' => '1', 'title' => 'المشرفين', 'url' => '/admin/supervisors', 'target' => '_self', 'icon_class' => 'voyager-group', 'color' => '#000000', 'parent_id' => NULL, 'order' => '6', 'created_at' => '2016-12-14 15:36:34', 'updated_at' => '2016-12-27 12:04:09'),
                array('id' => '30', 'menu_id' => '1', 'title' => 'توزيع الصلاحيات', 'url' => '/admin/roles-permissions', 'target' => '_self', 'icon_class' => 'voyager-params', 'color' => '#000000', 'parent_id' => NULL, 'order' => '4', 'created_at' => '2016-12-14 15:43:10', 'updated_at' => '2016-12-27 12:04:09'),
                array('id' => '31', 'menu_id' => '1', 'title' => 'أماكن الدورات', 'url' => '/admin/venues', 'target' => '_self', 'icon_class' => 'voyager-thumb-tack', 'color' => '#000000', 'parent_id' => NULL, 'order' => '10', 'created_at' => '2016-12-14 15:51:08', 'updated_at' => '2016-12-27 12:04:09'),
                array('id' => '32', 'menu_id' => '1', 'title' => 'الصلاحيات', 'url' => '/admin/permissions', 'target' => '_self', 'icon_class' => 'voyager-key', 'color' => '#000000', 'parent_id' => NULL, 'order' => '3', 'created_at' => '2016-12-14 16:04:08', 'updated_at' => '2016-12-27 12:04:09'),
                array('id' => '33', 'menu_id' => '1', 'title' => 'الأدوار', 'url' => '/admin/roles', 'target' => '_self', 'icon_class' => 'voyager-lock', 'color' => '#000000', 'parent_id' => NULL, 'order' => '2', 'created_at' => '2016-12-14 16:06:13', 'updated_at' => '2016-12-27 12:04:09'),
                array('id' => '34', 'menu_id' => '1', 'title' => 'الطلاب', 'url' => '/admin/students', 'target' => '_self', 'icon_class' => 'voyager-study', 'color' => '#000000', 'parent_id' => NULL, 'order' => '7', 'created_at' => '2016-12-14 16:08:44', 'updated_at' => '2016-12-27 12:04:09'),
                array('id' => '35', 'menu_id' => '1', 'title' => 'المستخدمين', 'url' => '/admin/users', 'target' => '_self', 'icon_class' => 'voyager-person', 'color' => '#000000', 'parent_id' => NULL, 'order' => '5', 'created_at' => '2016-12-14 16:13:18', 'updated_at' => '2016-12-27 12:04:09'),
                array('id' => '39', 'menu_id' => '1', 'title' => 'المدرسين', 'url' => '/admin/teachers', 'target' => '_self', 'icon_class' => 'voyager-pen', 'color' => '#000000', 'parent_id' => NULL, 'order' => '15', 'created_at' => '2016-12-26 09:30:19', 'updated_at' => '2016-12-27 12:04:09')
            )
        );


    }
}
