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
                array('id' => '1', 'name' => 'admin', 'display_name' => 'رئيس دائرة', 'created_at' => '2016-10-21 22:31:20', 'updated_at' => '2016-12-27 19:33:08'),
                array('id' => '3', 'name' => 'teacher', 'display_name' => 'مدرس', 'created_at' => '2016-12-05 00:00:00', 'updated_at' => '2016-12-27 19:33:16'),
                array('id' => '4', 'name' => 'supervisor', 'display_name' => 'مشرف ميداني', 'created_at' => '2016-12-08 00:00:00', 'updated_at' => '2016-12-27 19:33:25'),
                array('id' => '5', 'name' => 'region_manager', 'display_name' => 'مدير منطقة', 'created_at' => '2016-12-21 19:40:23', 'updated_at' => '2016-12-27 19:33:54')
            )
        );


    }
}
