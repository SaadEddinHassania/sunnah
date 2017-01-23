<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleCourseStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_course_status', function (Blueprint $table) {
            $table->integer('role_id')->unsigned();
            $table->integer('status_id')->unsigned();

            //this -read- when was role with different status
            $table->boolean('read')->default('0');
            $table->boolean('edit')->default('0');

            $table->foreign('status_id')->references('id')->on('course_status')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');

            $table->primary(['role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
