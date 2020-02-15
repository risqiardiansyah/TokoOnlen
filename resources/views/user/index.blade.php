@extends('template.template')

@section('content')

	<!-- Banner -->
	
	<div class="banner">
		<div class="banner_background" style="background-image:url(assets/images/banner_background.jpg)"></div>
		<div class="container fill_height">
			<div class="row fill_height">
				@foreach($data_first as $d)
				<div class="banner_product_image" ><img src="{{url('assets/images/')}}/{{$d->gambar}}" width="400px;" alt="..."></div>
				<div class="col-lg-5 offset-lg-4 fill_height">
					<div class="banner_content">
						<h1 class="banner_text">{{$d->nama_barang}}</h1>
						@if($d->diskon == 0)
						<div class="banner_price">Rp. {{number_format($d->harga,0, ',' , '.')}}</div>
						@else
						<div class="banner_price">Rp. {{ number_format($d->harga - ($d->harga * $d->diskon / 100),0,',' , '.') }}<br><span style="font-size:25px;">Rp. {{number_format($d->harga,0, ',' , '.')}}</span></div>
						@endif
						<div class="banner_product_name">{{$d->deskripsi_barang}}</div>
						<div class="button banner_button"><a href="#" role="button" data-toggle="modal" data-target="#throwKeranjang{{$d->id_barang}}">Masukkan Keranjang</a></div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>

	<!-- Characteristics -->

	<div class="characteristics">
		<div class="container"><h4>Kelebihan TokoOnlen</h4>
			<div class="row">
                
				<!-- Char. Item -->
				<div class="col-lg-6 col-md-6 char_col">
					
					<div class="char_item d-flex flex-row align-items-center justify-content-start">
						<div class="char_icon"><img src="{{url('assets/images/char_1.png')}}" alt=""></div>
						<div class="char_content">
							<div class="char_title">Pengiriman Gratis</div>
							<div class="char_subtitle">setiap pembelian di atas Rp. 200.000,00,-</div>
						</div>
					</div>
				</div>

				<!-- Char. Item -->
				<div class="col-lg-6 col-md-6 char_col">
					
					<div class="char_item d-flex flex-row align-items-center justify-content-start">
						<div class="char_icon"><img src="{{url('assets/images/char_4.png')}}" alt=""></div>
						<div class="char_content">
							<div class="char_title">Produk dengan kualitas no 1 di Indonesia</div>
							<div class="char_subtitle">Harga mulai dari Rp. 10.000,00,-</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Deals of the week -->

	<div class="deals_featured">
		<div class="container">
			<div class="row">
				<div class="col d-flex flex-lg-row flex-column align-items-center justify-content-start">
					
					<!-- Deals -->

					<div class="deals">
						<div class="deals_title">Deals of the Week</div>
						<div class="deals_slider_container">
							
							<!-- Deals Slider -->
							<div class="owl-carousel owl-theme deals_slider">
								
								<!-- Deals Item -->
								@foreach($data_first as $f)
								<div class="owl-item deals_item">
									<div class="deals_image"><img src="{{url('assets/images/')}}/{{$f->gambar}}" alt="..."></div>
									<div class="deals_content">
										<div class="deals_info_line d-flex flex-row justify-content-start">
											<div class="deals_item_category"><a href="javascript:void(0)">{{$f->nama_kategori}}</a></div>
											<div class="deals_item_price_a ml-auto"><strike> Rp. {{number_format($f->harga,0, ',' , '.')}}</strike></div>
										</div>
										<div class="deals_info_line d-flex flex-row justify-content-start">
											<div class="deals_item_name"><a href="{{url($f->id_barang.'/'.'detail')}}">{{$f->nama_barang}}</a></div>
											<div class="deals_item_price ml-auto">{{ number_format($d->harga - ($d->harga * $d->diskon / 100),0,',' , '.') }}</div>
										</div>
										<div class="available">
											<div class="available_line d-flex flex-row justify-content-start">
												<div class="available_title">Tersedia: <span>{{$f->jumlah - $f->terjual}}</span></div>
												<div class="sold_title ml-auto">Terjual: <span>{{$f->terjual}}</span></div>
											</div>
											<div class="available_bar"><span style="width:{{ (($f->jumlah - $f->terjual) / $f->jumlah) * 100 }}%"></span></div>
										</div>
										<div class="deals_timer d-flex flex-row align-items-center justify-content-start">
											<div class="deals_timer_title_container">
												<div class="deals_timer_title">Buruan !!!</div>
												<div class="deals_timer_subtitle">Waktu Penawaran Terbatas.</div>
											</div>
											<button class="btn btn-primary" role="button" data-toggle="modal" data-target="#throwKeranjang{{$d->id_barang}}">Masukkan Keranjang</button>
										</div>
									</div>
								</div>
								@endforeach
							</div>

						</div>

						<div class="deals_slider_nav_container">
							<div class="deals_slider_prev deals_slider_nav"><i class="fas fa-chevron-left ml-auto"></i></div>
							<div class="deals_slider_next deals_slider_nav"><i class="fas fa-chevron-right ml-auto"></i></div>
						</div>
					</div>
					
					<!-- Featured -->
					<div class="featured">
						<div class="tabbed_container">
							<div class="tabs">
								<ul class="clearfix">
									<li class="active">Diskon</li>
									<li>Barang Serupa</li>
									<li>Rating Tertinggi</li>
								</ul>
								<div class="tabs_line"><span></span></div>
							</div>

							<!-- Product DISKON Page -->
							<div class="product_panel panel active">
								<div class="featured_slider slider">

									<!-- Slider Item -->
									@foreach($barang_diskon as $dis)
									<div class="featured_slider_item">
										<div class="border_active"></div>
										<div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
											<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{url('assets/images/')}}/{{$dis->gambar}}" alt=""></div>
											<div class="product_content">
												<div class="product_price discount">Rp. {{ number_format($dis->harga - ($dis->harga * $dis->diskon / 100),0,',' , '.') }}<span><strike>Rp. {{number_format($dis->harga,0, ',' , '.')}}</strike></span></div>
												<div class="product_name"><div><a href="{{url($dis->id_barang.'/'.'detail')}}">{{$dis->nama_barang}}</a></div></div>
												<div class="product_extras">
													<button class="product_cart_button" role="button" data-toggle="modal" data-target="#throwKeranjang{{$dis->id_barang}}">Masukkan Keranjang</button>
												</div>
											</div>
											<ul class="product_marks">
												<li class="product_mark product_discount">-{{$dis->diskon}}%</li>
												<li class="product_mark product_new">Baru</li>
											</ul>
										</div>
									</div>
									@endforeach

								</div>
								<div class="featured_slider_dots_cover"></div>
							</div>

							<!-- Product BARANG SERUPA -->

							<div class="product_panel panel">
								<div class="featured_slider slider">

									<!-- Slider Item -->
									@foreach($barang_serupa as $bs)
									<div class="featured_slider_item">
										<div class="border_active"></div>
										<div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
											<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{url('assets/images/')}}/{{$bs->gambar}}" alt=""></div>
											<div class="product_content">
												@if($bs->diskon == 0)
												<div class="product_price discount">Rp. {{number_format($bs->harga,0, ',' , '.')}}</div>
												<div class="product_name"><div><a href="{{url($bs->id_barang.'/'.'detail')}}">{{$bs->nama_barang}}</a></div></div>
												@else
												<div class="product_price discount">Rp. {{ number_format($bs->harga - ($bs->harga * $bs->diskon / 100),0,',' , '.') }}<span><strike>Rp. {{number_format($bs->harga,0, ',' , '.')}}</strike></span></div>
												<div class="product_name"><div><a href="{{url($bs->id_barang.'/'.'detail')}}">{{$bs->nama_barang}}</a></div></div>
												@endif
												<div class="product_extras">
													<button class="product_cart_button" role="button" data-toggle="modal" data-target="#throwKeranjang{{$bs->id_barang}}">Masukkan Keranjang</button>
												</div>
											</div>
											<ul class="product_marks">
												@if($bs->diskon != 0)
													<li class="product_mark product_discount">-{{$bs->diskon}}%</li>
												@endif
												<li class="product_mark product_new">Baru</li>
											</ul>
										</div>
									</div>
									@endforeach

								</div>
								<div class="featured_slider_dots_cover"></div>
							</div>

							<!-- Product Rating Tinggi -->

							<div class="product_panel panel">
								<div class="featured_slider slider">

									<!-- Slider Item -->
									@foreach($rating_tinggi as $rt)
									<div class="featured_slider_item">
										<div class="border_active"></div>
										<div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
											<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{url('assets/images/')}}/{{$rt->gambar}}" alt=""></div>
											<div class="product_content">
												<div style="color:orange">
													@if($rt->rating == 4)
														<i class="fas fa-star"></i>
														<i class="fas fa-star"></i>
														<i class="fas fa-star"></i>
														<i class="fas fa-star"></i>
														<p class="center mb-0">{{$rt->rating}}.0</p>
													@else
														<i class="fas fa-star"></i>
														<i class="fas fa-star"></i>
														<i class="fas fa-star"></i>
														<i class="fas fa-star"></i>
														<i class="fas fa-star"></i>
														<p class="center" style="margin-bottom:0px!Important;">{{$rt->rating}}.0</p>
													@endif
												</div>
												@if($rt->diskon == 0)
												<div class="product_price discount" style="margin-top:0px!Important;">Rp. {{number_format($rt->harga,0, ',' , '.')}}</div>
												<div class="product_name"><div><a href="{{url($rt->id_barang.'/'.'detail')}}">{{$rt->nama_barang}}</a></div></div>
												@else
												<div class="product_price discount" style="margin-top:0px!Important;">Rp. {{ number_format($rt->harga - ($rt->harga * $rt->diskon / 100),0,',' , '.') }}<span><strike>Rp. {{number_format($rt->harga,0, ',' , '.')}}</strike></span></div>
												<div class="product_name"><div><a href="{{url($rt->id_barang.'/'.'detail')}}">{{$rt->nama_barang}}</a></div></div>
												@endif
												<div class="product_extras">
													<button class="product_cart_button" role="button" data-toggle="modal" data-target="#throwKeranjang{{$rt->id_barang}}">Masukkan Keranjang</button>
												</div>
											</div>
											<ul class="product_marks">
												@if($rt->diskon != 0)
													<li class="product_mark product_discount">-{{$rt->diskon}}%</li>
												@endif
												<li class="product_mark product_new">Baru</li>
											</ul>
										</div>
									</div>
									@endforeach

								</div>
								<div class="featured_slider_dots_cover"></div>
							</div>

						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<!-- Categories Tersedia -->

	<div class="popular_categories">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">
					<div class="popular_categories_content">
						<div class="popular_categories_title">Kategori Tersedia</div>
						<div class="popular_categories_slider_nav">
							<div class="popular_categories_prev popular_categories_nav"><i class="fas fa-angle-left ml-auto"></i></div>
							<div class="popular_categories_next popular_categories_nav"><i class="fas fa-angle-right ml-auto"></i></div>
						</div>
						<div class="popular_categories_link">Kategori yang tersedia</div>
					</div>
				</div>
				
				<!-- Popular Categories Slider -->

				<div class="col-lg-9">
					<div class="popular_categories_slider_container">
						<div class="owl-carousel owl-theme popular_categories_slider">

							<!-- Popular Categories Item -->
							@foreach($kategori as $k)
							<div class="owl-item">
								<div class="popular_category d-flex flex-column align-items-center justify-content-center">
									<div class="popular_category_image"><img src="{{url('assets/images/')}}/{{$k->gambar}}" alt=""></div>
									<div class="popular_category_text">{{$k->nama_kategori}}</div>
								</div>
							</div>
							@endforeach

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- New Produk -->

	<div class="new_arrivals">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="tabbed_container">
						<div class="tabs clearfix tabs-right">
							<div class="new_arrivals_title">Barang Terbaru</div>
							<ul class="clearfix">
								<li class="active">Terbaru</li>
							</ul>
							<div class="tabs_line"><span></span></div>
						</div>
						<div class="row">
							<div class="col-lg-9" style="z-index:1;">

								<!-- Product Panel -->
								<div class="product_panel panel active">
									<div class="arrivals_slider slider">

										<!-- Slider Item -->
										@foreach($data_barang as $d)
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{url('assets/images/')}}/{{$d->gambar}}" alt=""></div>
												<div class="product_content">
												@if($d->diskon != 0)
													<div class="product_price discount">Rp. {{ number_format($d->harga - ($d->harga * $d->diskon / 100),0,',' , '.') }}<br><span><strike>Rp. {{number_format($d->harga,0, ',' , '.')}}</strike></span></div>
												@else
													<div class="product_price discount">Rp. {{number_format($d->harga,0, ',' , '.')}}</div>
												@endif
													<div class="product_name"><div><a href="{{url($d->id_barang.'/'.'detail')}}">{{$d->nama_barang}}</a></div></div>
													<div class="product_extras">
														<button class="product_cart_button" role="button" data-toggle="modal" data-target="#throwKeranjang{{$d->id_barang}}">Masukkan Keranjang</button>
													</div>
												</div>
												<ul class="product_marks">
													<li class="product_mark product_discount">-{{$d->diskon}}%</li>
													<li class="product_mark product_new">Baru</li>
												</ul>
											</div>
										</div>
										@endforeach
                                        
									</div>
									<div class="arrivals_slider_dots_cover"></div>
								</div>

							</div>

							@foreach($data_first as $df)
							<div class="col-lg-3">
								<div class="arrivals_single clearfix">
									<div class="d-flex flex-column align-items-center justify-content-center">
										<div class="arrivals_single_image"><img src="{{url('assets/images/')}}/{{$df->gambar}}" alt=""></div>
										<div class="arrivals_single_content">
											<div class="arrivals_single_category"><a href="#">{{$df->nama_kategori}}</a></div>
											<div class="arrivals_single_name_container clearfix">
												<div class="arrivals_single_name"><a href="{{url($df->id_barang.'/'.'detail')}}">{{$df->nama_barang}}</a></div>
												<div class="arrivals_single_price text-right">Rp. {{number_format($df->harga,0, ',' , '.')}}</div>
											</div>
											<div style="color:orange;">
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
											</div><button class="arrivals_single_button" role="button" data-toggle="modal" data-target="#throwKeranjang{{$df->id_barang}}">Masukkan Keranjang</button>
										</div>
										<div class="product_fav active"><i class="fas fa-heart"></i></div>
										<ul class="arrivals_single_marks product_marks">
											<li class="arrivals_single_mark product_mark product_new">Baru</li>
										</ul>
									</div>
								</div>
							</div>
							@endforeach

						</div>
								
					</div>
				</div>
			</div>
		</div>		
	</div>

	<!-- Paling Banyak Terjual -->

	<div class="best_sellers">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="tabbed_container">
						<div class="tabs clearfix tabs-right">
							<div class="new_arrivals_title">Barang Paling Banyak Terjual</div>
							<ul class="clearfix">
								<li class="active">Top 20</li>
							</ul>
							<div class="tabs_line"><span></span></div>
						</div>

						<div class="bestsellers_panel panel active">

							<!-- Paling Banyak Terjual Slider -->

							<div class="bestsellers_slider slider">

								<!-- Best Sellers Item -->
								@foreach($terlaku as $t)
								<div class="bestsellers_item @if($t->diskon != 0) discount @else is_new @endif">
									<div class="bestsellers_item_container d-flex flex-row align-items-center justify-content-start">
										<div class="bestsellers_image"><img src="{{url('assets/images/best_1.png')}}" alt=""></div>
										<div class="bestsellers_content">
											<div class="bestsellers_category"><a href="#">{{$t->nama_kategori}}</a></div>
											<div class="bestsellers_name"><a href="{{url($t->id_barang.'/'.'detail')}}">{{$t->nama_barang}}</a></div>
											<span class="text-secondary">Stok {{$t->jumlah}}</span><br>
											<span class="text-secondary">Terjual {{$t->terjual}}</span>
											@if($t->diskon != 0)
													<div class="product_price discount">Rp. {{ number_format($t->harga - ($t->harga * $t->diskon / 100),0,',' , '.') }}<br><span><strike>Rp. {{number_format($t->harga,0, ',' , '.')}}</strike></span></div>
												@else
													<div class="product_price discount">Rp. {{number_format($t->harga,0, ',' , '.')}}</div>
												@endif
										</div>
									</div>
									<div class="bestsellers_fav active"></div>
									<ul class="bestsellers_marks">
										<li class="bestsellers_mark bestsellers_discount">-{{$t->diskon}}%</li>
										<li class="bestsellers_mark bestsellers_new">Baru</li>
									</ul>
								</div>
								@endforeach

							</div>
                    </div>    
				</div>
			</div>
		</div>
    </div>

@endsection