<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Keranjang;
use App\Krisar;
use Validator;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');  
    }

    public function kritik(Request $request)
    {
        DB::table('kritik');
    }

    protected function notifikasi($data)
    {
        $push = DB::table('notifikasi')->insert($data);
    }

    protected function baca(Request $request)
    {
        $data = array('status'=>'1');
        $id_user = $request->user()->id;
        $baca = DB::table('notifikasi')
                ->where('id_user','=',$id_user)
                ->where('id_notifikasi','=',$request->id)
                ->update($data);
        if ($baca) {
            echo 1;
        }else{
            echo 2;
        }
    }

    protected function hapus_notif(Request $request)
    {
        return DB::table('notifikasi')
                ->where('id_notifikasi','=',$request->id)
                ->delete();
    }

    protected function notifikasi_user(Request $request)
    {
        $d_hash = $request->user()->id;
        return DB::table('notifikasi')
            ->where('id_user','=',$d_hash)
            ->where('untuk','=','user')
            ->get();
    }

    // halaman utama
    public function index(Request $request)
    {   
        $d_hash = $request->user()->id;
        $hash = Crypt::encrypt($d_hash);
        
        $kategori = DB::table('kategori')->get('nama_kategori', ',' , 'gambar');
        $all_kategori = DB::table('kategori')->get();
        // dd($kategori);
        $data_first = DB::table('barang')
                        ->join('kategori', 'barang.id_kategori','=','kategori.id_kategori')
                        ->select('barang.*','kategori.nama_kategori')
                        ->where('kategori.nama_kategori','=',array_rand(array($kategori)))
                        ->limit(1)
                        ->get();
        $data_barang = DB::table('barang')
                        ->join('kategori', 'barang.id_kategori','=','kategori.id_kategori')
                        ->select('barang.*','kategori.nama_kategori')
                        ->get();
        $barang_diskon = DB::table('barang')
                        ->join('kategori', 'barang.id_kategori','=','kategori.id_kategori')
                        ->select('barang.*','kategori.nama_kategori')
                        ->where('barang.diskon','!=',0)
                        ->get();
        if ($data_first!='') {
            foreach ($data_first as $d) {
            $barang_serupa = DB::table('barang')
                        ->join('kategori', 'barang.id_kategori','=','kategori.id_kategori')
                        ->select('barang.*','kategori.nama_kategori')
                        ->where('kategori.nama_kategori','=','elektronik')
                        ->get();
            }
        }else{
            $barang_serupa = DB::table('barang')
                        ->join('kategori', 'barang.id_kategori','=','kategori.id_kategori')
                        ->select('barang.*','kategori.nama_kategori')
                        ->where('kategori.nama_kategori','=',$d->nama_kategori)
                        ->get();
        }
        
        $rating_tinggi = DB::table('barang')
                        ->join('kategori', 'barang.id_kategori','=','kategori.id_kategori')
                        ->select('barang.*','kategori.nama_kategori')
                        ->where('barang.rating','>',3)
                        ->orderBy('barang.rating', 'desc')
                        ->get();
        $terlaku = DB::table('barang')
                        ->join('kategori', 'barang.id_kategori','=','kategori.id_kategori')
                        ->select('barang.*','kategori.nama_kategori')
                        ->where('barang.terjual','>',0)
                        ->orderBy('barang.terjual', 'desc')
                        ->get();
        // dd($data_first);
        return view('user.index',
                    [
                        'data_first'=>$data_first,
                        'data_barang'=>$data_barang,
                        'barang_diskon'=>$barang_diskon,
                        'barang_serupa'=>$barang_serupa,
                        'rating_tinggi'=>$rating_tinggi,
                        'kategori'=>$all_kategori,
                        'all_kategori'=>$all_kategori,
                        'terlaku'=>$terlaku,
                        'hash'=>$hash
                    ]);
    }

    // Profile Page
    public function profile(Request $request)
    {
        $all_kategori = DB::table('kategori')->get();
        $barang = DB::table('barang')
                        ->join('kategori', 'barang.id_kategori','=','kategori.id_kategori')
                        ->select('barang.*','kategori.nama_kategori')
                        ->where('barang.rating','>',3)
                        ->limit(3)
                        ->orderBy('barang.rating', 'desc')
                        ->get();
        $d_hash = $request->user()->id;
        $hash = Crypt::encrypt($d_hash);

        return view('user.profile', [
            'all_kategori'=>$all_kategori,
            'barang' => $barang,
            'hash' => $hash
        ]);
    }

    // tampilkan kategori
    public function view_kategori(Request $request,$kategori)
    {
        $d_hash = $request->user()->id;
        $hash = Crypt::encrypt($d_hash);
        $kunci = DB::table('kategori')->where('link','=',$kategori)->get('nama_kategori')->toArray();
        // dd($kunci);
        $all_kategori = DB::table('kategori')->get();
        $data_barang = DB::table('barang')
                        ->join('kategori', 'barang.id_kategori','=','kategori.id_kategori')
                        ->select('barang.*','kategori.nama_kategori')
                        ->where('kategori.nama_kategori','=',$kategori)
                        ->get();
        return view('user.by_kategori', 
                    [
                        'all_kategori'=>$all_kategori,
                        'data_barang'=>$data_barang,
                        'nama'=>$kunci,
                        'hash'=>$hash
                    ]);
    }

    // tampilkan data where diskon != 0
    public function diskon(Request $request, $page)
    {
        $d_hash = $request->user()->id;
        $hash = Crypt::encrypt($d_hash);
        $all_kategori = DB::table('kategori')->get();
        if ($page == 'diskon') {
            $data_barang = DB::table('barang')
                            ->join('kategori', 'barang.id_kategori','=','kategori.id_kategori')
                            ->select('barang.*','kategori.nama_kategori')
                            ->where('barang.diskon','<>',0)
                            ->get();

            return view('user.page', 
                        [
                            'all_kategori'=>$all_kategori,
                            'data_barang'=>$data_barang,
                            'judul'=>'Diskon',
                            'hash'=>$hash
                        ]);
        } elseif ($page == 'all') {
            $data_barang = DB::table('barang')
                            ->join('kategori', 'barang.id_kategori','=','kategori.id_kategori')
                            ->select('barang.*','kategori.nama_kategori')
                            ->get();

            return view('user.page', 
                        [
                            'all_kategori'=>$all_kategori,
                            'data_barang'=>$data_barang,
                            'judul'=>'Semua Kategori',
                            'hash'=>$hash
                        ]);
        } elseif ($page == 'baru') {
            $data_barang = DB::table('barang')
                            ->join('kategori', 'barang.id_kategori','=','kategori.id_kategori')
                            ->select('barang.*','kategori.nama_kategori')
                            ->where('barang.kondisi','baru')
                            ->get();

            return view('user.page', 
                        [
                            'all_kategori'=>$all_kategori,
                            'data_barang'=>$data_barang,
                            'judul'=>'Kondisi Baru',
                            'hash'=>$hash
                        ]);
        } elseif ($page == 'bekas') {
            $data_barang = DB::table('barang')
                            ->join('kategori', 'barang.id_kategori','=','kategori.id_kategori')
                            ->select('barang.*','kategori.nama_kategori')
                            ->where('barang.kondisi','bekas')
                            ->get();

            return view('user.page', 
                        [
                            'all_kategori'=>$all_kategori,
                            'data_barang'=>$data_barang,
                            'judul'=>'Kondisi Bekas',
                            'hash'=>$hash
                        ]);
        } elseif ($page == 'banyak') {
            $data_barang = DB::table('barang')
                            ->join('kategori', 'barang.id_kategori','=','kategori.id_kategori')
                            ->select('barang.*','kategori.nama_kategori')
                            ->where('barang.terjual','>',0)
                            ->get();

            return view('user.page', 
                        [
                            'all_kategori'=>$all_kategori,
                            'data_barang'=>$data_barang,
                            'judul'=>'Paling Banyak Terjual',
                            'hash'=>$hash
                        ]);
        } elseif ($page == 'rating') {
            $data_barang = DB::table('barang')
                            ->join('kategori', 'barang.id_kategori','=','kategori.id_kategori')
                            ->select('barang.*','kategori.nama_kategori')
                            ->where('barang.rating','>=',4)
                            ->get();

            return view('user.page', 
                        [
                            'all_kategori'=>$all_kategori,
                            'data_barang'=>$data_barang,
                            'judul'=>'dengan Rating Tinggi',
                            'hash'=>$hash
                        ]);
        } elseif ($page == 'contact') {
            $data_barang = DB::table('barang')
                        ->join('kategori', 'barang.id_kategori','=','kategori.id_kategori')
                        ->select('barang.*','kategori.nama_kategori')
                        ->get();
            return view('user.contact', 
                        [
                            'data_barang'=>$data_barang,
                            'all_kategori'=>$all_kategori,
                            'hash'=>$hash
                        ]);
        }
    }

    // tampilkan list blog
    public function blog(Request $request)
    {
        $data_barang = DB::table('barang')
                        ->join('kategori', 'barang.id_kategori','=','kategori.id_kategori')
                        ->select('barang.*','kategori.nama_kategori')
                        ->get();
        $d_hash = $request->user()->id;
        $hash = Crypt::encrypt($d_hash);
        $all_kategori = DB::table('kategori')->get();
        $data_blog = DB::table('blog')->get();
        return view('user.blog',
                    [
                        'data_barang'=>$data_barang,
                        'all_kategori'=>$all_kategori,
                        'data_blog'=>$data_blog,
                        'hash'=>$hash
                    ]);
    }
    
    // tampilkan read more blog
    public function read_blog(Request $request, $id)
    {
        $d_hash = $request->user()->id;
        $hash = Crypt::encrypt($d_hash);
        $all_kategori = DB::table('kategori')->get();
        $get_blog = DB::table('blog')->where('id_blog',$id)->get();
        $data_blog = DB::table('blog')->limit(3)->get();
        $data_barang = DB::table('barang')
                        ->join('kategori', 'barang.id_kategori','=','kategori.id_kategori')
                        ->select('barang.*','kategori.nama_kategori')
                        ->get();
        return view('user.read_blog',
                    [
                        'data_barang'=>$data_barang,
                        'all_kategori'=>$all_kategori,
                        'get_blog'=>$get_blog,
                        'data_blog'=>$data_blog,
                        'hash'=>$hash
                    ]);
    }

    //move barang ke keranjang
    public function store(Request $request)
    {
        $rules = array(
            'jumlah_pesan' => 'required',
            'keterangan' => 'required'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors'=>$error->errors()->all()]);
        }

        $total = $request->jumlah_pesan * $request->harga;

        $data = array(
            'id_barang' => $request->id_barang,
            'id_user' => $request->id_user,
            'jumlah_pesan' => $request->jumlah_pesan,
            'keterangan' => $request->keterangan,
            'status' => 'k',
            'total'=>$total
        );

        $cek = DB::table('keranjang')
                ->where('id_user','=',$request->id_user)
                ->where('id_barang','=',$request->id_barang)
                ->where('status','=','k')
                ->get();
        
        if (count($cek) == 1) {
            foreach ($cek as $c) {
                $tot = $request->jumlah_pesan + $c->jumlah_pesan;
                $total_harga = $tot * $request->harga;
                $data = array(
                    'id_barang' => $request->id_barang,
                    'id_user' => $request->id_user,
                    'jumlah_pesan' => $tot,
                    'keterangan' => $request->keterangan,
                    'status' => 'k',
                    'total'=>$total_harga
                ); 
                $data_edit = Keranjang::find($c->id_keranjang);
                $edit = $data_edit->update($data);

                if ($edit) {
                    $data_push = array(
                        'id_barang'=>$request->id_barang,
                        'id_user'=>$request->id_user,
                        'judul'=>'Checkout Barang',
                        'isi'=>'User Menambah Barang Ke Keranjangnya.',
                        'jenis_notifikasi'=>'checkout',
                        'dari'=>'user',
                        'untuk'=>'admin'
                    );
                    $this->notifikasi($data_push);
                }
                return response()->json(['success'=>'Data ditambah ke cart']);
            }
        }else{
            $add = Keranjang::create($data);
            if ($add) {
                $data_push = array(
                    'id_barang'=>$request->id_barang,
                    'id_user'=>$request->id_user,
                    'judul'=>'Checkout Barang',
                    'isi'=>'User Menambah Barang Ke Keranjangnya.',
                    'jenis_notifikasi'=>'checkout',
                    'dari'=>'user',
                    'untuk'=>'admin'
                );
                $this->notifikasi($data_push);
            }
            return response()->json(['success'=>'Data ditambah ke cart']);
        }
    }

    // menampilkan list barang keranjang
    public function list_cart(Request $request, $id)
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
                            ->where('keranjang.status','k')
                            ->get()->toArray();
        $data_checkout = DB::table('keranjang')
                            ->join('users', 'keranjang.id_user','=','users.id')
                            ->join('barang', 'barang.id_barang','=','keranjang.id_barang')
                            ->select('users.id','keranjang.*','barang.*')
                            ->where('users.id',$id_user)
                            ->where('keranjang.status','c')
                            ->get()->toArray();
        $sum_harga_k = DB::table('keranjang')
                            ->join('users', 'keranjang.id_user','=','users.id')
                            ->join('barang', 'barang.id_barang','=','keranjang.id_barang')
                            ->select('users.id','keranjang.*','barang.*')
                            ->where('users.id',$id_user)
                            ->where('keranjang.status','k')
                            ->sum('keranjang.total');
        $sum_harga_c = DB::table('keranjang')
                            ->join('users', 'keranjang.id_user','=','users.id')
                            ->join('barang', 'barang.id_barang','=','keranjang.id_barang')
                            ->select('users.id','keranjang.*','barang.*')
                            ->where('users.id',$id_user)
                            ->where('keranjang.status','c')
                            ->sum('keranjang.total');
        $pembayaran = DB::table('metode_pembayaran')->get();
        $data_barang = DB::table('barang')
                        ->join('kategori', 'barang.id_kategori','=','kategori.id_kategori')
                        ->select('barang.*','kategori.nama_kategori')
                        ->get();
        return view('user.cart', [
            'data'=>$data_keranjang,
            'checkout'=>$data_checkout,
            'all_kategori'=>$all_kategori,
            'hash'=>$hash,
            'sum_harga'=>$sum_harga_k,
            'sum_harga_c'=>$sum_harga_c,
            'metode_pembayaran'=>$pembayaran,
            'data_barang'=>$data_barang
        ]);
    }

    //edit data keranjang
    public function edit_keranjang(Request $request)
    {
        $total = $request->jumlah_pesan * $request->harga;

        $simpan = array(
            'id_barang' => $request->id_barang,
            'id_user' => $request->id_user,
            'jumlah_pesan' => $request->jumlah_pesan,
            'keterangan' => $request->keterangan,
            'status' => 'k',
            'total'=>$total
        );

        $data = Keranjang::find($request->id_keranjang);
        $data->update($simpan);
        return response()->json(['success'=>'Data Di edit']);
    }

    public function hapus_keranjang(Request $request)
    {
        $data = Keranjang::find($request->id_keranjang);
        $data->delete();
        return response()->json(['success'=>'Data Di Hapus']);
    }

    public function hapus_all_keranjang(Request $request)
    {
        $hapus = DB::table('keranjang')->where('id_user',$request->id_user)->delete();
        return response()->json(['success'=>'Data Dihapus']);
    }

    public function checkout_all(Request $request)
    {
        $data = array(
            'pembayaran'=>$request->id_pembayaran,
            'status'=>'c',
            'status_pembelian'=>'pengecekan'
        );
        DB::table('keranjang')
            ->where('id_user','=',$request->id_user)
            ->where('status','=','k')
            ->update($data);

        return response()->json(['success'=>'Berhasil Checkout']);
    }

    public function edit_profile(Request $request)
    {
        $data = array(
            'name' => $request->nama,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'ttl' => $request->ttl,
            'alamat' => $request->alamat
        );

        DB::table('users')
        ->where('id',$request->id_user)
        ->update($data);

        return response()->json(['success'=>'Berhasil Edit']);
    }

    public function krisar(Request $request)
    {
        $id = $request->user()->id;

        $data = array(
            'id_user'=>$id,
            'krisar' => $request->krisar
        );

        $cek = DB::table('kritik_saran')
                    ->where('id_user', $id)
                    ->get();
        if (count($cek) >= 3) {
            echo 2;
        }else{
            Krisar::create($data);
            echo 1;
            // return response()->json(['success'=>'Terima Kasih Kritik Sarannya.']);
        }
    }

    public function detail_barang(Request $request,$id)
    {
        $d_hash = $request->user()->id;
        $hash = Crypt::encrypt($d_hash);
        $all_kategori = DB::table('kategori')->get();
        $detail = DB::table('barang')->where('id_barang','=',$id)->get();
        return view('user.detail_barang',
                    [
                        'all_kategori'=>$all_kategori,
                        'data_barang'=>$detail,
                        'hash'=>$hash
                    ]);
    }
}
