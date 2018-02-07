<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
            'name'           => 'Repo Admin',
            'password'          => bcrypt("a98df7yhsbdf"),
            'email'   => "demo@example.com",
            'is_admin' => true,
            'created_at' => Carbon::now(),
            ]
        );

        DB::table('users')->insert(
            [
                'name'           => 'Mokhlas Hussein',
                'password'          => bcrypt("123456"),
                'email'   => "mokhleshussien@aol.com",
                'is_admin' => false,
                'created_at' => Carbon::now(),
            ]
        );
    }
}
