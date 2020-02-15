@extends('template.template_admin')

@section('content')

<div class="col-12">
	<a href="#" class="btn btn-sm btn-primary float-right" style="margin-top: -50px;" role="button" data-toggle="modal" data-target="#modal_tambah">Tambah</a>
	<div class="card">
      <div class="card-header border-transparent">
        <h3 class="card-title">Data Kategori</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table m-0">
            <thead>
            <tr>
              <th>No.</th>
              <th>Gambar</th>
              <th>Nama Kategori</th>
              <th>Link <small class="text-secondary">*</small></th>
              <th>Status</th>
              <th>Hapus</th>
            </tr>
            </thead>
            <tbody class="data_kategori">

            @if(count($kategori)==0)
                <tr>
                  <td class="text-center" colspan="8"><h1>Belum Ada Data</h1></td>
                </tr>
            @endif

            </tbody>
          </table>
        </div>
        <!-- /.table-responsive -->
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Tambah Kategori</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="col-12">
            <p class="text-danger" id="form_result"></p>
            <div class="row">
            <div class="col-md-12">
            <form class="form_tambah_kategori" name="form_tambah_blog" enctype="multipart/form-data"><br>
              @csrf

              	<div class="form-group">
				    <label for="">Nama Kategori :</label>
				    <input type="text" name="nama_kategori" class="form-control text-dark explode" required>
				    <p class="after_explode"></p>
				</div>
				<input type="hidden" name="link" class="link">
				<label for="inputGroupFile01"> Gambar Kategori</label>
				<div class="custom-file">
				    <input type="file" class="custom-file-input cfll" name="gambar" aria-describedby="inputGroupFileAddon01" required>
				    <label class="custom-file-label lbl_fll"></label>
				</div>
                <div class="modal-footer text-center">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary btn_yakin">OK</button>
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

@endsection