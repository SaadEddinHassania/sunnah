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

        \DB::table('data_rows')->insert(
            array(
                array('id' => '36', 'data_type_id' => '4', 'field' => 'id', 'type' => 'PRI', 'display_name' => 'id', 'required' => '1', 'browse' => '0', 'read' => '0', 'edit' => '0', 'add' => '0', 'delete' => '0', 'details' => ''),
                array('id' => '37', 'data_type_id' => '4', 'field' => 'name', 'type' => 'text', 'display_name' => 'name', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '38', 'data_type_id' => '4', 'field' => 'email', 'type' => 'text', 'display_name' => 'email', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '39', 'data_type_id' => '4', 'field' => 'password', 'type' => 'password', 'display_name' => 'password', 'required' => '1', 'browse' => '0', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '40', 'data_type_id' => '4', 'field' => 'remember_token', 'type' => 'text', 'display_name' => 'remember_token', 'required' => '0', 'browse' => '0', 'read' => '0', 'edit' => '0', 'add' => '0', 'delete' => '0', 'details' => ''),
                array('id' => '41', 'data_type_id' => '4', 'field' => 'created_at', 'type' => 'timestamp', 'display_name' => 'created_at', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '0', 'delete' => '1', 'details' => ''),
                array('id' => '42', 'data_type_id' => '4', 'field' => 'updated_at', 'type' => 'timestamp', 'display_name' => 'updated_at', 'required' => '1', 'browse' => '0', 'read' => '0', 'edit' => '0', 'add' => '0', 'delete' => '0', 'details' => ''),
                array('id' => '43', 'data_type_id' => '4', 'field' => 'avatar', 'type' => 'image', 'display_name' => 'avatar', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '44', 'data_type_id' => '6', 'field' => 'id', 'type' => 'PRI', 'display_name' => 'id', 'required' => '1', 'browse' => '0', 'read' => '0', 'edit' => '0', 'add' => '0', 'delete' => '0', 'details' => ''),
                array('id' => '45', 'data_type_id' => '6', 'field' => 'name', 'type' => 'text', 'display_name' => 'name', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '46', 'data_type_id' => '6', 'field' => 'created_at', 'type' => 'timestamp', 'display_name' => 'created_at', 'required' => '0', 'browse' => '0', 'read' => '0', 'edit' => '1', 'add' => '0', 'delete' => '1', 'details' => ''),
                array('id' => '47', 'data_type_id' => '6', 'field' => 'updated_at', 'type' => 'timestamp', 'display_name' => 'updated_at', 'required' => '0', 'browse' => '0', 'read' => '0', 'edit' => '0', 'add' => '0', 'delete' => '0', 'details' => ''),
                array('id' => '61', 'data_type_id' => '8', 'field' => 'id', 'type' => 'PRI', 'display_name' => 'id', 'required' => '1', 'browse' => '0', 'read' => '0', 'edit' => '0', 'add' => '0', 'delete' => '0', 'details' => ''),
                array('id' => '62', 'data_type_id' => '8', 'field' => 'name', 'type' => 'text', 'display_name' => 'Name', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '63', 'data_type_id' => '8', 'field' => 'created_at', 'type' => 'timestamp', 'display_name' => 'created_at', 'required' => '0', 'browse' => '0', 'read' => '0', 'edit' => '0', 'add' => '0', 'delete' => '0', 'details' => ''),
                array('id' => '64', 'data_type_id' => '8', 'field' => 'updated_at', 'type' => 'timestamp', 'display_name' => 'updated_at', 'required' => '0', 'browse' => '0', 'read' => '0', 'edit' => '0', 'add' => '0', 'delete' => '0', 'details' => ''),
                array('id' => '65', 'data_type_id' => '8', 'field' => 'display_name', 'type' => 'text', 'display_name' => 'Display Name', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '66', 'data_type_id' => '9', 'field' => 'id', 'type' => 'PRI', 'display_name' => 'id', 'required' => '1', 'browse' => '0', 'read' => '0', 'edit' => '0', 'add' => '0', 'delete' => '0', 'details' => ''),
                array('id' => '67', 'data_type_id' => '9', 'field' => 'sn', 'type' => 'hidden', 'display_name' => 'sn', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '68', 'data_type_id' => '9', 'field' => 'name', 'type' => 'text', 'display_name' => 'name', 'required' => '0', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '69', 'data_type_id' => '9', 'field' => 'supervisor_id', 'type' => 'select_dropdown', 'display_name' => 'supervisor', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '70', 'data_type_id' => '9', 'field' => 'teacher_id', 'type' => 'select_dropdown', 'display_name' => 'teacher', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '71', 'data_type_id' => '9', 'field' => 'region_id', 'type' => 'select_dropdown', 'display_name' => 'region', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '0', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '72', 'data_type_id' => '9', 'field' => 'venue_id', 'type' => 'select_dropdown', 'display_name' => 'venue', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '73', 'data_type_id' => '9', 'field' => 'field_id', 'type' => 'select_dropdown', 'display_name' => 'field', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '74', 'data_type_id' => '9', 'field' => 'type_id', 'type' => 'select_dropdown', 'display_name' => 'type', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '75', 'data_type_id' => '9', 'field' => 'grade', 'type' => 'text', 'display_name' => 'grade', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '76', 'data_type_id' => '9', 'field' => 'details', 'type' => 'text_area', 'display_name' => 'details', 'required' => '0', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '77', 'data_type_id' => '9', 'field' => 'start_date', 'type' => 'date', 'display_name' => 'start date', 'required' => '0', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '78', 'data_type_id' => '9', 'field' => 'finish_date', 'type' => 'date', 'display_name' => 'finish date', 'required' => '0', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '79', 'data_type_id' => '9', 'field' => 'created_at', 'type' => 'timestamp', 'display_name' => 'created_at', 'required' => '0', 'browse' => '0', 'read' => '0', 'edit' => '0', 'add' => '0', 'delete' => '0', 'details' => ''),
                array('id' => '80', 'data_type_id' => '9', 'field' => 'updated_at', 'type' => 'timestamp', 'display_name' => 'updated_at', 'required' => '0', 'browse' => '0', 'read' => '0', 'edit' => '0', 'add' => '0', 'delete' => '0', 'details' => ''),
                array('id' => '81', 'data_type_id' => '9', 'field' => 'year', 'type' => 'hidden', 'display_name' => 'year', 'required' => '1', 'browse' => '0', 'read' => '0', 'edit' => '0', 'add' => '1', 'delete' => '0', 'details' => ''),
                array('id' => '82', 'data_type_id' => '10', 'field' => 'id', 'type' => 'PRI', 'display_name' => 'id', 'required' => '1', 'browse' => '0', 'read' => '0', 'edit' => '0', 'add' => '0', 'delete' => '0', 'details' => ''),
                array('id' => '83', 'data_type_id' => '10', 'field' => 'user_id', 'type' => 'text', 'display_name' => 'user_id', 'required' => '1', 'browse' => '0', 'read' => '0', 'edit' => '0', 'add' => '0', 'delete' => '0', 'details' => ''),
                array('id' => '84', 'data_type_id' => '10', 'field' => 'name', 'type' => 'text', 'display_name' => 'name', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '85', 'data_type_id' => '10', 'field' => 'email', 'type' => 'text', 'display_name' => 'email', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '86', 'data_type_id' => '10', 'field' => 'password', 'type' => 'password', 'display_name' => 'password', 'required' => '1', 'browse' => '0', 'read' => '0', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '87', 'data_type_id' => '10', 'field' => 'region_id', 'type' => 'select_dropdown', 'display_name' => 'region', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '0', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '88', 'data_type_id' => '10', 'field' => 'personal_id', 'type' => 'text', 'display_name' => 'personal id', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '89', 'data_type_id' => '10', 'field' => 'mobile', 'type' => 'text', 'display_name' => 'mobile', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '90', 'data_type_id' => '10', 'field' => 'dob', 'type' => 'date', 'display_name' => 'Date of birth', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '91', 'data_type_id' => '10', 'field' => 'qualification_id', 'type' => 'select_dropdown', 'display_name' => 'qualification', 'required' => '0', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '92', 'data_type_id' => '10', 'field' => 'specialization_id', 'type' => 'select_dropdown', 'display_name' => 'specialization', 'required' => '0', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '93', 'data_type_id' => '10', 'field' => 'address', 'type' => 'text', 'display_name' => 'address', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '94', 'data_type_id' => '11', 'field' => 'id', 'type' => 'PRI', 'display_name' => 'id', 'required' => '1', 'browse' => '0', 'read' => '0', 'edit' => '0', 'add' => '0', 'delete' => '0', 'details' => ''),
                array('id' => '95', 'data_type_id' => '11', 'field' => 'user_id', 'type' => 'text', 'display_name' => 'user_id', 'required' => '1', 'browse' => '0', 'read' => '0', 'edit' => '0', 'add' => '0', 'delete' => '0', 'details' => ''),
                array('id' => '96', 'data_type_id' => '11', 'field' => 'name', 'type' => 'text', 'display_name' => 'name', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '97', 'data_type_id' => '11', 'field' => 'email', 'type' => 'text', 'display_name' => 'email', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '98', 'data_type_id' => '11', 'field' => 'password', 'type' => 'password', 'display_name' => 'password', 'required' => '1', 'browse' => '0', 'read' => '0', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '99', 'data_type_id' => '11', 'field' => 'region_id', 'type' => 'select_dropdown', 'display_name' => 'region', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '0', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '100', 'data_type_id' => '11', 'field' => 'role_id', 'type' => 'select_dropdown', 'display_name' => 'role', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '101', 'data_type_id' => '11', 'field' => 'personal_id', 'type' => 'text', 'display_name' => 'personal id', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '102', 'data_type_id' => '11', 'field' => 'mobile', 'type' => 'text', 'display_name' => 'mobile', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '103', 'data_type_id' => '11', 'field' => 'dob', 'type' => 'date', 'display_name' => 'Date of birth', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '104', 'data_type_id' => '11', 'field' => 'qualification_id', 'type' => 'select_dropdown', 'display_name' => 'qualification', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '105', 'data_type_id' => '11', 'field' => 'specialization_id', 'type' => 'select_dropdown', 'display_name' => 'specialization', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '106', 'data_type_id' => '11', 'field' => 'address', 'type' => 'text', 'display_name' => 'address', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '107', 'data_type_id' => '13', 'field' => 'id', 'type' => 'PRI', 'display_name' => 'id', 'required' => '1', 'browse' => '0', 'read' => '0', 'edit' => '0', 'add' => '0', 'delete' => '0', 'details' => ''),
                array('id' => '108', 'data_type_id' => '13', 'field' => 'name', 'type' => 'text', 'display_name' => 'name', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '109', 'data_type_id' => '13', 'field' => 'created_at', 'type' => 'timestamp', 'display_name' => 'created_at', 'required' => '0', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '0', 'delete' => '1', 'details' => ''),
                array('id' => '110', 'data_type_id' => '13', 'field' => 'updated_at', 'type' => 'timestamp', 'display_name' => 'updated_at', 'required' => '0', 'browse' => '0', 'read' => '0', 'edit' => '0', 'add' => '0', 'delete' => '0', 'details' => ''),
                array('id' => '111', 'data_type_id' => '14', 'field' => 'id', 'type' => 'PRI', 'display_name' => 'id', 'required' => '1', 'browse' => '0', 'read' => '0', 'edit' => '0', 'add' => '0', 'delete' => '0', 'details' => ''),
                array('id' => '112', 'data_type_id' => '14', 'field' => 'name', 'type' => 'text', 'display_name' => 'name', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '113', 'data_type_id' => '14', 'field' => 'created_at', 'type' => 'timestamp', 'display_name' => 'created_at', 'required' => '0', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '0', 'delete' => '1', 'details' => ''),
                array('id' => '114', 'data_type_id' => '14', 'field' => 'updated_at', 'type' => 'timestamp', 'display_name' => 'updated_at', 'required' => '0', 'browse' => '0', 'read' => '0', 'edit' => '0', 'add' => '0', 'delete' => '0', 'details' => ''),
                array('id' => '115', 'data_type_id' => '15', 'field' => 'id', 'type' => 'PRI', 'display_name' => 'id', 'required' => '1', 'browse' => '0', 'read' => '0', 'edit' => '0', 'add' => '0', 'delete' => '0', 'details' => ''),
                array('id' => '116', 'data_type_id' => '15', 'field' => 'name', 'type' => 'text', 'display_name' => 'name', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '117', 'data_type_id' => '16', 'field' => 'id', 'type' => 'PRI', 'display_name' => 'id', 'required' => '1', 'browse' => '0', 'read' => '0', 'edit' => '0', 'add' => '0', 'delete' => '0', 'details' => ''),
                array('id' => '118', 'data_type_id' => '16', 'field' => 'name', 'type' => 'text', 'display_name' => 'name', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '119', 'data_type_id' => '16', 'field' => 'created_at', 'type' => 'timestamp', 'display_name' => 'created_at', 'required' => '0', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '0', 'delete' => '1', 'details' => ''),
                array('id' => '120', 'data_type_id' => '16', 'field' => 'updated_at', 'type' => 'timestamp', 'display_name' => 'updated_at', 'required' => '0', 'browse' => '0', 'read' => '0', 'edit' => '0', 'add' => '0', 'delete' => '0', 'details' => ''),
                array('id' => '121', 'data_type_id' => '17', 'field' => 'id', 'type' => 'PRI', 'display_name' => 'id', 'required' => '1', 'browse' => '0', 'read' => '0', 'edit' => '0', 'add' => '0', 'delete' => '0', 'details' => ''),
                array('id' => '122', 'data_type_id' => '17', 'field' => 'name', 'type' => 'text', 'display_name' => 'name', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '130', 'data_type_id' => '19', 'field' => 'id', 'type' => 'PRI', 'display_name' => 'id', 'required' => '1', 'browse' => '0', 'read' => '0', 'edit' => '0', 'add' => '0', 'delete' => '0', 'details' => ''),
                array('id' => '131', 'data_type_id' => '19', 'field' => 'display_name', 'type' => 'text', 'display_name' => 'name', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '132', 'data_type_id' => '19', 'field' => 'func_name', 'type' => 'text', 'display_name' => 'function name', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '133', 'data_type_id' => '19', 'field' => 'policy_name', 'type' => 'text', 'display_name' => 'policy name', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '134', 'data_type_id' => '19', 'field' => 'created_at', 'type' => 'timestamp', 'display_name' => 'created_at', 'required' => '0', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '0', 'delete' => '1', 'details' => ''),
                array('id' => '135', 'data_type_id' => '19', 'field' => 'updated_at', 'type' => 'timestamp', 'display_name' => 'updated_at', 'required' => '0', 'browse' => '0', 'read' => '0', 'edit' => '0', 'add' => '0', 'delete' => '0', 'details' => ''),
                array('id' => '136', 'data_type_id' => '20', 'field' => 'role_id', 'type' => 'PRI', 'display_name' => 'role', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '137', 'data_type_id' => '20', 'field' => 'permission_id', 'type' => 'PRI', 'display_name' => 'permission', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '138', 'data_type_id' => '20', 'field' => 'global', 'type' => 'checkbox', 'display_name' => 'global', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '139', 'data_type_id' => '21', 'field' => 'id', 'type' => 'PRI', 'display_name' => 'id', 'required' => '1', 'browse' => '0', 'read' => '0', 'edit' => '0', 'add' => '0', 'delete' => '0', 'details' => ''),
                array('id' => '140', 'data_type_id' => '21', 'field' => 'name', 'type' => 'text', 'display_name' => 'name', 'required' => '1', 'browse' => '1', 'read' => '1', 'edit' => '1', 'add' => '1', 'delete' => '1', 'details' => ''),
                array('id' => '141', 'data_type_id' => '21', 'field' => 'created_at', 'type' => 'timestamp', 'display_name' => 'created at', 'required' => '0', 'browse' => '1', 'read' => '1', 'edit' => '0', 'add' => '0', 'delete' => '0', 'details' => ''),
                array('id' => '142', 'data_type_id' => '21', 'field' => 'updated_at', 'type' => 'timestamp', 'display_name' => 'updated_at', 'required' => '0', 'browse' => '0', 'read' => '0', 'edit' => '0', 'add' => '0', 'delete' => '0', 'details' => '')
            )
        );


    }
}
