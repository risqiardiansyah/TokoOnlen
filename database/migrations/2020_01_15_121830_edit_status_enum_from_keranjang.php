<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditStatusEnumFromKeranjang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('keranjang', function (Blueprint $table) {
            DB::statement("ALTER TABLE keranjang MODIFY status ENUM('k','c','d')");
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('keranjang', function (Blueprint $table) {
            DB::statement("ALTER TABLE keranjang MODIFY status ENUM('k','c','d')");
        // });
    }
}
