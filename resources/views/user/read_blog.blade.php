@extends('template.template')

@section('content')

	<!-- Single Blog Post -->
    @foreach($get_blog as $get)
	<div class="single_post">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<div class="single_post_title">{{$get->judul}}</div>
					<div class="single_post_text">
						<p>{{$get->isi}}</p>
					</div>
				</div>
			</div>
		</div>
    </div>
    @endforeach

	<!-- Blog Posts -->
    <br><br>
	<div class="blog">
		<div class="container">
			<div class="row">
				<div class="col"><h3>Baca Lainnya</h3><br>
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

@endsection