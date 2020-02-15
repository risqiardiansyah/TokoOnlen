<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
	protected $primaryKey = 'id_keranjang';
    protected $table = 'keranjang';
    protected $fillable = ['id_barang','id_user','jumlah_pesan','keterangan','status','total','status_pembelian','pembayaran'];
}
