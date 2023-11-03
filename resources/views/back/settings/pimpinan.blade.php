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
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <form method="post" action="{{URL::full()}}" enctype="multipart/form-data">
                          @csrf
               
                        <div class="card-body">
                   
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group">
                                <label for="">Nama Pimpinan</label>
                                <input type="text" class="form-control" name="nama" value="{{ $data->nama_pimpinan }}" placeholder="Nama Pimpinan">
                              </div>
                              <div class="form-group">
                                <label for="">NIP Pimpinan</label>
                                <input type="text" class="form-control" name="nip" value="{{ $data->nip_pimpinan }}" placeholder="NIP Pimpinan">
                              </div>
                            
                              <div class="form-group">
                                <label for="">Tingkat / Golongan</label>
                                <input type="text" class="form-control" name="tingkat" value="{{ $data->tingkat_pimpinan }}" placeholder="Tingkat / Golongan">
                              </div>
                            </div>
                    
                            <div class="card-footer" style="background-color : white !important;">
                              <button name="submit" type="submit" class="btn btn-primary" value="true">Update</button>
                            </div>
                          </div>

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
