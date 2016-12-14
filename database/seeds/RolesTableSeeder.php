<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('roles')->delete();

        \DB::table('roles')->insert(
            array(
                array('id' => '1', 'name' => 'admin', 'display_name' => 'Administrator', 'created_at' => '2016-10-21 22:31:20', 'updated_at' => '2016-10-21 22:31:20'),
                array('id' => '3', 'name' => 'teacher', 'display_name' => 'Teacher', 'created_at' => '2016-12-05 00:00:00', 'updated_at' => '2016-12-05 00:00:00'),
                array('id' => '4', 'name' => 'supervisor', 'display_name' => 'Supervisor', 'created_at' => '2016-12-08 00:00:00', 'updated_at' => '2016-12-08 00:00:00')
            )
        );


    }
}
