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
                        <form method="post" action="{{URL::full()}}" enctype="multipart/form-data">
                              @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nama_skpd">Nama SKPD</label>
                                        <input type="text" class="form-control" id="nama_skpd" name="nama_skpd"
                                            placeholder="Masukkan nama SKPD" value="{{$edit->nama_skpd ?? null}}" required>
                                    </div>
                                    <div class="form-group">
                                      <label for="type">Jenis</label>
                                        <select class="form-control" name="type">
                                            <option value="organisasi">Organisasi</option>
                                            <option value="kecamatan">Kecamatan</option>
                                        </select>
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
