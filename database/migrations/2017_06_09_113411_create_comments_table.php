<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('package_id')->unsigned()->index();
            $table->string('commentable_type')->nullable();
            $table->index(['commentable_type']);

            $table->bigInteger('user_id')->unsigned()->index();
            $table->string('commented_type')->nullable();
            $table->index(['commented_type']);

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('package_id')
                ->references('id')
                ->on('packages')
                ->onDelete('cascade');

            $table->longText('comment');
            $table->boolean('approved')->default(true);
            $table->boolean('is_reply')->default(false);
            $table->bigInteger('comment_id')->unsigned()->nullable();
            $table->double('rate', 15, 8)->nullable();
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
        Schema::dropIfExists('comments');
    }
}
