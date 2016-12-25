<?php

use Illuminate\Database\Seeder;

class CourseTypeTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('roles')->delete();

        \DB::table('roles')->insert(
            array(
                array('id' => '1','name' => 'حتى 12 ساعة','created_at' => '2016-12-20 20:44:21','updated_at' => '2016-12-20 20:44:21'),
                array('id' => '2','name' => 'من 13 الى 24 ساعة','created_at' => '2016-12-20 20:44:26','updated_at' => '2016-12-20 20:44:31'),
                array('id' => '3','name' => 'من 25 الى 48 ساعة','created_at' => '2016-12-01 00:00:00','updated_at' => '2016-12-01 00:00:00')
            )
        );
    }
}
