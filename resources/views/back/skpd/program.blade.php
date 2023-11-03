@extends('back.layouts.templating')

@section('content')
<!-- Content Header (Page header) -->

<!-- /.content-header -->

<!-- Main content -->
<section class="content" >
    <div class="container-fluid">
        <div class="row">

            <div class="col-12">
                <div class="callout callout-info" style="margin-top:20px;">
                    <h5 style="color:red;"><i class="fas fa-info"></i> Perhatian !!!</h5>
                    Program dibawah ini sudah ditentukan oleh Admin BAPPEDA untuk melakukan penambahan program anda dapat menghubungi admin BAPPEDA
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="card-title mt-2">Data Program</h3>
                                <!--<a href="{{ url(modul('path').'/create') }}"
                                    type="button" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"
                                        aria-hidden="true"></i> Tambah</a>-->
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="table" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width:20px">No.</th>
                                    <th>Kode Program</th>
                                    <th>Nama Program</th>
                                    <th style="width:100px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

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