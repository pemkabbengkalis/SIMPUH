@extends('back.layouts.templating')

@section('content')
    <!-- Content Header (Page header) -->
    <style>
        .highcharts-figure, .highcharts-data-table table {
    min-width: 310px;
    max-width: 100%;
    margin: 1em auto;
}
        </style>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1 class="m-0">SIMPUH <small>Sistem Informasi Monitoring Program Unggulan Daerah</small></h1>
                </div><!-- /.col -->
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h4><b>{{ $jmlhPrgUngg ?? '7' }}</b></h4>

                        <p>Program Unggulan </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bookmark" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h4><b>{{ $semuaTargetSKPD }}</b></h4>

                        <p>Kegiatan Perangkat Daerah</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-exchange-alt" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box" style="background-color: #e376fa!important;color:white;">
                    <div class="inner">
                        <h4><b>Rp. {{ number_format($TargetSKPD) }}</b></h4>

                        <p>Target Anggaran</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-bullseye" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h4><b>Rp. {{ number_format($semuaRealisasiSKPD) }}</b></h4>

                        <p>Realisasi Anggaran</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-tasks" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Progres Realisasi Program Unggulan Kabupaten Bengkalis</h5>

                        <div class="card-tools">

                                <div class="btn-group">

                                    <form action="{{ url('admin/dashboard') }}">
                                        <ul class="nav nav-pills ml-auto">
                                            <li class="nav-item">
                                                <select name="filter" class="form-control">
                                                    <option value="">-- Filter Berdasarkan --</option>
                                                    <option value="SKPD" @if(isset($_GET['filter'])) @if($_GET['filter']=='SKPD') selected @endif @endif>PERANGKAT DAERAH</option>
                                                    <option value="KEGIATAN UNGGULAN" @if(isset($_GET['filter'])) @if($_GET['filter']=='KEGIATAN UNGGULAN') selected @endif @endif>PROGRAM UNGGULAN</option>
                                                    <option value="GRAFIK" @if(isset($_GET['filter'])) @if($_GET['filter']=='GRAFIK') selected @endif @endif>GRAFIK</option>
                                                </select>
                                            </li>
                                            <li class="nav-item" style="margin-left:10px">
                                                <select name="tahun" id="" class="form-control form-control-select">
                                                    @foreach ($tahun as $row)
                                                        <option value="{{ $row->tahun }}" @if($periode == $row->tahun) selected @endif>{{ $row->tahun }}</option>
                                                    @endforeach
                                                </select>
                                            </li>
                                            <li class="nav-item">
                                                <button class="btn btn-primary ml-2" type="submit">Submit</button>
                                            </li>
                                        </ul>
                                    </form>
                                </div>


                        </div>
                    </div>
                    @if(isset($_GET['filter']))
                      @if($_GET['filter']=='KEGIATAN UNGGULAN')
                         <div class="card-body">
                            <table id="table" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th rowspan="2" style="vertical-align: middle">NO</th>
                                        <th rowspan="2" style="vertical-align: middle">PROGRAM UNGGULAN</th>
                                        <th width="250" rowspan="2" style="vertical-align: middle">TARGET</th>
                                        <th width="250" rowspan="2" style="vertical-align: middle">REALISASI</th>
                                        <th width="250" colspan="2">TINGKAT CAPAIAN</th>
                                    </tr>
                                    <tr>
                                        <th>
                                           <center> % </center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($program as $i => $v)
                                    <tr>
                                        <td >{{$i+1}}</td>
                                        <td>{{$v->nama_program_unggulan}}</td>
                                        <td>{{gettarget($v->id_program_unggulan,$th)}}</td>
                                        <td>{{getrealisasi($v->id_program_unggulan,$th)}}</td>
                                        <td>
                                           <center> @php
                                                $target = (float) floatval(preg_replace("/[^0-9.]/", "", gettarget($v->id_program_unggulan,$th)));
                                                $realisasi = (float) floatval(preg_replace("/[^0-9.]/", "", getrealisasi($v->id_program_unggulan,$th)));
                                                if($target != 0){
                                                    echo floor(($realisasi/$target) * 100);
                                                }else{
                                                    echo floatval(gettarget($v->id_program_unggulan,$th));
                                                }


                                            @endphp
                                            % </center>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                         </div>
                      @elseif($_GET['filter']=='GRAFIK')

                      <div class="card-body">


                        <figure class="highcharts-figure">
                            <div id="chart"></div>

                        </figure>

                     </div>


                     <div class="card-body">


                        <figure class="highcharts-figure">
                            <div id="chartunggulan"></div>

                        </figure>

                     </div>

                     <div class="card-body">


                        <figure class="highcharts-figure">
                            <div id="skpdchart"></div>

                        </figure>

                     </div>

                      @else
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="table-responsive-sm">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr style="background-color: #3498db;color:white;">
                                                    <th style="width:20px;">No</th>
                                                    <th style="text-align:center" scope="col">Perangkat Daerah</th>
                                                    <th style="width:20px;">Realisasi Kinerja (%) </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $capek = 1;
                                            @endphp
                                            @foreach ($anggaranpersen as $row)

                                                    <tr>
                                                        <th style="font-weight:normal;text-align:center" scope="row">{{ $capek++ }}</th>
                                                        <td>{{ $row['nama_skpd'] }}</td>
                                                        <td class="text-center">{{ number_format($row['persenkinerja'], 1) . '' }}</td>
                                                    </tr>

                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="table-responsive-sm">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr style="background-color: #f80909;color:white">
                                                    <th style="width:20px;">No</th>
                                                    <th style="text-align:center" scope="col">Perangkat Daerah</th>
                                                    <th style="width:20px;">Realisasi Anggaran (%)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $capek = 1;
                                                @endphp
                                                @foreach ($anggaranpersen as $row)

                                                        <tr>
                                                            <th style="font-weight:normal;text-align:center" scope="row">{{ $capek++ }}</th>
                                                            <td>{{ $row['nama_skpd'] }}</td>
                                                            <td class="text-center" >{{  number_format($row['anggaran'], 1) . ''  }}</td>
                                                        </tr>

                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                      @endif
                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection


