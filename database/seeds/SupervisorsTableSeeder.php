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
        
        \DB::table('supervisors')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'region_id' => 1,
                'role_id' => 1,
                'personal_id' => '400672150',
                'mobile' => '0598296990',
                'dob' => '1995-04-29',
                'qualification_id' => 1,
                'specialization_id' => 1,
                'address' => 'غزة الرمال',
                'created_at' => '2016-01-28 11:20:57',
                'updated_at' => '2016-10-25 14:32:23',
            ),
        ));
        
        
    }
}
