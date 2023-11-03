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
                          <h3 class="card-title mt-2">Realisasi </h3>
                        </div>
                        <div class="col-md-2">

                        <div class="form-group">
                           
                            <select name="periode" id="" class="form-control form-control-select" onchange="if(this.value) {location.href='{{url('kaban/realisasi-skpd?periode=')}}'+this.value;}else {location.href='{{url('kaban/realisasi-skpd')}}'}"> 
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
               <center>--silahkan pilih periode--ss</center>
               @else 
               @if($skpd)

               <a href="#" onclick="if($('#trw:checked').val()) {location.href='{{url('cetak_realisasi_all/'.request('tahun'))}}/'+$('#trw:checked').val()}else{alert('pilih triwulan')}" class="btn btn-primary btn-md w-40"> <i class="fa fa-print"></i> Cetak Kabupaten</a>  
               @endif

               <table id="table" class="table table-bordered table-striped" style="width:100%;">
               @if(!$skpd)
                <thead>
                    <tr>
                        <th style="width:20px">No</th>
                        <th>Tahun</th>
                        <th>Total Pagu (Rp)</th>
                        <th>Realisasi</th>          
                        <th style="width:100px">Aksi</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $k=> $r)
                    <tr>
                    <td>{{$k+1}}</td>
                        <td>{{$r->tahun}}</td>
                        <td align="right">{!!$r->pagu ? number_format($r->pagu) : '<small>Belum Ditetapkan</small>'!!}</td>
                        <td align="right">{!!$r->realisasi ? number_format($r->realisasi) : '<small>Belum Ditetapkan</small>'!!}</td>
                        <td>  <center>
                         
                      <a href=" {{url('kaban/realisasi-skpd?periode='.request('periode').'&tahun='.$r->tahun)}} " class="btn btn-warning btn-xs text-white"><i class="fas fa-bars"></i></a>
                          </center></td>
                    </tr>
                    @endforeach
                </tbody>
                @else
            
                <thead>
                    <tr>
                        <th style="width:20px;vertical-align:middle">No</th>
                        <th style="vertical-align:middle">Nama SKPD</th>
                        <th style="vertical-align:middle">Tahun</th>
                        <th style="vertical-align:middle">Total Pagu (Rp)</th>
                        <th style="vertical-align:middle">Total Realisasi (Rp)</th>
                        @foreach(['I','II','III','IV'] as $k=>$tw)
                        <th style="text-align:center;cursor:pointer">
                        <input type="radio" id="trw" name="tw" value="{{$k+1}}"><br>TW {{$tw}} </th>
                        @endforeach
                        <th  style="vertical-align:middle;width:180px">Aksi</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($skpd as $k=> $r)
                    <tr>
                        <td>{{$k+1}}</td>
                        <td>{{$r->nama_skpd}}</td>
                        <td>{{request('tahun')}}</td>
                        <td align="right">{{number_format($r->pagu)}}</td>
                        <td align="right">{{number_format($r->realisasi)}}</td>
                        @foreach(cek_tw(request('tahun'),$r->id_skpd) as $tw)
                        <td style="text-align:center;"> 
                        <i class="fa {{$tw->status=='sudah' ? 'fa-check text-success' : 'fa-times text-danger'}}"></i> 
                      </td>
                        @endforeach
                        <td>  <center>
                  <a href="#" onclick="if($('#trw:checked').val()) { location.href='{{url('cetak_realisasi/'.$r->id_skpd.'/'.request('tahun'))}}/'+$('#trw:checked').val()}else{alert('pilih triwulan')}" class="btn btn-primary btn-xs w-40"> <i class="fa fa-print"></i> Cetak</a>
                             <a href=" {{url('admin/realisasi-skpd?periode='.request('periode').'&tahun='.request('tahun').'&skpd='.$r->id_skpd)}} " class="btn btn-warning btn-xs text-white w-40"><i class="fas fa-eye"></i> Lihat Detail</a>
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
