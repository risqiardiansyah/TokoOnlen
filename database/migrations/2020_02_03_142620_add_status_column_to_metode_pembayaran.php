<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusColumnToMetodePembayaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('metode_pembayaran', function (Blueprint $table) {
            $table->enum('status',['aktif','tidak aktif'])->default('aktif')->after('nomor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('metode_pembayaran', function (Blueprint $table) {
            $table->enum('status',['aktif','tidak aktif'])->default('aktif')->after('nomor');
        });
    }
}
