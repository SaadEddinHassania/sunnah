<?php

use Illuminate\Database\Seeder;

class SpecializationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('specializations')->delete();

        \DB::table('specializations')->insert(
            array(
                array('id' => 1, 'name' => 'تكنولوجيا المعلومات'),
            )
        );


    }
}
