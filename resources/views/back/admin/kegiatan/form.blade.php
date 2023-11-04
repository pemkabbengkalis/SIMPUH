@extends('back.layouts.templating')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

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
                            <label for="">Nama Program</label>
                            <select  onchange="getval(this)"  class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" name="id_program" required>
                              <option value="">Pilih Program</option>
                              @foreach($program->get() as $row)
                               @php
                                 $indexawal = explode(' ',$row->nama_ref);
                                 if($indexawal[0]){
                                  $arraydot = explode('.',$indexawal[0]);
                                    if(count($arraydot) == 3){
                                      @endphp
                                       
                                      <option {{!empty($edit) && $row->id_program==$edit->id_program ? 'selected':''}} value="{{$indexawal[0]}}">{{$row->nama_ref}}</option>
                                

                                      @php


                                    }
                                 
                                 
                                  }
                                   
                                
                               @endphp
                              
                               @endforeach
                            </select>
                          </div>
                        <div class="form-group">
                          <label for="">Kode Kegiatan & Nama Kegiatan</label>
                          <select onchange="getsub(this)" name="kode_kegiatan" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" id="kegiatan"></select>
                        </div>

                        <div class="form-group">
                          <label for="">Kode Sub Kegiatan & Nama Sub Kegiatan</label>
                          <select  name="kode_sub_kegiatan" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" ></select>
                        </div>
                    
                        <div class="form-group">
                          <label for="">SKPD TERKAIT</label>
                          <select name="id_skpd" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                              @foreach($skpd->get() as $index => $v)
                                <option {{!empty($edit) && $v->id_skpd==$edit->id_skpd ? 'selected':''}} value="{{ $v->id_skpd }}">{{ $v->nama_skpd }}</option>
                              @endforeach
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

 @section('script')
<script>
function getval(sel)
{
    
    var id_program = sel.value;
    //alert(id_program);
    get_kegiatans(id_program);
}

function getsub(sel)
{
    
    var id_kegiatan = sel.value;
    //alert(id_kegiatan);
    get_sub_kegiatans(id_kegiatan);
}
function get_kegiatans(id_program) {
            $('[name="kode_kegiatan"]').html("");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{url('admin/kegiatan/getsubkegiatans')}}",
                type: 'POST',
                data: {
                    id_program  : id_program
                },
                success: function (response) {
                    var obj = JSON.parse(response);
                    if(obj != '') {
                        $('[name="kode_kegiatan"]').html(obj);
                        //AIZ.plugins.bootstrapSelect('refresh');
                    }
                }
            });
        }

        function get_sub_kegiatans(id_kegiatan) {
            $('[name="kode_sub_kegiatan"]').html("");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{url('admin/kegiatan/getsubsubkegiatans')}}",
                type: 'POST',
                data: {
                    id_kegiatan  : id_kegiatan
                },
                success: function (response) {
                    var obj = JSON.parse(response);
                    if(obj != '') {
                        $('[name="kode_sub_kegiatan"]').html(obj);
                        //AIZ.plugins.bootstrapSelect('refresh');
                    }
                }
            });
        }
</script>
@endsection



