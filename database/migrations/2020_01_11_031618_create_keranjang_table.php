<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeranjangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //k = keranjang c = checkout , d = dikirim
    public function up()
    {
        Schema::create('keranjang', function (Blueprint $table) {
            $table->bigIncrements('id_keranjang');
            $table->integer('id_barang');
            $table->integer('id_user');
            $table->integer('jumlah');
            $table->text('keterangan');
            $table->enum('status',['k','c','d']);
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
        Schema::dropIfExists('keranjang');
    }
}
