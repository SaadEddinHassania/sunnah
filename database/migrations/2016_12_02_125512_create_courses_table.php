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
            $table->integer('supervisor_id')->references('id')->on('supervisors')->onDelete('set NULL');
            $table->integer('teacher_id')->references('id')->on('supervisors')->onDelete('set NULL');
            $table->integer('region_id')->references('id')->on('regions')->onDelete('set NULL');
            $table->integer('venue_id')->references('id')->on('venues')->onDelete('set NULL');
            $table->integer('field_id')->references('id')->on('fields')->onDelete('set NULL');
            $table->integer('type_id')->references('id')->on('courses_types')->onDelete('set NULL');
            $table->string('grade')->default('0');
            $table->string('details')->nullable();
            $table->date('start_date')->nullable();
            $table->date('finish_date')->nullable();
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
        Schema::drop('courses');
    }
}
