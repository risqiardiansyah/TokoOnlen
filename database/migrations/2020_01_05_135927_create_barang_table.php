<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->bigIncrements('id_barang');
            $table->bigInteger('id_kategori');
            $table->string('nama_barang', 100);
            $table->text('deskripsi_barang');
            $table->integer('jumlah');
            $table->integer('harga');
            $table->enum('kondisi',['baru','bekas']);
            $table->string('gambar');
            $table->integer('diskon');
            $table->integer('terjual');
            $table->integer('rating');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
}
