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
                        <div class="col-md-12">
                          <h3 class="card-title mt-2">Data</h3>
                            <a href="#" type="button" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</a>
                        </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <h3 class="text-center">Program Unggulan Daerah Kabupaten Bengkalis Twiwulan III 2021-2026</br>Dinas Tenaga Kerja dan Transmigtasi</h3>
                  <table id="table" class="table table-responsive table-bordered w-auto">
                    <thead class="text-center">
                    <tr>
                      <th rowspan="2"style="width:20px">OPD Pelaksana</th>
                      <th rowspan="2">Program/Kegiatan/Sub Kegiatan</th>
                      <th colspan="2">Target Kinerja dan Anggaran</th>
                      <th colspan="2">Realisasi Capaian Triwulan I</th>
                      <th colspan="2">Realisasi Capaian Triwulan II</th>
                      <th colspan="2">Realisasi Capaian Triwulan III</th>
                      <th colspan="2">Realisasi Capaian Triwulan IV</th>
                      <th colspan="2">Realisasi Capaian Kinerja dan Anggaran yang di Evaluasi</th>
                      <th colspan="2">Tingkat Capaian (%)</th>
                      <th rowspan="2">Kendala yang dihadapi</th>
                      <th rowspan="2">Tindak Lanjut</th>
                    </tr>
                    <tr>
                      <th>K</th>
                      <th>Rp.</th>
                      <th>K</th>
                      <th>Rp.</th>
                      <th>K</th>
                      <th>Rp.</th>
                      <th>K</th>
                      <th>Rp.</th>
                      <th>K</th>
                      <th>Rp.</th>
                      <th>K</th>
                      <th>Rp.</th>
                      <th>K</th>
                      <th>Rp.</th>
                    </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td rowspan="3">Dinas Tenaga Kerja dan Transmigrasi</td>
                        <td>PROGRAM PERENCANAAN TENAGA KERJA</td>
                        <td></td>
                        <td>121.000.000</td>
                        <td></td>
                        <td>-</td>
                        <td></td>
                        <td>-</td>
                        <td></td>
                        <td>37.710.000</td>
                        <td></td>
                        <td>-</td>
                        <td></td>
                        <td>37.710.000</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td>Kegiatan : Penyusunan Rencana Tenaga Kerja (RTK)</td>
                        <td></td>
                        <td>125.000.000</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>37.710.000</td>
                        <td></td>
                        <td></td>
                        <td>0</td>
                        <td>37.710.000</td>
                        <td>0,00</td>
                        <td>30,17</td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td>Sub Kegiatan : Penyusunan Rencana Tenaga Kerja Makro</td>
                        <td>1 Dokumen</td>
                        <td>125.000.000</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>37.710.000</td>
                        <td></td>
                        <td></td>
                        <td>0</td>
                        <td>37.710.000</td>
                        <td>0,00</td>
                        <td>30,17</td>
                        <td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</td>
                        <td>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</td>
                      </tr>
                      <tr>
                        <td colspan="14" class="text-right">Total Rata-rata Capaian Kinerja Perprogram (%)</td>
                        <td>0,00</td>
                        <td>30,17</td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td colspan="14" class="text-right">Predikat Kinerja</td>
                        <td class="bg-danger">Sangat Rendah</td>
                        <td class="bg-danger">Sangat Rendah</td>
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
