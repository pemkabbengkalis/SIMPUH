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
                          <label for="">Nama Program Unggulan</label>
                          <textarea class="form-control" name="nama_program_unggulan" placeholder="Nama Program Unggulan" required>{{$edit->nama_program_unggulan ?? null}}</textarea>
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
