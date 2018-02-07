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
        $this->call(OptionsTableSeeder::class);
        $this->call(LangsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PermissionRolesTableSeeder::class);
        $this->call(PermissionUsersTableSeeder::class);
        $this->call(RoleUsersTableSeeder::class);
        // still empty
        $this->call(PackagesTableSeeder::class);
        $this->call(RatesTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(CommentsAnswersTableSeeder::class);
    }
}
