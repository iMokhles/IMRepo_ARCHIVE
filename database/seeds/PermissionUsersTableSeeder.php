<?php

use Illuminate\Database\Seeder;

class PermissionUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permission_users')->delete();
        
        
        
    }
}