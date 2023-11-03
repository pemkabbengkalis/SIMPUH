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
                      <th scope="col">No.</th>
                      <th scope="col">Nama SKPD</th>
                      <th scope="col">Jenis</th>
                      <th style="width:100px">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                      @forelse ($data->get() as $key=>$row)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{ $row->nama_skpd }}</td>
                      <td>{{ $row->type }}</td>
                      <td>
                          <center>
                            <a href="{{url(modul('path').'/edit/'.en($row->id_skpd))}}" class="btn btn-warning btn-xs text-white"><i class="fas fa-edit"></i></a>
                            <a href="{{url(modul('path').'/delete/'.en($row->id_skpd))}}" class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true" onclick="return confirm('Yakin akan menghapus data ini?')"></i></a>
                          </center>
                      </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Data Masih Kosong</td>
                        </tr>
                    @endforelse
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
