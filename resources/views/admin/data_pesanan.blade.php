@extends('template.template_admin')

@section('content')

<div class="col-12"><a href="#" class="btn btn-sm btn-primary float-right" style="margin-top: -50px;" role="button" data-toggle="modal" data-target="#modal_riwayat">Riwayat</a>
	<div class="card">
      <div class="card-header border-transparent">
        <h3 class="card-title">Latest Orders</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table m-0">
            <thead>
            <tr>
              <th>Order ID</th>
              <th>Status</th>
              <th>Nama Barang</th>
              <th>Pemesan</th>
              <th>Jumlah Pesan</th>
              <th>Total</th>
              <th>Metode Bayar</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>

            @if(count($pesanan)==0)
                <tr>
                  <td class="text-center" colspan="8"><h1>Belum Ada Pesanan</h1></td>
                </tr>
            @endif

              @foreach($pesanan as $p)

              
	            <tr>
	              <td>{{$p->id_keranjang}} <i class="fas fa-question-circle text-primary" data-container="body" data-placement="right" data-toggle="popover" title="Catatan" data-content="{{$p->keterangan}}"></i></td>
              @if($p->status_pembelian == 'pengecekan')
                <td><span class="badge badge-warning">Pengecekan</span></td>
              @elseif($p->status_pembelian == 'dikemas')
                <td><span class="badge badge-success">Dikemas</span></td>
              @elseif($p->status_pembelian == 'dikirim')
                <td><span class="badge badge-success">Dikirim</span></td>
              @endif
	              <td><a href="javascript:void(0)">{{$p->nama_barang}}</a></td>
	              <td>{{$p->name}}</td>
	              <td>{{$p->jumlah_pesan}}</td>
	              <td>Rp. {{number_format($p->total,0,',','.')}}</td>
	              <td>{{$p->nama_pembayaran}}</td>
                <td>
                  @if($p->status_pembelian == 'pengecekan')
                    <a href="javascript:void(0)" class="badge badge-primary" onclick="kemas('dikemas',{{$p->id_keranjang}})">Setujui&Kemas</a>
                    <a href="javascript:void(0)" class="badge badge-danger" onclick="kemas('ditolak',{{$p->id_keranjang}})">Batalkan</a>
                  @elseif($p->status_pembelian == 'dikemas')
                    <a href="javascript:void(0)" class="badge badge-success" onclick="kemas('dikirim',{{$p->id_keranjang}})">Kirim</a>
                    <a href="javascript:void(0)" class="badge badge-danger" onclick="kemas('ditolak',{{$p->id_keranjang}})">Batalkan</a>
                  @elseif($p->status_pembelian == 'dikirim')
                    <a href="javascript:void(0)" class="badge badge-success">Menunggu<br>Diterima...</a>
                  @endif
                </td>
	            </tr>
	        @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.table-responsive -->
      </div>
      <!-- /.card-body -->
      @if(count($pesanan)!=0)
      <div class="card-footer clearfix">
        <a href="javascript:void(0)" class="btn btn-sm btn-primary float-left trm" onclick="status_all('dikemas')">Terima&kemas Semua</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-danger float-left tlk" onclick="status_all('ditolak')">Tolak Semua</a>
      </div>
      @endif
      <!-- /.card-footer -->
    </div>
    <!-- /.card -->
</div>

{{-- Modal --}}
<div class="modal fade" id="modal_riwayat" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Riwayat Pesanan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Sukses</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Ditolak</a>
            </li>
          </ul>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
              <table class="table m-0">
                    <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama Barang</th>
                      <th>Status</th>
                      <th>Jumlah Pesan</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($accept as $a)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$a->nama_barang}}</td>
                        <td>{{$a->jumlah_pesan}}</td>
                        <td><span class="badge badge-success">{{ ucfirst($a->status_pembelian) }}</span></td>
                      </tr>
                    @endforeach
                    </tbody>
                </table>
              </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
              <table class="table m-0">
                    <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama Barang</th>
                      <th>Status</th>
                      <th>Jumlah Pesan</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cancel as $a)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$a->nama_barang}}</td>
                        <td>{{$a->jumlah_pesan}}</td>
                        <td><span class="badge badge-danger">{{ ucfirst($a->status_pembelian) }}</span></td>
                      </tr>
                    @endforeach
                    </tbody>
              </table>
            </div>
          </div>
        </div>
    
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Oke</button>
            
        </div>
    </div>

  </div>
</div>
{{-- Modal --}}
@endsection