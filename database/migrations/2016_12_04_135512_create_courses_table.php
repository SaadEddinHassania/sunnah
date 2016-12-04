<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sn');
            $table->string('name')->nullable();
            $table->unsignedInteger('supervisor_id');
            $table->integer('teacher_id')->unsigned()->index();
            $table->integer('region_id')->unsigned()->index();
            $table->integer('venue_id')->unsigned()->index();
            $table->integer('field_id')->unsigned()->index();
            $table->integer('type_id')->unsigned()->index();
            $table->string('grade')->default('0');
            $table->string('details')->nullable();
            $table->date('start_date')->nullable();
            $table->date('finish_date')->nullable();
            $table->timestamps();


        });
        Schema::table('courses', function ($table) {
            $table->foreign('supervisor_id')->references('user_id')->on('supervisors');
            $table->foreign('teacher_id')->references('user_id')->on('supervisors');
            $table->foreign('region_id')->references('id')->on('regions');
            $table->foreign('venue_id')->references('id')->on('venues');
            $table->foreign('field_id')->references('id')->on('courses_fields');
            $table->foreign('type_id')->references('id')->on('courses_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('courses');
    }
}
