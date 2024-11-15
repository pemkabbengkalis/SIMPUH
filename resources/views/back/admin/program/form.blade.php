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
                          <label for="">Kode  Program</label>
                          <input type="text" class="form-control" name="kode_program" value="{{$edit->kode_program ?? null}}" placeholder="Kode Program" required>
                        </div>
                        @if(!empty($edit))
                        <!-- <div style="display:flex; flex-direction:row; flex-wrap:wrap; gap:2px;">
                        @for($i=0;$i < 100;$i++)
                        <button style="width:100px" type="button" class="btn btn-block btn-default btn-sm">Default</button>
                        @endfor
                        
                        </div> -->
                        <input type="hidden" name="oldref" value="{{$edit->kode_program.' '.$edit->nama_program}}">
                        @endif
                        <div class="form-group">
                          <label for="">Nama  Program</label>
                          <input type="text" class="form-control" name="nama_program" value="{{$edit->nama_program ?? null}}" placeholder="Nama Program" required>
                        </div>
                        @if(!empty($data))
                         <div class="form-group">
                          <label for="">Program Unggulan</label>
                          <select name="unggulan" class="form-control">
                            <option value="">--Pilih Program Unggulan--</option>
                            @foreach($data as $i => $v)
                            <option value="{{ $v->id_program_unggulan }}" @if(isset($edit)) @if($v->id_program_unggulan==$edit->id_program_unggulan) selected @endif @endif>{{ $v->nama_program_unggulan }}</option>
                            @endforeach
                          </select>
                        </div>
                        @endif
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
