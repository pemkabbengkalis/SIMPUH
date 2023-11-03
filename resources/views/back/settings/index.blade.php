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
                          @method('PUT')
                        <div class="card-body">
                          <div class="form-group">
                            <label for="">SKPD</label>
                            <input type="text" class="form-control" name="nama_skpd" placeholder="Nama SKPD" value="{{ sesiowner() }}" readonly>
                          </div>
                          <div class="row">
                            <div class="col-lg-8">
                              <div class="form-group">
                                <label for="">Nama Admin</label>
                                <input type="text" class="form-control" name="nama" value="{{ $data->nama }}" placeholder="Nama">
                              </div>
                              <div class="form-group">
                                <label for="">Alamat Email</label>
                                <input type="text" class="form-control" name="email" value="{{ $data->email }}" placeholder="Email">
                                @error('email')
                                    <div class="text-red mt-2 text-sm">{{ $message }}</div>
                                @enderror
                              </div>
                              <div class="form-group">
                                <label for="">Nomor HP</label>
                                <input type="text" class="form-control" name="no_hp" value="{{ $data->no_hp }}" placeholder="Nomor HP">
                              </div>
                              <div class="form-group">
                                <label for="">Jenis Kelamin</label>
                                <select class="form-control form-select" name="jenis_kelamin">
                                  <option value="1" {{ $data->jenis_kelamin == '1' ? 'selected' : '' }}>Laki-laki</option>
                                  <option value="0" {{ $data->jenis_kelamin == '0' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-lg-4">
                              <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" class="form-control" name="username" value="{{ $data->username }}" placeholder="username" disabled>
                                @error('username')
                                    <div class="text-red mt-2 text-sm">{{ $message }}</div>
                                @enderror
                              </div>
                              <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="password">
                                @error('password')
                                    <div class="text-red mt-2 text-sm">{{ $message }}</div>
                                @enderror
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
