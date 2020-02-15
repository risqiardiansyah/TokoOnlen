@extends('template.template_admin')

@section('content')

<div class="col-12 col-sm-6 col-md-3">
  <a href="{{url('/toko_onlen/adm/data/user')}}" class="text-dark">
  <div class="info-box">
    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

    
    <div class="info-box-content">
      <span class="info-box-text">Data User</span>
      <span class="info-box-number">
        {{count($user)}}
        <small>Orang</small>
      </span>
    </div>
    
    <!-- /.info-box-content -->
  </div>
  <!-- /.info-box --></a>
</div>
<!-- /.col -->
<div class="col-12 col-sm-6 col-md-3">
  <a href="javascript:void(0)" class="text-dark">
  <div class="info-box mb-3">
    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-shopping-cart"></i></span>

    <div class="info-box-content">
      <span class="info-box-text">Data Barang</span>
      <span class="info-box-number">{{count($barang)}} Barang / {{$sum_barang}} Stok</span>
    </div>
    <!-- /.info-box-content -->
  </div>
  </a>
  <!-- /.info-box -->
</div>
<!-- /.col -->

<!-- fix for small devices only -->
<div class="clearfix hidden-md-up"></div>

<div class="col-12 col-sm-6 col-md-3">
  <a href="javascript:void(0)" class="text-dark">
  <div class="info-box mb-3">
    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-box-open"></i></span>

    <div class="info-box-content">
      <span class="info-box-text">Data Pesanan</span>
      <span class="info-box-number">{{count($pesanan)}} Barang</span>
    </div>
    <!-- /.info-box-content -->
  </div>
  </a>
  <!-- /.info-box -->
</div>
<!-- /.col -->
<div class="col-12 col-sm-6 col-md-3">
  <a href="javascript:void(0)" class="text-dark">
  <div class="info-box mb-3">
    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-comment-dots"></i></span>

    <div class="info-box-content">
      <span class="info-box-text">Feedback</span>
      <span class="info-box-number">{{count($kritik_saran)}} Feedback</span>
    </div>
    <!-- /.info-box-content -->
  </div>
  </a>
  <!-- /.info-box -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->

<div class="row">
<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <h5 class="card-title">Recap Report</h5>

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
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <p class="text-center">
            <strong>Data</strong>
          </p>

          <div class="progress-group">
            Barang Yang Ditambahkan ke Keranjang
            <span class="float-right"><b>{{$keranjang}}</b>/{{$sum_barang}}</span>
            <div class="progress progress-sm">
              <div class="progress-bar bg-primary" style="width: {{ (($sum_barang / $sum_barang) * 100) - ((($sum_barang - $keranjang) / $sum_barang) * 100)}}%"></div>
            </div>
          </div>
          <!-- /.progress-group -->

          <div class="progress-group">
            Barang Yang Dicheckout
            <span class="float-right"><b>{{$checkout}}</b>/{{$sum_barang}}</span>
            <div class="progress progress-sm">
              <div class="progress-bar bg-warning" style="width:{{ (($sum_barang / $sum_barang) * 100) - ((($sum_barang - $checkout) / $sum_barang) * 100)}}%"></div>
            </div>
          </div>

          <!-- /.progress-group -->
          <div class="progress-group">
            <span class="progress-text">Barang Yang Terjual(Transaksi Sukses)</span>
            <span class="float-right"><b>{{$terjual}}</b>/{{$sum_barang}}</span>
            <div class="progress progress-sm">
              <div class="progress-bar bg-success" style="width: {{ (($sum_barang / $sum_barang) * 100) - ((($sum_barang - $terjual) / $sum_barang) * 100)}}%"></div>
            </div>
          </div>

          <!-- /.progress-group -->
          <div class="progress-group">
            Pesanan Ditolak
            <span class="float-right"><b>{{$ditolak}}</b>/{{$sum_barang}}</span>
            <div class="progress progress-sm">
              <div class="progress-bar bg-danger" style="width: {{ (($sum_barang / $sum_barang) * 100) - ((($sum_barang - $ditolak) / $sum_barang) * 100)}}%"></div>
            </div>
          </div>
          <!-- /.progress-group -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- ./card-body -->
    <div class="card-footer">
      <div class="row">
        <div class="col-md-4 col-6">
          <div class="description-block border-right">
            <h5 class="description-header">Rp. {{number_format($penghasilan,0,',','.')}}</h5>
            <span class="description-text">TOTAL PENGHASILAN</span>
          </div>
          <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-6">
          <div class="description-block border-right">
            <h5 class="description-header">Rp. {{number_format($modal-(50000*$sum_barang),0,',','.')}}</h5>
            <span class="description-text">MODAL</span>
          </div>
          <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-6">
          <div class="description-block border-right">
            @if($penghasilan < $modal )
              <h5 class="description-header text-warning">Rp. 0</h5>
            @elseif($penghasilan > $modal)
              <h5 class="description-header text-success">Rp. {{number_format($penghasilan - ($modal-(50000*$sum_barang)),0,',','.')}}</h5>
            @endif
            <span class="description-text">TOTAL KEUNTUNGAN</span>
          </div>
          <!-- /.description-block -->
        </div>

      </div>
      <!-- /.row -->
    </div>
    <!-- /.card-footer -->
  </div>
  <!-- /.card -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->


<!-- Main row -->
<div class="row">

<div class="col-md-12">

  <!-- PRODUCT LIST -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Barang Dengan Penjualan Tertinggi</h3>

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
      <ul class="products-list product-list-in-card pl-2 pr-2">
        @foreach($data_barang as $d)
        <li class="item">
          <div class="product-img">
            <img src="{{asset('assets/images/')}}/{{$d->gambar}}" alt="Product Image" class="img-size-50">
          </div>
          <div class="product-info">
            <a href="javascript:void(0)" class="product-title"> {{$d->nama_barang}}
              <span class="badge badge-warning float-right">Rp. {{$d->harga}}</span></a>
            <span class="product-description">
              {{$d->deskripsi_barang}}
            </span>
          </div>
        </li>
        @endforeach
        <!-- /.item -->
      </ul>
    </div>
    <!-- /.card-body -->
    <div class="card-footer text-center">
      <a href="javascript:void(0)" class="uppercase">View All Products</a>
    </div>
    <!-- /.card-footer -->
  </div>
  <!-- /.card -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->

<div class="row">
<div class="col-md-12">
      <!-- USERS LIST -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">User TokoOnlen</h3>

          <div class="card-tools">
            <span class="badge badge-danger">{{count($user)}} Pengguna</span>
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <ul class="users-list clearfix">
            @foreach($user as $u)
            <li>
              <img src="{!! asset('assets/images/person.png') !!}" alt="User" style="max-width: 70px;">
              <a class="users-list-name" href="javascript:void(0)">{{$u->name}}</a>
              <span class="users-list-date">{{$u->created_at}}</span>
            </li>
            @endforeach
          </ul>
          <!-- /.users-list -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer text-center">
          <a href="javascript::">View All Users</a>
        </div>
        <!-- /.card-footer -->
      </div>
      <!--/.card -->
    </div>
    <!-- /.col -->

  @endsection