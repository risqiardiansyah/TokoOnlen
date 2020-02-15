<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnStatusPembelian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('keranjang', function (Blueprint $table) {
            DB::statement("ALTER TABLE keranjang ADD status_pembelian ENUM('pengecekan','disetujui','dikemas','dikirim','diterima','ditolak') AFTER status");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('keranjang', function (Blueprint $table) {
            DB::statement("ALTER TABLE keranjang ADD status_pembelian ENUM('pengecekan','disetujui','dikemas','dikirim','diterima','ditolak') AFTER status");
        });
    }
}
