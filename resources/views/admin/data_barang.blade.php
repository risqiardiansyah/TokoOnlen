@extends('template.template_admin')

@section('content')

<div class="col-md-12">

  <!-- PRODUCT LIST -->
  <a href="javascript:void(0)" class="btn btn-primary mb-3" role="button" data-toggle="modal" data-target="#modal_tambah">Tambah +</a>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Data Barang</h3>

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
        @foreach($barang as $d)
        <li class="item">
          <div class="product-img">
            <img src="{{asset('assets/images/')}}/{{$d->gambar}}" alt="Product Image" class="img-size-50">
          </div>

          <div class="product-info">
            <a href="javascript:void(0)" class="product-title"> {{$d->nama_barang}}

            	@for($i=1; $i<=$d->rating; $i++)
            		<i class="fas fa-star text-sm" style="color: orange"></i>
            	@endfor
            <span class="badge badge-warning float-right">Rp. {{number_format($d->harga,0,',','.')}}</span></a>

              

            <span class="product-description">
            	<small class="text-dark">Detail Barang :</small><br>
              	{{$d->deskripsi_barang}}<br>
            	Jumlah : {{ $d->jumlah }} | Terjual : {{$d->terjual}} | Tersisa : {{$d->jumlah - $d->terjual}}<br>
            	Diskon : {{$d->diskon}}%<br>
            	Kondisi : {{$d->kondisi}}
              	<a href="javascript:void(0)">
              		<span class="badge badge-success float-right" role="button" data-toggle="modal" data-target="#modal_edit{{$d->id_barang}}">Edit</span>
              		<span class="badge badge-danger float-right" role="button" data-toggle="modal" data-target="#modal_hapus{{$d->id_barang}}">Hapus</span>
          		</a>
            </span>
          </div>
        </li>
        @endforeach
        <!-- /.item -->
      </ul>
    </div>
  </div>
  <!-- /.card -->
</div>
<!-- /.col -->

<!-- Modal Tambah-->
<div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		<div class="modal-header bg-primary text-white">
		    <h5 class="modal-title " id="exampleModalLongTitle">Tambah Barang</h5>
		    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		      <span aria-hidden="true">&times;</span>
		    </button>
		  </div>
		  <div class="modal-body">
		    <div class="row">

		      <div class="col-12">
		        <div class="row">
		            <div class="col-md-12">
		            <div id="form"></div>
		            <form class="form_tambah_barang" name="form_edit_barang" enctype="multipart/form-data"><br>
		            	@csrf
		            	<div class="form-group">
						    <label for="">Nama Barang :</label>
						    <input type="text" name="nama_barang" class="form-control text-dark" required>
						</div>
						<label for="inputGroupFile01"> Gambar Barang</label>
						<div class="custom-file">
						    <input type="file" class="custom-file-input cfll" name="gambar" aria-describedby="inputGroupFileAddon01" required>
						    <label class="custom-file-label lbl_fll"></label>
						</div>
		            	<div class="form-group">
						    <label for="">Deskripsi Barang :</label>
						    <textarea type="text" name="deskripsi_barang" class="form-control text-dark" required></textarea>
						</div>
						
						<div class="form-group">
						    <label for="">Jumlah Barang :</label>
						    <input type="number" name="jumlah" class="form-control text-dark" required>
						</div>
						<div class="form-group">
						    <label for="">Harga Barang :</label>
						    <input type="number" name="harga" class="form-control text-dark harga" required>
						    <p class="text-secondary"><small class="nf_harga"> </small></p>
						</div>
						<div class="form-group">
							<label for="">Diskon</label>
							<select class="form-control text-dark" name="diskon" style="min-width: 50px; margin-left: 0px;">
								@for($i=0; $i<=100; $i++)
						    	<option value="{{$i}}">{{$i}} %</option>
						    	@endfor
						    </select>
						</div>
						<div class="form-group">
							<label for="">Kondisi</label>
							<select class="form-control text-dark" name="kondisi" style="min-width: 50px; margin-left: 0px;">
						    	<option value="baru">Baru</option>
						    	<option value="bekas">Bekas</option>
						    </select>
						</div>
						<div class="form-group">
							<label for="">Kategori</label>
							<select class="form-control text-dark" name="id_kategori" style="min-width: 50px; margin-left: 0px;">
								@foreach($kategori as $k)
									<option value="{{$k->id_kategori}}">{{$k->nama_kategori}}</option>
								@endforeach
						    </select>
						</div>

						<div class="text-center">
			                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
			                <button type="submit" class="btn btn-primary btn_edit">Simpan</button>
			                <button class="btn btn-secondary btn_proses" hidden>
			                  <i class="fas fa-spinner fa-spin animated ml-2" aria-hidden="true"></i>
			                </button>
		              	</div>
					</form>

		            </div>
		        </div>

		      </div>
		    </div>
		  	</div>
		</div>
	</div>
</div>
{{-- end Modal --}}

<!-- Modal EDIT -->
@foreach($barang as $dab)
<div class="modal fade" id="modal_edit{{$dab->id_barang}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		<div class="modal-header bg-primary text-white">
		    <h5 class="modal-title " id="exampleModalLongTitle">Edit Barang</h5>
		    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		      <span aria-hidden="true">&times;</span>
		    </button>
		  </div>
		  <div class="modal-body">
		    <div class="row">
		      <div class="col-lg-5">
		        <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails"
		          data-ride="carousel">
		            <div class="carousel-item active">
		              <img class="d-block w-100"
		                src="{{url('assets/images/')}}/{{$dab->gambar}}" alt="First slide">
		            </div>
		        </div>
		      </div>

		      <div class="col-lg-7">
		      	<p class="text-danger" id="form_result"></p>
		        <div class="row">
		            <div class="col-md-12">
		            <div id="form"></div>
		            <form class="form_edit_barang" name="form_edit_barang" enctype="multipart/form-data"><br>
		            	@csrf
		            	<div class="form-group">
						    <label for="">Nama Barang :</label>
						    <input type="text" name="nama_barang" class="form-control text-dark" value="{{$dab->nama_barang}}">
						</div>
						<label for="inputGroupFile01"> Gambar Barang</label>
						<div class="custom-file">
						    <input type="file" class="custom-file-input cfl" name="gambar" aria-describedby="inputGroupFileAddon01">
						    <label class="custom-file-label lbl_fl"></label>
						</div>
		            	<div class="form-group">
						    <label for="">Deskripsi Barang :</label>
						    <textarea type="text" name="deskripsi_barang" class="form-control text-dark">{{$dab->nama_barang}}</textarea>
						</div>
		            	<div class="form-group">
							<input class="form-control" name="id_barang" value="{{$dab->id_barang}}" readonly hidden="true">
						</div>
						<div class="form-group">
							<input class="form-control" name="id_user" value="{{Auth::id()}}" readonly hidden="true">
						</div>
						<div class="form-group">
							<input class="form-control" name="gambar_sblm" value="{{$dab->gambar}}" readonly hidden="true">
						</div>
						
						<div class="form-group">
						    <label for="">Jumlah Barang :</label>
						    <input type="number" name="jumlah" class="form-control text-dark" value="{{$dab->jumlah}}">
						</div>
						<div class="form-group">
						    <label for="">Harga Barang :</label>
						    <input type="number" name="harga" class="form-control text-dark harga" value="{{$dab->harga}}" maxlength="3">
						    <p class="text-secondary"><small class="nf_harga"> </small></p>
						</div>
						<div class="form-group">
							<label for="">Diskon</label>
							<select class="form-control text-dark" name="diskon" style="min-width: 50px; margin-left: 0px;">
								<option value="{{$dab->diskon}}">{{$dab->diskon}} %</option>
								@for($i=0; $i<=100; $i++)
						    	<option value="{{$i}}">{{$i}} %</option>
						    	@endfor
						    </select>
						</div>
						<div class="form-group">
							<label for="">Kondisi</label>
							<select class="form-control text-dark" name="kondisi" style="min-width: 50px; margin-left: 0px;">
								<option value="{{$dab->kondisi}}">{{$dab->kondisi}}</option>
						    	<option value="baru">Baru</option>
						    	<option value="bekas">Bekas</option>
						    </select>
						</div>
						<div class="form-group">
							<label for="">Kategori</label>
							<select class="form-control text-dark" name="id_kategori" style="min-width: 50px; margin-left: 0px;">
								@foreach($kategori as $k)
									<option value="{{$k->id_kategori}}">{{$k->nama_kategori}}</option>
								@endforeach
						    </select>
						</div>

						<div class="text-center">
			                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
			                <button type="submit" class="btn btn-primary btn_edit">Simpan</button>
			                <button class="btn btn-secondary btn_proses" hidden>
			                  <i class="fas fa-spinner fa-spin animated ml-2" aria-hidden="true"></i>
			                </button>
		              	</div>
					</form>

		            </div>
		        </div>

		      </div>
		    </div>
		  	</div>
		</div>
	</div>
</div>
@endforeach
{{-- end Modal --}}

<!-- Modal Hapus Satu barang-->
@foreach($barang as $dab)
<div class="modal fade" id="modal_hapus{{$dab->id_barang}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">

    <div class="modal-content">
    	<div class="modal-header bg-danger text-white">
	        <h5 class="modal-title">Hapus Data {{$dab->nama_barang}}</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
      	</div>

      	<div class="modal-body">
      		<p>Yakin Ingin Menghapus Barang {{$dab->nama_barang}} Dari Keranjang ???</p>
      	</div>
		
	    <form class="form_hapus_barang" enctype="multipart/form-data">
	    	@csrf
	      	<input type="hidden" name="id_barang" value="{{$dab->id_barang}}">
	      	<input type="hidden" name="gambar" value="{{$dab->gambar}}">
		    <div class="modal-footer">
		        <button type="submit" class="btn btn-danger btn_yakin">Yakin</button>
		        <button class="btn btn-secondary btn_proses" hidden="true">
	                <i class="fas fa-spinner fa-spin animated ml-2" aria-hidden="true"></i>
	            </button>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
		        
		    </div>
  		</form>
  	</div>

  </div>
</div>
@endforeach
{{-- end Modal hapus--}}


@endsection