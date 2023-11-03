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
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="form-group">
                              <label for="">Foto Bupati</label>
                              @if(!empty($edit) && $edit->foto_bupati)<br>
                              <img class="img-thumbnail" src="{{asset($edit->foto_bupati)}}" alt="">
                              <input type="hidden" name="foto_bupati_old" value="{{$edit->foto_bupati}}">

                              @endif
                              <input type="file" class="form-control form-file" name="foto_bupati"  placeholder="Foto Bupati" >
                            </div>
                            <div class="form-group">
                              <label for="">Nama Bupati</label>
                              <input type="text" class="form-control" name="bupati" value="{{$edit->bupati ?? null}}" placeholder="Nama Bupati" required>
                            </div>
                            <div class="form-group">
                              <label for="">Foto Wakil</label>
                              @if(!empty($edit) && $edit->foto_wakil)<br>
                              <img class="img-thumbnail" src="{{asset($edit->foto_wakil)}}" alt="">
                              <input type="hidden" name="foto_wakil_old" value="{{$edit->foto_wakil}}">
                              @endif
                              <input type="file" class="form-control" name="foto_wakil" placeholder="Foto Wakil" >
                            </div>
                            <div class="form-group">
                              <label for="">Nama Wakil</label>
                              <input type="text" class="form-control" name="wakil" value="{{$edit->wakil ?? null}}" placeholder="Nama Wakil" required>
                            </div>
                          </div>
                          <div class="col-lg-8">


                        <div class="form-group">
                          <label for="">Nama Periode</label>
                          <input type="text" class="form-control" name="nama_periode" value="{{$edit->nama_periode ?? null}}" placeholder="Nama Periode" required>
                        </div>
                        <div class="form-group">
                          <label for="">Tahun Mulai</label>
                          <input type="text" class="form-control" name="tahun_mulai" value="{{$edit->tahun_mulai ?? null}}" placeholder="Tahun Mulai" required>
                        </div>
                        <div class="form-group">
                          <label for="">Tahun Akhir</label>
                          <input type="text" class="form-control" name="tahun_akhir" value="{{$edit->tahun_akhir ?? null}}" placeholder="Tahun Akhir" required>
                        </div>
                        <div class="form-group">
                          <label for="">Visi dan Misi</label>
                          <textarea name="visimisi" class="form-control" rows="8" cols="80" placeholder="Visi dan Misi">{{$edit->visimisi ?? null}}</textarea>
                        </div>
                        <div class="form-group">
                          <label for="">Keterangan</label>
                          <input type="text" class="form-control" name="keterangan" value="{{$edit->keterangan ?? null}}" placeholder="Keterangan" required>
                        </div>
                        <div class="form-group">
                          <label for="">Status Periode</label><br>
                          @foreach(['N','Y'] as $r)
                          <input {{!empty($edit) && $edit->aktif== $r ? 'checked':''}} type="radio" name="aktif" value="{{$r}}"> {{$r=='Y' ? 'Aktif':'Tidak Aktif'}}
                          @endforeach
                        </div>
                        </div>

                      </div>

                    </div><div class="card-footer">
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
