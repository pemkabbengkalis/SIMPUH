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
                          <h3 class="card-title mt-2"><b>{{nama_skpd(request('skpd'))}}</b> </h3>
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
                <style>
                    td{padding:5px}
                    .bold{font-weight:bold}
                </style>
               <table class="table-bordered table-striped table-hover" style="width:2500px;font-size:small">
                <thead>
                    <tr>
                        <th rowspan="3" style="vertical-align:middle" class="text-center">Progarm Unggulan</th>
                        <th rowspan="3" style="vertical-align:middle" class="text-center">Program / Kegiatan / Sub Kegiatan</th>
                        <th colspan="2" rowspan="2" style="vertical-align:middle;text-align:center" >Target Kinerja <br> dan Anggaran</th>
                        <th colspan="8" class="text-center" >Realisasi</th>
                        <th rowspan="2" colspan="2" style="vertical-align:middle;text-align:center">REALISASI CAPAIAN <br>KINERJA DAN ANGGARAN <br>YANG DI EVALUASI</th>
                        <th rowspan="2" colspan='2' style="vertical-align:middle;text-align:center">Tingkat Capaian (%)</th>
                        <th rowspan="3" style="vertical-align:middle;text-align:center">Kendala <br>Yang Dihadapi</th>
                        <th rowspan="3" style="vertical-align:middle;text-align:center">Tindak Lanjut</th>
                    </tr>
                    
                    <tr>
                       
                        @foreach(['I','II','III','IV'] as $k=>$r)
                        <th colspan="2" class="text-center">
                            <input style="cursor:pointer" type="radio" name="triwulan" onchange="$('.tindakan').hide();$('.tindakan_{{$k+1}}').show();$('.kendala').hide();$('.kendala_{{$k+1}}').show();" value="{{$r}}">
                            <br>REALISASI <br>CAPAIAN TRIWULAN {{$r}} </th>
                        @endforeach
                    </tr>
                    <tr>
                    <th class="text-center">K</th>
                        <th align="center" class="text-center">Rp</th>
                        @for($a=1; $a<=4; $a++)
                        <th align="center" class="text-center">K</th>
                        <th align="center" class="text-center">RP</th>
                        @endfor
                        <th align="center" class="text-center">K</th>
                        <th align="center" class="text-center">RP</th>
                        <th align="center" class="text-center">K</th>
                        <th align="center" class="text-center">RP</th>
                    </tr>
                </thead>
                <tbody>
                <tr class="bg-dark">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td align="right" class="bold">{{number_format($rincian->target)}}</td>
                        <td></td>
                        <td align="right" class="bold">{{number_format($rincian->I)}}</td>
                        <td></td>
                        <td align="right" class="bold">{{number_format($rincian->II)}}</td>
                        <td></td>
                        <td align="right" class="bold">{{number_format($rincian->III)}}</td>
                        <td></td>
                        <td align="right" class="bold">{{number_format($rincian->IV)}}</td>
                        <td></td>
                        <td align="right"><b>{{number_format($rincian->evaluasi)}}</b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @foreach($rincian->data as $r)
                    <tr>
                        <td style="vertical-align:top" rowspan="{{count($r->kegiatan)+$r->total_sub+1}}"><b>{{Str::upper($r->nama_program_unggulan)}}</b></td>
                        <td ><b>{{$r->nama_program}}</b></td>
                        <td ></td>
                        <td align="right"><b>{{number_format($r->target_rp)}}</b></td>
                        @foreach($r->realisasi as $rr1)
                        <td class="text-center"></td>
                        <td align="right"><b>{{number_format($rr1)}}</b></td>
                        @endforeach
                        <td></td>
                        <td align="right" class="bold">{{number_format($r->evaluasi)}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach($r->kegiatan as $r2)
                    <tr>
                        <td class="pl-4"><b>{{$r2->nama_kegiatan}}</b></td>
                        <td></td>
                        <td align="right"><b>{{number_format($r2->target_rp)}}</b></td>
                        @foreach($r2->realisasi as $rr2)
                        <td class="text-center"></td>
                        <td align="right"><b>{{number_format($rr2)}}</b></td>
                        @endforeach
                        <td></td>
                        <td align="right" class="bold">{{number_format($r2->evaluasi)}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach($r2->sub_kegiatan as $r3)
                    <tr>
                    <td class="pl-5">{{$r3->nama_sub_kegiatan}}</td>
                    <td>{{$r3->kuantitas}} {{$r3->satuan}}</td>
                    <td align="right">{{number_format($r3->target_rp)}}</td>
                    @foreach($r3->realisasi as $r4)
                    <td class="text-center">{{$r4->kuantitas}}</td>
                    <td align="right">{{$r4->pagu ? number_format($r4->pagu) : '0'}}</td>
                    @endforeach
                    <td align="center">{{$r3->evaluasi_kuantitas}}</td>

                    <td align="right">{{number_format($r3->evaluasi)}}</td>
                    <td align="center">{{$r3->persen_kuantitas}}</td>
                    <td align="center">{{$r3->persen_pagu}}</td>
                    <td>
@foreach($r3->kendala as $k=>$rj)
<span class="kendala_{{$k+1}} kendala" style="display:none">{{$rj}}</span>
@endforeach
                    </td>
                    <td>
                    @foreach($r3->tindakan as $k=>$rg)
<span class="tindakan_{{$k+1}} tindakan" style="display:none">{{$rg}}</span>
@endforeach
                    </td>
                    </tr>
                    @endforeach
                    @endforeach
                    <tr class="bg-primary">
                        <td colspan="14" align="right" class="bold">Total Rata-rata Capaian Kinerja Perprogram (%)</td>
                        <td  align="center" class="bold"> {{round($r->persen_k / $r->total_sub)}}</td>
                        <td align="center" class="bold">{{round($r->persen_rp / $r->total_sub)}}</td>
                        <td align="center"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="14" align="right" class="bold">Prediket Kinerja</td>
                        @php $pk[] = round($r->persen_k / $r->total_sub);
                         $prp[] = round($r->persen_rp / $r->total_sub); @endphp
                        <td  align="center" class="bold">{{prediket(round($r->persen_k / $r->total_sub))}}</td>
                        <td  align="center" class="bold">{{prediket(round($r->persen_rp / $r->total_sub))}}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endforeach
                    <tr class="bg-dark">
                        <td colspan="14" align="right">T<b>otal Rata-rata Capaian Kinerja {{nama_skpd(request('skpd'))}}</b></td>
                        <td  align="center" class="bold">{{round(array_sum($pk) / count($pk))}}</td>
                        <td  align="center" class="bold">{{round(array_sum($prp) / count($prp))}}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="14" align="right"><b>Prediket Kinerja</b></td>
                        <td  align="center" class="bold">{{prediket(round(array_sum($pk) / count($pk)))}}</td>
                        <td  align="center" class="bold">{{prediket(round(array_sum($prp) / count($prp)))}}</td>
                        <td></td>
                        <td></td>
                    </tr>
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
