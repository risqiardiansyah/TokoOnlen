<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveColumnRateAppKrisar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kritik_saran', function (Blueprint $table) {
            $table->dropColumn('rating_app');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kritik_saran', function (Blueprint $table) {
            $table->dropColumn('rating_app');
        });
    }
}
