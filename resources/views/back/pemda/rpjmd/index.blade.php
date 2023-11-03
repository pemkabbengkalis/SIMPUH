@extends('back.layouts.templating')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Capaian Kinerja Elekronik</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item">Pemerintah Daerah</li>
          <li class="breadcrumb-item active">RPJMD</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <h3 class="card-title mt-2">Master Data RPJMD</h3>
              </div>
              <div class="col-md-2 mx-auto">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-plus"></i>&nbsp; Tambah</button>
                <button type="button" class="btn btn-warning btn-sm"><i class="fa fa-spinner" aria-hidden="true"></i> Refresh</button>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="table" class="table table-bordered table-striped">
              <thead class="text-center">
                <tr>
                  <th>No.</th>
                  <th>RPJMD</th>
                  <th>Kepala Daerah/Wakil Kepala Daerah</th>
                  <th>Terakhir Ubah</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($data as $index => $v)
                <tr>
                  <td>{{$index+1}}</td>
                  <td><b>Rencana Pembangunan Jangka Menengah Daerah (RPJMD) Periode Pemerintahan {{$v->awal_periode}}-{{$v->akhir_periode}}</b><br> Keterangan : {{$v->keterangan_periode}}</td>
                  <td>Kepala Daerah/Wakil Kepala Daerah</td>
                  <td>
                    <span><h6><i class="fa fa-list" aria-hidden="true"></i> Penetapan :</h6></span>
                    <span><h6><i class="fa fa-user" aria-hidden="true"></i> User :</h6></span>
                    <span><h6><i class="fa fa-clock" aria-hidden="true"></i> Waktu :</h6></span>
                  </td>
                  <td class="mb-3">
                    <div style="margin-bottom: 25px;">
                      <a href="#" class="btn btn-info btn-sm"><i class="fa fa-file" aria-hidden="true"></i></a>
                      <button type="button" class="btn btn-warning btn-sm text-white btn-sm" data-toggle="modal" data-target="#modal-edit"><i class="fas fa-edit"></i></button>
                      <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-user" aria-hidden="true"></i></a>
                      <a href="#" class="btn btn-info btn-sm"><i class="fa fa-print" aria-hidden="true"></i></a>
                      <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-print" aria-hidden="true"></i></a>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->

<!-- /.modal tambah-->
<div class="modal fade" id="modal-tambah">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Periode</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="" action="" method="post">
          <form>
            <div class="row mb-3">
              <label for="periode_awal" class="col-sm-2 col-form-label">Periode</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" id="periode_awal" placeholder="xxxx">
              </div>
              <label for="periode_akhir" class="col-sm-2 col-form-label text-center">s.d.</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" id="periode_akhir" placeholder="xxxx">
              </div>
            </div>
            <div class="row mb-3">
              <label for="status" class="col-sm-2 col-form-label">Status</label>
              <div class="col-md-2">
          			<select name="status" class="form-control">
          				<option value="#">Entri Data</option>
                  <option value="#">Penetapan</option>
                </select>
          		</div>
            </div>
            <div class="row mb-3">
              <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
              <div class="col-md-10">
                <textarea class="form-control" rows="3" placeholder="Keterangan periode ..."></textarea>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary"> Simpan</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal tambah end -->
  <!-- /.modal edit-->
  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data Periode</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="" action="index.html" method="post">
            <form>
              <div class="row mb-3">
                <label for="periode_awal" class="col-sm-2 col-form-label">Periode</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" id="periode_awal" placeholder="xxxx">
                </div>
                <label for="periode_akhir" class="col-sm-2 col-form-label text-center">s.d.</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" id="periode_akhir" placeholder="xxxx">
                </div>
              </div>
              <div class="row mb-3">
                <label for="status" class="col-sm-2 col-form-label">Status</label>
                <div class="col-md-2">
            			<select name="status" class="form-control">
            				<option value="#">Entri Data</option>
                    <option value="#">Penetapan</option>
                  </select>
            		</div>
              </div>
              <div class="row mb-3">
                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-md-10">
                  <textarea class="form-control" rows="3" placeholder="Keterangan periode ..."></textarea>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary"> Simpan</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal edit end -->
  @endsection
