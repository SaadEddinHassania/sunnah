<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permissions', function ($table) {
            $table->string('policy_name')->after('display_name');
            $table->dropColumn('name');
            $table->string('func_name')->after('display_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permissions', function ($table) {
            $table->dropColumn('func_name');
            $table->dropColumn('policy_name');
            $table->string('name');
        });
    }
}
