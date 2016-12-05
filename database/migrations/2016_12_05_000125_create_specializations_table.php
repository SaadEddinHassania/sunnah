<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecializationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specializations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->integer('specialization_id')->unsigned()->nullable()->after('qualification_id');
            $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('set NULL');
        });

        Schema::table('supervisors', function (Blueprint $table) {
            $table->integer('specialization_id')->unsigned()->after('qualification_id');
            $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('RESTRICT');
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
            $table->dropForeign(['specialization_id']);
        });
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['specialization_id']);
        });
        Schema::drop('specializations');
    }
}
