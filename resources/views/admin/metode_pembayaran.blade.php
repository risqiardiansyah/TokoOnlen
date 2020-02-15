@extends('template.template_admin')

@section('content')

<div class="col-12">
	<a href="#" class="btn btn-sm btn-primary float-right" style="margin-top: -50px;" role="button" data-toggle="modal" data-target="#modal_tambah">Tambah</a>
	<div class="card">
      <div class="card-header border-transparent">
        <h3 class="card-title">Data Metode Pembayaran</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table m-0">
            <thead>
            <tr>
              <th>No.</th>
              <th>Gambar</th>
              <th>Nama Metode Pembayaran</th>
              <th>Nomor</th>
              <th>Status</th>
            </tr>
            </thead>
            <tbody class="data_metode">

            @if(count($metode_pembayaran)==0)
                <tr>
                  <td class="text-center" colspan="8"><h1>Belum Ada Pesanan</h1></td>
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
            <form class="form_tambah_metode_pembayaran" name="form_tambah_blog" enctype="multipart/form-data"><br>
              @csrf

              <div>
                <h1>Tambah Metode Pembayaran Belum Tersedia</h1>
              </div>

                <div class="modal-footer text-center">
                  {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button> --}}
                  <button type="submit" class="btn btn-primary btn_tambah_blog">OK</button>
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