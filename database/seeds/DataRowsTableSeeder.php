<?php

use Illuminate\Database\Seeder;

class DataRowsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('data_rows')->delete();
        
        \DB::table('data_rows')->insert(array (

            24 => 
            array (
                'id' => 36,
                'data_type_id' => 4,
                'field' => 'id',
                'type' => 'PRI',
                'display_name' => 'id',
                'required' => 1,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '',
            ),
            25 => 
            array (
                'id' => 37,
                'data_type_id' => 4,
                'field' => 'name',
                'type' => 'text',
                'display_name' => 'name',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
            ),
            26 => 
            array (
                'id' => 38,
                'data_type_id' => 4,
                'field' => 'email',
                'type' => 'text',
                'display_name' => 'email',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
            ),
            27 => 
            array (
                'id' => 39,
                'data_type_id' => 4,
                'field' => 'password',
                'type' => 'password',
                'display_name' => 'password',
                'required' => 1,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
            ),
            28 => 
            array (
                'id' => 40,
                'data_type_id' => 4,
                'field' => 'remember_token',
                'type' => 'text',
                'display_name' => 'remember_token',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '',
            ),
            29 => 
            array (
                'id' => 41,
                'data_type_id' => 4,
                'field' => 'created_at',
                'type' => 'timestamp',
                'display_name' => 'created_at',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 0,
                'delete' => 1,
                'details' => '',
            ),
            30 => 
            array (
                'id' => 42,
                'data_type_id' => 4,
                'field' => 'updated_at',
                'type' => 'timestamp',
                'display_name' => 'updated_at',
                'required' => 1,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '',
            ),
            31 => 
            array (
                'id' => 43,
                'data_type_id' => 4,
                'field' => 'avatar',
                'type' => 'image',
                'display_name' => 'avatar',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
            ),
            32 => 
            array (
                'id' => 44,
                'data_type_id' => 6,
                'field' => 'id',
                'type' => 'PRI',
                'display_name' => 'id',
                'required' => 1,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '',
            ),
            33 => 
            array (
                'id' => 45,
                'data_type_id' => 6,
                'field' => 'name',
                'type' => 'text',
                'display_name' => 'name',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
            ),
            34 => 
            array (
                'id' => 46,
                'data_type_id' => 6,
                'field' => 'created_at',
                'type' => 'timestamp',
                'display_name' => 'created_at',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 1,
                'add' => 0,
                'delete' => 1,
                'details' => '',
            ),
            35 => 
            array (
                'id' => 47,
                'data_type_id' => 6,
                'field' => 'updated_at',
                'type' => 'timestamp',
                'display_name' => 'updated_at',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '',
            ),

            43 => 
            array (
                'id' => 61,
                'data_type_id' => 8,
                'field' => 'id',
                'type' => 'PRI',
                'display_name' => 'id',
                'required' => 1,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '',
            ),
            44 => 
            array (
                'id' => 62,
                'data_type_id' => 8,
                'field' => 'name',
                'type' => 'text',
                'display_name' => 'Name',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
            ),
            45 => 
            array (
                'id' => 63,
                'data_type_id' => 8,
                'field' => 'created_at',
                'type' => 'timestamp',
                'display_name' => 'created_at',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '',
            ),
            46 => 
            array (
                'id' => 64,
                'data_type_id' => 8,
                'field' => 'updated_at',
                'type' => 'timestamp',
                'display_name' => 'updated_at',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '',
            ),
            47 => 
            array (
                'id' => 65,
                'data_type_id' => 8,
                'field' => 'display_name',
                'type' => 'text',
                'display_name' => 'Display Name',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
            ),

        ));
        
        
    }
}
