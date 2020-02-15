@extends('template.template_admin')

@section('content')

<div class="col-12">
	<div class="card">
		<div class="card-header">
			<h3>Data Blog</h3>

		        <div class="card-tools" style="margin-top: -35px;">
		          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah" title="Tambah Data Blog">
		            Tambah Blog
		          </button>
		        </div>
		</div>
		<div class="card-body">
		
		@foreach($blog as $b)
		<div class="card collapsed-card">
	     	<div class="card-header border-transparent">
		        <h3 class="card-title">{{$loop->iteration}}. {{substr($b->judul,0,70)}}</h3>

		        <div class="card-tools">
		          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Lihat Isi">
		            <i class="fas fa-plus text-primary"></i>
		          </button>
		           {{-- data-card-widget="remove" --}}
		          <button type="button" class="btn btn-tool" title="Hapus Blog" onclick="hapus_blog({{$b->id_blog}},'{{$b->gambar}}')"> 
		            <i class="fas fa-times text-danger"></i>
		          </button>
		        </div>
	    	</div>
	      <!-- /.card-header -->

	     	<div class="card-body">
		        <div class="col-12">
		            <div class="post">
		              <div class="user-block">
		                <img class="img-circle img-bordered-sm" src="{{asset('assets/images/')}}/{{$b->gambar}}" alt="user image">
		                <span class="username">
		                  <a href="#">{{$b->judul}}</a>
		                </span>
		                <span class="description">Dibagikan - {{date('D, d M Y | H:i A', strtotime($b->created_at))}}</span>
		              </div>
		              <!-- /.user-block -->
		              <p>
		                <?php echo substr($b->isi,0,300) ?> @if(strlen($b->isi) >= 300) ... @endif
		              </p>
		            </div>
		        </div>
	      	</div>
		    <!-- /.card-body -->
		    <div class="card-footer clearfix">
		        <a href="javascript:void(0)" class="btn btn-sm btn-primary float-left trm" data-toggle="modal" data-target="#modal_edit_blog{{$b->id_blog}}">Edit</a>
		        <a href="javascript:void(0)" class="btn btn-sm btn-danger float-left tlk" data-toggle="modal" data-target="#modal_hapus{{$b->id_blog}}">Hapus</a>
		    </div>
		    <!-- /.card-footer -->
	    </div>
	    <!-- /.card -->
	    @endforeach
		</div>
	</div>
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Tambah Blog</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
		      <div class="col-12">
		      	<p class="text-danger" id="form_result"></p>
		        <div class="row">
		            <div class="col-md-12">
		            <div id="form"></div>
		            <form class="form_tambah_blog" name="form_tambah_blog" enctype="multipart/form-data"><br>
		            	@csrf
		            	<label for="inputGroupFile01"> Gambar Barang</label>
						<div class="form-group custom-file">
						    <input type="file" class="custom-file-input cfl" name="gambar" aria-describedby="inputGroupFileAddon01" required>
						    <label class="custom-file-label lbl_fl"></label>
						</div>

		            	<div class="form-group">
						    <label for="">Judul :</label>
						    <input type="text" name="judul" class="form-control text-dark" required>
						</div>

			            <div class="mb-3">
			            	<label>Isi :</label>
			                <textarea class="textarea" name="isi" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px;line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>
			            </div>

						<div class="modal-footer text-center">
			                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
			                <button type="submit" class="btn btn-primary btn_tambah_blog">Simpan</button>
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
{{-- End Modal Tambah--}}

{{-- Modal Edit --}}
@foreach($blog as $b)
<div class="modal fade" id="modal_edit_blog{{$b->id_blog}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Edit Blog</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
        	<div class="row">
		      <div class="col-12">
		        <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails"
		          data-ride="carousel">
		            <div class="carousel-item active">
		              <img class="d-block w-100"
		                src="{{url('assets/images/')}}/{{$b->gambar}}" alt="First slide">
		            </div>
		        </div>
		      </div>

		      <div class="col-12">
		      	<p class="text-danger" id="form_result"></p>
		        <div class="row">
		            <div class="col-md-12">
		            <div id="form"></div>
		            <form class="form_edit_blog" name="form_edit_blog" enctype="multipart/form-data"><br>
		            	@csrf
		            	<input type="hidden" name="id_blog" value="{{$b->id_blog}}">
		            	<input type="hidden" name="gambar_sblm" value="{{$b->gambar}}">
		            	<label for="inputGroupFile01"> Ganti Gambar Blog</label>
						<div class="form-group custom-file">
						    <input type="file" class="custom-file-input cfl" name="gambar" aria-describedby="inputGroupFileAddon01">
						    <label class="custom-file-label lbl_fl"></label>
						</div>

		            	<div class="form-group">
						    <label for="">Judul :</label>
						    <input type="text" name="judul" class="form-control text-dark" value="{{$b->judul}}" required>
						</div>

			            <div class="mb-3">
			            	<label>Isi :</label>
			                <textarea class="textarea" name="isi" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px;line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required>{{$b->isi}}</textarea>
			            </div>

						<div class="modal-footer text-center">
			                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
			                <button type="submit" class="btn btn-primary btn_edit_blog">Edit</button>
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
{{-- End Modal Edit--}}

<!-- Modal Hapus Satu barang-->
@foreach($blog as $dab)
<div class="modal fade" id="modal_hapus{{$dab->id_blog}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">

    <div class="modal-content">
    	<div class="modal-header bg-danger text-white">
	        <h5 class="modal-title">Hapus Blog {{$dab->judul}}</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
      	</div>

      	<div class="modal-body">
      		<p>Yakin Ingin Menghapus Blog {{$dab->judul}} ???</p>
      	</div>

	    <div class="modal-footer">
	        <button type="submit" class="btn btn-danger btn_yakin" onclick="hapus_blog({{$dab->id_blog}},'{{$dab->gambar}}')">Yakin</button>
	        <button class="btn btn-secondary btn_proses" hidden="true">
                <i class="fas fa-spinner fa-spin animated ml-2" aria-hidden="true"></i>
            </button>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
	        
	    </div>
  	</div>

  </div>
</div>
@endforeach
{{-- end Modal hapus--}}

@endsection