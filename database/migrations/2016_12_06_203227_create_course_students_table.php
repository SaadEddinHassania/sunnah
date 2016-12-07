<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_students', function (Blueprint $table) {
            $table->integer('course_id')->unsigned()->index();;
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');

            $table->integer('student_id')->unsigned()->index();;
            $table->foreign('student_id')->references('user_id')->on('students')->onDelete('cascade');

            $table->string('status')->nullable();
            $table->float('grade')->nullable();

            $table->primary(['course_id', 'student_id']);

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
        Schema::dropIfExists('course_students');
    }
}
