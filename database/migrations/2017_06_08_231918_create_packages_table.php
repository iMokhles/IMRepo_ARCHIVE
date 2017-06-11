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
            $table->string('Package')->nullable();
            $table->string('Source')->nullable();
            $table->string('Version')->nullable();
            $table->string('Priority')->nullable();
            $table->string('Section')->nullable();
            $table->string('Essential')->nullable();
            $table->string('Maintainer')->nullable();
            $table->string('Pre-Depends')->nullable();
            $table->string('Depends')->nullable();
            $table->string('Recommends')->nullable();
            $table->string('Suggests')->nullable();
            $table->string('Conflicts')->nullable();
            $table->string('Provides')->nullable();
            $table->string('Replaces')->nullable();
            $table->string('Enhances')->nullable();
            $table->string('Architecture')->nullable()->default("iphoneos-arm");
            $table->string('Filename')->nullable();
            $table->integer('Size')->nullable();
            $table->string('Installed-Size')->nullable();
            $table->string('Description')->nullable();
            $table->string('Multi')->nullable();
            $table->string('Origin')->nullable();
            $table->string('Bugs')->nullable();
            $table->string('Name')->nullable();
            $table->string('Author')->nullable();
            $table->string('Sponsor')->nullable();
            $table->string('Homepage')->nullable();
            $table->string('Website')->nullable();
            $table->string('Depiction')->nullable();
            $table->string('Icon')->nullable();
            $table->string('MD5sum')->nullable();
            $table->string('SHA1')->nullable();
            $table->string('SHA256')->nullable();
            $table->integer('Stat')->nullable();
            $table->string('Tag')->nullable();
            $table->string('UUID')->nullable();
            $table->float('Price')->nullable();
            $table->string('Purchase_Link')->nullable();
            $table->boolean('Purchase_Link_Stat')->nullable()->default(false);
            $table->string('Changelog_id')->nullable();
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
