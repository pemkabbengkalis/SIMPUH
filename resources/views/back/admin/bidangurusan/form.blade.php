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
                            <label for="">URUSAN</label>
                            <select class="form-control form-select" name="kode_urusan" required>
                              <option value="">Pilih Urusan</option>
                              @foreach($urusan->get() as $row)
                              <option {{!empty($edit) && $row->kode_urusan==$edit->kode_urusan ? 'selected':''}} value="{{$row->kode_urusan}}">{{$row->kode_urusan}} {{$row->nama_urusan}}</option>
                              @endforeach
                            </select>
                          </div>
                        <div class="f
                        <div class="form-group">
                          <label for="">Kode Bidang Urusan</label>
                          <input type="text" class="form-control" name="kode_bidang_urusan" value="{{$edit->kode_bidang_urusan ?? null}}" placeholder="Kode Bidang Urusan" required>
                        </div>
                        <div class="form-group">
                          <label for="">Nama Bidang Urusan</label>
                          <input type="text" class="form-control" name="nama_bidang_urusan" value="{{$edit->nama_bidang_urusan ?? null}}" placeholder="Nama Bidang Urusan" required>
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
