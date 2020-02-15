<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMetodePembayaranToKeranjang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. Tf bank, 2. DANA, 3. OVO, 4. Link aja
        Schema::table('keranjang', function (Blueprint $table) {
            $table->enum('pembayaran',['1','2','3','4']);
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
            $table->dropColumn('pembayaran');
        });
    }
}
