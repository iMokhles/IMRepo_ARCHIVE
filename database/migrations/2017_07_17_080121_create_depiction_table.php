<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepictionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depictions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('package_id')->index('package_id')->nullable();
            $table->longText('long_description')->nullable();
            $table->string('mini_ios')->nullable();
            $table->string('max_ios')->nullable();
            $table->string('price')->nullable();
            $table->string('devices_support')->nullable();
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
        Schema::dropIfExists('depictions');
    }
}
