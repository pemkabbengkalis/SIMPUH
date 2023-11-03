@extends('back.layouts.templating')

@section('content')
<!-- Content Header (Page header) -->

<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-12">
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-md">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 style="font-weight: bold" class="modal-title"><i class="nav-icon fas fa-bullseye"></i> Tambah Data Target</h4>

                                <button type="button" class="btn btn-danger" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="card-body">
                                    <form action="{{ Request::url().'/create' }}" method="POST">
                                        {{ csrf_field() }}
                                        <label>SubKegiatan</label>
                                        <select name="idsubkeg" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                            <option value="">--Pilih Sub Kegiatan--</option>
                                            @foreach($subkeg as $i => $v)
                                            <option  value="{{ $v->id_sub_kegiatan }}">{{$v->nama_sub_kegiatan}}</option>
                                            @endforeach
                                        </select>
                                        <label>Kuantitas Target</label><br>
                                        <i style="color:grey">*Jika kuantitas target berbeda anda dapat menambahkan dengan mengklik icon tambah</i>
                                        <div class="tambah-target">
                                        <div class="row" style="margin-left:3px;margin-right:3px;">
                                            <input type="number" style="width:40%" class="form-control" name="kuantitas[]" required placeholder="Jumlah Kuantitas">
                                            <input type="text" style="width:40%; margin-left:5px" class="form-control" name="satuan[]" placeholder="Satuan Kuantitas">
                                            <a  id="add_form_field" style="width:10%;margin-left:5px" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                                        </div>
                                    
                                        
                                        
                                        </div>
                                        
                                        <label>Target Tahun</label>
                                        <select name="targettahun" class="form-control" required>
                                            <option value="">--Pilih Tahun--</option>
                                            @foreach($tahun as $dt)
                                            <option value="{{ $dt }}">{{ $dt }}</option>
                                            @endforeach
                                        </select>
                                        <label>Pagu 1 Tahun</label>
                                        <input type="number" class="form-control" name="pagu" required>
                                        <label>Jenis Pagu</label>
                                        <select name="jenis" class="form-control" required>
                                            <option value="">--Pilih Jenis--</option>
                                            @foreach($jenis as $dj)
                                            <option value="{{ $dj }}">{{ $dj }}</option>
                                            @endforeach
                                        </select>
                                    
                                </div>
                            </div>
                            
                                <div class="card-body">
                                    <div class="modal-footer">
                                <button type="reset" class="btn btn-warning"><i class="fa fa-redo"></i> Reset</button>
                                <button type="submit" name="submit"  value="true" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                                </div>
                            </div>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="card" style="margin-top:20px;">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12">
                                <a data-toggle="modal" data-target="#myModal" style="float:right;"
                                    class="btn btn-success"><i class="fa fa-plus"></i> Tambah Data</a>
                                <h3 style="font-weight:bold" class="card-title mt-2"><i class="fa fa-bullseye"></i> Data
                                    Target</h3>
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
                                    <th>Sub Kegiatan</th>
                                    <th>Kuantitas Target</th>
                                    <th>Target Tahun</th>
                                    <th>Pagu 1 Tahun</th>
                                    <th style="width:150px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $index =>$v)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $v->nama_sub_kegiatan }}</td>
                                    <td>
                                        {{ $v->kuantitas.' '.$v->satuan }}
                                        {{kuantitaslain($v->id)}}
                                    </td>
                                    <td>{{ $v->target_tahun }}</td>
                                    <td>{{ 'Rp '.number_format($v->pagu) }}</td>
                                    <td>
                                        <!-- <a data-toggle="modal" data-target="#myModal{{ $v->id }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a> -->
                                        <a href="{{ ('target/edit/'.base64_encode($v))}}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                        <a href="{{ ('target/delete/'.base64_encode($v->id)) }}" onclick="return confirm('Apakah anda yakin akan menghapus data ini, data yang dihapus tidak dapat dikembalikan?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>

                                @include('back.skpd.target.modal')

                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="width:20px">No.</th>
                                    <th>Sub Kegiatan</th>
                                    <th>Kuantitas Target</th>
                                    <th>Target Tahun</th>
                                    <th>Pagu 1 Tahun</th>
                                    <th style="width:150px">Aksi</th>
                                </tr>
                            </tfoot>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!--<script type="text/javascript">
    
    function deleteId(id) {
        var wrapper = $(".tambah-target"+id);
        $(wrapper).on("click", "#delete", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })

    }
    
    function addinput(id) {

    var max_fields = 100;
    var wrapper = $(".tambah-target"+id);
    var add_button = $("#add_form_field"+id);
    var x = 1;
        if (x < max_fields) {
            x++;
            $(wrapper).append('<div class="row" style="margin-top:10px;margin-left:3px;margin-right:3px;"><input type="number" value="" style="width:40%" class="form-control" name="kuantitase[]" required placeholder="Jumlah Kuantitas"><input type="text" style="width:40%;margin-left:5px" class="form-control" name="satuane[]" placeholder="Satuan Kuantitas"><a id="delete'+id+'" onclick="deleteinput('+id+')"  style="width:10%;margin-left:5px" class="btn btn-danger"><i class="fa fa-trash"></i></a></div>'); //add input box
        } else {
            alert('You Reached the limits')
        }                        
    }

   
</script>-->
<script type="text/javascript">
    function deleteInput(id) {
        var wrapper = $(".tambah-target");
        $(wrapper).on("click", "#delete"+id, function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
        })      
    }

    $(document).ready(function() {
    var max_fields = 100;
    var wrapper = $(".tambah-target");
    var add_button = $("#add_form_field");

    var x = 1;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
            $(wrapper).append('<div class="row" style="margin-top:10px;margin-left:3px;margin-right:3px;"><input type="number" style="width:40%" class="form-control" name="kuantitas[]" required placeholder="Jumlah Kuantitas"><input type="text" style="width:40%;margin-left:5px" class="form-control" name="satuan[]" placeholder="Satuan Kuantitas"><a  id="delete" style="width:10%;margin-left:5px" class="btn btn-danger"><i class="fa fa-trash"></i></a></div>'); //add input box
        } else {
            alert('You Reached the limits')
        }
    });
    
    $(wrapper).on("click", "#delete", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
});
    </script>
@endsection