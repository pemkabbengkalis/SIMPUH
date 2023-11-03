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
                        <div class="col-md-12">
                          <h3 class="card-title mt-2">Master Data RKPD</h3>
                            <button type="button" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus" aria-hidden="true"></i>
 Tambah</button>

                        </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="table" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                    <tr>
                      <th>No.</th>
                      <th>RKPD</th>
                      <th>Terakhir Ubah</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                      @for($a=0;$a<=50; $a++)
                    <tr>
                      <td>#</td>
                      <td><b>Rencana Kerja Pembangunan Daerah (RKPD) Tahun Anggaran 2022</b>
                        <br>
                        <span>Periode Pemerintahan : <b>2016 - 2021</b> &nbsp; Status : <b>Penetapan</b></span>
                        <br>
                        <span>Keterangan : </span>
                      </td>
                      <td>
                          <span><h6><i class="fa fa-user" aria-hidden="true"></i> User :</h6></span>
                          <span><h6><i class="fa fa-clock" aria-hidden="true"></i> Waktu :</h6></span>
                      </td>
                      <td>
                          <center>
                            <a href="#" class="btn btn-info btn-xs"><i class="fa fa-print" aria-hidden="true"></i></a>
                            <a href="#" class="btn btn-warning btn-xs text-white"><i class="fas fa-edit"></i></a>
                            <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i></a>
                          </center>
                      </td>
                    </tr>
                    @endfor
                  </tbody>
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
