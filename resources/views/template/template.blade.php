<!DOCTYPE html>
<html lang="en">
<head>
<title>TokoOnlen</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="OneTech shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="shortcut icon" href="{{ asset('assets/images/char_3.png') }}">

<link rel="stylesheet" type="text/css" href="{!! asset('assets/styles/bootstrap4/bootstrap.min.css') !!}">
<link href="{!! asset('assets/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') !!}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{!! asset('assets/plugins/OwlCarousel2-2.2.1/owl.carousel.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset('assets/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset('assets/plugins/OwlCarousel2-2.2.1/animate.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset('assets/plugins/slick-1.8.0/slick.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset('assets/sweetalert/sweetalert2.min.css') !!}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

/* Button used to open the chat form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 10px 14px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup chat - hidden by default */
.chat-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width textarea */
.form-container textarea {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  resize: none;
  min-height: 200px;
}

/* When the textarea gets focus, do something */
.form-container textarea:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/send button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
</style>

@if(Request::segment(1) == '')
<link rel="stylesheet" type="text/css" href="{!! asset('assets/styles/main_styles.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset('assets/styles/responsive.css') !!}">
@elseif(Request::segment(1) == 'u')
<link rel="stylesheet" type="text/css" href="{!! asset('assets/styles/blog_styles.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset('assets/styles/blog_responsive.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset('assets/styles/blog_single_styles.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset('assets/styles/blog_single_responsive.css') !!}">
@elseif(Request::segment(1)=='contact')
<link rel="stylesheet" type="text/css" href="{!! asset('assets/styles/contact_styles.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset('assets/styles/contact_responsive.css') !!}">
@elseif(Request::segment(1)=='cart')
<link rel="stylesheet" type="text/css" href="{!! asset('assets/styles/cart_styles.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset('assets/styles/cart_responsive.css') !!}">
@else
<link rel="stylesheet" type="text/css" href="{!! asset('assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset('assets/styles/shop_styles.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset('assets/styles/shop_responsive.css') !!}">
@endif
</head>

<body>

<div class="super_container">
	
	<!-- Header -->
	
	<header class="header">

		<!-- Top Bar -->
		{{-- {{dd(Auth::user())}} --}}
		<div class="top_bar">
			<div class="container">
				<div class="row">
					<div class="col d-flex flex-row">
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{url('assets/images/phone.png')}}" alt=""></div><a href="https://wa.me/6288225146375?text=Hallo%20Admin%20Saya%20Ingin%20Bertanya%20Tentang%20TokoOnlen%20" target="_blank">+62 8822-5146-375</a></div>
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{url('assets/images/mail.png')}}" alt=""></div><a href="mailto:ardiris19@gmail.com">ardiris19@gmail.com</a></div>
						<div class="top_bar_content ml-auto">
							@if(Route::has('login'))
							<div class="top_bar_user">
								@auth
									<div class="main_nav_menu ml-auto">
										<ul class="standard_dropdown main_nav_dropdown">
											<div class="user_icon"><img src="{{url('assets/images/user.svg')}}" alt=""></div>
											<li class="hassubs">
												<a href="#">{{Auth::user()->name}}<i class="fas fa-chevron-down"></i></a>
												<ul>
													<li><a href="{{ url('/u/profile') }}">Profile</a></li>
													<li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">{{ __('Logout') }}</i></a></li>
												</ul>
											</li>
										</ul>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
									</div>
								@else
									<div class="user_icon"><img src="{{url('assets/images/user.svg')}}" alt=""></div>
									@if(Route::has('register'))
										<div><a href="{{route('login')}}">Masuk</a></div>
									@endif
									<div><a href="{{route('register')}}">Daftar</a></div>
								@endauth
							@endif	
							</div>
						</div>
					</div>
				</div>
			</div>		
		</div>

		<!-- Header Main -->
		<button class="open-button" onclick="openForm()">Message <i class="fas fa-comment"></i></button>

	<div class="chat-popup" id="myForm">
	  <form action="/action_page.php" class="form-container">

	    <label><b>Message/Notifikasi</b></label>
	    <div class="notifikasi">
	    
		</div>
	    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
	  </form>
	</div>
		<div class="header_main">
			<div class="container">
				<div class="row">

					<!-- Logo -->
					<div class="col-lg-2 col-sm-3 col-3 order-1">
						<div class="logo_container">
							<div class="logo"><a href="/">TokoOnlen</a></div>
						</div>
					</div>

					<!-- Search -->
					<div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
						<div class="header_search">
							<div class="header_search_content">
								<div class="header_search_form_container">
									<form action="#" class="header_search_form clearfix">
										<input type="search" required="required" class="header_search_input" placeholder="Cari barang...">
										<div class="custom_dropdown">
											<div class="custom_dropdown_list">
												<span class="custom_dropdown_placeholder clc">Kategori Barang</span>
												<i class="fas fa-chevron-down"></i>
												<ul class="custom_list clc">
													<li><a class="clc" href="#">Kategori Barang</a></li>
												@foreach($all_kategori as $k)
													<li><a class="clc" href="#">{{$k->nama_kategori}}</a></li>
												@endforeach
												</ul>
											</div>
										</div>
										<button type="submit" class="header_search_button trans_300" value="Submit"><img src="{{url('assets/images/search.png')}}" alt=""></button>
									</form>
								</div>
							</div>
						</div>
					</div>

					@auth
					@if(Auth::user()->name!='')
					<div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
						<div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
							<div class="wishlist d-flex flex-row align-items-center justify-content-end">
								<div class="wishlist_icon" style="width: 35px!important;"><img src="{{url('assets/images/notif.png')}}" alt=""></div>
								<div class="wishlist_content">
									<div class="wishlist_text"><a href="javascript:void(0)" onclick="openForm()">Message</a></div>
									<div class="wishlist_count text-primary animated rubberBand infinite">New</div>
								</div>
							</div>
							<!-- Cart -->
							<div class="cart">
								<div class="cart_container d-flex flex-row align-items-center justify-content-end">
									<div class="cart_icon">
										<img src="{{url('assets/images/cart.png')}}" alt="">
										<div class="cart_count"><span></span></div>
									</div>
									<div class="cart_content">
										<div class="cart_text"><a href="{{url('/cart/')}}/{{$hash}}">Keranjang</a></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					@endif
					@endauth
				</div>
			</div>
		</div>

		<!-- Main Navigation -->

		<nav class="main_nav">
			<div class="container">
				<div class="row">
					<div class="col">
						
						<div class="main_nav_content d-flex flex-row">

							<!-- Main Nav Menu -->

							<div class="main_nav_menu ml-auto">
								<ul class="standard_dropdown main_nav_dropdown">
									<li><a href="@if(Request::segment(1) == '') {{'#'}} @else {{'/'}}  @endif" class="@if(Request::segment(1) == '') {{'text-primary'}}  @endif">Beranda<i class="fas fa-chevron-down"></i></a></li>
									<li><a href="@if(Request::segment(1) == 'diskon') {{'#'}} @else {{'/diskon'}}  @endif" class="@if(Request::segment(1) == 'diskon') {{'text-primary'}}  @endif">Diskon<i class="fas fa-chevron-down"></i></a></li>
									<li class="hassubs">
										<a href="#">Kategori<i class="fas fa-chevron-down"></i></a>
										<ul>
											<!-- <li>
												<a href="#">Menu Item<i class="fas fa-chevron-down"></i></a>
												<ul>
													<li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
													<li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
													<li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
												</ul>
											</li> -->
											@foreach($all_kategori as $k)
											<li><a href="/k/{{$k->link}}">{{$k->nama_kategori}}<i class="fas fa-chevron-down"></i></a></li>
											@endforeach
										</ul>
									</li>
									<li class="hassubs">
										<a href="#">Pages<i class="fas fa-chevron-down"></i></a>
										<ul>
											<li><a href="{{url('/all')}}">Semua Barang<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="{{url('/baru')}}">Barang Terbaru<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="{{url('/banyak')}}">Paling Banyak Terjual<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="{{url('/rating')}}">Rating Tertinggi<i class="fas fa-chevron-down"></i></a></li>
										</ul>
									</li>
									<li><a href="{{url('/u/blog')}}">Blog<i class="fas fa-chevron-down"></i></a></li>
									<li><a href="{{url('/contact')}}">Contact<i class="fas fa-chevron-down"></i></a></li>
								</ul>
							</div>

							<!-- Menu Trigger -->

							<div class="menu_trigger_container ml-auto">
								<div class="menu_trigger d-flex flex-row align-items-center justify-content-end">
									<div class="menu_burger">
										<div class="menu_trigger_text">menu</div>
										<div class="cat_burger menu_burger_inner"><span></span><span></span><span></span></div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</nav>
		
		<!-- Menu -->

		<div class="page_menu">
			<div class="container">
				<div class="row">
					<div class="col">
						
						<div class="page_menu_content">
							
							<div class="page_menu_search">
								<form action="#">
									<input type="search" required="required" class="page_menu_search_input" placeholder="Search for products...">
								</form>
							</div>
								<li class="page_menu_item">
									<a href="@if(Request::segment(1) == '') {{'#'}} @else {{'/'}}  @endif">Beranda<i class="fa fa-angle-down"></i></a>
								</li>
								<li class="page_menu_item">
									<a href="/diskon">Diskon<i class="fa fa-angle-down"></i></a>
								</li>
								<li class="page_menu_item has-children">
									<a href="#">Kategori<i class="fa fa-angle-down"></i></a>
									<ul class="page_menu_selection">
									@foreach($all_kategori as $k)
										<li><a href="/k/{{$k->link}}">{{$k->nama_kategori}}<i class="fa fa-angel-down"></i></a></li>
									@endforeach
									</ul>
								</li>
								<li class="page_menu_item has-children">
									<a href="#">Pages<i class="fa fa-angle-down"></i></a>
									<ul class="page_menu_selection">
										<li><a href="{{url('/all')}}">Semua Barang<i class="fa fa-angle-down"></i></a></li>
										<li><a href="{{url('/baru')}}">Barang Terbaru<i class="fa fa-angle-down"></i></a></li>
										<li><a href="{{url('/banyak')}}">Paling Banyak Terjual<i class="fa fa-angle-down"></i></a></li>
										<li><a href="{{url('/rating')}}">Rating Tertinggi<i class="fa fa-angle-down"></i></a></li>
									</ul>
								</li>
								<li class="page_menu_item"><a href="{{url('/u/blog')}}">Blog<i class="fa fa-angle-down"></i></a></li>
								<li class="page_menu_item"><a href="{{url('/contact')}}">Contact<i class="fa fa-angle-down"></i></a></li>
							</ul>
							
							<div class="menu_contact">
								<div class="menu_contact_item"><div class="menu_contact_icon"><img src="{{url('assets/images/phone_white.png')}}" alt=""></div>+62 8822-5146-375</div>
								<div class="menu_contact_item"><div class="menu_contact_icon"><img src="{{url('assets/images/mail_white.png')}}" alt=""></div><a href="mailto:ardiris19@gmail.com">ardiris19@gmail.com</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</header>

    @yield('content')

	<!-- Newsletter -->
	
	<div class="newsletter">
		<div class="container">
			<div class="row">@if(Request::segment(1)!='contact')
				<div class="col">
					<div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
						<div class="newsletter_title_container">
							<div class="newsletter_icon"><img src="{{url('assets/images/send.png')}}" alt=""></div>
							<div class="newsletter_title">Kirim Kritik, Pesan, dan Saran untuk TokoOnlen</div>
							<div class="newsletter_text"><p>Kritik dan saran kalian sangat membantu kami untuk terus berkembang</p></div>
						</div>
						<div class="newsletter_content clearfix">
							<form class="newsletter_form">
								@csrf
								<input type="text" name="krisar" class="newsletter_input" required="required" placeholder="Masukkan Saran atau Kritik kalian disini..">
								<input type="hidden" name="id_user" value="{{Auth::id()}}">
								<button type="submit" class="newsletter_button">Kirim</button>
								<button type="button" class="newsletter_button spin" hidden><i class="fas fa-spinner fa-spin animated ml-2"></i></button>
							</form>
						</div>
					</div>
				</div>@endif
			</div>
		</div>
	</div>

	<!-- Footer -->

	<footer class="footer">
		<div class="container">
			<div class="row">

				<div class="col-lg-3 footer_col">
					<div class="footer_column footer_contact">
						<div class="logo_container">
							<div class="logo"><a href="#">TokoOnlen</a></div>
						</div>
						<div class="footer_title">Ada Pertanyaan? Hubungi Kami di</div>
						<div class="footer_phone">+62 8822-5146-375</div>
						<div class="footer_contact_text">
							<p>Parakancanggah, RT 04/05, Banjarnegara,</p>
							<p>Jawa Tengah, Indonesia.</p>
						</div>
					</div>
				</div>

				<div class="col-lg-2 offset-lg-2">
					<div class="footer_column">
						<div class="footer_title">Mau cari apa?</div>
						<ul class="footer_list">
						@foreach($all_kategori as $k)
							<li><a href="/k/{{$k->link}}">{{$k->nama_kategori}}</a></li>
						@endforeach
						</ul>
					</div>
				</div>

				<div class="col-lg-2">
					<div class="footer_column">
						<div class="footer_title">Customer Care</div>
						<ul class="footer_list">
							<li><a href="{{url('/u/profile')}}">My Account</a></li>
							<li><a href="#">Customer Services</a></li>
							<li><a href="#">Returns / Exchange</a></li>
							<li><a href="#">Product Support</a></li>
						</ul>
					</div>
				</div>

			</div>
		</div>
	</footer>

	<!-- Copyright -->

	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col">
					
					<div class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | TokoOnlen
                    </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Tambah Keranjang-->
	@foreach($data_barang as $dab)
	<div class="modal fade" id="throwKeranjang{{$dab->id_barang}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
						<strong>Rp. {{ number_format($dab->harga - ($dab->harga * $dab->diskon / 100),0,',' , '.') }}</strong>
					</span>
		            <span class="text-secondary">
		            	<small>
		                  <s>Rp. {{number_format($dab->harga,0, ',' , '.')}}</s>
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
                <form class="form_tambah" name="form_tambah" enctype="multipart/form-data"><br>
                	@csrf
                	<div class="form-group">
						<input class="form-control" name="id_barang" value="{{$dab->id_barang}}" readonly hidden="true">
					</div>
					<div class="form-group">
						<input class="form-control" name="id_user" value="{{Auth::id()}}" readonly hidden="true">
					</div>
					<div class="form-group">
						<input class="form-control" name="harga" value="{{$dab->harga - ($dab->harga * $dab->diskon / 100)}}" readonly hidden="true">
					</div>
					<div class="form-group">
					    <label for="">Jumlah Barang :</label>
					    <select class="form-control text-dark" name="jumlah_pesan" style="min-width: 50px; margin-left: 0px;">
					    	@for($i=1; $i <= $dab->jumlah - $dab->terjual; $i++ )
					    		<option value="{{$i}}">{{$i}}</option>
					    	@endfor
					    </select>
					</div>
					<div class="form-group">
					    <label for="">Keterangan/Catatan : </label>
						<textarea class="form-control text-dark" name="keterangan" rows="3" required></textarea>
						<small class="text-secondary">*isi dengan "--" jika tidak ada catatan.</small>
					</div>

					<div class="text-center">
		                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
		                <button type="submit" class="btn btn-primary btn_tambah">Masukkan
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
	{{-- end Modal --}}

<script src="{!! asset('assets/js/jquery-3.3.1.min.js') !!}"></script>
<script src="{!! asset('assets/styles/bootstrap4/popper.js') !!}"></script>
<script src="{!! asset('assets/styles/bootstrap4/bootstrap.min.js') !!}"></script>
<script src="{!! asset('assets/plugins/greensock/TweenMax.min.js') !!}"></script>
<script src="{!! asset('assets/plugins/greensock/TimelineMax.min.js') !!}"></script>
<script src="{!! asset('assets/plugins/scrollmagic/ScrollMagic.min.js') !!}"></script>
<script src="{!! asset('assets/plugins/greensock/animation.gsap.min.js') !!}"></script>
<script src="{!! asset('assets/plugins/greensock/ScrollToPlugin.min.js') !!}"></script>
<script src="{!! asset('assets/plugins/OwlCarousel2-2.2.1/owl.carousel.js') !!}"></script>
<script src="{!! asset('assets/plugins/slick-1.8.0/slick.js') !!}"></script>
<script src="{!! asset('assets/plugins/easing/easing.js') !!}"></script>
<script src="{!! asset('assets/sweetalert/sweetalert2.min.js') !!}"></script>
<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>
{{-- <script type="text/javascript" src="{!! asset('assets/js/keranjang.js') !!}"></script> --}}


@if(Request::segment(1) == '')
<script src="{!! asset('assets/js/custom.js') !!}"></script>
@elseif(Request::segment(1) == 'u')
<script src="{!! asset('assets/js/blog_custom.js') !!}"></script>
<script src="{!! asset('assets/js/blog_single_custom.js') !!}"></script>
@elseif(Request::segment(1)=='contact')
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
<script src="{!! asset('assets/js/contact_custom.js') !!}"></script>
@elseif(Request::segment(1)=='cart')
<script src="{!! asset('assets/js/cart_custom.js') !!}"></script>
@else
<script src="{!! asset('assets/plugins/Isotope/isotope.pkgd.min.js') !!}"></script>
<script src="{!! asset('assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.js') !!}"></script>
<script src="{!! asset('assets/plugins/parallax-js-master/parallax.min.js') !!}"></script>
<script src="{!! asset('assets/js/shop_custom.js') !!}"></script>
@endif
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script type="text/javascript">
	$(function () {
	  $('[data-toggle="popover"]').popover()
	})

	$(function () {
	  $('.example-popover').popover({
	    container: 'body'
	  })
	})
</script>

{{-- Tambah Barang ke keranjang --}}
<script>
	$(document).ready(function(){
    $('.form_tambah').on('submit', function(event){

    	$('.btn_tambah').attr('hidden','true');
		$('.btn_proses').removeAttr('hidden');

        event.preventDefault();

        $.ajax({
            url: "{{route('keranjang.add_cart')}}",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cached: false,
            processData: false,
            dataType: 'json',
            error: function(xhr,status,error){
            	var err = eval("(" + xhr.responseText + ")");
            	$('#form_result').text('Silahkan Login untuk menambahkan barang ke keranjang !!');
  				alert("Silahkan Login untuk menambahkan barang ke keranjang !!");
            },
            success:function(data){
                var html = '';
                if (data.errors) {
                    html += '<div class="alert alert-danger">';
                        for (var i = 0; i < data.errors.length; i++) {
                            html += '<p> '+ data.errors[count] +' </p>';
                        }
                    html += '</div>';
                }
                if (data.success) {
                    html += '<div class="alert alert-success">'+ data.success +'</div>';
                    location.href = "{{url('/cart/')}}/{{$hash}}";
                }
                $('#form_result').html(html);
            }
        })
    })
	});
</script>
{{-- End Tambah Barang ke keranjang --}}

<script>
	$(document).ready(function(){
		$('.form_edit_keranjang').on('submit', function(event){
		
		$('.btn_edit').attr('hidden','true');
		$('.btn_proses').removeAttr('hidden');

		$.ajax({
			url: "{{route('keranjang.edit_cart')}}",
			method: "POST",
			data: new FormData(this),
			contentType: false,
			cached: false,
			processData: false,
			dataType: 'json',
			error: function(xhr,status,error) {
				var err = eval("("+ xhr.responseText + ")");
				$('#form_result').text(err);
				alert(err);
			},
			success: function(data) {
				var html = '';
				if (data.errors) {
					html+= '<div class="alert alert-danger">';
					for (var i = 0; i < data.errors.length; i++) {
						html += '<p> '+ data.errors[count] +' </p>';
					}
					html+= '</div>';
				}
				if (data.success) {
                    html += '<div class="alert alert-success">'+ data.success +'</div>';
                    location.href = "{{url('/cart/')}}/{{$hash}}";
                }
                $('#form_result').html(html);
			}
		})
		})
	});
</script>

<script>
	$(document).ready(function(){
		$('.form_hapus_keranjang').on('submit', function(event){
		
		$('.btn_yakin').attr('hidden','true');
		$('.btn_proses').removeAttr('hidden');

		$.ajax({
			url: "{{route('keranjang.hapus_cart')}}",
			method: "POST",
			data: new FormData(this),
			contentType: false,
			cached: false,
			processData: false,
			dataType: 'json',
			error: function(xhr,status,error) {
				var err = eval("("+ xhr.responseText + ")");
				$('#form_result').text(err);
				console.log(err);
				break;
				// alert(err);
			},
			success: function(data) {
				var html = '';
				if (data.errors) {
					html+= '<div class="alert alert-danger">';
					for (var i = 0; i < data.errors.length; i++) {
						html += '<p> '+ data.errors[i] +' </p>';
					}
					html+= '</div>';
				}
				if (data.success) {
                    html += '<div class="alert alert-success">'+ data.success +'</div>';
                    location.href = "{{url('/cart/')}}/{{$hash}}";
                }
                $('#form_result').html(html);
			}
		})
		})
	});
</script>

<script>
	$(document).ready(function() {
		$('.form_hapus_all').on('submit', function(event) {
		
		$('.btn_yakin').attr('hidden','true');
		$('.btn_proses').removeAttr('hidden');

		$.ajax({
			url: "{{route('keranjang.hapus_all_cart')}}",
			method: "POST",
			data: new FormData(this),
			contentType: false,
			cached: false,
			processData: false,
			dataType: 'json',
			error: function(xhr,status,error) {
				var err = eval("(" + xhr.responseText + ")");
				$("#form_result").text(err);
				console.log(err);
				break;
			},
			success:function(data) {
				var html = '';
				if (data.errors) {
					html += '<div clas="alert alert-danger">';
					for (var i = 0; i < data.errors.length; i++) {
						html += '<p>' + data.errors[i] + '</p>';
					}
					html += '</div>';
				}
				if (data.success) {
					html += '<div class="alert alert-success">'+ data.success + '</div>';
					location.href = "{{url('/cart/')}}/{{$hash}}}";
				}
				$("#form_result").html(html);
			}
		})
		})
	});
</script>

<script>
	$(document).ready(function() {
		$('.form_hapus_all_riwayat').on('submit', function(event) {
		
		$('.btn_yakin').attr('hidden','true');
		$('.btn_proses').removeAttr('hidden');

		$.ajax({
			url: "{{route('keranjang.hapus_all_riwayat')}}",
			method: "POST",
			data: new FormData(this),
			contentType: false,
			cached: false,
			processData: false,
			dataType: 'json',
			error: function(xhr,status,error) {
				var err = eval("(" + xhr.responseText + ")");
				$("#form_result").text(err);
				console.log(err);
				break;
			},
			success:function(data) {
				var html = '';
				if (data.errors) {
					html += '<div clas="alert alert-danger">';
					for (var i = 0; i < data.errors.length; i++) {
						html += '<p>' + data.errors[i] + '</p>';
					}
					html += '</div>';
				}
				if (data.success) {
					html += '<div class="alert alert-success">'+ data.success + '</div>';
					location.href = "{{url('/cart/riwayat/')}}/{{$hash}}}";
				}
				$("#form_result").html(html);
			}
		})
		})
	});
</script>

<script>
	$(document).ready(function() {
		$('.formc_all').on('submit', function(event) {
		
		$('.btn_yakin').attr('hidden','true');
		$('.btn_proses').removeAttr('hidden');

		$.ajax({
			url: "{{route('checkout.all')}}",
			method: "POST",
			data: new FormData(this),
			contentType: false,
			cached: false,
			processData: false,
			dataType: 'json',
			error: function(xhr,status,error) {
				var err = eval("(" + xhr.responseText + ")");
				$("#form_result").text(err);
				console.log(err);
				break;
			},
			success:function(data) {
				var html = '';
				if (data.errors) {
					html += '<div clas="alert alert-danger">';
					for (var i = 0; i < data.errors.length; i++) {
						html += '<p>' + data.errors[i] + '</p>';
					}
					html += '</div>';
				}
				if (data.success) {
					html += '<div class="alert alert-success">'+ data.success + '</div>';
					location.href = "{{url('/cart/')}}/{{$hash}}}";
				}
				$("#form_result").html(html);
			}
		})
		})
	});
</script>

<script>
	$(document).ready(function() {
		$('.formc_single').on('submit', function(event) {
		
		$('.btn_yakin').attr('hidden','true');
		$('.btn_proses').removeAttr('hidden');

		$.ajax({
			url: "{{route('checkout.single')}}",
			method: "POST",
			data: new FormData(this),
			contentType: false,
			cached: false,
			processData: false,
			dataType: 'json',
			error: function(xhr,status,error) {
				var err = eval("(" + xhr.responseText + ")");
				$("#form_result").text(err);
				console.log(err);
				break;
			},
			success:function(data) {
				var html = '';
				if (data.errors) {
					html += '<div clas="alert alert-danger">';
					for (var i = 0; i < data.errors.length; i++) {
						html += '<p>' + data.errors[i] + '</p>';
					}
					html += '</div>';
				}
				if (data.success) {
					html += '<div class="alert alert-success">'+ data.success + '</div>';
					location.href = "{{url('/cart/')}}/{{$hash}}}";
				}
				$("#form_result").html(html);
			}
		})
		})
	});
</script>

<script>
	$(document).ready(function() {
		$('.form_batal_pesan').on('submit', function(event) {
		
		$('.btn_yakin').attr('hidden','true');
		$('.btn_proses').removeAttr('hidden');

		$.ajax({
			url: "{{route('pesan.batal')}}",
			method: "POST",
			data: new FormData(this),
			contentType: false,
			cached: false,
			processData: false,
			dataType: 'json',
			error: function(xhr,status,error) {
				var err = eval("(" + xhr.responseText + ")");
				$("#form_result").text(err);
				console.log(err);
				break;
			},
			success:function(data) {
				var html = '';
				if (data.errors) {
					html += '<div clas="alert alert-danger">';
					for (var i = 0; i < data.errors.length; i++) {
						html += '<p>' + data.errors[i] + '</p>';
					}
					html += '</div>';
				}
				if (data.success) {
					html += '<div class="alert alert-success">'+ data.success + '</div>';
					location.href = "{{url('/cart/')}}/{{$hash}}}";
				}
				$("#form_result").html(html);
			}
		})
		})
	});
</script>

{{-- Add Kritik Saran --}}
<script>
	$(document).ready(function() {
		$('.newsletter_form').on('submit', function(event) {
		
		$('.newsletter_button').attr('hidden','true');
		$('.spin').removeAttr('hidden');

		event.preventDefault();
		$.ajax({
			url: "{{route('kritik.saran')}}",
			method: "POST",
			data: new FormData(this),
			contentType: false,
			cached: false,
			processData: false,
			dataType: 'json',
			error: function(xhr,status,error) {
				var err = eval("(" + xhr.responseText + ")");
				$("#form_result").text(err);
				console.log(err);
			},
			success:function(response) {
				if (response == 1) {
                    Swal.fire({ 
                        type: 'success',
                        title: 'Terima Kasih !',
                        text: 'Terima Kasih telah memberikan feedback untuk kami',
                      }).then((result) => {
                        location.href = "{{url('/')}}";
                      });
                }else if (response == 2) {
                	Swal.fire({ 
                        type: 'warning',
                        title: 'Gagal!',
                        text: 'Anda Telah Memberi Kritik 3x',
                    }).then((result) => {
                		$('.newsletter_button').removeAttr('hidden');
                		$('.spin').attr('hidden', 'true');
                    });
                
                }
			}
		})
		})
	});
</script>
<script type="text/javascript">
  $(document).ready(function() {
  	tampil_notif();

  	setTimeout(function(){
       tampil_notif();
   	},10000);

    window.kemas = function(argument,id) {
      var status = argument;
      
      var id_keranjang = id;
      $(".select_status").attr("disabled","true");
      $.ajax({
        url: "{{url('status_pembelian')}}/"+status+"",
        method: "POST",
        data:{"_token": "{{ csrf_token() }}",status:status, id_keranjang:id_keranjang},
        
        success: function(response) {
          if (response == 1) {
            Swal.fire({ 
                type: 'success',
                title: 'sc !',
                text: 'Berhasil !!',
              }).then((result) => {
                location.reload();
              });
            }else{
              Swal.fire({ 
                type: 'error',
                title: 'sc !',
                text: 'ggl !!',
              });
            }
        }
      })
    }

    function tampil_notif() {
    	$.ajax({
    		url: "{{url('get/notifikasi_user')}}",
    		type: "GET",
    		async: true,
    		dataType: "json",

    		success: function(data) {
    			var html = '';
    			if (data.length!=0) {
    			for (var i = 0; i < data.length; i++) {
    				html += '';
    				if (data[i].jenis_notifikasi=="diterima") {
    					html += '<div class="alert alert-success" role="alert" style="min-width: 280px;">';
    				}else if(data[i].jenis_notifikasi=="dikemas"){
    					html += '<div class="alert alert-warning" role="alert" style="min-width: 280px;">';
    				}else{
    					html += '<div class="alert alert-primary" role="alert" style="min-width: 280px;">';
    				}
    				
			  			html += '<h4 class="alert-heading">'+data[i].judul+'</h4>'+
						  		'<p>'+data[i].isi+'</p>';
						  if(data[i].status=='1')
						html+=	'<a href="javascript:void(0)" class="badge badge-success">Dibaca</a>'+
								'<a href="javascript:void(0)" class="badge badge-danger float-right" onclick="hapus_notif('+data[i].id_notifikasi+')"><i class="fas fa-trash"></i><a>'+
								'</div>';
						  else
						html+=	'<a href="javascript:void(0)" class="badge badge-warning" onclick="baca('+data[i].id_notifikasi+')">Tandai Dibaca</a>'+
								'</div>';
    			}
    			}else{
			    	html += '<div class="alert alert-primary" role="alert" style="min-width: 280px;">'+
					  		'<h4 class="alert-heading text-center">Notifikasi Kosong</h4>'+
							'</div>';
    			}
    			$('.notifikasi').html(html);
    		}
    	})
    }

    window.baca = function(id) {
    var id = id;

    $.ajax({
        url: "{{route('notifikasi.baca')}}",
        method: "POST",
        data: {"_token":"{{csrf_token()}}", id:id},

        success: function(response) {
          if(response == 1){
                tampil_notif();
            }else{
              Swal.fire({
                type: 'warning',
                title: 'Gagal !',
                text: 'Gagal !!',
              });
            }
        }
      })
  	}

  	window.hapus_notif = function(id) {
    var id = id;

    $.ajax({
        url: "{{route('notifikasi.hapus')}}",
        method: "POST",
        data: {"_token":"{{csrf_token()}}", id:id},

        success: function(response) {
          if(response == 1){
                tampil_notif();
            }else{
              Swal.fire({
                type: 'warning',
                title: 'Gagal !',
                text: 'Gagal !!',
              });
            }
        }
      })
  	}

  });
</script>

</body>

</html>