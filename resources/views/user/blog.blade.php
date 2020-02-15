@extends('template.template')

@section('content')

    <!-- Home -->

    <div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="url({{url('assets/images/shop_background.jpg')}})"></div>
		<div class="home_overlay"></div>
		<div class="home_content d-flex flex-column align-items-center justify-content-center">
			<h2 class="home_title">Blog Teknologi</h2>
		</div>
	</div>

	<!-- Daftar Blog -->

	<div class="blog">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="blog_posts d-flex flex-row align-items-start justify-content-between">
						
                        <!-- Blog post -->
                        @foreach($data_blog as $b)
						<div class="blog_post">
                            <div class="blog_image" style="background-image:url({{url('assets/images/')}}/{{$b->gambar}})"></div>
							<div class="blog_text"><b>{{substr($b->judul,0,30)}}</b> <br> {{substr($b->isi,0,70)}}...</div>
							<div class="blog_button"><a href="{{url('/u/blog/')}}/{{$b->id_blog}}">Lanjutkan Membaca</a></div>
                        </div>
                        @endforeach
						
					</div>
				</div>
					
			</div>
		</div>
    </div>
    
    <!-- End Daftar Blog -->

@endsection