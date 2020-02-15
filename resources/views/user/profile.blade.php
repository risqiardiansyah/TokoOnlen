<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="{!! asset('assets/images/char_3.png') !!}" type="image/png">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{-- <meta name="keywords" content="keyword kamu">
        <meta name="description" content="deskripsi konten">
        <meta name="robots" content="INDEX, FOLLOW">
        <meta name="revisit-after" content="10 days">
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        </head><frameset rows="*" frameborder="no" border="0" framespacing="0">
        <frame name="main_frame" src="http://127.0.0.1:8000/">
        </frameset> --}}
        {{-- <meta HTTP-EQUIV="REFRESH" CONTENT="0.01 /*lama waktu*/; URL=http://127.0.0.1:8000"> --}}
        <title>Profile - TokoOnlen</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" type="text/css" href="{!! asset('assets/styles/bootstrap4/bootstrap.min.css') !!}">
        <link href="{!! asset('assets/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') !!}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="{!! asset('assets/plugins/OwlCarousel2-2.2.1/owl.carousel.css') !!}">
        <link rel="stylesheet" type="text/css" href="{!! asset('assets/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') !!}">
        <link rel="stylesheet" type="text/css" href="{!! asset('assets/plugins/OwlCarousel2-2.2.1/animate.css') !!}">
        <link rel="stylesheet" type="text/css" href="{!! asset('assets/plugins/slick-1.8.0/slick.css') !!}">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="{!! asset('profile/css/bootstrap.css') !!}">
        <link rel="stylesheet" href="{!! asset('profile/vendors/linericon/style.css') !!}">
        <link rel="stylesheet" href="{!! asset('profile/vendors/lightbox/simpleLightbox.css') !!}">
        <link rel="stylesheet" href="{!! asset('profile/vendors/nice-select/css/nice-select.css') !!}">
        <link rel="stylesheet" href="{!! asset('profile/vendors/animate-css/animate.css') !!}">
        <link rel="stylesheet" href="{!! asset('profile/vendors/popup/magnific-popup.css') !!}">
        <!-- main css -->
        <link rel="stylesheet" href="{!! asset('profile/css/style.css') !!}">
        <link rel="stylesheet" href="{!! asset('profile/css/responsive.css') !!}">
        <link rel="stylesheet" type="text/css" href="{!! asset('assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.css') !!}">
        <link rel="stylesheet" type="text/css" href="{!! asset('assets/styles/shop_styles.css') !!}">
        <link rel="stylesheet" type="text/css" href="{!! asset('assets/styles/shop_responsive.css') !!}">
        <link rel="stylesheet" type="text/css" href="{!! asset('assets/sweetalert/sweetalert2.min.css') !!}">
    </head>
    <body>
        
        <!--================Header Menu Area =================-->
        <header class="header_area">
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
                                            <li class="hassubs">
                                                <a href="/">Beranda</a>
                                            </li>
                                            <div class="user_icon"><img src="{{url('assets/images/user.svg')}}" alt=""></div>
                                            <li class="hassubs">
                                                <a href="#">{{Auth::user()->name}}<i class="fas fa-chevron-down"></i></a>
                                                <ul>
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
    </header>
        <!--================Header Menu Area =================-->
        
        
        <!--================Home Banner Area =================-->
        <section class="profile_area">
           	<div class="container">
           		<div class="profile_inner p_120">
					<div class="row">
						<div class="col-lg-5">
							<img class="img-fluid text-center" src="{!! asset('assets/images/person.png') !!}" alt="...">
						</div>
						<div class="col-lg-7 col-sm-12">
							<div class="personal_text">
                                <h6>Profile Anda..<a href="javascript:void(0)" role="button" data-toggle="modal" data-target="#modal_edit" title="Edit Profile">
                                <span class="fa-stack">
                                  <i class="far fa-circle fa-stack-2x"></i>
                                  <i class="fas fa-edit fa-stack-1x"></i>
                                </span></a></h6>
								<h3>{{Auth::user()->name}}</h3>
                                @if(Auth::user()->level == 'usr')
								<h4>Pengguna</h4>
                                @else
                                <h4>{{Auth::user()->name}} </h4>
                                @endif
								<p>Detail Profile Anda :</p>
								<ul class="list basic_info">
                                    @if(Auth::user()->ttl == '')
									   <li><a href="javascript:void(0)"><i class="lnr lnr-calendar-full"></i> Belum Diisi </a></li>
                                    @else
                                        <li><a href="javascript:void(0)"><i class="lnr lnr-calendar-full"></i> {{Auth::user()->ttl}} </a></li>
                                    @endif

                                    @if(Auth::user()->no_telp == '')
									   <li><a href="javascript:void(0)"><i class="lnr lnr-phone-handset"></i> Belum Diisi</a></li>
                                    @else
                                     <li><a href="javascript:void(0)"><i class="lnr lnr-phone-handset"></i> {{Auth::user()->no_telp}}</a></li>
                                    @endif
                                    
                                    @if(Auth::user()->email == '')
									   <li><a href="javascript:void(0)"><i class="lnr lnr-envelope"></i> Belum Diisi</a></li>
                                    @else
                                        <li><a href="javascript:void(0)"><i class="lnr lnr-envelope"></i> {{Auth::user()->email}}</a></li>
                                    @endif

                                    @if(Auth::user()->alamat == '')
									   <li><a href="javascript:void(0)"><i class="lnr lnr-home"></i> Belum Diisi</a></li>
                                    @else
                                        <li><a href="javascript:void(0)"><i class="lnr lnr-home"></i>{{substr(Auth::user()->alamat, 0, 50)}}...</a></li>
                                    @endif
								</ul>
								<ul class="list personal_social">
                                    <li><a href="javascript:void(0)" class="bg-warning" role="button" data-toggle="modal" data-target="#modal_edit"><i class="fas fa-edit" ></i></a></li>
									<li><a href="{{url('cart/')}}/{{$hash}}" class="bg-warning" title="Keranjang Anda"><i class="fas fa-shopping-cart"></i></a></li>
									<li><a href="{{url('cart/riwayat/')}}/{{$hash}}" class="bg-warning" title="Riwayat Pembelian Anda"><i class="fas fa-history"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
           		</div>
            </div>
        </section>
        <!--================End Home Banner Area =================-->
        
        <!--================Testimonials Area =================-->
        <section class="testimonials_area p_120">
        	<div class="container">
        		<div class="main_title">
        			<h2>Rekomendasi Barang Untuk Kamu</h2>
        			<p>Barang-barang dengan kualitas tinggi dan harga yang murah, hanya untuk kamu.</p>
        		</div>
        		<div class="testi_inner">
					<div class="testi_slider owl-carousel">
						@foreach($barang as $b)<div class="item">
							<div class="testi_item">
                                <img src="{!! asset('assets/images/') !!}/{{$b->gambar}}" style="max-width: 200px;">
								<p>{{$b->deskripsi_barang}}</p>
								<h4>{{$b->nama_barang}}</h4>
                                @if($b->rating == 5)
								<i style="color: orange;" class="fas fa-star"></i>
								<i style="color: orange;" class="fas fa-star"></i>
								<i style="color: orange;" class="fas fa-star"></i>
								<i style="color: orange;" class="fas fa-star"></i>
								<i style="color: orange;" class="fas fa-star"></i>
                                @elseif($b->rating == 4)
                                <i style="color: orange;" class="fas fa-star"></i>
                                <i style="color: orange;" class="fas fa-star"></i>
                                <i style="color: orange;" class="fas fa-star"></i>
                                <i style="color: orange;" class="fas fa-star"></i>
                                <i style="color: orange;" class="far fa-star-o"></i>
                                @else
                                <i style="color: orange;" class="fas fa-star"></i>
                                <i style="color: orange;" class="fas fa-star"></i>
                                <i style="color: orange;" class="fas fa-star"></i>
                                <i style="color: orange;" class="fas fa-star-half-o"></i>
                                <i style="color: orange;" class="fas fa-star-half-o"></i>
                                @endif
							</div>    
						</div>
                        @endforeach
					</div>
        		</div>
        	</div>
        </section>
        <!--================End Testimonials Area =================-->
        
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
                        {{-- @foreach($all_kategori as $k)
                            <li><a href="/k/{{$k->link}}">{{$k->nama_kategori}}</a></li>
                        @endforeach --}}
                        </ul>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="footer_column">
                        <div class="footer_title">Customer Care</div>
                        <ul class="footer_list">
                            <li><a href="#">My Account</a></li>
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

{{-- Modal Edit --}}
<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">

    <div class="modal-content">
        <div class="modal-header bg-primary text-white">
            <h5 class="modal-title">Edit Profile</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
<form class="form_edit_profile" enctype="multipart/form-data">
        <div class="modal-body">
        
            @csrf
            <label for="nama">Nama : </label>
            <div class="form-group">
                <input type="text" class="form-control text-secondary" name="nama" value="{{Auth::user()->name}}" required>
            </div>

            <label for="email">Email : </label>
            <div class="form-group">
                <input type="email" class="form-control text-secondary" name="email" value="{{Auth::user()->email}}" required>
            </div>

            <label for="no_telp">No. Telpon : </label>
            <div class="form-group">
                <input type="number" class="form-control text-secondary" name="no_telp" value="{{Auth::user()->no_telp}}">
            </div>

            <label for="tgl_lahir">Tgl. Lahir : </label>
            <div class="form-group">
                <input type="date" class="form-control text-secondary" name="ttl" value="{{Auth::user()->ttl}}">
            </div>

            <label for="alamat">Alamat : </label>
            <div class="form-group">
                <textarea class="form-control text-secondary" name="alamat">{{Auth::user()->alamat}}</textarea>
            </div>
            <input type="hidden" name="id_user" value="{{Auth::id()}}">
        
        </div>
        
        
            
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn_simpan">Simpan</button>
                <button class="btn btn-secondary btn_proses" hidden="true">
                    <i class="fas fa-spinner fa-spin animated ml-2" aria-hidden="true"></i>
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                
            </div>
        </form>
    </div>

  </div>
</div>
{{-- end Modal edit data diri--}}  

    <script src="{!! asset('profile/js/jquery-3.3.1.min.js') !!}"></script>
    <script src="{!! asset('profile/js/popper.js') !!}"></script>
    <script src="{!! asset('profile/js/bootstrap.min.js') !!}"></script>
    <script src="{!! asset('profile/js/stellar.js') !!}"></script>
    <script src="{!! asset('profile/vendors/lightbox/simpleLightbox.min.js') !!}"></script>
    <script src="{!! asset('profile/vendors/nice-select/js/jquery.nice-select.min.js') !!}"></script>
    <script src="{!! asset('profile/vendors/isotope/imagesloaded.pkgd.min.js') !!}"></script>
    <script src="{!! asset('profile/vendors/isotope/isotope.pkgd.min.js') !!}"></script>
    <script src="{!! asset('profile/vendors/owl-carousel/owl.carousel.min.js') !!}"></script>
    <script src="{!! asset('profile/vendors/popup/jquery.magnific-popup.min.js') !!}"></script>
    <script src="{!! asset('profile/js/jquery.ajaxchimp.min.js') !!}"></script>
    <script src="{!! asset('profile/vendors/counter-up/jquery.waypoints.min.js') !!}"></script>
    <script src="{!! asset('profile/vendors/counter-up/jquery.counterup.min.js') !!}"></script>
    <script src="{!! asset('profile/js/mail-script.js') !!}"></script>
    <script src="{!! asset('profile/js/theme.js') !!}"></script>
    <script src="{!! asset('assets/sweetalert/sweetalert2.min.js') !!}"></script>

    <script>
        $(document).ready(function(){
            $('.form_edit_profile').on('submit', function(event) {
            
            $('.btn_simpan').attr('hidden','true');
            $('.btn_proses').removeAttr('hidden');

            event.preventDefault();
            $.ajax({
                url: "{{route('edit.profile')}}",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cached: false,
                processData: false,
                async: false,
                dataType: 'json',

                error: function(xhr,status,error) {
                    var err = eval("(" + xhr.responseText + ")");
                    $("#form_result").text(err);
                    console.log(err);
                },
                success: function(data) {
                    Swal.fire({
                    type: 'success',
                    title: 'selamat!',
                    text: 'Berhasil Edit Data Diri',
                  }).then((result) => {
                    location.href = "{{url('/u/profile')}}";
                  });
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
                        location.reload();
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

    </body>
</html>