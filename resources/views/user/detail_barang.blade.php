@extends('template.template')

@section('content')

<div class="col-12 mt-4 mb-4">
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Barang</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    @foreach($data_barang as $d)
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
              <div class="col-12">
                <img src="{{url('assets/images/')}}/{{$d->gambar}}" class="product-image" alt="Product Image" width="500px">
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3">{{$d->nama_barang}}</h3>
              @if($d->rating == 5)
                <i class="fas fa-star" style="color: orange;"></i>
                <i class="fas fa-star" style="color: orange;"></i>
                <i class="fas fa-star" style="color: orange;"></i>
                <i class="fas fa-star" style="color: orange;"></i>
                <i class="fas fa-star" style="color: orange;"></i>
                {{$d->rating.".0"}}
              @elseif($d->rating == 4)
                <i class="fas fa-star" style="color: orange;"></i>
                <i class="fas fa-star" style="color: orange;"></i>
                <i class="fas fa-star" style="color: orange;"></i>
                <i class="fas fa-star" style="color: orange;"></i>
                <i class="fas fa-star" style="color: grey;"></i>
                {{$d->rating.".0"}}
              @elseif($d->rating == 3)
                <i class="fas fa-star" style="color: orange;"></i>
                <i class="fas fa-star" style="color: orange;"></i>
                <i class="fas fa-star" style="color: orange;"></i>
                <i class="fas fa-star" style="color: grey;"></i>
                <i class="fas fa-star" style="color: grey;"></i>
                {{$d->rating.".0"}}
              @elseif($d->rating == 2)
                <i class="fas fa-star" style="color: orange;"></i>
                <i class="fas fa-star" style="color: orange;"></i>
                <i class="fas fa-star" style="color: grey;"></i>
                <i class="fas fa-star" style="color: grey;"></i>
                <i class="fas fa-star" style="color: grey;"></i>
                {{$d->rating.".0"}}
              @elseif($d->rating == 1)
                <i class="fas fa-star" style="color: orange;"></i>
                <i class="fas fa-star" style="color: grey;"></i>
                <i class="fas fa-star" style="color: grey;"></i>
                <i class="fas fa-star" style="color: grey;"></i>
                <i class="fas fa-star" style="color: grey;"></i>
                {{$d->rating.".0"}}
              @else
                <i class="fas fa-star" style="color: grey;"></i>
                <i class="fas fa-star" style="color: grey;"></i>
                <i class="fas fa-star" style="color: grey;"></i>
                <i class="fas fa-star" style="color: grey;"></i>
                <i class="fas fa-star" style="color: grey;"></i>
                {{$d->rating.".0"}}
              @endif
              <p>{{$d->deskripsi_barang}}</p>

              <hr>

              <div class="bg-gray py-2 px-3 mt-4">
                  <h3 class="text-primary">
                    Stok : {{$d->jumlah - $d->terjual}}
                  </h3>
                  <br>
                @if($d->diskon == 0 || $d->diskon == null)
                  <h2 class="mb-0">
                    Rp. {{number_format($d->harga,0,',','.')}}
                  </h2>
                @else
                  <h2 class="mb-0">
                    Rp. {{number_format($d->harga - ($d->harga * $d->diskon / 100),0,',','.')}}
                  </h2>
                  <h4 class="mt-0">
                    <small class="text-danger">
                     <strike>Rp. {{number_format($d->harga,0,',','.')}}</strike>
                    </small>
                  </h4>
                @endif
              </div>

              <div class="mt-4">
                <div class="btn btn-primary btn-lg btn-flat" role="button" data-toggle="modal" data-target="#throwKeranjang{{$d->id_barang}}">
                  <i class="fas fa-cart-plus fa-lg mr-2"></i> 
                  Masukkan Keranjang
                </div>
              </div>

            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
      <br><br>
      <hr>

    </section>
    <!-- /.content -->
    @endforeach
  </div>
  <!-- /.content-wrapper -->
</div>

  @endsection