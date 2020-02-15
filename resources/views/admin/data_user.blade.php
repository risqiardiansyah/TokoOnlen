@extends('template.template_admin')

@section('content')

<div class="col-md-12">
<div class="card">
<div class="card-header">
  <h3 class="card-title">Data User <small> *klik pada user untuk melakukan action</small></h3>
</div>
<!-- /.card-header -->
<div class="card-body">
  <table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
      <th width="10px;">No.</th>
      <th>Nama</th>
      <th>Email</th>
      <th>No. Telp</th>
      <th>Alamat</th>
      <th>Waktu Pendaftaran</th>
    </tr>
    
    </thead>
    <tbody>
    <?php $i=1 ?>
    @foreach($user as $u)
	    <tr onclick="alert('fdf')" style="cursor: pointer;">
	      <td> {{$i++}} </td>
	      <td> {{$u->name}} </td>
	      <td> {{$u->email}} </td>
	      <td> {{$u->no_telp}} </td>
	      <td> {{$u->alamat}} </td>
	      <td> {{$u->created_at}} </td>
	    </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
      <th>No. </th>
      <th>Nama</th>
      <th>Email</th>
      <th>No. Telp</th>
      <th>Alamat</th>
      <th>Waktu Pendaftaran</th>
    </tr>
    </tfoot>
  </table>
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->
</div>

@endsection
