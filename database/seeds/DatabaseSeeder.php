<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(MenuItemsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(DataTypesTableSeeder::class);
        $this->call(DataRowsTableSeeder::class);
        $this->call(RegionsTableSeeder::class);
        $this->call(SpecializationsTableSeeder::class);
        $this->call(QualificationsTableSeeder::class);
        $this->call(SupervisorsTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(Roles_PermissionsSeeder::class);

    }
}
