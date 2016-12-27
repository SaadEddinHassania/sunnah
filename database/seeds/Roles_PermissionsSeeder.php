<?php

use Illuminate\Database\Seeder;

class Roles_PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('roles_permissions')->delete();

        \DB::table('roles_permissions')->insert(
            array(
                array('id' => '1', 'role_id' => '1', 'permission_id' => '1', 'global' => '1'),
                array('id' => '3', 'role_id' => '1', 'permission_id' => '2', 'global' => '1'),
                array('id' => '4', 'role_id' => '1', 'permission_id' => '3', 'global' => '1'),
                array('id' => '5', 'role_id' => '1', 'permission_id' => '4', 'global' => '1'),
                array('id' => '6', 'role_id' => '1', 'permission_id' => '5', 'global' => '1'),
                array('id' => '7', 'role_id' => '1', 'permission_id' => '6', 'global' => '1'),
                array('id' => '8', 'role_id' => '1', 'permission_id' => '7', 'global' => '1'),
                array('id' => '9', 'role_id' => '1', 'permission_id' => '11', 'global' => '1'),
                array('id' => '10', 'role_id' => '1', 'permission_id' => '8', 'global' => '1'),
                array('id' => '11', 'role_id' => '1', 'permission_id' => '9', 'global' => '1'),
                array('id' => '12', 'role_id' => '1', 'permission_id' => '12', 'global' => '1'),
                array('id' => '13', 'role_id' => '1', 'permission_id' => '10', 'global' => '1'),
                array('id' => '16', 'role_id' => '4', 'permission_id' => '1', 'global' => '0'),
                array('id' => '17', 'role_id' => '4', 'permission_id' => '2', 'global' => '0'),
                array('id' => '18', 'role_id' => '4', 'permission_id' => '3', 'global' => '0'),
                array('id' => '20', 'role_id' => '4', 'permission_id' => '6', 'global' => '0'),
                array('id' => '21', 'role_id' => '4', 'permission_id' => '11', 'global' => '0'),
                array('id' => '23', 'role_id' => '4', 'permission_id' => '5', 'global' => '0'),
                array('id' => '25', 'role_id' => '1', 'permission_id' => '23', 'global' => '0'),
                array('id' => '26', 'role_id' => '1', 'permission_id' => '14', 'global' => '1'),
                array('id' => '27', 'role_id' => '1', 'permission_id' => '15', 'global' => '0'),
                array('id' => '28', 'role_id' => '1', 'permission_id' => '16', 'global' => '1'),
                array('id' => '29', 'role_id' => '1', 'permission_id' => '17', 'global' => '1'),
                array('id' => '30', 'role_id' => '1', 'permission_id' => '18', 'global' => '0'),
                array('id' => '31', 'role_id' => '1', 'permission_id' => '19', 'global' => '0'),
                array('id' => '32', 'role_id' => '1', 'permission_id' => '20', 'global' => '0'),
                array('id' => '33', 'role_id' => '1', 'permission_id' => '21', 'global' => '0'),
                array('id' => '34', 'role_id' => '1', 'permission_id' => '22', 'global' => '0'),
                array('id' => '35', 'role_id' => '1', 'permission_id' => '24', 'global' => '1'),
                array('id' => '36', 'role_id' => '3', 'permission_id' => '1', 'global' => '0'),
                array('id' => '37', 'role_id' => '3', 'permission_id' => '2', 'global' => '0'),
                array('id' => '38', 'role_id' => '3', 'permission_id' => '3', 'global' => '0'),
                array('id' => '39', 'role_id' => '3', 'permission_id' => '4', 'global' => '0'),
                array('id' => '40', 'role_id' => '3', 'permission_id' => '14', 'global' => '0'),
                array('id' => '41', 'role_id' => '3', 'permission_id' => '15', 'global' => '0'),
                array('id' => '42', 'role_id' => '3', 'permission_id' => '16', 'global' => '0'),
                array('id' => '43', 'role_id' => '3', 'permission_id' => '17', 'global' => '0'),
                array('id' => '44', 'role_id' => '4', 'permission_id' => '4', 'global' => '0'),
                array('id' => '45', 'role_id' => '4', 'permission_id' => '7', 'global' => '0'),
                array('id' => '46', 'role_id' => '4', 'permission_id' => '15', 'global' => '0'),
                array('id' => '47', 'role_id' => '4', 'permission_id' => '16', 'global' => '0'),
                array('id' => '48', 'role_id' => '4', 'permission_id' => '17', 'global' => '0'),
                array('id' => '49', 'role_id' => '4', 'permission_id' => '27', 'global' => '0'),
                array('id' => '50', 'role_id' => '3', 'permission_id' => '27', 'global' => '0'),
                array('id' => '51', 'role_id' => '4', 'permission_id' => '25', 'global' => '0'),
                array('id' => '52', 'role_id' => '5', 'permission_id' => '5', 'global' => '0'),
                array('id' => '53', 'role_id' => '5', 'permission_id' => '14', 'global' => '0'),
                array('id' => '54', 'role_id' => '4', 'permission_id' => '5', 'global' => '0'),
                array('id' => '55', 'role_id' => '4', 'permission_id' => '14', 'global' => '0')
            )
        );
    }
}
