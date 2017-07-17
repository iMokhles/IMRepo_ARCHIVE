<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->increments('id');
            $table->longtext('Package')->nullable();
            $table->longtext('Source')->nullable();
            $table->longtext('Version')->nullable();
            $table->longtext('Priority')->nullable();
            $table->longtext('Section')->nullable();
            $table->longtext('Essential')->nullable();
            $table->longtext('Maintainer')->nullable();
            $table->longtext('Pre-Depends')->nullable();
            $table->longtext('Depends')->nullable();
            $table->longtext('Recommends')->nullable();
            $table->longtext('Suggests')->nullable();
            $table->longtext('Conflicts')->nullable();
            $table->longtext('Provides')->nullable();
            $table->longtext('Replaces')->nullable();
            $table->longtext('Enhances')->nullable();
            $table->string('Architecture')->nullable()->default("iphoneos-arm");
            $table->longtext('Filename')->nullable();
            $table->bigInteger('Size')->nullable();
            $table->longtext('Installed-Size')->nullable();
            $table->longtext('Description')->nullable();
            $table->longtext('Multi')->nullable();
            $table->longtext('Origin')->nullable();
            $table->longtext('Bugs')->nullable();
            $table->longtext('Name')->nullable();
            $table->longtext('Author')->nullable();
            $table->longtext('Sponsor')->nullable();
            $table->longtext('Homepage')->nullable();
            $table->longtext('Website')->nullable();
            $table->longtext('Depiction')->nullable();
            $table->longtext('Icon')->nullable();
            $table->longtext('MD5sum')->nullable();
            $table->longtext('SHA1')->nullable();
            $table->longtext('SHA256')->nullable();
            $table->boolean('Stat')->nullable();
            $table->longtext('Tag')->nullable();
            $table->longtext('UUID')->nullable();
            $table->string('Price')->nullable()->default();
            $table->longtext('Purchase_Link')->nullable();
            $table->boolean('Purchase_Link_Stat')->nullable()->default(false);
            $table->longtext('Changelog_id')->nullable();
            $table->integer('Downloads')->nullable();
            $table->string('package_hash')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('packages');
    }
}
