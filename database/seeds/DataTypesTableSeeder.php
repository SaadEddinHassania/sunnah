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
        
        \DB::table('data_types')->insert(array (

            2 =>
            array (
                'id' => 4,
                'name' => 'users',
                'slug' => 'users',
                'display_name_singular' => 'User',
                'display_name_plural' => 'Users',
                'icon' => 'voyager-person',
                'model_name' => 'TCG\\Voyager\\Models\\User',
                'description' => '',
                'created_at' => '2016-01-27 19:43:51',
                'updated_at' => '2016-02-03 02:07:20',
            ),

            4 =>
            array (
                'id' => 6,
                'name' => 'menus',
                'slug' => 'menus',
                'display_name_singular' => 'Menu',
                'display_name_plural' => 'Menus',
                'icon' => 'voyager-list',
                'model_name' => 'TCG\\Voyager\\Models\\Menu',
                'description' => '',
                'created_at' => NULL,
                'updated_at' => '2016-06-29 00:09:35',
            ),
            5 =>
            array (
                'id' => 8,
                'name' => 'roles',
                'slug' => 'roles',
                'display_name_singular' => 'Role',
                'display_name_plural' => 'Roles',
                'icon' => 'voyager-lock',
                'model_name' => 'TCG\\Voyager\\Models\\Role',
                'description' => '',
                'created_at' => '2016-10-21 22:09:45',
                'updated_at' => '2016-10-21 22:09:45',
            ),
        ));
        
        
    }
}
