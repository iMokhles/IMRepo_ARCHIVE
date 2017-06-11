<?php

use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'key'           => 'site_title',
            'name'          => 'IMRepo',
            'description'   => 'Site Tile',
            'value'         => 'IMRepo',
            'field'         => '{"name":"value","label":"Value", "title":"IMRepo" ,"type":"text"}',
            'active'        => 1,

        ]);

        DB::table('settings')->insert([
            'key'           => 'allow_protection',
            'name'          => 'Allow Protection',
            'description'   => 'Allow protection with UDIDs',
            'value'         => true,
            'field'         => '{"name":"value","label":"Value", "title":"IMRepo" ,"type":"checkbox"}',
            'active'        => 1,

        ]);
    }
}
