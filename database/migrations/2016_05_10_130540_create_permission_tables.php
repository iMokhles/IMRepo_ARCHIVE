<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePermissionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $config = config('laravel-permission.table_names');

        Schema::create($config['roles'], function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create($config['permissions'], function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create($config['user_has_permissions'], function (Blueprint $table) use ($config) {
            $table->bigInteger('user_id')->unsigned()->index();
            $table->bigInteger('permission_id')->unsigned()->index();

            $table->foreign('user_id')
                ->references('id')
                ->on($config['users'])
                ->onDelete('cascade');

            $table->foreign('permission_id')
                ->references('id')
                ->on($config['permissions'])
                ->onDelete('cascade');

            $table->primary(['user_id', 'permission_id']);
        });

        Schema::create($config['user_has_roles'], function (Blueprint $table) use ($config) {
            $table->bigInteger('role_id')->unsigned()->index();
            $table->bigInteger('user_id')->unsigned()->index();

            $table->foreign('role_id')
                ->references('id')
                ->on($config['roles'])
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on($config['users'])
                ->onDelete('cascade');

            $table->primary(['role_id', 'user_id']);

            Schema::create($config['role_has_permissions'], function (Blueprint $table) use ($config) {
                $table->bigInteger('permission_id')->unsigned()->index();
                $table->bigInteger('role_id')->unsigned()->index();

                $table->foreign('permission_id')
                    ->references('id')
                    ->on($config['permissions'])
                    ->onDelete('cascade');

                $table->foreign('role_id')
                    ->references('id')
                    ->on($config['roles'])
                    ->onDelete('cascade');

                $table->primary(['permission_id', 'role_id']);
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $config = config('laravel-permission.table_names');

        Schema::drop($config['role_has_permissions']);
        Schema::drop($config['user_has_roles']);
        Schema::drop($config['user_has_permissions']);
        Schema::drop($config['roles']);
        Schema::drop($config['permissions']);
    }
}
