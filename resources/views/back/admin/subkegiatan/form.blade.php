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
                                    <h3 class="card-title mt-2">Form</h3>
                                    <a href="{{url(modul('path'))}}" class="btn btn-danger btn-sm float-right"><i class="fa fa-undo"
                                            aria-hidden="true"></i>
                                        Kembali</a>

                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <form method="post" action="{{URL::full()}}">
                          @csrf
                        <div class="card-body">
                          <div class="form-group">
                            <label for="">Kegiatan</label>
                            <select class="form-control form-select" name="id_kegiatan" required>
                              <option value="">Pilih program</option>
                              @foreach($kegiatan->get() as $row)
                              <option {{!empty($edit) && $row->id_kegiatan==$edit->id_kegiatan ? 'selected':''}} value="{{$row->id_kegiatan}}">{{$row->kode_kegiatan}} {{$row->nama_kegiatan}}</option>
                              @endforeach
                            </select>
                          </div>
                        <div class="form-group">
                          <label for="">Kode Sub Kegiatan</label>
                          <input type="text" class="form-control" name="kode_sub_kegiatan" value="{{$edit->kode_sub_kegiatan ?? null}}" placeholder="Kode Sub Kegiatan" required>
                        </div>
                        <div class="form-group">
                          <label for="">Nama Sub Kegiatan</label>
                          <input type="text" class="form-control" name="nama_sub_kegiatan" value="{{$edit->nama_sub_kegiatan ?? null}}" placeholder="Nama Sub Kegiatan" required>
                        </div>
                        </div>
                        <div class="card-footer">
                            <button name="submit" type="submit" class="btn btn-primary" value="true">Submit</button>
                        </div>
                      </form>

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
