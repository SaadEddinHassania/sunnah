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

        \DB::table('menu_items')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'menu_id' => 2,
                    'title' => 'Dashboard',
                    'url' => "/{$prefix}",
                    'target' => '_self',
                    'icon_class' => 'voyager-boat',
                    'color' => NULL,
                    'parent_id' => NULL,
                    'order' => 1,
                    'created_at' => '2016-05-31 22:17:38',
                    'updated_at' => '2016-06-01 20:24:01',
                ),
            1 =>
                array(
                    'id' => 2,
                    'menu_id' => 2,
                    'title' => 'Media',
                    'url' => "/{$prefix}/media",
                    'target' => '_self',
                    'icon_class' => 'voyager-images',
                    'color' => NULL,
                    'parent_id' => NULL,
                    'order' => 5,
                    'created_at' => '2016-05-31 22:18:08',
                    'updated_at' => '2016-06-01 20:24:01',
                ),
            2 =>
                array(
                    'id' => 4,
                    'menu_id' => 2,
                    'title' => 'Users',
                    'url' => "/{$prefix}/users",
                    'target' => '_self',
                    'icon_class' => 'voyager-person',
                    'color' => NULL,
                    'parent_id' => NULL,
                    'order' => 3,
                    'created_at' => '2016-05-31 22:19:16',
                    'updated_at' => '2016-05-31 22:20:07',
                ),

            3 =>
                array(
                    'id' => 7,
                    'menu_id' => 2,
                    'title' => 'Roles',
                    'url' => "/{$prefix}/roles",
                    'target' => '_self',
                    'icon_class' => 'voyager-lock',
                    'color' => NULL,
                    'parent_id' => NULL,
                    'order' => 2,
                    'created_at' => '2016-10-21 19:14:25',
                    'updated_at' => '2016-10-24 00:44:07',
                ),
            4 =>
                array('id' => '8', 'menu_id' => '2', 'title' => 'Courses', 'url' => "/{$prefix}/courses", 'target' => '_self', 'icon_class' => 'voyager-receipt', 'color' => '#000000', 'parent_id' => NULL, 'order' => '4', 'created_at' => '2016-12-07 00:10:59', 'updated_at' => '2016-12-07 00:11:33'),
        ));


    }
}
