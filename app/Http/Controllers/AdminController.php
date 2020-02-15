<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use File;
use Validator;

class AdminController extends Controller
{
    function __construct(Request $request)
    {
    	$this->middleware('auth');
    }

    protected function get_barang()
    {
        return DB::table('barang')->get()->toArray();
    }

    protected function get_user()
    {
        return DB::table('users')->where('level','!=','adm')->get();
    }

    protected function pesanan()
    {
        return DB::table('keranjang')->where('status','!=','d')->where('status','!=','k')->get();
    }

    protected function kritik_saran()
    {
        return DB::table('kritik_saran')->get();
    }

    protected function metode_pembayaran()
    {
        return DB::table('metode_pembayaran')->get();
    }

    protected function kategori()
    {
        return DB::table('kategori')->get();
    }

    protected function variable()
    {
        $sum_barang = DB::table('barang')->sum('jumlah');
        $keranjang = DB::table('keranjang')->where('status','=','k')->sum('jumlah_pesan');
        $checkout = DB::table('keranjang')->where('status','=','c')->sum('jumlah_pesan');
        $terjual = DB::table('keranjang')->where('status_pembelian','=','diterima')->sum('jumlah_pesan');
        $ditolak = DB::table('keranjang')->where('status','=','d')->where('status_pembelian','=','ditolak')->sum('jumlah_pesan');
        $d_tolak = DB::table('keranjang')
                        ->join('barang','keranjang.id_barang','=','barang.id_barang')
                        ->select('barang.nama_barang','keranjang.*')
                        ->where('status','=','d')
                        ->where('status_pembelian','=','ditolak')->get();
        $d_terima =  DB::table('keranjang')
                        ->join('barang','keranjang.id_barang','=','barang.id_barang')
                        ->select('barang.nama_barang','keranjang.*')
                        ->where('status','=','d')
                        ->where('status_pembelian','=','diterima')->get();
        $modal = DB::table('barang')->sum('harga');
        $penghasilan = DB::table('keranjang')->where('status_pembelian','=','diterima')->sum('total');
        $data_barang = DB::table('barang')->limit(3)->orderBy('terjual','desc')->get();
        $pesanan_u_b = DB::table('keranjang')
                            ->join('barang', 'keranjang.id_barang','=','barang.id_barang')
                            ->join('users', 'keranjang.id_user','=','users.id')
                            ->join('metode_pembayaran', 'keranjang.pembayaran','=','metode_pembayaran.id_pembayaran')
                            ->select('keranjang.*','barang.*','users.*','metode_pembayaran.*')
                            ->where('keranjang.status','=','c')
                            ->orderBy('status_pembelian','asc')
                            ->get();
        $data_feedback = DB::table('kritik_saran')
                    ->join('users','kritik_saran.id_user','=','users.id')
                    ->select('users.name','kritik_saran.*')
                    ->get();
        $data_blog = DB::table('blog')->get();
        return [
            'data_barang'=>$data_barang,
            'barang'=>$this->get_barang(),
            'sum_barang'=>$sum_barang,
            'user'=>$this->get_user(),
            'pesanan'=>$this->pesanan(),
            'keranjang'=>$keranjang,
            'checkout'=>$checkout,
            'terjual'=>$terjual,
            'ditolak'=>$ditolak,
            'modal'=>$modal*$sum_barang,
            'penghasilan'=>$penghasilan,
            'kritik_saran'=>$this->kritik_saran(),
            'metode_pembayaran'=>$this->metode_pembayaran(),
            'kategori'=>$this->kategori(),
            'pesanan'=>json_decode($pesanan_u_b),
            'data_feedback'=>$data_feedback,
            'accept'=>$d_terima,
            'cancel'=>$d_tolak,
            'blog'=>$data_blog
        ];
    }

    protected function notifikasi($data)
    {
        DB::table('notifikasi')->insert($data);
    }

    protected function notifikasi_admin()
    {
        return DB::table('notifikasi')
                    ->where('untuk','=','admin')
                    ->orderBy('jenis_notifikasi','asc')
                    ->get();
    }

    public function halut(Request $request)
    {
        if ($request->user()->level == 'usr') {
            return redirect('/');
        }

        return view('admin.dashboard', $this->variable());
    }

    public function data_user(Request $request)
    {
        if ($request->user()->level == 'usr') {
            return redirect('/');
        }

        return view('admin.data_user', $this->variable());
    }

    public function data_barang(Request $request)
    {
        if ($request->user()->level == 'usr') {
            return redirect('/');
        }

        return view('admin.data_barang', $this->variable());
    }

    public function data_pesanan(Request $request)
    {
        if ($request->user()->level == 'usr') {
            return redirect('/');
        }
        return view('admin.data_pesanan', $this->variable());
    }

    public function data_feedback(Request $request)
    {
        if ($request->user()->level == 'usr') {
            return redirect('/');
        }
        return view('admin.data_feedback', $this->variable());
    }

    public function data_blog(Request $request)
    {
        if ($request->user()->level == 'usr') {
            return redirect('/');
        }
        return view('admin.data_blog', $this->variable());
    }

    public function data_kategori(Request $request)
    {
        if ($request->user()->level == 'usr') {
            return redirect('/');
        }
        return view('admin.data_kategori', $this->variable());
    }

    public function nonaktifkan_kategori(Request $request)
    {
        $id_kategori = $request->id;

        $status = array('status'=>'tidak aktif');

        $upd = DB::table('kategori')
                    ->where('id_kategori','=',$id_kategori)
                    ->update($status);
        if ($upd) {
            echo 1;
        }else echo 2;
    }

    public function aktifkan_kategori(Request $request)
    {
        $id_kategori = $request->id;

        $status = array('status'=>'aktif');

        $upd = DB::table('kategori')
                    ->where('id_kategori','=',$id_kategori)
                    ->update($status);
        if ($upd) {
            echo 1;
        }else echo 2;
    }

    public function tambah_kategori(Request $request)
    {
        $nama_kategori = $request->nama_kategori;

        $rules = array(
            'gambar'=>'required|image:jpeg,jpg,png'
        );

        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            return response()->json(['errors'=>$error->errors()->all()]);
        }

        $now = Carbon::now()->format('d-m-Y');
        $hour = Carbon::now()->format('H-i-s');

        $gambar = $request->file('gambar');
        $nama_gambar = 'kategori-'.$now.'-'.$hour.'-'.$gambar->getClientOriginalName();
        $path = 'assets/images/';

        $upload = $gambar->move($path, $nama_gambar);

        if ($request->file('gambar') != '' || $request->file('gambar') != null) {
            $data = array(
                'nama_kategori'=>$request->nama_kategori,
                'gambar'=>$nama_gambar,
                'link'=>$request->link,
                'status'=>'aktif'
            );

            $ins = DB::table('kategori')->insert($data);

            if ($ins) {
                echo 1;
            }else{
                echo 2;
            }
        }else {
            echo 3;
        }
    }

    public function hapus_kategori(Request $request)
    {
        $id = $request->id;

        $data = DB::table('kategori')->where('id_kategori','=',$id)->get('gambar');

        // $gambar = $data;

        // return view('test', ['gambar'=>$gambar]);
        $del = DB::table('kategori')->where('id_kategori','=',$id)->delete();
        if ($del) {
            foreach ($data as $gambar) {
                File::delete('assets/images/'.$gambar->gambar);
            }
            echo 1;
        }else echo 2;
    }

    public function data_metode_pembayaran(Request $request)
    {
        if ($request->user()->level == 'usr') {
            return redirect('/');
        }
        return view('admin.metode_pembayaran', $this->variable());
    }

    public function nonaktifkan(Request $request)
    {
        $id_pembayaran = $request->id;

        $status = array('status'=>'tidak aktif');

        $upd = DB::table('metode_pembayaran')
                    ->where('id_pembayaran','=',$id_pembayaran)
                    ->update($status);
        if ($upd) {
            echo 1;
        }else echo 2;
    }

    public function aktifkan(Request $request)
    {
        $id_pembayaran = $request->id;

        $status = array('status'=>'aktif');

        $upd = DB::table('metode_pembayaran')
                    ->where('id_pembayaran','=',$id_pembayaran)
                    ->update($status);
        if ($upd) {
            echo 1;
        }else echo 2;
    }

    public function edit_barang(Request $request)
    {
        $rules = array(
            'gambar'=>'required|image:jpeg,jpg,png'
        );

        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            return response()->json(['errors'=>$error->errors()->all()]);
        }

        $id_barang = $request->id_barang;
        
        $now = Carbon::now()->format('d-m-Y');
        $hour = Carbon::now()->format('H-i-s');
        

        if ($request->file('gambar') != '' || $request->file('gambar') != null) {
            $gambar = $request->file('gambar');
        $nama_gambar = $now.'-'.$id_barang.'-'.$hour.'-'.$gambar->getClientOriginalName();
        $path = 'assets/images/';
        
        $data = array(
            'id_kategori'=>$request->id_kategori,
            'nama_barang'=>$request->nama_barang,
            'deskripsi_barang'=>$request->deskripsi_barang,
            'jumlah'=>$request->jumlah,
            'harga'=>$request->harga,
            'diskon'=>$request->diskon,
            'kondisi'=>$request->kondisi,
            'gambar'=>$nama_gambar
        );
            $upload = $gambar->move($path, $nama_gambar);

            if ($upload) {
            $upd = DB::table('barang')
            ->where('id_barang',$id_barang)
            ->update($data);

                if ($upd) {
                    File::delete('assets/images/'.$request->gambar_sblm);
                    echo 1;
                } else {echo 2;}
            }
        }else{
            $da = array(
                'id_kategori'=>$request->id_kategori,
                'nama_barang'=>$request->nama_barang,
                'deskripsi_barang'=>$request->deskripsi_barang,
                'jumlah'=>$request->jumlah,
                'harga'=>$request->harga,
                'diskon'=>$request->diskon,
                'kondisi'=>$request->kondisi,
                'gambar'=>$request->gambar_sblm
            );

            $ud = DB::table('barang')
            ->where('id_barang',$id_barang)
            ->update($da);

            if ($ud) {
                echo 1;
            }else{
                echo 3;
            }
        }
    }

    public function hapus_barang(Request $request)
    {
        $id_barang = $request->id_barang;

        $del = DB::table('barang')
                ->where('id_barang',$id_barang)
                ->delete();
        if ($del) {
            File::delete('assets/images/'.$request->gambar);
            echo 1;
        }else{
            echo 2;
        }
    }

    public function tambah_barang(Request $request)
    {
        $rules = array(
            'gambar'=>'required|image:jpeg,jpg,png'
        );

        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            return response()->json(['errors'=>$error->errors()->all()]);
        }

        $now = Carbon::now()->format('d-m-Y');
        $hour = Carbon::now()->format('H-i-s');

        $gambar = $request->file('gambar');
        $nama_gambar = $now.'-'.$hour.'-'.$gambar->getClientOriginalName();
        $path = 'assets/images/';

        $upload = $gambar->move($path, $nama_gambar);

        $data = array(
            'id_kategori'=>$request->id_kategori,
            'nama_barang'=>$request->nama_barang,
            'deskripsi_barang'=>$request->deskripsi_barang,
            'jumlah'=>$request->jumlah,
            'terjual'=>0,
            'rating'=>0,
            'harga'=>$request->harga,
            'diskon'=>$request->diskon,
            'kondisi'=>$request->kondisi,
            'gambar'=>$nama_gambar
        );

        if ($upload) {
            $insert = DB::table('barang')->insert($data);
            if ($insert) {
                echo 1;
            }else{
                echo 2;
            }
        }else{
            echo 3;
        }
    }

    public function tambah_blog(Request $request)
    {
        $rules = array(
            'gambar'=>'required|image:jpeg,jpg,png'
        );

        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            return response()->json(['errors'=>$error->errors()->all()]);
        }

        $now = Carbon::now()->format('d-m-Y');
        $hour = Carbon::now()->format('H-i-s');

        $gambar = $request->file('gambar');
        $nama_gambar = 'blog-'.$now.'-'.$hour.'-'.$gambar->getClientOriginalName();
        $path = 'assets/images/';

        $upload = $gambar->move($path, $nama_gambar);

        $data = array(
            'judul'=>$request->judul,
            'isi'=>$request->isi,
            'gambar'=>$nama_gambar
        );

        if ($upload) {
            $insert = DB::table('blog')->insert($data);
            if ($insert) {
                echo 1;
            }else{
                echo 2;
            }
        }else{
            echo 3;
        }
    }

    public function hapus_blog(Request $request)
    {
        $id_blog = $request->id;

        $del = DB::table('blog')
                ->where('id_blog',$id_blog)
                ->delete();
        if ($del) {
            File::delete('assets/images/'.$request->gambar);
            echo 1;
        }else{
            echo 2;
        }
    }

    public function edit_blog(Request $request)
    {
        if ($request->file('gambar') == '' || $request->file('gambar') == null) {
            $data = array(
                'judul'=>$request->judul,
                'isi'=>$request->isi
            );

            $upd = DB::table('blog')
                    ->where('id_blog','=',$request->id_blog)
                    ->update($data);
            if ($upd) {
                echo 1;
            }else{
                echo 'ddd';
            }
        }else{

            $rules = array(
                'gambar'=>'required|image:jpeg,jpg,png'
            );

            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json(['errors'=>$error->errors()->all()]);
            }

            $now = Carbon::now()->format('d-m-Y');
            $hour = Carbon::now()->format('H-i-s');

            $gambar = $request->file('gambar');
            $nama_gambar = 'blog-'.$now.'-'.$hour.'-'.$gambar->getClientOriginalName();
            $path = 'assets/images/';

            $upload = $gambar->move($path, $nama_gambar);
            if ($upload) {
                $da = array(
                'judul'=>$request->judul,
                'isi'=>$request->isi,
                'gambar'=>$nama_gambar
                );

                $upd = DB::table('blog')
                        ->where('id_blog','=',$request->id_blog)
                        ->update($da);

                if ($upd) {
                    File::delete('assets/images/'.$request->gambar_sblm);
                    echo 1;
                }else{
                    echo 2;
                }
            }else{
                echo 3;
            }
        }

        
    }

    public function status_pembelian(Request $request, $status)
    {
        $now = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        // echo $now;
        // die();
        $get_id_user = DB::table('keranjang')
                        ->select('id_user')
                        ->where('id_keranjang','=',$request->id_keranjang)
                        ->get();

        if ($status == 'dikemas') {
            foreach ($get_id_user as $d) {
                $push = array(
                    'id_barang'=>$request->id_keranjang,
                    'id_user'=>$d->id_user,
                    'judul'=>'Barang Dikemas',
                    'isi'=>'Pesanan Anda Disetujui dan Dikemas.',
                    'jenis_notifikasi'=>'dikemas',
                    'dari'=>'admin',
                    'untuk'=>'user',
                    'status'=>'0'
                );
            }
            
            $set = array(
                'status_pembelian'=>'dikemas'
            );
        }elseif ($status == 'dikirim') {
            foreach ($get_id_user as $d) {
                $push = array(
                    'id_barang'=>$request->id_keranjang,
                    'id_user'=>$d->id_user,
                    'judul'=>'Barang Dikirim',
                    'isi'=>'Pesanan Anda Sudah Dikirim.',
                    'jenis_notifikasi'=>'dikirim',
                    'dari'=>'admin',
                    'untuk'=>'user',
                    'status'=>'0'
                );
            }

            $set = array(
                'status_pembelian'=>'dikirim'
            );
        }elseif($status == 'diterima'){
            foreach ($get_id_user as $d) {
                $push = array(
                    'id_barang'=>$request->id_keranjang,
                    'id_user'=>$d->id_user,
                    'judul'=>'Barang Diterima',
                    'isi'=>'Barang Sudah Diterima Oleh Pemesan.',
                    'jenis_notifikasi'=>'diterima',
                    'dari'=>'user',
                    'untuk'=>'admin',
                    'status'=>'0'
                );
            }

            $set = array(
                'status_pembelian'=>'diterima',
                'status'=>'d',
                'updated_at'=>$now
            );
        }elseif($request->status == 'ditolak'){
            foreach ($get_id_user as $d) {
                $push = array(
                    'id_barang'=>$request->id_keranjang,
                    'id_user'=>$d->id_user,
                    'judul'=>'Barang Ditolak',
                    'isi'=>'Pesanan Anda Ditolak Karena Barang Tidak Tersedia.',
                    'jenis_notifikasi'=>'batal',
                    'dari'=>'admin',
                    'untuk'=>'user',
                    'status'=>'0'
                );
            }

            $set = array(
                'status_pembelian'=>'ditolak',
                'status'=>'d'
            );
        }
        $push = $this->notifikasi($push);
        $ganti = DB::table('keranjang')
                    ->where('id_keranjang','=',$request->id_keranjang)
                    ->update($set);
        if ($ganti) {
            echo 1;

        }else{
            echo 2;
        }
    }

    public function status_all(Request $request, $status)
    {
        if ($request->status == 'dikemas') {
            $ganti = DB::table('keranjang')
                ->where('status','=','c')
                ->where('status_pembelian','!=','dikirim')
                ->update(array('status_pembelian'=>$request->status));
        }elseif ($request->status == 'ditolak') {
            $ganti = DB::table('keranjang')
                ->where('status','=','c')
                ->where('status_pembelian','!=','dikirim')
                ->update(array('status_pembelian'=>$request->status,'status'=>'d'));
        }
        
        if ($ganti) {
            echo 1;
        }else{
            echo 2;
        }
    }

}
