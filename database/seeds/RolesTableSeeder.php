<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'super_admin',
                'created_at' => '2017-06-09 10:14:47',
                'updated_at' => '2017-06-09 10:14:47',
            ),
        ));
        
        
    }
}