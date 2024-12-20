<style>
                    th,td{padding:5px;border:1px solid #000}
                    .bold{font-weight:bold}
                </style>
                <center>
                    <h5>PROGRAM UNGGULAN DAERAH KABUPATEN BENGKALIS TRIWULAN {{$trw}} TAHUN 2021-2026<br>{{Str::upper(nama_skpd(request('skpd')))}}																	
</h5>
                </center>
               <table class="table-bordered table-striped table-hover" border="1" style="border-color:#000;border-collapse:collapse;width:100%;font-size:10px">
                <thead>
                    <tr>
                        <th rowspan="3" style="vertical-align:middle" class="text-center">Progarm Unggulan</th>
                        <th rowspan="3" style="vertical-align:middle" class="text-center">Program / Kegiatan / Sub Kegiatan</th>
                        <th colspan="2" rowspan="2" style="vertical-align:middle;text-align:center" >Target Kinerja <br> dan Anggaran</th>
                        <th colspan="8" class="text-center" >REALISASI</th>
                        <th rowspan="2" colspan="2" style="vertical-align:middle;text-align:center">REALISASI CAPAIAN <br>KINERJA DAN ANGGARAN <br>YANG DI EVALUASI</th>
                        <th rowspan="2" colspan='2' style="vertical-align:middle;text-align:center">Tingkat Capaian (%)</th>
                        <th rowspan="3" style="vertical-align:middle;text-align:center">Kendala <br>Yang Dihadapi</th>
                        <th rowspan="3" style="vertical-align:middle;text-align:center">Tindak Lanjut</th>
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