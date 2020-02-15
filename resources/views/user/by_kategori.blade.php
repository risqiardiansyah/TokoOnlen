@extends('template/template')

@section('content')

<!-- Home -->

<div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="{{url('assets/images/shop_background.jpg')}}"></div>
		<div class="home_overlay"></div>
		<div class="home_content d-flex flex-column align-items-center justify-content-center">
			<h2 class="home_title">Kategori {{$nama[0]->nama_kategori}}</h2>
		</div>
	</div>

	<!-- Shop -->

	<div class="shop">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">

					<!-- Shop Sidebar -->
					<div class="shop_sidebar">
						
						<div class="sidebar_section filter_by_section">
							<div class="sidebar_title">Kategori Teratas :</div>
                            <ul class="brands_list">
                            @foreach($all_kategori as $a)
								<li class="brand"><a href="/k/{{$a->link}}" class="@if(Request::segment(2)==$a->link) text-primary @endif">{{$a->nama_kategori}}</a></li>
                            @endforeach
                            </ul>
						</div>
					</div>

				</div>

				<div class="col-lg-9">
					
					<!-- Shop Content -->

					<div class="shop_content">
						<div class="shop_bar clearfix">
							<div class="shop_product_count"><span>{{count($data_barang)}} </span>Produk Ditemukan</div>
							
						</div>

						<div class="product_grid">
							<div class="product_grid_border"></div>

                            <!-- Product Item -->
                            @foreach($data_barang as $d)
							<div class="product_item @if($d->diskon != 0) discount @else is_new @endif">
								<div class="product_border"></div>
								<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{url('assets/images/')}}/{{$d->gambar}}" alt=""></div>
								<div class="product_content">
                                    @if($d->diskon != 0)
                                        <div class="product_price">Rp. {{ number_format($d->harga - ($d->harga * $d->diskon / 100),0,',' , '.') }}<br><span><strike>Rp. {{number_format($d->harga,0, ',' , '.')}}</strike></span></div>
									@else
									    <div class="product_price">Rp. {{number_format($d->harga,0, ',' , '.')}}<br><span></span></div>
                                    @endif
									<div class="product_name"><div><a href="#" tabindex="0">{{$d->nama_barang}}</a></div></div>
								</div>
								<ul class="product_marks">
									<li class="product_mark product_discount">-{{$d->diskon}}%</li>
									<li class="product_mark product_new">Baru</li>
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