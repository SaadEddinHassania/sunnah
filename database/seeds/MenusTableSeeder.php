<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('menus')->delete();

        \DB::table('menus')->insert(
            array(
                array('id' => '1', 'name' => 'developer', 'created_at' => '2016-05-19 18:31:14', 'updated_at' => '2016-12-14 09:32:20'),
                array('id' => '2', 'name' => 'admin', 'created_at' => '2016-05-19 19:55:51', 'updated_at' => '2016-05-19 19:55:51'),
                array('id' => '3', 'name' => 'teacher', 'created_at' => '2016-12-09 11:44:37', 'updated_at' => '2016-12-09 11:44:37'),
                array('id' => '4', 'name' => 'supervisor', 'created_at' => '2016-12-09 12:28:13', 'updated_at' => '2016-12-09 12:28:13')
            )
        );


    }
}
