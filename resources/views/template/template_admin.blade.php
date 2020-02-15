<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Admin TokoOnlen</title>

  <link rel="shortcut icon" href="{{ asset('assets/images/char_3.png') }}">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{!! asset('admin/plugins/fontawesome-free/css/all.min.css') !!} ">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{!! asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') !!} ">
  <!-- Theme style -->
  <link rel="stylesheet" href="{!! asset('admin/dist/css/adminlte.min.css') !!} ">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{!! asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css') !!}">
  <!-- summernote -->
  <link rel="stylesheet" href="{!! asset('admin/plugins/summernote/summernote-bs4.css') !!}">
  <link rel="stylesheet" type="text/css" href="{!! asset('assets/sweetalert/sweetalert2.min.css') !!}">
  <style>
  .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
  }

  .switch input { 
    opacity: 0;
    width: 0;
    height: 0;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked + .slider {
    background-color: #2196F3;
  }

  input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }

  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  }
  </style>

  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown satu">
        <a class="nav-link dua" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">*</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right direct-chat-messages notif" style="padding: 0px!important;">
          {{-- Notif --}}
        </div>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right direct-chat-messages check" style="padding: 0px!important;">
          <div class="text-center text-success" style="margin-top: 100px;"><i class="fas fa-check-circle fa-3x fa-bounce"></i></div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fas fa-th-large"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/u/profile')}}" class="brand-link">
      <img src="{!! asset('assets/images/person.png') !!}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{Auth::user()->name}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="{{url('toko_onlen/adm/admin')}}" class="nav-link @if(Request::segment(4) == '') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <span class="right badge badge-success">New</span>
              </p>
            </a>
          </li>
          
          <li class="nav-item has-treeview @if(Request::segment(4) == 'data') menu-open @endif">
            <a href="#" class="nav-link @if(Request::segment(4) == 'data') active @endif">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Data
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/toko_onlen/adm/admin/data/user')}}" class="nav-link @if(Request::segment(5) == 'user') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/toko_onlen/adm/admin/data/barang')}}" class="nav-link @if(Request::segment(5) == 'barang') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/toko_onlen/adm/admin/data/pesanan')}}" class="nav-link @if(Request::segment(5) == 'pesanan') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pesanan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/toko_onlen/adm/admin/data/feedback')}}" class="nav-link @if(Request::segment(5) == 'feedback') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Feedback</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{url('/toko_onlen/adm/admin/blog')}}" class="nav-link @if(Request::segment(4) == 'blog') active @endif">
              <i class="nav-icon fas fa-blog"></i>
              <p>
                Blog
              </p>
            </a>
          </li>

          <li class="nav-header">FITUR KHUSUS</li>
          <li class="nav-item">
            <a href="{{url('/toko_onlen/adm/admin/metode_pembayaran')}}" class="nav-link @if(Request::segment(4) == 'metode_pembayaran') active @endif">
              <i class="nav-icon fas fa-money-check-alt"></i>
              <p>
                Metode Pembayaran
                <span class="badge badge-info right">{{count($metode_pembayaran)}}</span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('/toko_onlen/adm/admin/kategori')}}" class="nav-link @if(Request::segment(4) == 'kategori') active @endif">
              <i class="nav-icon fab fa-buromobelexperte"></i>
              <p>
                Kategori
                <span class="badge badge-info right">{{count($kategori)}}</span>
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Admin TokoOnlen</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">


  @yield('content')
        
        </div>
      </div>
    </section>
  </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.2
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{!! asset('admin/plugins/jquery/jquery.min.js') !!}"></script>
<!-- Bootstrap -->
<script src="{!! asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
<!-- overlayScrollbars -->
<script src="{!! asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') !!}"></script>
<!-- AdminLTE App -->
<script src="{!! asset('admin/dist/js/adminlte.js') !!}"></script>
<!-- DataTables -->
<script src="{!! asset('admin/plugins/datatables/jquery.dataTables.js') !!}"></script>
<script src="{!! asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js') !!}"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="{!! asset('admin/dist/js/demo.js') !!}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{!! asset('admin/plugins/jquery-mousewheel/jquery.mousewheel.js') !!}"></script>
<script src="{!! asset('admin/plugins/raphael/raphael.min.js') !!}"></script>
<script src="{!! asset('admin/plugins/jquery-mapael/jquery.mapael.min.js') !!}"></script>
<script src="{!! asset('admin/plugins/jquery-mapael/maps/usa_states.min.js') !!}"></script>
<!-- ChartJS -->
<script src="{!! asset('admin/plugins/chart.js/Chart.min.js') !!}"></script>

<!-- PAGE SCRIPTS -->
<script src="{!! asset('admin/dist/js/pages/dashboard2.js') !!}"></script>
<script src="{!! asset('assets/sweetalert/sweetalert2.min.js') !!}"></script>

<script src="{!! asset('admin/plugins/summernote/summernote-bs4.min.js') !!}"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>

<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>

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

{{-- Edit Barang --}}
<script>
  $(document).ready(function() {

    $('.form_edit_barang').on('submit', function(event) {
    
    $('.button_edit').attr('hidden','true');
    $('.btn_proses').removeAttr('hidden');

    event.preventDefault();
    $.ajax({
      url: "{{route('edit.barang')}}",
      method: "POST",
      data: new FormData(this),
      contentType: false,
      cached: false,
      processData: false,
      dataType: 'json',
      
      success:function(response) {
        if (response == 1) {
            Swal.fire({ 
                type: 'success',
                title: 'Berhasil !',
                text: 'Berhasil Edit Barang !!',
              }).then((result) => {
                location.reload();
              });
        }else if (response == 2) {
          Swal.fire({ 
                type: 'error',
                title: 'Gagal!',
                text: 'Gagal Edit Data',
            }).then((result) => {
            $('.newsletter_button').removeAttr('hidden');
            $('.btn_proses').attr('hidden', 'true');
            });
        }else if (response == 3) {
          Swal.fire({ 
                type: 'warning',
                title: 'Warning!',
                text: 'Data Masih Sama Dengan Sebelumnya !',
            }).then((result) => {
            $('.newsletter_button').removeAttr('hidden');
            $('.btn_proses').attr('hidden', 'true');
            });
        
        }else{
          Swal.fire({ 
                type: 'warning',
                title: 'Warning!',
                text: 'File Harus PNG/JPG !!!',
            }).then((result) => {
            $('.newsletter_button').removeAttr('hidden');
            $('.btn_proses').attr('hidden', 'true');
            });
        }
      }
    })
    })
  });
</script>

{{-- Hapus Barang --}}
<script>
  $(document).ready(function() {
    $('.form_hapus_barang').on('submit', function(event) {
    
    $('.btn_yakin').attr('hidden','true');
    $('.btn_proses').removeAttr('hidden');

    event.preventDefault();
    $.ajax({
      url: "{{route('hapus.barang')}}",
      method: "POST",
      data: new FormData(this),
      contentType: false,
      cached: false,
      processData: false,
      dataType: 'json',
      
      success:function(response) {
        if (response == 1) {
            Swal.fire({ 
                type: 'success',
                title: 'Berhasil !',
                text: 'Berhasil Hapus Barang !!',
              }).then((result) => {
                location.reload();
              });
        }else if (response == 2) {
          Swal.fire({ 
                type: 'error',
                title: 'Gagal!',
                text: 'Gagal Hapus Barang',
            }).then((result) => {
            $('.newsletter_button').removeAttr('hidden');
            $('.btn_proses').attr('hidden', 'true');
            });
        }else{
          Swal.fire({ 
                type: 'warning',
                title: 'Warning!',
                text: 'File Harus PNG/JPG !!!',
            }).then((result) => {
            $('.newsletter_button').removeAttr('hidden');
            $('.btn_proses').attr('hidden', 'true');
            });
        }
      }
    })
    })
  });
</script>

{{-- Tambah Barang --}}
<script>
  $(document).ready(function() {
    $('.form_tambah_barang').on('submit', function(event) {
    
    $('.btn_yakin').attr('hidden','true');
    $('.btn_proses').removeAttr('hidden');

    event.preventDefault();
    $.ajax({
      url: "{{route('tambah.barang')}}",
      method: "POST",
      data: new FormData(this),
      contentType: false,
      cached: false,
      processData: false,
      dataType: 'json',
      
      success:function(response) {
        if (response == 1) {
            Swal.fire({ 
                type: 'success',
                title: 'Berhasil !',
                text: 'Berhasil Tambah Barang !!',
              }).then((result) => {
                location.reload();
              });
        }else if (response == 2) {
          Swal.fire({ 
                type: 'error',
                title: 'Gagal!',
                text: 'Gagal Tambah Barang',
            }).then((result) => {
            $('.newsletter_button').removeAttr('hidden');
            $('.btn_proses').attr('hidden', 'true');
            });
        }else{
          Swal.fire({ 
                type: 'warning',
                title: 'Warning!',
                text: 'File Harus PNG/JPG !!!',
            }).then((result) => {
            $('.newsletter_button').removeAttr('hidden');
            $('.btn_proses').attr('hidden', 'true');
            });
        }
      }
    })
    })
  });
</script>

{{-- Tambah Blog --}}
<script>
  $(document).ready(function() {
    $('.form_tambah_blog').on('submit', function(event) {
    
    $('.btn_tambah_blog').attr('hidden','true');
    $('.btn_proses').removeAttr('hidden');

    event.preventDefault();
    $.ajax({
      url: "{{route('tambah.blog')}}",
      method: "POST",
      data: new FormData(this),
      contentType: false,
      cached: false,
      processData: false,
      dataType: 'json',
      
      success:function(response) {
        if (response == 1) {
            Swal.fire({ 
                type: 'success',
                title: 'Berhasil !',
                text: 'Berhasil Tambah Blog !!',
              }).then((result) => {
                location.reload();
              });
        }else if (response == 2) {
          Swal.fire({ 
                type: 'error',
                title: 'Gagal!',
                text: 'Gagal Tambah Blog',
            }).then((result) => {
            $('.newsletter_button').removeAttr('hidden');
            $('.btn_proses').attr('hidden', 'true');
            });
        }else{
          Swal.fire({
                type: 'warning',
                title: 'Warning!',
                text: 'File Harus PNG/JPG !!!',
            }).then((result) => {
            $('.newsletter_button').removeAttr('hidden');
            $('.btn_proses').attr('hidden', 'true');
            });
        }
      }
    })
    })
  });
</script>

{{-- Edit Blog --}}
<script>
  $(document).ready(function() {
    $('.form_edit_blog').on('submit', function(event) {
    
    $('.btn_edit_blog').attr('hidden','true');
    $('.btn_proses').removeAttr('hidden');

    event.preventDefault();
    $.ajax({
      url: "{{route('edit.blog')}}",
      method: "POST",
      data: new FormData(this),
      contentType: false,
      cached: false,
      processData: false,
      dataType: 'json',
      
      success:function(response) {
        if (response == 1) {
            Swal.fire({ 
                type: 'success',
                title: 'Berhasil !',
                text: 'Berhasil Edit Blog !!',
              }).then((result) => {
                location.reload();
              });
        }else if (response == 2) {
          Swal.fire({ 
                type: 'error',
                title: 'Gagal!',
                text: 'Gagal Edit Blog',
            }).then((result) => {
            $('.newsletter_button').removeAttr('hidden');
            $('.btn_proses').attr('hidden', 'true');
            });
        }else{
          Swal.fire({
                type: 'warning',
                title: 'Warning!',
                text: 'File Harus PNG/JPG !!!',
            }).then((result) => {
            $('.newsletter_button').removeAttr('hidden');
            $('.btn_proses').attr('hidden', 'true');
            });
        }
      }
    })
    })
  });
</script>

{{-- Tambah Kategori --}}
<script>
  $(document).ready(function() {
    $('.form_tambah_kategori').on('submit', function(event) {
    
    $('.btn_yakin').attr('hidden','true');
    $('.btn_proses').removeAttr('hidden');

    event.preventDefault();
    $.ajax({
      url: "{{route('kategori.tambah')}}",
      method: "POST",
      data: new FormData(this),
      contentType: false,
      cached: false,
      processData: false,
      dataType: 'json',
      
      success:function(response) {
        if (response == 1) {
            Swal.fire({ 
                type: 'success',
                title: 'Berhasil !',
                text: 'Berhasil Tambah Kategori !!',
              }).then((result) => {
                location.reload();
              });
        }else if (response == 2) {
          Swal.fire({ 
                type: 'error',
                title: 'Gagal!',
                text: 'Gagal',
            }).then((result) => {
            $('.newsletter_button').removeAttr('hidden');
            $('.btn_proses').attr('hidden', 'true');
            });
        }else{
          Swal.fire({ 
                type: 'warning',
                title: 'Warning!',
                text: 'File Harus PNG/JPG !!!',
            }).then((result) => {
            $('.newsletter_button').removeAttr('hidden');
            $('.btn_proses').attr('hidden', 'true');
            });
        }
      }
    })
    })
  });
</script>

<script>
  $(document).ready(function(){

    $('.harga').on('input', function(){
      var harga = $('.harga').val();
      var rp = harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");

      $('.nf_harga').text('Rp. '+rp);
    })

    $('.cfl').on('input', function() {
      var fullPath = $('.cfl').val();
      var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
      var filename = fullPath.substring(startIndex);
      
      $('.lbl_fl').text(filename);
    })

    $('.cfll').on('input', function() {
      var fullPath = $('.cfll').val();
      var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
      var filename = fullPath.substring(startIndex);
      
      $('.lbl_fll').text(filename);
    })
    
    var tx = " ";
    $(".explode").val(tx);
    
    $('.explode').on('input', function() {
      var data = $('.explode').val().split(' ');
      $('.link').val(data[1]);
      $('.after_explode').text(data[1]);
    })

  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    window.kemas = function(argument,id) {
      var status = argument;
      
      var id_keranjang = id;
      $.ajax({
        url: "{{url('status_pembelian')}}/"+status+"",
        method: "POST",
        data:{"_token": "{{ csrf_token() }}",status:status, id_keranjang:id_keranjang},
        
        success: function(response) {
          if (response == 1) {
            Swal.fire({ 
                type: 'success',
                title: 'Berhasil !',
                text: 'Berhasil Update Status Pesanan !!',
              }).then((result) => {
                location.reload();
              });
            }else{
              Swal.fire({ 
                type: 'error',
                title: 'Error !',
                text: 'gagal !!',
              });
            }
        }
      })
    }

    window.status_all = function(argument) {
      var status = argument;
      
      $.ajax({
        url: "{{url('status_all')}}/"+status+"",
        method: "POST",
        data:{"_token": "{{ csrf_token() }}",status:status},
        
        success: function(response) {
          if (response == 1) {
            $(".trm").addClass('disabled');
            Swal.fire({ 
                type: 'success',
                title: 'sc !',
                text: 'Berhasil !!',
              }).then((result) => {
                location.reload();
              });
            }else{
              $(".trm").addClass('disabled');
              $(".tlk").addClass('disabled');
              Swal.fire({
                type: 'warning',
                title: 'Gagal !',
                text: 'Semua Barang Telah Diterima/Dikirim/Ditolak !!',
              });

            }
        }
      })
    }

    window.hapus_blog = function(argument,gambar) {
      var id = argument;
      var gambar = gambar;

      $.ajax({
        url: "{{url('hapus_blog')}}/"+id+"",
        method: "POST",
        data: {"_token":"{{csrf_token()}}", id:id, gambar:gambar},

        success: function(response) {
          if(response == 1){
            Swal.fire({ 
                type: 'success',
                title: 'sc !',
                text: 'Berhasil Hapus Blog!!',
              }).then((result) => {
                location.reload();
              });
            }else{
              Swal.fire({
                type: 'warning',
                title: 'Gagal !',
                text: 'Semua Barang Telah Diterima/Dikirim/Ditolak !!',
              });
            }
        }
      })
    }

  });
</script>

<script>
$(document).ready(function(){
  tampil_data();
  tampil_data_kategori();
  tampil_notif();

  function tampil_data() {
    $.ajax({
      url: "{{url('get/metode_pembayaran')}}",
      type: "GET",
      async: true,
      dataType: "json",

      success : function(data) {
        var html = '';
        var no = 0;
        
        for (var i = 0; i < data.length; i++) {
          no++;
          html += '<tr>'+ 
                '<td>'+no+'</td>'+
                '<td>'+data[i].nama_pembayaran+'</td>'+
                '<td>'+data[i].nomor+'</td>'+
                '<td>'+
                '<label class="switch">';
                if(data[i].status == 'aktif') {
          html += '<input type="checkbox" checked >'+
                  '<span class="slider round" onclick="nonaktifkan('+data[i].id_pembayaran+')"></span>'+
                  '</label>';
                  }else{
          html += '<input type="checkbox">'+
                  '<span class="slider round" onclick="aktifkan('+data[i].id_pembayaran+')"></span>'+
                  '</label>';
                  }
          html += '</td></tr>';
        }
        $(".data_metode").html(html);
      }
    })
  }

  function tampil_data_kategori() {
    $.ajax({
      url: "{{url('get/kategori')}}",
      type: "GET",
      async: true,
      dataType: "json",

      success : function(data) {
        var html = '';
        var no = 0;
        
        for (var i = 0; i < data.length; i++) {
          no++;
          html += '<tr>'+ 
                '<td>'+no+'</td>'+
                '<td><img src="{{url("assets/images")}}/'+data[i].gambar+'" width="50px;"></td>'+
                '<td>'+data[i].nama_kategori+'</td>'+
                '<td><a href="{{url("toko_onlen/k/")}}/'+data[i].link+'">{{url("toko_onlen/k/")}}/'+data[i].link+'</td>'+
                '<td>'+
                '<label class="switch">';
                if(data[i].status == 'aktif') {
          html += '<input type="checkbox" checked >'+
                  '<span class="slider round" onclick="nonaktifkan_kategori('+data[i].id_kategori+')"></span>'+
                  '</label>';
                  }else{
          html += '<input type="checkbox">'+
                  '<span class="slider round" onclick="aktifkan_kategori('+data[i].id_kategori+')"></span>'+
                  '</label>';
                  }
          html += '</td><td><button class="btn btn-danger btn-sm" onclick="hapus_kategori('+data[i].id_kategori+')"><i class="fas fa-trash"></i></button></td></tr>';
        }
        $(".data_kategori").html(html);
      }
    })
  }

  function tampil_notif() {
    $.ajax({
      url: "{{url('get/notifikasi_admin')}}",
      type: "GET",
      async: true,
      dataType: "json",

      success : function(data) {

        var html = '';
        
        html += '<span class="dropdown-item dropdown-header">Notifikasi/Message</span>';

        for (var i = 0; i < data.length; i++) {
          html+= '<div class="dropdown-divider"></div>';
            if (data[i].jenis_notifikasi=='checkout') {
          html += '<div class="dropdown-item bg-info">'+
                    '<i class="fas fa-shopping-cart mr-2"></i>'+data[i].judul+''+
                    '<p>'+data[i].isi+'</p><hr>';
            }else if(data[i].jenis_notifikasi=='batal'){
              html += '<div class="dropdown-item bg-danger">'+
                    '<i class="fas fa-ban mr-2"></i>'+data[i].judul+''+
                    '<p>'+data[i].isi+'</p><hr>';
            }else if(data[i].jenis_notifikasi=='diterima'){
              html += '<div class="dropdown-item bg-success">'+
                    '<i class="fas fa-check-circle mr-2"></i>'+data[i].judul+''+
                    '<p>'+data[i].isi+'</p><hr>';
            }else if(data[i].jenis_notifikasi=='pesanan'){
              html += '<div class="dropdown-item bg-warning">'+
                    '<i class="fas fa-exclamation mr-2"></i>'+data[i].judul+''+
                    '<p>'+data[i].isi+'</p><hr>';
            }else{
              html += '<div class="dropdown-item bg-secondary">'+
                    '<i class="fas fa-envelope mr-2"></i>'+data[i].judul+''+
                    '<p>'+data[i].isi+'</p><hr>';
            }
            if (data[i].status=='0') {
              html += '<button class="btn btn-warning btn-sm" role="button" onclick="baca('+data[i].id_notifikasi+')">Tandai Dibaca</button>'+
                  '</div>';
            }else{
              html += '<button class="btn btn-success btn-sm" disabled>Dibaca</button>'+
                      '<button class="btn btn-danger float-right" onclick="hapus_notif('+data[i].id_notifikasi+')" style="margin-top: -10px!important;"><i class="fas fa-trash"></i></button>'+
                  '</div>';
            }
        }
        console.log(data);
        $('.notif').html(html);
      }
    })
  }

  //metode
  window.nonaktifkan = function(id) {
    var id = id;

    $.ajax({
        url: "{{route('metode_pembayaran.nonaktifkan')}}",
        method: "POST",
        data: {"_token":"{{csrf_token()}}", id:id},

        success: function(response) {
          if(response == 1){
            Swal.fire({ 
                type: 'success',
                title: 'Berhasil !',
                text: 'Dinonaktifkan',
                showConfirmButton: false,
                timer: 1500,
              }).then((result) => {
                tampil_data();
              });
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

  //metode
  window.aktifkan = function(id) {
    var id = id;

    $.ajax({
        url: "{{route('metode_pembayaran.aktifkan')}}",
        method: "POST",
        data: {"_token":"{{csrf_token()}}", id:id},

        success: function(response) {
          if(response == 1){
            Swal.fire({ 
                type: 'success',
                title: 'Berhasil !',
                text: 'Diaktifkan',
                showConfirmButton: false,
                timer: 1500,
              }).then((result) => {
                tampil_data_kategori();
              });
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

  //kategori
  window.nonaktifkan_kategori = function(id) {
    var id = id;

    $.ajax({
        url: "{{route('kategori.nonaktifkan')}}",
        method: "POST",
        data: {"_token":"{{csrf_token()}}", id:id},

        success: function(response) {
          if(response == 1){
            Swal.fire({ 
                type: 'success',
                title: 'Berhasil !',
                text: 'Dinonaktifkan',
                showConfirmButton: false,
                timer: 1500,
              }).then((result) => {
                tampil_data_kategori();
              });
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

  //kategori
  window.aktifkan_kategori = function(id) {
    var id = id;

    $.ajax({
        url: "{{route('kategori.aktifkan')}}",
        method: "POST",
        data: {"_token":"{{csrf_token()}}", id:id},

        success: function(response) {
          if(response == 1){
            Swal.fire({ 
                type: 'success',
                title: 'Berhasil !',
                text: 'Diaktifkan',
                showConfirmButton: false,
                timer: 1500,
              }).then((result) => {
                tampil_data_kategori();
              });
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

  window.hapus_kategori = function(id) {
    var id = id;
    if (confirm('Yakin ingin menghapus data ini ??')) {
    $.ajax({
      url: "{{route('kategori.hapus')}}",
      method: "POST",
      data: {"_token":"{{csrf_token()}}", id:id},

      success: function(response) {
          if(response == 1){
            Swal.fire({ 
                type: 'success',
                title: 'Berhasil !',
                text: 'Data Dihapus',
                showConfirmButton: false,
                timer: 1500,
              }).then((result) => {
                tampil_data_kategori();
              });
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
  }

  window.baca = function(id) {
    $('.check').addClass('show');
    var id = id;

    $.ajax({
        url: "{{route('notifikasi.baca')}}",
        method: "POST",
        data: {"_token":"{{csrf_token()}}", id:id},

        success: function(response) {
          if(response == 1){
                tampil_notif();
                $('.check').removeClass('show');
                $('.satu').addClass('show');
                $('.dua').attr('aria-expanded','true');
                $('.notif').addClass('show');
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
                $('.satu').addClass('show');
                $('.dua').attr('aria-expanded','true');
                $('.notif').addClass('show');
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