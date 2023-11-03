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
                            <label for="">SKPD</label>
                            <select class="form-control form-select" name="id_skpd" required>
                              <option value="">Pilih SKPD</option>
                              @foreach($skpd->get() as $row)
                              <option {{!empty($edit) && $row->id_skpd==$edit->id_skpd ? 'selected':''}} value="{{$row->id_skpd}}">{{$row->nama_skpd}}</option>
                              @endforeach
                            </select>
                          </div>
                        <div class="form-group">
                          <label for="">Nama Admin</label>
                          <input type="text" class="form-control" name="nama" value="{{$edit->nama ?? null}}" placeholder="Nama Admin" required>
                        </div>
                        <div class="form-group">
                          <label for="">Alamat Email</label>
                          <input type="text" class="form-control" name="email" value="{{$edit->email ?? null}}" placeholder="Alamat Email" required>
                        </div>
                        <div class="form-group">
                          <label for="">Username</label>
                          <input {{!empty($edit) && $edit->username ? 'disabled':''}} type="text" class="form-control" name="username" value="{{$edit->username ?? null}}" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                          <label for="">Password</label>
                          <input type="password" class="form-control" name="password" value="" placeholder="Password" {{empty($edit) ? 'required':''}}>
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
