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
              <li class="breadcrumb-item active">LHE</li>
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
                          <h3 class="card-title mt-2">Master Data Laporan Hasil Evaluasi (LHE)</h3>
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
                      <th>Laporan Hasil Evaluasi (LHE)</th>
                      <th>Kategori</th>
                      <th>Nilai</th>
                      <th>Keterangan</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>#{{-- {{$loop->iteration}} --}}</td>
                      <td>nama file</td>
                      <td>kategori</td>
                      <th>nilai</th>
                      <th>keterangan</th>
                      <td>
                        <div style="margin-bottom:15px">
                          <a href="#" class="btn btn-warning btn-sm text-white"><i class="fas fa-edit"></i></a>
                            <a href="#" class="btn btn-info btn-sm"><i class="fa fa-file" aria-hidden="true"></i></a>
                            <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-print" aria-hidden="true"></i></a>
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
