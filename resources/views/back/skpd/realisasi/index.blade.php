@extends('back.layouts.templating')

@section('content')
<!-- Content Header (Page header) -->

<!-- /.content-header -->

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
            window.open('https://simpuh.bengkaliskab.go.id/cetak_realisasi/'+idskpd+'/'+tahun+'/'+trw,'popup','width=600,height=600'); return false;
        };
        
    </script>

  </div>
</div>
                <div class="card card-info" style="margin-top:20px;">
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
                                            onchange="if(this.value) {location.href='https://simpuh.bengkaliskab.go.id/skpd/realisasi?periode='+this.value;}else {location.href='https://simpuh.bengkaliskab.go.id/skpd/realisasi'}">
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
                            
                            <table>
                                <thead>
                                    <tr>
                                        <th rowspan="3">NOs</th>
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
                                </thead>
                                <tbody>
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
                                    
                                    @foreach($data as $i => $v )

                                    <?php
                                       $sumcprp       =  0;
                                       $sumtcpkuantitas=  0;
                                       $jumtcpkuantitas=  0;
                                       $jumcprp       =  0;
                                       $coldata       =  get_programfromidunggulan($v->id_program_unggulan,(isset($_GET['periode'])) ? $_GET['periode'] : date('Y'),Session::get('id_skpd')); 
                                       $countkegiatan =  count_kegiatan($v->id_program_unggulan,(isset($_GET['periode'])) ? $_GET['periode'] : date('Y'),Session::get('id_skpd')); 
                                    ?>
                                     
                                    <tr>
                                        <td rowspan="{{ $countkegiatan }}">{{ $i+1 }}</td>
                                        <td  style="padding-left:50px;font-weight:bold" rowspan="{{ $countkegiatan }}">{{ $v->nama_program_unggulan }}</td>

                                        @foreach($coldata as $ic => $cv)
                                          <?php $kegiatan = get_kegiatan($cv->id_program,(isset($_GET['periode'])) ? $_GET['periode'] : date('Y'),Session::get('id_skpd')); ?>
                                         @if($ic==0)
                                           
                                            <td><b>{{ $cv->nama_program }}</b>
                                            @foreach($kegiatan as $ik => $vk)
                                            
                                            <?php
                                            $sumcprp += $vk['tcp_pagu']; 
                                            $jumcprp ++;
                                            $sumtcpkuantitas += $vk['tcp_kuantitas'];
                                            $jumtcpkuantitas ++;
                                            
                                            ?>
                                            @if($ik==0)
                                            <br>
                                            <b>Kegiatan : {{ $vk['nama_kegiatan'] }} </b>
                                            <br>Sub Kegiatan : {{ $vk['nama_sub_kegiatan'] }}
                                            </td>
                                              
                                                <td align="center">{{ $vk['kuantitas'].' '.$vk['satuan'] }} </td>
                                                <td align="right" class="bold">{{'Rp '.number_format( $vk['pagu']) }}</td>
                                                <td>{{ $vk['tw1_kuantitas'].' '.$vk['tw1_rel_satuan'] }}</td>
                                                <td align="right" class="bold">{{ 'Rp '.number_format($vk['tw1_rel_pagu']) }}</td>
                                                <td>{{ $vk['tw2_kuantitas'].' '.$vk['tw2_rel_satuan'] }}</td>
                                                <td align="right" class="bold">{{ 'Rp '.number_format($vk['tw2_rel_pagu']) }}</td>
                                                <td>{{ $vk['tw3_kuantitas'].' '.$vk['tw3_rel_satuan'] }}</td>
                                                <td align="right" class="bold">{{ 'Rp '.number_format($vk['tw3_rel_pagu']) }}</td>
                                                <td>{{ $vk['tw4_kuantitas'].' '.$vk['tw4_rel_satuan'] }}</td>
                                                <td align="right" class="bold">{{ 'Rp '.number_format($vk['tw4_rel_pagu']) }}</td>
                                                <td>{{ $vk['totkuantitas'] }}</td>
                                                <td align="right"><b>{{ 'Rp '.number_format($vk['totpagu']) }}</b></td>
                                                <td>{{ round($vk['tcp_kuantitas'],2) }}</td>
                                                <td>{{ round($vk['tcp_pagu'],2) }}</td>
                                                <td>
                                                    
                                                    <i  data-toggle="modal" data-target="#myModal{{ $vk['id'] }}" style="color:rgb(9, 127, 140)" class="fa fa-edit"></i>
                                                    <!--<i style="color:rgb(140, 9, 31)" class="fa fa-trash"></i>-->
                                                </td>
                        
                                    </tr>
                                    @include('back.skpd.realisasi.modal')
                                            @else
                                            <tr>
                                                <td>
                                                    <br>
                                            <b>Kegiatan  : {{ $vk['nama_kegiatan'] }}</b>
                                            <br>Sub Kegiatan : {{ $vk['nama_sub_kegiatan'] }}</td>
                                                <td align="center">{{ $vk['kuantitas'].' '.$vk['satuan'] }} </td>
                                                <td align="right" class="bold">{{'Rp '.number_format( $vk['pagu']) }}</td>
                                                <td>{{ $vk['tw1_kuantitas'].' '.$vk['tw1_rel_satuan'] }}</td>
                                                <td align="right" class="bold">{{ 'Rp '.number_format($vk['tw1_rel_pagu']) }}</td>
                                                <td>{{ $vk['tw2_kuantitas'].' '.$vk['tw2_rel_satuan'] }}</td>
                                                <td align="right" class="bold">{{ 'Rp '.number_format($vk['tw2_rel_pagu']) }}</td>
                                                <td>{{ $vk['tw3_kuantitas'].' '.$vk['tw3_rel_satuan'] }}</td>
                                                <td align="right" class="bold">{{ 'Rp '.number_format($vk['tw3_rel_pagu']) }}</td>
                                                <td>{{ $vk['tw4_kuantitas'].' '.$vk['tw4_rel_satuan'] }}</td>
                                                <td align="right" class="bold">{{ 'Rp '.number_format($vk['tw4_rel_pagu']) }}</td>
                                                <td>{{ $vk['totkuantitas'] }}</td>
                                                <td align="right"><b>{{ 'Rp '.number_format($vk['totpagu']) }}</b></td>
                                                <td>{{ round($vk['tcp_kuantitas'],2) }}</td>
                                                <td>{{ round($vk['tcp_pagu'],2) }}</td>
                                                <td>
                                                    
                                                    <i  data-toggle="modal" data-target="#myModal{{ $vk['id'] }}" style="color:rgb(9, 127, 140)" class="fa fa-edit"></i>
                                                    <!--<i style="color:rgb(140, 9, 31)" class="fa fa-trash"></i>-->
                                                </td>
                                            </tr>
                                             @include('back.skpd.realisasi.modal')
                                            @endif
                                            @endforeach

                                            

                                    @else
                                    <tr>
                                        <td><b>{{ $cv->nama_program }}</b>
                                        @foreach($kegiatan as $ik => $vk)
                                         <?php
                                            $sumcprp += $vk['tcp_pagu']; 
                                            $jumcprp ++;
                                            $sumtcpkuantitas += $vk['tcp_kuantitas'];
                                            $jumtcpkuantitas ++;
                                            
                                            ?>
                                            @if($ik==0)
                                           <br>
                                            <b>Kegiatans: {{ $vk['nama_kegiatan'] }}</b>
                                            <br>Sub Kegiatan : {{ $vk['nama_sub_kegiatan'] }}
                                        </td>
                                       <td align="center">{{ $vk['kuantitas'].' '.$vk['satuan'] }} </td>
                                                <td align="right" class="bold">{{'Rp '.number_format( $vk['pagu']) }}</td>
                                                <td>{{ $vk['tw1_kuantitas'].' '.$vk['tw1_rel_satuan'] }}</td>
                                                <td align="right" class="bold">{{ 'Rp '.number_format($vk['tw1_rel_pagu']) }}</td>
                                                <td>{{ $vk['tw2_kuantitas'].' '.$vk['tw2_rel_satuan'] }}</td>
                                                <td align="right" class="bold">{{ 'Rp '.number_format($vk['tw2_rel_pagu']) }}</td>
                                                <td>{{ $vk['tw3_kuantitas'].' '.$vk['tw3_rel_satuan'] }}</td>
                                                <td align="right" class="bold">{{ 'Rp '.number_format($vk['tw3_rel_pagu']) }}</td>
                                                <td>{{ $vk['tw4_kuantitas'].' '.$vk['tw4_rel_satuan'] }}</td>
                                                <td align="right" class="bold">{{ 'Rp '.number_format($vk['tw4_rel_pagu']) }}</td>
                                                <td>{{ $vk['totkuantitas'] }}</td>
                                                <td align="right"><b>{{ 'Rp '.number_format($vk['totpagu']) }}</b></td>
                                                <td>{{ round($vk['tcp_kuantitas'],2) }}</td>
                                                <td>{{ round($vk['tcp_pagu'],2) }}</td>
                                                <td>
                                                    
                                                    <i  data-toggle="modal" data-target="#myModal{{ $vk['id'] }}" style="color:rgb(9, 127, 140)" class="fa fa-edit"></i>
                                                    <!--<i style="color:rgb(140, 9, 31)" class="fa fa-trash"></i>-->
                                                </td>
                        
                                    </tr>
                                    @include('back.skpd.realisasi.modal')

                                        @else
                                            <tr>
                                                <td><br>
                                            <b>Kegiatan : {{ $vk['nama_kegiatan'] }}</b>
                                            <br>Sub Kegiatan : {{ $vk['nama_sub_kegiatan'] }}</td>
                                                <td align="center">{{ $vk['kuantitas'].' '.$vk['satuan'] }} </td>
                                                <td align="right" class="bold">{{'Rp '.number_format( $vk['pagu']) }}</td>
                                                <td>{{ $vk['tw1_kuantitas'].' '.$vk['tw1_rel_satuan'] }}</td>
                                                <td align="right" class="bold">{{ 'Rp '.number_format($vk['tw1_rel_pagu']) }}</td>
                                                <td>{{ $vk['tw2_kuantitas'].' '.$vk['tw2_rel_satuan'] }}</td>
                                                <td align="right" class="bold">{{ 'Rp '.number_format($vk['tw2_rel_pagu']) }}</td>
                                                <td>{{ $vk['tw3_kuantitas'].' '.$vk['tw3_rel_satuan'] }}</td>
                                                <td align="right" class="bold">{{ 'Rp '.number_format($vk['tw3_rel_pagu']) }}</td>
                                                <td>{{ $vk['tw4_kuantitas'].' '.$vk['tw4_rel_satuan'] }}</td>
                                                <td align="right" class="bold">{{ 'Rp '.number_format($vk['tw4_rel_pagu']) }}</td>
                                                <td>{{ $vk['totkuantitas'] }}</td>
                                                <td align="right"><b>{{ 'Rp '.number_format($vk['totpagu']) }}</b></td>
                                                <td>{{ round($vk['tcp_kuantitas'],2) }}</td>
                                                <td>{{ round($vk['tcp_pagu'],2) }}</td>
                                                <td>
                                                    
                                                    <i  data-toggle="modal" data-target="#myModal{{ $vk['id'] }}" style="color:rgb(9, 127, 140)" class="fa fa-edit"></i>
                                                    <!--<i style="color:rgb(140, 9, 31)" class="fa fa-trash"></i>-->
                                                </td>
                                            </tr>
                                            @include('back.skpd.realisasi.modal')
                                            @endif
                                            @endforeach
                                    @endif



                                    @endforeach
                                    
                                         
                                    
                                    
                             
       
                                        <td colspan="15" align="right" class="bold">Total Rata-rata Capaian Kinerja
                                            Perprogram (%)</td>
                                        <td align="center" class="bold"> {{ round($sumtcpkuantitas/$jumtcpkuantitas,2) }}</td>
                                        <td align="center" class="bold">{{ round($sumcprp/$jumcprp,2) }} 
                                        
                                        </td>
                                        <td></td>
                                        
                                        
                                        
                                    </tr>
                                    <tr>
                                        <td colspan="15" align="right" class="bold">Prediket Kinerja</td>
                                        <td {!! colorPrediket(number_format($sumtcpkuantitas/$jumtcpkuantitas,2)) !!} align="center" class="bold">{{  prediket(number_format($sumtcpkuantitas/$jumtcpkuantitas,2)) }}</td>
                                        <td {!! colorPrediket(number_format($sumcprp/$jumcprp,2)) !!}align="center" class="bold">{{ prediket(number_format($sumcprp/$jumcprp,2))}}</td>
                                        <td></td>
                                        
                                        <?php 
                                            $sumcprp = 0;
                                            $jumcprp = 0;
                                            $sumtcpkuantitas = 0;
                                            $jumtcpkuantitas = 0;
                                        ?>
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