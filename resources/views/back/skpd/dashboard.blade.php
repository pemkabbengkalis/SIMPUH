@extends('back.layouts.templating')

@section('content')
    <!-- Content Header (Page header) -->
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
                <h4><b>{{ $jmlhPrgUngg }}</b></h4>

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
                <h4><b>{{ $targetSKPD }}</b></h4>

                <p>Target Perangkat Daerah </p>
              </div>
              <div class="icon">
                <i class="fas fa-bullseye" aria-hidden="true"></i>
              </div>
              </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h4><b>Rp. {{ number_format($jmlahRealisasiSKPD) }}</b></h4>

                <p>Realisasi Perangkat Daerah</p>
              </div>
              <div class="icon">
              <i class="fas fa-chart-line" aria-hidden="true"></i>
              </div>
              </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h4><b>{{ $jmlahKegiatanSKPD }}</b></h4>

                <p>Kegiatan</p>
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
                      <h5 class="card-title">Progress Realisasi Program Unggulan Kabupaten Bengkalis</h5>
                      <div class="card-tools">
                          <div class="btn-group">
                            <form action="{{ url('skpd/dashboard') }}">
                              <ul class="nav nav-pills ml-auto">
                                  <li class="nav-item">
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
                  <div class="card-body">
                      <div class="row">
                          <div class="col-md-12">
                            <div class="table-responsive-sm">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="table-primary">
                                            <th style="width:20px;">No</th>
                                            <th scope="col">Perangkat Daerah</th>
                                            <th style="width:20px;">Realisasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($persentase as $row)
                                            @if (($row->id_skpd == Session::get('id_skpd')))
                                                <tr>
                                                    <th style="font-weight: normal;" scope="row">1</th>
                                                    <td>{{ $row->nama_skpd }}</td>
                                                    <td class="text-center">{{ round(($row->total_realisasi_pagu/$row->pagu)*100) }}%</td>
                                                </tr>  
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      </div>
    <!-- /.content -->
    
@endsection
