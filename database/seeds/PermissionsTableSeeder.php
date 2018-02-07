<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Create',
                'created_at' => '2017-06-09 10:14:22',
                'updated_at' => '2017-06-09 10:14:22',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Read',
                'created_at' => '2017-06-09 10:14:29',
                'updated_at' => '2017-06-09 10:14:29',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Update',
                'created_at' => '2017-06-09 10:14:32',
                'updated_at' => '2017-06-09 10:14:32',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Delete',
                'created_at' => '2017-06-09 10:14:36',
                'updated_at' => '2017-06-09 10:14:36',
            ),
        ));
        
        
    }
}