<?php

use Illuminate\Database\Seeder;

class SupervisorsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('supervisors')->delete();

        \DB::table('supervisors')->insert(array());


    }
}
