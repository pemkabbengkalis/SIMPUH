@extends('back.layouts.templating')

@section('content')
    <!-- Content Header (Page header) -->
@include('back.bc')
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
                          <h3 class="card-title mt-2">Data</h3>
                            <a href="{{url(modul('path').'/create')}}" type="button" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</a>
                        </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="table" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                    <tr>
                      <th style="width:20px">No.</th>
                      <th>Nama SKPD</th>
                      <th>Nama Admin</th>
                      <th>Email</th>
                      <th>Username</th>
                      <th style="width:100px">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>

                      @foreach($data->join('tbl_skpd','tbl_skpd.id_skpd','users.id_skpd')->get() as $key=>$row)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$row->nama_skpd}}</td>
                      <td>{{$row->nama}}</td>
                      <td>{{$row->email}}</td>
                      <td> {{$row->username}}

                       </td>
                      <td>
                          <center>
                            <a href="{{url(modul('path').'/edit/'.en($row->id))}}" class="btn btn-warning btn-xs text-white"><i class="fas fa-edit"></i></a>
                            <a href="{{url(modul('path').'/delete/'.en($row->id))}}" class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true" onclick="return confirm('Yakin akan menghapus data ini?')"></i></a>
                          </center>
                      </td>
                    </tr>
                    @endforeach
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
