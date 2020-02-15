@extends('template.template')

@section('content')

<!-- Cart -->

	<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1">
					<div class="cart_container">
						<div id="form_result"></div>
						<p class="text-right text-primary"><a href="{{url('/cart/riwayat/')}}/{{$hash}}">Riwayat</a></p>
						<div class="cart_title">Keranjang Anda</div>

						@if(count($data) == 0)
						<br>
							<hr>
							<h1 class="text-center display-5">Keranjang Kosong</h1>
							<hr>
						<br>
						@endif

						<div class="cart_items">
							@foreach($data as $d)
							<ul class="cart_list">
								<li class="cart_item clearfix">
									<div class="cart_item_image"><img src="{{url('assets/images/')}}/{{$d->gambar}}" alt=""></div>
									<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
										<div class="cart_item_name cart_info_col">
											<div class="cart_item_title">Nama</div>
											<div class="cart_item_text">{{$d->nama_barang}}</div>
										</div>
										<div class="cart_item_color cart_info_col">
											<div class="cart_item_title">Kondisi</div>
											<div class="cart_item_text">{{ucfirst($d->kondisi)}}</div>
										</div>
										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_title">Jumlah</div>
											<div class="cart_item_text">{{$d->jumlah_pesan}}</div>
										</div>
										<div class="cart_item_price cart_info_col">
											<div class="cart_item_title">Harga</div>
											@if($d->diskon == 0)
												<div class="cart_item_text">Rp. {{number_format($d->harga,0,',','.')}}</div>
											@else
												<div class="cart_item_text">
													Rp. {{number_format($d->harga - ($d->harga * $d->diskon / 100),0,',','.')}}<br>
													<small style="font-size:13px; color: red;">{{$d->diskon}}% OFF <strike>{{number_format($d->harga,0,',','.')}}</strike></small>
												</div>
											@endif
										</div>
										<div class="cart_item_total cart_info_col">
											<div class="cart_item_title">Total</div>
											<div class="cart_item_text">Rp. {{number_format($d->total ,0,',' , '.') }}</div>
										</div>
										<div class="cart_item_total cart_info_col">
											<div class="cart_item_title">Action</div>
											<div class="cart_item_text">
												<a href="#" class="btn btn-sm btn-primary" role="button" data-toggle="modal" data-target="#modal_checkout_single{{$d->id_keranjang}}" title="Checkout Barang">Checkout</a>
											</div>
										</div>
										<div class="cart_item_total cart_info_col">
											<div class="cart_item_title">Action</div>
											<div class="cart_item_text">
												<a href="#" class="btn btn-sm btn-success" role="button" data-toggle="modal" data-target="#modal_edit{{$d->id_barang}}" title="Edit Barang"><i class="fas fa-edit"></i></a>
												<a href="" class="btn btn-danger btn-sm" role="button" data-toggle="modal" data-target="#modal_hapus{{$d->id_keranjang}}" title="Hapus Barang"><i class="fas fa-trash"></i></a>
											</div>
										</div>
										<div class="cart_item_total cart_info_col">
											<div class="cart_item_title"><i class="fas fa-question-circle text-primary" data-container="body" data-placement="bottom" data-toggle="popover" title="Catatan Barang" data-content="{{ $d->keterangan }}"></i></div>
										</div>
									</div>
								</li>
							</ul>
							@endforeach
						</div>
						
						<!-- Order Total -->
						<div class="order_total">
							<div class="order_total_content text-md-right">
								<div class="order_total_title">Order Total:</div>
									<div class="order_total_amount">
										Rp. {{number_format($sum_harga,0,',','.')}}
									</div>
							</div>
						</div>

						@if(count($data)==0)

						{{-- // --}}
						@else
						<div class="cart_buttons">
							<a href="#" type="button" class="btn btn-lg btn-danger" data-toggle="modal" data-target="#modal_hapus_all" title="Hapus Semua Barang">Hapus Semua</a>
							<button type="button" class="button cart_button_checkout" data-toggle="modal" data-target="#modal_checkout_all" title="Checkout Semua Barang">Checkout Semua</button>
						</div>
						@endif
					<hr>
					<hr>
					<hr>
						<p class="text-danger" id="form_result"></p>
						<div class="cart_title">Barang checkout/pesanan Anda</div>
						
						@if(count($checkout) == 0)
							<br>
							<hr>
							<h1 class="text-center display-5">Checkout Kosong</h1>
							<p class="text-center text-primary"><a href="{{url('/cart/riwayat/')}}/{{$hash}}">Riwayat</a></p>
							<hr>
							<br>

						@endif

						<div class="cart_items">
							@foreach($checkout as $ck)
							<ul class="cart_list">
								<li class="cart_item clearfix">
									<div class="cart_item_image"><img src="{{url('assets/images/')}}/{{$ck->gambar}}" alt=""></div>
									<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
										<div class="cart_item_name cart_info_col">
											{{-- pengecekan, disetujui, dikemas, dikirim, diterima, ditolak --}}
											<div class="cart_item_title text-success">Status</div>
											@if($ck->status_pembelian =='pengecekan')
												<div class="cart_item_text text-info">Pengecekan <i class="fas fa-question-circle" data-container="body" data-placement="bottom" data-toggle="popover" title="Penjelasan" data-content="Barang Dalam Tahap Pengecekan Ketersediaan"></i></div>
											@elseif($ck->status_pembelian =='disetujui')
												<div class="cart_item_text text-warning">Disetujui <i class="fas fa-question-circle" data-container="body" data-placement="bottom" data-toggle="popover" title="Penjelasan" data-content="Barang Disetujui dan Menunggu Pembayaran"></i></div>
											@elseif($ck->status_pembelian =='dikemas')
												<div class="cart_item_text text-warning">Dikemas <i class="fas fa-question-circle" data-container="body" data-placement="bottom" data-toggle="popover" title="Penjelasan" data-content="Barang Dalam Tahap Pengemasan"></i></div>
											@elseif($ck->status_pembelian =='dikirim')
												<div class="cart_item_text text-success">Dikirim <i class="fas fa-question-circle" data-container="body" data-placement="bottom" data-toggle="popover" title="Penjelasan" data-content="Barang Dalam Tahap Pengiriman Kepada Anda"></i></div>
											@elseif($ck->status_pembelian =='diterima')
												<div class="cart_item_text text-success">Diterima <i class="fas fa-question-circle" data-container="body" data-placement="bottom" data-toggle="popover" title="Penjelasan" data-content="Barang Telah Diterima Oleh Anda"></i></div>
											@else
												<div class="cart_item_text text-danger">Ditolak <i class="fas fa-question-circle" data-container="body" data-placement="bottom" data-toggle="popover" title="Penjelasan" data-content="Barang Ditolak karena Stok Barang Sudah Tidak Tersedia."></i></div>
											@endif
										</div>
										<div class="cart_item_color cart_info_col">
											<div class="cart_item_title">Nama</div>
											<div class="cart_item_text">{{$ck->nama_barang}}</div>
										</div>
										<div class="cart_item_color cart_info_col">
											<div class="cart_item_title">Kondisi</div>
											<div class="cart_item_text">{{ucfirst($ck->kondisi)}}</div>
										</div>
										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_title">Jumlah</div>
											<div class="cart_item_text">{{$ck->jumlah_pesan}}</div>
										</div>
										<div class="cart_item_price cart_info_col">
											<div class="cart_item_title">Harga</div>
											@if($ck->diskon == 0)
												<div class="cart_item_text">Rp. {{number_format($ck->harga,0,',','.')}}</div>
											@else
												<div class="cart_item_text">
													Rp. {{number_format($ck->harga - ($ck->harga * $ck->diskon / 100),0,',','.')}}<br>
													<small style="font-size:13px; color: red;">{{$ck->diskon}}% OFF <strike>{{number_format($ck->harga,0,',','.')}}</strike></small>
												</div>
											@endif
										</div>
										<div class="cart_item_total cart_info_col">
											<div class="cart_item_title">Total</div>
											<div class="cart_item_text">Rp. {{number_format($ck->total ,0,',' , '.') }}</div>
										</div>
										<div class="cart_item_total cart_info_col">
											<div class="cart_item_title">Action</div>
											<div class="cart_item_text">
												@if($ck->status_pembelian =='pengecekan' || $ck->status_pembelian =='disetujui')
													<a href="" class="btn btn-danger btn-sm" role="button" data-toggle="modal" data-target="#modal_batal{{$ck->id_keranjang}}" title="Hapus Barang">Batalkan</i></a>
												@elseif($ck->status_pembelian =='dikemas')
													<p>---</p>
												@elseif($ck->status_pembelian =='dikirim')
													<a href="" class="btn btn-success btn-sm" role="button" data-toggle="modal" data-target="#modal_konfirmasi{{$ck->id_keranjang}}" title="Konfirmasi Barang">Konfirmasi</i></a>
												@else
													<a href="" class="btn btn-danger btn-sm" role="button" data-toggle="modal" data-target="#modal_hapus_c{{$ck->id_keranjang}}" title="Hapus Barang"><i class="fas fa-trash"></i></a>
												@endif
											</div>
										</div>
										<div class="cart_item_total cart_info_col">
											<div class="cart_item_title"><i class="fas fa-question-circle text-primary" data-container="body" data-placement="bottom" data-toggle="popover" title="Catatan Barang" data-content="{{ $ck->keterangan }}"></i></div>
										</div>
									</div>
								</li>
							</ul>
							@endforeach
						</div>
						
						
						<!-- Order Total -->
						<div class="order_total">
							<div class="order_total_content text-md-right">
								<div class="order_total_title">Order Total:</div>
									<div class="order_total_amount">
										Rp. {{number_format($sum_harga_c,0,',','.')}}
									</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

<!-- Modal edit-->
@foreach($data as $dab)
<div class="modal fade" id="modal_edit{{$dab->id_barang}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header bg-primary text-white">
    <h5 class="modal-title " id="exampleModalLongTitle">Tambah Barang ke Keranjang</h5>
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
                src="{{url('assets/images/')}}/{{$dab->gambar}}"
                alt="First slide">
            </div>
        </div>
      </div>

      <div class="col-lg-7">
      	<p class="text-danger" id="form_result"></p>
        <h2 class="h2-responsive product-name">
          <strong>{{$dab->nama_barang}}</strong>
        </h2>
        <h4 class="h4-responsive">
        	@if($dab->diskon!=0)
				<span class="text-success">
					<strong>Rp. {{number_format($dab->harga,0, ',' , '.')}}</strong>
				</span>
	            <span class="text-secondary">
	            	<small>
	                  <s>Rp. {{ number_format($dab->harga - ($dab->harga * $dab->diskon / 100),0,',' , '.') }}</s>
	                </small>
	            </span>
	        @else
	        	<span class="text-success">
					<strong>Rp. {{number_format($dab->harga,0, ',' , '.')}}</strong>
				</span>
	        @endif
        </h4>

        <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">
          <div class="card">

            <div class="card-header" role="tab" id="headingOne1">
              <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1" aria-expanded="true"
                aria-controls="collapseOne1">
                <h5 class="mb-0">
                  Deskripsi Barang <i class="fas fa-angle-down rotate-icon"></i>
                </h5>
              </a>
            </div>

            <div id="collapseOne1" class="collapse show" role="tabpanel" aria-labelledby="headingOne1"
              data-parent="#accordionEx">
              <div class="card-body"> {{$dab->deskripsi_barang}} </div>
            </div>

          </div>

        </div>

        <div class="row">
            <div class="col-md-12">
            <div id="form"></div>
            <form class="form_edit_keranjang" name="form_tambah" enctype="multipart/form-data"><br>
            	@csrf
            	<div class="form-group">
					<input class="form-control" name="id_keranjang" value="{{$dab->id_keranjang}}" readonly hidden="true">
				</div>
            	<div class="form-group">
					<input class="form-control" name="id_barang" value="{{$dab->id_barang}}" readonly hidden="true">
				</div>
				<div class="form-group">
					<input class="form-control" name="id_user" value="{{Auth::id()}}" readonly hidden="true">
				</div>
				<div class="form-group">
					<input class="form-control" name="harga" value="{{($dab->harga - ($dab->harga * $dab->diskon / 100))}}" readonly hidden="true">
				</div>
				<div class="form-group">
				    <label for="">Jumlah Barang :</label><small class="text-secondary">*Angka pertama adalah jml sebelumnya</small>
				    <select class="form-control text-dark" name="jumlah_pesan" style="min-width: 50px; margin-left: 0px;">
				    	<option value="{{$dab->jumlah_pesan}}">{{$dab->jumlah_pesan}}</option>
				    	@for($i=1; $i <= $dab->jumlah; $i++ )
				    		<option value="{{$i}}">{{$i}}</option>
				    	@endfor
				    </select>
				</div>
				<div class="form-group">
				    <label for="">Keterangan/Catatan : </label>
					<textarea class="form-control text-dark" name="keterangan" rows="3" required>{{$dab->keterangan}}</textarea>
					<small class="text-secondary">*isi dengan "--" jika tidak ada catatan.</small>
				</div>

				<div class="text-center">
	                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
	                <button type="submit" class="btn btn-primary btn_edit">Masukkan
	                  <i class="fas fa-cart-plus ml-2" aria-hidden="true"></i>
	                </button>
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
{{-- end Modal edit--}}

<!-- Modal Hapus Satu barang-->
@foreach($data as $dab)
<div class="modal fade" id="modal_hapus{{$dab->id_keranjang}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
		
	    <form class="form_hapus_keranjang" enctype="multipart/form-data">
	    	@csrf
	      <input type="hidden" name="id_keranjang" value="{{$dab->id_keranjang}}">
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

<!-- Modal Hapus Satu barang c-->
@foreach($checkout as $dab)
<div class="modal fade" id="modal_hapus_c{{$dab->id_keranjang}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
		
	    <form class="form_hapus_keranjang" enctype="multipart/form-data">
	    	@csrf
	      <input type="hidden" name="id_keranjang" value="{{$dab->id_keranjang}}">
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
{{-- end Modal hapus c--}}

<!-- Modal Hapus Satu barang c-->
@foreach($checkout as $dab)
<div class="modal fade" id="modal_batal{{$dab->id_keranjang}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">

    <div class="modal-content">
    	<div class="modal-header bg-danger text-white">
	        <h5 class="modal-title">Batalkan Pemesanan {{$dab->nama_barang}}</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
      	</div>

      	<div class="modal-body">
      		<p>Yakin Ingin Membatalkan Pesanan Barang {{$dab->nama_barang}} ???</p>
      	</div>
		
	    <form class="form_batal_pesan" enctype="multipart/form-data">
	    	@csrf
	      <input type="hidden" name="id_keranjang" value="{{$dab->id_keranjang}}">
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
{{-- end Modal hapus c--}}

{{-- modal hapus all  --}}
<div class="modal fade" id="modal_hapus_all" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">

    <div class="modal-content">
    	<div class="modal-header bg-danger text-white">
	        <h5 class="modal-title">Hapus Seluruh Data</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
      	</div>

      	<div class="modal-body">
      		<p>Yakin Ingin Menghapus Semua Barang Dari Keranjang ???</p>
      	</div>
		
	    <form class="form_hapus_all" enctype="multipart/form-data">
	    	@csrf
	      <input type="hidden" name="id_user" value="{{Auth::id()}}">
		    <div class="modal-footer">
		        <button type="submit" class="btn btn-danger btn_yakin">Ya</button>
		        <button class="btn btn-secondary btn_proses" hidden="true">
	                <i class="fas fa-spinner fa-spin animated ml-2" aria-hidden="true"></i>
	            </button>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
		        
		    </div>
  		</form>
  	</div>

  </div>
</div>
{{-- end Modal hapus--}}

{{-- modal konfirmasi  --}}
@foreach($checkout as $d)
<div class="modal fade" id="modal_konfirmasi{{$d->id_keranjang}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">

    <div class="modal-content">
    	<div class="modal-header bg-success text-white">
	        <h5 class="modal-title">Hapus Seluruh Data</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
      	</div>

      	<div class="modal-body">
      		<p>Konfirmasi Barang Bahwa Sudah Anda Terima ???</p>
      	</div>
		
	    <div class="modal-footer">
	        <button type="button" class="btn btn-success btn_yakin" onclick="kemas('diterima',{{$d->id_keranjang}})">Ya</button>
	        <button class="btn btn-secondary btn_proses" hidden="true">
                <i class="fas fa-spinner fa-spin animated ml-2" aria-hidden="true"></i>
            </button>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
	        
	    </div>
  	</div>

  </div>
</div>
@endforeach
{{-- end konfiirmasi--}}

{{-- modal checkout --}}
<div class="modal fade" id="modal_checkout_all" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">

    <div class="modal-content">
    	<div class="modal-header bg-primary text-white">
	        <h5 class="modal-title">Checkout Seluruh Barang</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
      	</div>

      	<div class="modal-body">
  		<form class="formc_all" enctype="multipart/form-data">
    		@csrf
    		<input type="hidden" name="status" value="c">
			<input type="hidden" name="id_user" value="{{Auth::id()}}">
      		<div class="form-group">
      			<small class="text-secondary">*nama dan alamat penerima merupakan nama anda di profile</small><br><br>
			    <label>-- Pilih Metode Pembayaran : --</label>
			    <select class="form-control text-dark" name="id_pembayaran" style="min-width: 250px; margin-left: 0px;">
			    	@foreach($metode_pembayaran as $mp)
			    		<option value="{{$mp->id_pembayaran}}">{{$mp->nama_pembayaran}}</option>
			    	@endforeach
			    </select>
			</div>
	      
		    <div class="modal-footer">
		        <button type="submit" class="btn btn-primary btn_yakin">Konfirmasi</button>
		        <button class="btn btn-secondary btn_proses" hidden="true">
	                <i class="fas fa-spinner fa-spin animated ml-2" aria-hidden="true"></i>
	            </button>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
		        
		    </div>

  		</form>
  	</div>
  	</div>

  </div>
</div>
{{-- end Modal checkout--}}

{{-- modal checkout single --}}
@foreach($data as $co)
<div class="modal fade" id="modal_checkout_single{{$co->id_keranjang}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">

    <div class="modal-content">
    	<div class="modal-header bg-primary text-white">
	        <h5 class="modal-title">Checkout Barang {{$co->nama_barang}}</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
      	</div>

      	<div class="modal-body">
  		<form class="formc_single" enctype="multipart/form-data">
    		@csrf
    		<input type="hidden" name="id_keranjang" value="{{$co->id_keranjang}}">
    		<input type="hidden" name="status_pembelian" value="pengecekan">
      		<div class="form-group">
      			<small class="text-secondary">*nama dan alamat penerima merupakan nama anda di profile</small><br><br>
			    <label>-- Pilih Metode Pembayaran : --</label>
			    <select class="form-control text-dark" name="id_pembayaran" style="min-width: 250px; margin-left: 0px;">
			    	@foreach($metode_pembayaran as $mp)
			    		<option value="{{$mp->id_pembayaran}}">{{$mp->nama_pembayaran}}</option>
			    	@endforeach
			    </select>
			</div>
	      
		    <div class="modal-footer">
		        <button type="submit" class="btn btn-primary btn_yakin">Konfirmasi</button>
		        <button class="btn btn-secondary btn_proses" hidden="true">
	                <i class="fas fa-spinner fa-spin animated ml-2" aria-hidden="true"></i>
	            </button>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
		        
		    </div>

  		</form>
  	</div>
  	</div>

  </div>
</div>
@endforeach
{{-- end Modal checkout single --}}

@endsection