<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function ($table) {
            $table->integer('hours')->after('field_id');
            $table->string('book')->after('hours');

            $table->dropForeign('courses_type_id_foreign');
            $table->dropColumn('type_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function ($table) {
            $table->dropColumn('hours');
            $table->dropColumn('book');

            $table->integer('type_id')->unsigned()->index();
            $table->foreign('type_id')->references('id')->on('courses_types');;
        });
    }
}
