<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->integer('qualification_id')->unsigned()->nullable()->after('dob');
            $table->foreign('qualification_id')->references('id')->on('qualifications')->onDelete('set NULL');
        });

        Schema::table('supervisors', function (Blueprint $table) {
            $table->integer('qualification_id')->unsigned()->after('dob');
            $table->foreign('qualification_id')->references('id')->on('qualifications')->onDelete('RESTRICT ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('supervisors', function (Blueprint $table) {
            $table->dropForeign(['qualification_id']);
        });
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['qualification_id']);
        });
        Schema::drop('qualifications');
    }
}
