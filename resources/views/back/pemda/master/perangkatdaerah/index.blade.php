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
              <li class="breadcrumb-item">Data Master</li>
              <li class="breadcrumb-item active">Jenis Satuan</li>
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
                          <h3 class="card-title mt-2">Daftar Jenis Satuan</h3>
                        </div>
                        <div class="col-md-2 mx-auto">

                          <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#dialog-periode"><i class="fa fa-plus" aria-hidden="true"></i>
 Tambah</a>



                            <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-refresh" aria-hidden="true"></i> Refresh</button>
                        </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>No.</th>
                      <th>Perangkat Daerah</th>
                      <th>Urusan Pemerintahan</th>
                      <th>Terakhir Ubah</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $index => $v)
                    <tr>
                      <td>{{$index+1}}</td>
                      <td><p style="font-size:15px;margin-bottom:5px;"><b>{{$v->nama_perangkatdaerah}} </b></p>
                        <p>
  					<span>E-Mail : </span><b></b>
  					<span style="margin-left:10px;">No. Telp : </span><b></b> <br>
  					<span>Alamat : </span><b></b>
  				</p>
                      </td>

                      <td>
                          <span><h6><i class="fa fa-user" aria-hidden="true"></i> User :</h6></span>
                          <span><h6><i class="fa fa-clock" aria-hidden="true"></i> Waktu :</h6></span>
                      </td>
                      <td>
                        <div style="margin-bottom:15px">
                            <a href="#" class="btn btn-warning btn-sm text-white"><i class="fas fa-edit"></i></a>
                            <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
@endsection
