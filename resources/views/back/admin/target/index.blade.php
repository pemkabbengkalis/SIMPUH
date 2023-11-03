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
                          <h3 class="card-title mt-2">Periode {{request('periode') ? namaperiode(request('periode')) : null }} {{request('tahun') ? '/ Tahun '.request('tahun') : null }} </h3>
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
                <div class="card-body">
               @if(!$data)
               <center>--silahkan pilih periode--</center>
               @else 
               <table id="table" class="table table-bordered table-striped" style="width:100%;font-size:small">
               @if(!$skpd)
                <thead>
                    <tr>
                        <th style="width:20px">No</th>
                        <th>Tahun</th>
                        <th>Total Pagu (Rp)</th>
                        <th style="width:100px">Aksi</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $k=> $r)
                    <tr>
                    <td>{{$k+1}}</td>
                        <td>{{$r->tahun}}</td>
                        <td align="right">{!!$r->pagu ? number_format($r->pagu) : '<small>Belum Ditetapkan</small>'!!}</td>
                        <td>  <center>
                            <a href=" {{url('admin/target-skpd?periode='.request('periode').'&tahun='.$r->tahun)}} " class="btn btn-warning btn-xs text-white"><i class="fas fa-eye"></i></a>
                          </center></td>
                    </tr>
                    @endforeach
                </tbody>
                @else
                <thead>
                    <tr>
                        <th style="width:20px">No</th>
                        <th>Nama SKPD</th>
                        <th>Tahun</th>
                        <th>Total Pagu (Rp)</th>
                        <th >Aksi</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($skpd as $k=> $r)
                    <tr>
                        <td>{{$k+1}}</td>
                        <td>{{$r->nama_skpd}}</td>
                        <td>{{request('tahun')}}</td>
                        <td align="right">{{number_format($r->pagu)}}</td>
                        <td>  <center>
                            <a href=" {{url('admin/target-skpd?periode='.request('periode').'&tahun='.request('tahun').'&skpd='.$r->id_skpd)}} " class="btn btn-warning btn-xs text-white w-100"><i class="fas fa-eye"></i> Lihat Detail</a>
                          </center></td>
                    </tr>
                    @endforeach
                </tbody>
                @endif
               </table>
               @endif
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
