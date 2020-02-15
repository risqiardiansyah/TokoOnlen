<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Keranjang;
use Validator;
use Illuminate\Support\Facades\Crypt;

class KeranjangController extends Controller
{
	public function __construct(Request $request)
    {
        $this->middleware('auth');
    }

    protected function notifikasi($data,$id)
    {
        
        DB::table('notifikasi')
            ->where('id_user','=',$id)
            ->where('jenis_notifikasi','=','checkout')
            ->delete();

        DB::table('notifikasi')->insert($data);
    }

    protected function upd_notif($id)
    {
        $data = array(
            'judul'=>'Pembatalan Pesanan',
            'isi'=>'Pemesanan Barang Dibatalkan.',
            'jenis_notifikasi'=>'batal'
        );

        DB::table('notifikasi')
            ->where('id_barang','=',$id)
            ->update($data);
    }

    // function batalkan pesanan
    public function batal_pesan(Request $request)
    {
    	$data = array(
    		'status'=>'d',
    		'status_pembelian'=>'pengecekan'
    	);
    	$upd = Keranjang::find($request->id_keranjang);
    	$upd->update($data);

        $this->upd_notif($request->id_keranjang);

    	return response()->json(['success'=>'Pemesanan Di Batalkan']);
    }

    public function checkout_single(Request $request)
    {
    	$data = array(
    		'status_pembelian'=>$request->status_pembelian,
    		'pembayaran'=>$request->id_pembayaran,
    		'status'=>'c'
    	);
    	$co = Keranjang::find($request->id_keranjang);
    	$upd = $co->update($data);
        
        $push = array(
            'id_barang'=>$request->id_keranjang,
            'id_user'=>$request->user()->id,
            'judul'=>'Pesanan Barang',
            'isi'=>'User Membuat Pesanan.',
            'jenis_notifikasi'=>'pesanan',
            'dari'=>'user',
            'untuk'=>'admin'
        );
        $id = $request->user()->id;

        $this->notifikasi($push,$id);
        // exit(0);
    	return response()->json(['success'=>'Data Di Checkout']);
    }

    public function list_cart_riwayat(Request $request,$id)
    {
    	$d_hash = $request->user()->id;
        $hash = Crypt::encrypt($d_hash);
        $all_kategori = DB::table('kategori')->get();
        $id_user    = Crypt::decrypt($id); 
        $data_keranjang = DB::table('keranjang')
                            ->join('users', 'keranjang.id_user','=','users.id')
                            ->join('barang', 'barang.id_barang','=','keranjang.id_barang')
                            ->select('users.id','keranjang.*','barang.*')
                            ->where('users.id',$id_user)
                            ->where('keranjang.status','=','d')
                            ->get()->toArray();
        $data_barang = DB::table('barang')
                        ->join('kategori', 'barang.id_kategori','=','kategori.id_kategori')
                        ->select('barang.*','kategori.nama_kategori')
                        ->get();
        $notif = DB::table('notifikasi')
                ->where('id_user','=',$d_hash)
                ->where('untuk','=','user')
                ->get();
        return view('user.cart_riwayat', [
            'data'=>$data_keranjang,
            'all_kategori'=>$all_kategori,
            'hash'=>$hash,
            'data_barang'=>$data_barang,
            'notifikasi'=>$notif
        ]);
    }

    public function hapus_all_riwayat(Request $request)
    {
    	// Barang yg telah diterima
    	DB::table('keranjang')
    		->where('id_user',$request->id_user)
    		->where('status','d')
    		->where('status_pembelian','diterima')
    		->delete();
    	// Barang yg ditolak
    	DB::table('keranjang')
    		->where('id_user',$request->id_user)
    		->where('status','d')
    		->where('status_pembelian','ditolak')
    		->delete();
    	// Barang yg dibatalkan User
    	DB::table('keranjang')
    		->where('id_user',$request->id_user)
    		->where('status','d')
    		->delete();
    	return response()->json(['error'=>'Error']);
    	
    }
}
