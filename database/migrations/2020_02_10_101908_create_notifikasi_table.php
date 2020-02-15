<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotifikasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->bigIncrements('id_notifikasi');
            $table->integer('id_barang')->nullable();
            $table->integer('id_user');
            $table->string('judul');
            $table->text('isi');
            $table->enum('jenis_notifikasi',['pembayaran','pesanan','batal','diterima','dikemas','dikirim']);
            $table->enum('dari',['admin','user']);
            $table->enum('untuk',['admin','user']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExist('notifikasi');
    }
}
