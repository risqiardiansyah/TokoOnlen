<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeveralColumnToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('alamat')->after('email_verified_at');
            $table->date('ttl')->after('email_verified_at');
            $table->string('no_telp')->after('email_verified_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('alamat')->after('email_verified_at');
            $table->date('ttl')->after('email_verified_at');
            $table->string('no_telp')->after('email_verified_at');
        });
    }
}
