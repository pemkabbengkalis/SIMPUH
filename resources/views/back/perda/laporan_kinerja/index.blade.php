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
              <li class="breadcrumb-item">Perangkat Daerah</li>
              <li class="breadcrumb-item active">LKjIP</li>
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
                          <h3 class="card-title mt-2">LKjIP</h3>
                        </div>
                        <div class="col-md-2 mx-auto">
                            <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i>
 Tambah</button>
                            <button type="button" class="btn btn-warning btn-sm"><i class="fa fa-spinner" aria-hidden="true"></i> Refresh</button>
                        </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>No.</th>
                      <th>LKjIP</th>
                      <th>Progres Entri Data</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>#</td>
                      <td><b>Laporan Kinerja Instansi Pemerintah (LKjIP) Perangkat Daerah Tahun Anggaran 2021</b><br>Status : <b>Penetapan</b> Perangkat Daerah : Terakhir Ubah : <b>(2021-12-24 10:05:54)</b><br>Deskripsi : <b>Laporan Akuntabilitas Kinerja Kabupaten Bengkalis</b></td>
                      <td>pie chart</td>
                      <td>
                        <div style="margin-bottom:15px">
                            <a href="#" class="btn btn-info btn-sm"><i class="fa fa-file" aria-hidden="true"></i></a>
                            <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>
                            <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </div>
                      </td>
                    </tr>
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
@endsection
