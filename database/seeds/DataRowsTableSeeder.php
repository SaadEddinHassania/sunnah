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

        \DB::table('data_rows')->insert(array(

            24 =>
                array(
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
                array(
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
                array(
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
                array(
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
                array(
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
                array(
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
                array(
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
                array(
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
                array(
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
                array(
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
                array(
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
                array(
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
                array(
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
                array(
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
                array(
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
                array(
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
                array(
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
            48 =>
                array(
                    'id' => 66,
                    'data_type_id' => 9,
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
            49 =>
                array(
                    'id' => 67,
                    'data_type_id' => 9,
                    'field' => 'sn',
                    'type' => 'hidden',
                    'display_name' => 'SN',
                    'required' => 1,
                    'browse' => 1,
                    'read' => 1,
                    'edit' => 1,
                    'add' => 1,
                    'delete' => 1,
                    'details' => '',
                ),
            50 => array('id' => '68', 'data_type_id' => '9', 'field' => 'name', 'type' => 'text', 'display_name' => 'name', 'required' => '0', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
            51 => array('id' => '69', 'data_type_id' => '9', 'field' => 'supervisor_id', 'type' => 'select_dropdown', 'display_name' => 'supervisor', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
            52 => array('id' => '70', 'data_type_id' => '9', 'field' => 'teacher_id', 'type' => 'select_dropdown', 'display_name' => 'teacher', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
            53 => array('id' => '71', 'data_type_id' => '9', 'field' => 'region_id', 'type' => 'select_dropdown', 'display_name' => 'region', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '0', 'add' => '1', 'delete' => '1', 'details' => ''),
            54 => array('id' => '72', 'data_type_id' => '9', 'field' => 'venue_id', 'type' => 'select_dropdown', 'display_name' => 'venue', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
            55 => array('id' => '73', 'data_type_id' => '9', 'field' => 'field_id', 'type' => 'select_dropdown', 'display_name' => 'field', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
            56 => array('id' => '74', 'data_type_id' => '9', 'field' => 'type_id', 'type' => 'select_dropdown', 'display_name' => 'type', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
            57 => array('id' => '75', 'data_type_id' => '9', 'field' => 'grade', 'type' => 'text', 'display_name' => 'grade', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
            58 => array('id' => '76', 'data_type_id' => '9', 'field' => 'details', 'type' => 'text_area', 'display_name' => 'details', 'required' => '0', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
            59 => array('id' => '77', 'data_type_id' => '9', 'field' => 'start_date', 'type' => 'date', 'display_name' => 'start date', 'required' => '0', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
            60 => array('id' => '78', 'data_type_id' => '9', 'field' => 'finish_date', 'type' => 'date', 'display_name' => 'finish date', 'required' => '0', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
            61 => array('id' => '79', 'data_type_id' => '9', 'field' => 'created_at', 'type' => 'timestamp', 'display_name' => 'created_at', 'required' => '0', 'browse' => '0', 'read' => '0', 'edit' => '0', 'add' => '0', 'delete' => '0', 'details' => ''),
            62 => array('id' => '80', 'data_type_id' => '9', 'field' => 'updated_at', 'type' => 'timestamp', 'display_name' => 'updated_at', 'required' => '0', 'browse' => '0', 'read' => '0', 'edit' => '0', 'add' => '0', 'delete' => '0', 'details' => ''),
            63 => array('id' => '81', 'data_type_id' => '9', 'field' => 'year', 'type' => 'hidden', 'display_name' => 'year', 'required' => '1', 'browse' => '0', 'read' => '0', 'edit' => '0', 'add' => '1', 'delete' => '0', 'details' => '')

        ));


    }
}
