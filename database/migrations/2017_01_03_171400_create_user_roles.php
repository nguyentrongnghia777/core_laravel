<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
        });

        Schema::create('users_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedMediumInteger('user_id');
            $table->unsignedMediumInteger('group_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users_groups');
        Schema::drop('groups');
    }
}
