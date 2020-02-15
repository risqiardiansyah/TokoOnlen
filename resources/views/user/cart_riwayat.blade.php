@extends('template.template')

@section('content')

<!-- Cart -->
{{-- {{dd($data)}} --}}
	<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1">
					<div class="cart_container">
						<p class="text-danger" id="form_result"></p>
						<div class="cart_title">Riwayat Pembelian Anda</div>

						
						@if(count($data) == 0)
						<br>
							<hr>
							<h1 class="text-center display-5">Belum Ada Riwayat</h1>
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
											{{-- pengecekan, disetujui, dikemas, dikirim, diterima, ditolak --}}
											<div class="cart_item_title text-success">Status</div>
											@if($d->status == 'd' && $d->status_pembelian == 'ditolak')
												<div class="cart_item_text text-danger">Ditolak <i class="fas fa-question-circle" data-container="body" data-placement="bottom" data-toggle="popover" title="Penjelasan" data-content="Barang Ditolak Karena Stok Habis"></i></div>
											@elseif($d->status == 'd' && $d->status_pembelian != 'ditolak' && $d->status_pembelian != 'diterima')
												<div class="cart_item_text text-warning">Dibatalkan <i class="fas fa-question-circle" data-container="body" data-placement="bottom" data-toggle="popover" title="Penjelasan" data-content="Barang Dibatalkan Pemesanan"></i></div>
											@elseif($d->status == 'd' && $d->status_pembelian == 'diterima')
												<div class="cart_item_text text-success">Diterima <i class="fas fa-question-circle" data-container="body" data-placement="bottom" data-toggle="popover" title="Penjelasan" data-content="Barang Dibatalkan Pemesanan"></i></div>
											@endif
										</div>
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

						@if(count($data)==0)

						{{-- // --}}
						@else
						<div class="cart_buttons">
							<a href="#" type="button" class="btn btn-lg btn-danger" data-toggle="modal" data-target="#modal_hapus_all_riwayat" title="Hapus Semua Barang">Hapus Semua</a>
						</div>
						@endif

				</div>
			</div>
		</div>
	</div>

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

{{-- modal hapus all  --}}
<div class="modal fade" id="modal_hapus_all_riwayat" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">

    <div class="modal-content">
    	<div class="modal-header bg-danger text-white">
	        <h5 class="modal-title">Hapus Seluruh Data</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
      	</div>

      	<div class="modal-body">
      		<p>Yakin Ingin Menghapus Semua Barang Dari Riwayat ???</p>
      	</div>
		
	    <form class="form_hapus_all_riwayat" enctype="multipart/form-data">
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

@endsection