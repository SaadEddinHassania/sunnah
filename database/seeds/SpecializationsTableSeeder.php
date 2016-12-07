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
        
        \DB::table('specializations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'تكنولوجيا المعلومات'
            ),
        ));
        
        
    }
}
