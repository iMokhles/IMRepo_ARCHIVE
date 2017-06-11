<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->string('user_id')->index('user_id')->nullable();
            $table->integer('package_id')->index('package_id')->nullable();
            $table->string('email')->nullable();
            $table->text('comment')->nullable();
            $table->string('type')->nullable();
            $table->string('transactionId')->nullable();
            $table->text('linked_devices')->nullable();
            $table->bigInteger('ip')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
