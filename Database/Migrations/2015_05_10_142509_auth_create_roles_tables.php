<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AuthCreateRolesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();

            $table->timestamps();
        });

        Schema::create('roleables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned()->index();
            $table->string('caller_type', 100);
            $table->integer('caller_id')->unsigned()->index();

            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('roleables');
        Schema::drop('roles');
    }

}