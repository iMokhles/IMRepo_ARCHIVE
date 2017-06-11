<?php

use Illuminate\Database\Seeder;

class RoleUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('role_users')->delete();
        
        \DB::table('role_users')->insert(array (
            0 => 
            array (
                'role_id' => 1,
                'user_id' => 1,
            ),
        ));
        
        
    }
}