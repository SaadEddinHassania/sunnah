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
                array('id' => '1', 'name' => 'developer', 'created_at' => '2016-05-19 18:31:14', 'updated_at' => '2016-12-14 09:32:20')
            )
        );


    }
}
