@extends('back.layouts.templating')

@section('content')
<!-- Content Header (Page header) -->

<!-- /.content-header -->
<style>




</style>
<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-12">
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-md">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 style="font-weight: bold" class="modal-title"><i
                                        class="nav-icon fas fa-bullseye"></i> Tambah Data Target</h4>

                                <button type="button" class="btn btn-danger" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="card-body">

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div id="cetakdata" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-print"></i> Cetak Data Realisasi Program Unggulan</h4>

        <button type="button" class="btn btn-danger" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="">Pilih Tahun</label>
            <select class="form-control" name="tahun" id="thprint">
                @foreach(getTahun() as $v)
                   <option value="{{ $v }}" @if($v == (isset($_GET['periode']) ? $_GET['periode'] : date('Y'))) selected @endif>{{ $v }}</option>
                @endforeach
            </select>


        </div>
        <div class="form-group">
            <label for="">Pilih Triwulan</label>

            <select class="form-control" name="trw" id="trw">
                @foreach([1=>'I','II','III','IV'] as $k=>$r)
                <option value="{{$k}}">Triwulan {{$r}}</option>
                @endforeach
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button onclick="myPrint()" type="button" class="btn btn-primary" ><i class="fa fa-print"></i> Cetak</button>
      </div>
    </div>
    <script>
        function myPrint(){
            var tahun = document.getElementById('thprint').value;
            var idskpd = {{ Session::get('id_skpd') }};
            var trw = document.getElementById('trw').value;
            window.open('/cetak_realisasi/'+idskpd+'/'+tahun+'/'+trw,'popup','width=600,height=600'); return false;
        };

    </script>

  </div>
</div>
                <div class="card-info" style="margin-top:20px;">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 style="font-weight:bold" class="card-title mt-2"><i class="fa fa-chart-line"></i>
                                    Data
                                    Realisasi</h3>
                                    <a data-toggle="modal" data-target="#cetakdata" style="float:right;" class="btn btn-warning"><i class="fa fa-print"></i> Cetak Data</a>


                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->

                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-10">
                                    <h3 class="card-title mt-2"><b>Realisasi Kegiatan {{ (isset($_GET['periode']) ? $_GET['periode'] : date('Y')) }}</b> </h3>
                                </div>
                                <div class="col-md-2">

                                    <div class="form-group">

                                        <select name="periode" id="" class="form-control form-control-select"
                                            onchange="if(this.value) {location.href='{{ url('skpd/realisasi2') }}?periode='+this.value;}else {location.href='{{ url('skpd/realisasi2') }}'}">
                                            <option value="">--Pilih Tahun--</option>
                                            @foreach(getTahun() as $v)
                                            <option value="{{ $v }}" @if($v == (isset($_GET['periode']) ? $_GET['periode'] : date('Y'))) selected @endif>{{ $v }}</option>
                                            @endforeach
                                        </select></div>

                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="overflow:auto">
                            <table class="table-bordered table-striped table-hover"
                                style="width:100%;font-size:small">
                                <thead>
                                    <tr>
                                        <th rowspan="3">NO</th>
                                        <th rowspan="3" style="vertical-align:middle" class="text-center">Progarm
                                            Unggulan</th>
                                        <th rowspan="3" style="vertical-align:middle" class="text-center">Program /
                                            Kegiatan / Sub Kegiatan</th>
                                        <th colspan="2" rowspan="2" style="vertical-align:middle;text-align:center">
                                            Target Kinerja <br> dan Anggaran</th>
                                        <th colspan="8" class="text-center">Realisasi</th>
                                        <th rowspan="2" colspan="2" style="vertical-align:middle;text-align:center">
                                            REALISASI CAPAIAN <br>KINERJA DAN ANGGARAN <br>YANG DI EVALUASI</th>
                                        <th rowspan="2" colspan="2" style="vertical-align:middle;text-align:center">
                                            Tingkat Capaian (%)</th>
                                        <th rowspan="3" style="vertical-align:middle;text-align:center">Aksi</th>

                                    </tr>

                                    <tr>

                                        <th colspan="2" class="text-center">

                                            <br>REALISASI <br>CAPAIAN TRIWULAN I </th>
                                        <th colspan="2" class="text-center">

                                            <br>REALISASI <br>CAPAIAN TRIWULAN II </th>
                                        <th colspan="2" class="text-center">

                                            <br>REALISASI <br>CAPAIAN TRIWULAN III </th>
                                        <th colspan="2" class="text-center">

                                            <br>REALISASI <br>CAPAIAN TRIWULAN IV </th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">K</th>
                                        <th align="center" class="text-center">Rp</th>
                                        <th align="center" class="text-center">K</th>
                                        <th align="center" class="text-center">RP</th>
                                        <th align="center" class="text-center">K</th>
                                        <th align="center" class="text-center">RP</th>
                                        <th align="center" class="text-center">K</th>
                                        <th align="center" class="text-center">RP</th>
                                        <th align="center" class="text-center">K</th>
                                        <th align="center" class="text-center">RP</th>
                                        <th align="center" class="text-center">K</th>
                                        <th align="center" class="text-center">RP</th>
                                        <th align="center" class="text-center">K</th>
                                        <th align="center" class="text-center">RP</th>
                                    </tr>


                                    <tr class="bg-dark">
                                        <td align="center">1</td>
                                        <td align="center">2</td>
                                        <td align="center">3</td>
                                        <td colspan="2" align="center">4</td>
                                        <td colspan="2" align="center">5</td>
                                        <td colspan="2" align="center">6</td>
                                        <td colspan="2" align="center">7</td>
                                        <td colspan="2" align="center">8</td>
                                        <td align="center" colspan="2">7 =  6</td>
                                        <td colspan="2" align="center">8 = 7/5X100</td>
                                        <td align="center"></td>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php

                                    @endphp

                                    @foreach($data as $i => $v)
                                     @php
                                     $program = get_programfromidunggulan($v->id_program_unggulan,(isset($_GET['periode'])) ? $_GET['periode'] : date('Y'),Session::get('id_skpd'));
                                     $countprogram = count($program);
                                     $kuantitasprog = 0;
                                     $realisasiprog = 0;
                                     $noungulan = 1;

                                     @endphp
                                     @for($no=0;$no < $countprogram; $no++)
                                     <!--Program-->
                                    <tr>
                                        <td>{{ $noungulan++ }}</td>
                                        <td>{{ $v->nama_program_unggulan }}</td>
                                        <td><b>{{ $program[$no]->nama_program }}</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <!--Kegiatan-->
                                    @php
                                    $kegiatan = getDataKegiatanByIdProgram($program[$no]->id_program);
                                    $countkegiatan = count($kegiatan);
                                    $realisasikeg = 0 ;
                                    $kuantitaskeg = 0 ;
                                    @endphp
                                    @foreach($kegiatan as $ik => $vk)
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td><p style="font-weight: 600;
                                            color: black;">Kegiatan : {{ $vk->nama_kegiatan }}</p></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <!--Subkegiatan-->
                                    @php
                                        $subkegiatan = getDataSubKegiatanFromIdKegiatan($vk->id_kegiatan);
                                        $countsubkegiatan = count($subkegiatan);
                                        $sumtcpkuantitas = 0 ;
                                        $jumtcpkuantitas = 0 ;
                                        $sumcprp = 0;
                                        $jumcprp = 0;

                                    @endphp
                                    @foreach($subkegiatan as $is => $vsub)
                                    @php

                                    $vk = get_kegiatanone($program[$no]->id_program,$tahuncatch,Session('id_skpd'),$vk->id_kegiatan,$vsub->id_sub_kegiatan);
                                    $sumtcpkuantitas += $vk['tcp_kuantitas'];
                                    $jumtcpkuantitas ++;
                                    $sumcprp += $vk['tcp_pagu'];
                                    $jumcprp ++;


                                    @endphp
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td><p style="font-weight: 400;
                                            color: rgb(39, 39, 39);">Sub Kegiatan   : {{ $vsub->nama_sub_kegiatan }}</p></td>
                                        <td align="center">{{ $vk['kuantitas'].' '.$vk['satuan'] }} </td>
                                        <td align="center">{{'Rp '.number_format( $vk['pagu']) }}</td>
                                        <td>{{ $vk['tw1_kuantitas'].' '.$vk['tw1_rel_satuan'] }}</td>
                                        <td align="right" class="bold">{{ 'Rp '.number_format($vk['tw1_rel_pagu']) }}</td>
                                        <td align="center">{{ $vk['tw2_kuantitas'].' '.$vk['tw2_rel_satuan'] }}</td>
                                        <td align="right" class="bold">{{ 'Rp '.number_format($vk['tw2_rel_pagu']) }}</td>
                                        <td align="center">{{ $vk['tw3_kuantitas'].' '.$vk['tw3_rel_satuan'] }}</td>
                                        <td align="right" class="bold">{{ 'Rp '.number_format($vk['tw3_rel_pagu']) }}</td>
                                        <td align="center">{{ $vk['tw4_kuantitas'].' '.$vk['tw4_rel_satuan'] }}</td>
                                        <td align="right" class="bold">{{ 'Rp '.number_format($vk['tw4_rel_pagu']) }}</td>
                                        <td align="center">{{ $vk['totkuantitas'] }}</td>
                                        <td align="right"><b>{{ 'Rp '.number_format($vk['totpagu']) }}</b></td>
                                        <td align="center">@if(round($vk['tcp_kuantitas'],2) > 100) 100 @else {{ round($vk['tcp_kuantitas'],2) }} @endif</td>
                                        <td align="center">@if(round($vk['tcp_pagu'],2)) 100 @else {{ round($vk['tcp_pagu'],2) }} @endif</td>
                                        <td align="center"><i  data-toggle="modal" data-target="#myModal{{ $vk['id'] }}" style="color:rgb(9, 127, 140)" class="fa fa-edit"></i>
                                        </td>
                                    </tr>
                                    @include('back.skpd.realisasi.modal')
                                    @endforeach
                                    @php
                                    $kuantitaskeg += round($sumtcpkuantitas/$jumtcpkuantitas,2);
                                    $realisasikeg += round($sumcprp/$jumcprp,2);
                                    @endphp
                                    <!--endsubkegiatan-->
                                    @endforeach
                                    <tr>
                                        <td colspan="15" align="right" class="bold">Total Rata-rata Capaian Kinerja
                                            Perprogram (%)</td>
                                        <td align="center" class="bold"> @if(number_format($kuantitaskeg/$countkegiatan) > 100) 100 @else {{ number_format($kuantitaskeg/$countkegiatan) }} @endif</td>
                                        <td align="center" class="bold">
                                            @if(number_format($realisasikeg/$countkegiatan) > 100) 100 @else {{ number_format($realisasikeg/$countkegiatan) }} @endif
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="15" align="right" class="bold">Prediket Kinerja</td>
                                        <td {!! colorPrediket($kuantitaskeg/$countkegiatan) !!} align="center" class="bold"> {{ prediket($kuantitaskeg/$countkegiatan) }}</td>
                                        <td {!! colorPrediket($realisasikeg/$countkegiatan) !!}  align="center" class="bold">
                                            {{ prediket($realisasikeg/$countkegiatan) }}
                                        </td>
                                        <td></td>
                                    </tr>
                                    @php
                                    $kuantitasprog += round($kuantitaskeg/$countkegiatan,2);
                                    $realisasiprog += round($realisasikeg/$countkegiatan,2);
                                    @endphp
                                    @endfor
                                    <tr>
                                        <td colspan="15" align="right" class="bold">Total Rata-rata Capaian Kinerja
                                            Perprogram (%)</td>
                                        <td align="center" class="bold"> @if(number_format($kuantitasprog/$countprogram) > 100) 100 @else {{ number_format($kuantitasprog/$countprogram) }} @endif</td>
                                        <td align="center" class="bold">
                                           @if(number_format($realisasiprog/$countprogram) > 100) 100  @else  {{ number_format($realisasiprog/$countprogram) }}  @endif
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="15" align="right" class="bold">Prediket Kinerja</td>
                                        <td {!! colorPrediket($kuantitasprog/$countprogram) !!} align="center" class="bold"> {{ prediket($kuantitasprog/$countprogram) }}</td>
                                        <td {!! colorPrediket($realisasiprog/$countprogram) !!}  align="center" class="bold">
                                            {{ prediket($realisasiprog/$countprogram) }}
                                        </td>
                                        <td></td>
                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
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
