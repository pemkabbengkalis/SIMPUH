@if(request('exc'))
@php
	 header("Content-type: application/vnd-ms-excel");
	 header('Content-Transfer-Encoding: Binary');
	 header("Content-Disposition: attachment; filename=Evaluasi Triwulan ".$trw." ".Str::upper(nama_skpd(request('skpd'))).".xls"); 
     @endphp
@endif
<style>
                    th,td{padding:5px;border:1px solid #000}
                    .bold{font-weight:bold}
                    tr {
        page-break-inside: avoid;
    }
                </style>
                  <center>
                    <img src="{{request()->toexcel ? public_path('logo-bks.png') : asset('logo-bks.png')}}" height="80">
                <h5>EVALUASI TERHADAP PROGRAM UNGGULAN<br>PEMERINTAH KABUPATEN BENGKALIS<br> {{Str::upper(nama_skpd(request('skpd')))}}<BR>@if($trw!='none')TRIWULAN {{$trw}} @endif TAHUN 2021-2026<br></h5>

                  </center>
               <table   style="border-color:#000;border-collapse:collapse;width:100%;font-size:10px">
                <thead>
            
                    <tr>
                        <th rowspan="3" width="15%" style="vertical-align:middle" class="text-center">Progarm Unggulan</th>
                        <th  width="15%" rowspan="3" style="vertical-align:middle" class="text-center">Program / Kegiatan / Sub Kegiatan</th>
                        <th colspan="2" rowspan="2" style="vertical-align:middle;text-align:center" >Target Kinerja <br> dan Anggaran</th>
                        <th colspan="8" class="text-center" >REALISASI</th>
                        <th rowspan="2" colspan="2" style="vertical-align:middle;text-align:center">REALISASI CAPAIAN <br>KINERJA DAN ANGGARAN <br>YANG DI EVALUASI</th>
                        <th rowspan="2" colspan='2' style="vertical-align:middle;text-align:center">Tingkat Capaian (%)</th>
                        <th rowspan="3" width="15%" style="vertical-align:middle;text-align:center">Kendala <br>Yang Dihadapi</th>
                        <th rowspan="3" width="15%" style="vertical-align:middle;text-align:center">Tindak Lanjut</th>
                    </tr>
                    
                    <tr>
                       
                        @foreach(['I','II','III','IV'] as $k=>$r)
                        <th colspan="2" class="text-center">
                            
                            TRIWULAN {{$r}} </th>
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
                        <td align="right" class="bold">{{rp($rincian->target)}}</td>
                        <td></td>
                        @foreach(['I','II','III','IV'] AS $rt)
                        <td align="right" class="bold">{{isset($rincian->$rt) ? rp($rincian->$rt) : 0}}</td>
                        <td></td>
                        @endforeach

                        <td align="right"><b>{{rp($rincian->evaluasi)}}</b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @foreach($rincian->data as $r)
                    <tr>
                        <td style="vertical-align:top" rowspan="{{count($r->kegiatan)+$r->total_sub+1}}"><b>{{Str::upper($r->nama_program_unggulan)}}</b></td>
                        <td  ><b style="word-break: break-all;">{{$r->nama_program}}</b></td>
                        <td ></td>
                        <td align="right"><b>{{rp($r->target_rp)}}</b></td>
                        @php
                        $trr = 0;
                        @endphp
                        @foreach($r->realisasi as $kr=>$rr1)
                        @php 
                        $trr++;
                        @endphp
                        <td class="text-center"></td>
                        <td align="right"><b>{{rp($rr1)}}</b></td>
                        @endforeach
                        @if($trr < 4)
                        @for($i=$trr; $i<4; $i++)
                        <td class="text-center"></td>
                        <td align="right"></td>
                        @endfor
                        @endif
                        <td></td>
                        <td align="right" class="bold">{{rp($r->evaluasi)}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach($r->kegiatan as $r2)
                    <tr>
                        <td class="pl-4"><b>{{$r2->nama_kegiatan}}</b></td>
                        <td></td>
                        <td align="right"><b>{{rp($r2->target_rp)}}</b></td>
                        @php
                        $trr = 0;
                        @endphp
                        @foreach($r2->realisasi as $rr2)
                        @php 
                        $trr++;
                        @endphp
                        <td class="text-center"></td>
                        <td align="right"><b>{{rp($rr2)}}</b></td>
                        @endforeach
                        @if($trr < 4)
                        @for($i=$trr; $i<4; $i++)
                        <td class="text-center"></td>
                        <td align="right"></td>
                        @endfor
                        @endif
                        <td></td>
                        <td align="right" class="bold">{{rp($r2->evaluasi)}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach($r2->sub_kegiatan as $r3)
                    
                    <tr>
                    <td class="pl-5">{{$r3->nama_sub_kegiatan}}</td>
                    <td>{{$r3->kuantitas}} {{$r3->satuan}}</td>
                    <td align="right">{{rp($r3->target_rp)}}</td>
                    @php
                        $trr = 0;
                        @endphp
                    @foreach($r3->realisasi as $r4)
                    @php 
                        $trr++;
                        @endphp
                    <td class="text-center" align="center">{{$r4->kuantitas}}</td>
                    <td align="right">{{$r4->pagu ? rp($r4->pagu) : '0'}}</td>
                    @endforeach
                    @if($trr < 4)
                        @for($i=$trr; $i<4; $i++)
                        <td class="text-center"></td>
                        <td align="right"></td>
                        @endfor
                        @endif
                    <td align="center">{{$r3->evaluasi_kuantitas}}</td>

                    <td align="right">{{rp($r3->evaluasi)}}</td>
                    <td align="center">{{$r3->persen_kuantitas}}</td>
                    <td align="center">{{$r3->persen_pagu}}</td>
               
                    <td>
@foreach($r3->kendala as $k=>$rj)
<span class="kendala_{{$k+1}} kendala" style="{{$k+1 == request('trw') ? '': 'display:none'}}">{{$rj}}</span>
@endforeach
                    </td>
                    <td>
                    @foreach($r3->tindakan as $k=>$rg)
<span class="tindakan_{{$k+1}} tindakan" style="{{$k+1 == request('trw') ? '': 'display:none'}}">{{$rg}}</span>
@endforeach
                    </td>
                    </tr>
                    @endforeach
                    @endforeach
                    <tr class="bg-primary">
                        <td colspan="14" align="right" class="bold">Total Rata-rata Capaian Kinerja Perprogram (%)</td>
                        <td  align="center" class="bold"> {{round($r->persen_k / $r->total_sub,2)}}</td>
                        <td align="center" class="bold">{{round($r->persen_rp / $r->total_sub)}}</td>
                        <td align="center"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="14" align="right" class="bold">Prediket Kinerja</td>
                        @php $pk[] = $r->persen_k / $r->total_sub;
                         $prp[] = $r->persen_rp / $r->total_sub; @endphp
                        <td  align="center" class="bold" {!!colorPrediket(round($r->persen_k / $r->total_sub,2))!!}>{{prediket(round($r->persen_k / $r->total_sub))}}</td>
                        <td  align="center" class="bold" {!!colorPrediket(round($r->persen_rp / $r->total_sub,2))!!}>{{prediket(round($r->persen_rp / $r->total_sub,2))}}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endforeach
                    <tr class="bg-dark">
                        <td colspan="14" align="right"><b>Total Rata-rata Capaian Kinerja {{nama_skpd(request('skpd'))}}</b></td>
                        <td  align="center" class="bold">{{isset($pk) ? round(array_sum($pk) / count($pk),2) :''}}</td>
                        <td  align="center" class="bold">{{isset($prp) ? round(array_sum($prp) / count($prp),2) :''}}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="14" align="right"><b>Prediket Kinerja</b></td>
                        <td  align="center" class="bold" {!!colorPrediket(isset($pk) ? round(array_sum($pk) / count($pk),2) :'')!!}>{{isset($pk) ?prediket(round(array_sum($pk) / count($pk),2)):''}}</td>
                        <td  align="center" class="bold" {!!colorPrediket(isset($prp) ? round(array_sum($prp) / count($prp),2) :'')!!}>{{isset($prp) ?prediket(round(array_sum($prp) / count($prp),2)):''}}</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
<br>
<br>
            <table style="width:20%;float:right" border="0">
            <tr>
                <td style="border: 0">
                    Bengkalis, {{tglindo(request('date') ?? date('Y-m-d'))}}
                    <br>
                   Kepala {{nama_skpd(request('skpd'))}}
                    <br>
                    <br>
                    <br>
                    {{nama_skpd(request('skpd'),'nama_pimpinan')}}<br>
                    NIP. {{nama_skpd(request('skpd'),'nip_pimpinan')}}

                </td>
            </tr>
            </table>