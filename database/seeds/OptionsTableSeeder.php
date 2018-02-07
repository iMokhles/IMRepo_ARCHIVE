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
            'key'           => 'release_origin',
            'name'          => 'iMokhles',
            'description'   => 'Repo Origin',
            'value'         => 'iMokhles',
            'field'         => '{"name":"value","label":"Value", "title":"iMokhles" ,"type":"text"}',
            'active'        => 1,

        ]);

        DB::table('settings')->insert([
            'key'           => 'release_label',
            'name'          => 'iMokhles repo',
            'description'   => 'Repo Label',
            'value'         => 'iMokhles repo',
            'field'         => '{"name":"value","label":"Value", "title":"iMokhles repo" ,"type":"text"}',
            'active'        => 1,

        ]);

        DB::table('settings')->insert([
            'key'           => 'release_version',
            'name'          => '1.0',
            'description'   => 'Repo Version',
            'value'         => '1.0',
            'field'         => '{"name":"value","label":"Value", "title":"Version 1.0" ,"type":"text"}',
            'active'        => 1,

        ]);

        DB::table('settings')->insert([
            'key'           => 'release_description',
            'name'          => 'iMokhles Personal Repo',
            'description'   => 'Repo Description',
            'value'         => 'iMokhles Personal Repo',
            'field'         => '{"name":"value","label":"Value", "title":"iMokhles Personal Repo" ,"type":"text"}',
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

        DB::table('settings')->insert([
            'key'           => 'enable_auto_build',
            'name'          => 'Enable Auto Build',
            'description'   => 'Auto build packages once you upload new debs',
            'value'         => true,
            'field'         => '{"name":"value","label":"Value", "title":"IMRepo" ,"type":"checkbox"}',
            'active'        => 1,

        ]);

        DB::table('settings')->insert([
            'key'           => 'support_url',
            'name'          => 'Support Url in Depiction',
            'description'   => 'Support url which will appear in depiction page',
            'value'         => "http://imokhles.com",
            'field'         => '{"name":"value","label":"Support URL", "title":"IMRepo" ,"type":"text"}',
            'active'        => 1,

        ]);

        DB::table('settings')->insert([
            'key'           => 'donate_url',
            'name'          => 'Donate Url in Depiction',
            'description'   => 'Donate url which will appear in depiction page',
            'value'         => "http://imokhles.com",
            'field'         => '{"name":"value","label":"Support URL", "title":"IMRepo" ,"type":"text"}',
            'active'        => 1,

        ]);

        DB::table('settings')->insert([
            'key'           => 'site_url',
            'name'          => 'Site Url in Depiction',
            'description'   => 'Site url which will appear in depiction page',
            'value'         => "http://imokhles.com",
            'field'         => '{"name":"value","label":"Support URL", "title":"IMRepo" ,"type":"text"}',
            'active'        => 1,

        ]);
    }
}
