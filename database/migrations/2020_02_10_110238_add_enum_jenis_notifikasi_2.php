<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEnumJenisNotifikasi2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notifikasi', function (Blueprint $table) {
            $table->dropColumn('jenis_notifikasi');
        });

        Schema::table('notifikasi', function (Blueprint $table) {
            $table->enum('jenis_notifikasi',['pembayaran','checkout','pesanan','batal','diterima','dikemas','dikirim'])->after('isi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notifikasi', function (Blueprint $table) {
            //
        });
    }
}
