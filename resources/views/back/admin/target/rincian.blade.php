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
                        <div class="col-md-10">
                          <h3 class="card-title mt-2"><b>{{nama_skpd(request('skpd'))}}</b><br><small>Periode {{request('periode') ? namaperiode(request('periode')) : null }} {{request('tahun') ? '/ Tahun '.request('tahun') : null }} </small></h3>
                        </div>
                        <div class="col-md-2">

                        <div class="form-group">
                           
                            <select name="periode" id="" class="form-control form-control-select" onchange="if(this.value) {location.href='{{url('admin/target-skpd?periode=')}}'+this.value;}else {location.href='{{url('admin/target-skpd')}}'}"> 
                                <option value="">--pilih periode--</option> 
                                @foreach($periode as $r)
                                <option value="{{$r->id_periode}}" {{request('periode') && request('periode')==$r->id_periode ? 'selected':''}} >{{$r->nama_periode}}</option>
                                @endforeach
                            </select></div>

                        </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="overflow:auto">
               <table class="table table-bordered table-striped" style="width:100%;font-size:small">
                <thead>
                    <tr>
                        <th>Program / Kegiatan / Sub Kegiatan</th>
                        <th>Kuantitas</th>
                        <th>Satuan</th>
                        <th>Rp</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($rincian as $r)
                    <tr>
                        <td colspan="3"><b>{{$r->nama_program}}</b></td>
                        <td align="right"><b>{{number_format($r->target_rp)}}</b></td>
                    </tr>
                    @foreach($r->kegiatan as $r2)
                    <tr>
                        <td colspan="3" class="pl-4"><b>{{$r2->nama_kegiatan}}</b></td>
                        <td align="right"><b>{{number_format($r2->target_rp)}}</b></td>
                    </tr>
                    @foreach($r2->sub_kegiatan as $r3)
                    <tr>
                        <td class="pl-5">{{$r3->nama_sub_kegiatan}}</td>
                        <td>{{$r3->kuantitas}}</td>
                        <td>{{$r3->satuan}}</td>
                        <td align="right">{{number_format($r3->target_rp)}}</td>
                    </tr>
                    @endforeach
                    @endforeach
                    @endforeach
                </tbody>
            </table>
                </div>
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
