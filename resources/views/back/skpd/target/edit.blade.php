@extends('back.layouts.templating')

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">
                    <div class="card" style="margin-top:20px;">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 style="font-weight:bold" class="card-title mt-2"><i class="fa fa-bullseye"></i> Edit Data</h3>
                                     <a style="float:right" href="{{url('skpd/target/')}}" class="btn btn-danger"><i class="fa fa-times"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ url('skpd/target/update') }}" method="POST">
                                {{ csrf_field() }}
                                <label>SubKegiatan</label>
                                <input type="hidden" name="id" value="{{ $edit->id }}">
                                <select name="idsubkeg" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    <option value="">--Pilih Sub Kegiatan--</option>
                                    @foreach($subkeg as $i => $v)
                                    <option  value="{{ $v->id_sub_kegiatan }}" @if($v->id_sub_kegiatan==$edit->id_sub_kegiatan) selected @endif>{{$v->nama_sub_kegiatan}}</option>
                                    @endforeach
                                </select>
                                <label>Kuantitas Target</label><br>
                                <i style="color:grey">*Jika kuantitas target berbeda anda dapat menambahkan dengan mengklik icon tambah</i>
                                <div class="tambah-target">
                                <div class="row" style="margin-left:3px;margin-right:3px;">
                                    <input type="hidden" name="id_kuantitaslain[]" value="0">
                                    <input type="number" value="{{ $edit->kuantitas }}" style="width:40%" class="form-control" name="kuantitase[]" required placeholder="Jumlah Kuantitas">
                                    <input type="text" value="{{ $edit->satuan }}" style="width:40%; margin-left:5px" class="form-control" name="satuane[]" placeholder="Satuan Kuantitas">
                                    <a  id="add_form_field" style="width:10%;margin-left:5px" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                                    
                                </div>
                                {{ checkkuantitaslain($edit->id) }}
                            
                                
                                
                                </div>
                                
                                <label>Target Tahun</label>
                                <select name="targettahun" class="form-control" required>
                                    <option value="">--Pilih Tahun--</option>
                                    @foreach($tahun as $dt)
                                    <option value="{{ $dt }}" @if ($dt == $edit->target_tahun) selected @endif>{{ $dt }}</option>
                                    @endforeach
                                </select>
                                <label>Pagu 1 Tahun</label>
                                <input type="number" value="{{ $edit->pagu }}" class="form-control" name="pagu" required>
                                <label>Jenis Pagu</label>
                                <select name="jenis" class="form-control" required>
                                    <option value="">--Pilih Jenis--</option>
                                    @foreach($jenis as $dj)
                                    <option value="{{ $dj }}" @if ($dj == $edit->jenis) selected @endif>{{ $dj }}</option>
                                    @endforeach
                                </select>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="submit"  value="true" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
                            </div>
                    </div>
                    
                        <div class="card-body">
                          
                    </div>
                    </form>
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
            var wrapper = $(".tambah-target" + id);
            $(wrapper).on("click", "#delete", function(e) {
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })

        }

        function addinput(id) {

            var max_fields = 100;
            var wrapper = $(".tambah-target" + id);
            var add_button = $("#add_form_field" + id);
            var x = 1;
            if (x < max_fields) {
                x++;
                $(wrapper).append(
                    '<div class="row" style="margin-top:10px;margin-left:3px;margin-right:3px;"><input type="number" value="" style="width:40%" class="form-control" name="kuantitase[]" required placeholder="Jumlah Kuantitas"><input type="text" style="width:40%;margin-left:5px" class="form-control" name="satuane[]" placeholder="Satuan Kuantitas"><a id="delete' +
                    id + '" onclick="deleteinput(' + id +
                    ')"  style="width:10%;margin-left:5px" class="btn btn-danger"><i class="fa fa-trash"></i></a></div>'
                    ); //add input box
            } else {
                alert('You Reached the limits')
            }
        }
    </script>-->
    <script type="text/javascript">
        function deleteInput(id) {
            var itemId = id; // The ID of the item you want to delete

            $.ajax({
                url: '/skpd/target/deletekuantitaslain/' + itemId,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token if required
                },
                success: function (result) {
                    // Handle the success response
                    console.log(result);
                },
                error: function (xhr, status, error) {
                    // Handle the error response
                    console.error(xhr.responseText);
                }
            });
            var wrapper = $(".tambah-target");
            $(wrapper).on("click", "#delete" + id, function(e) {
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
                    $(wrapper).append(
                        '<input type="hidden" name="id_kuantitaslain[]" value="0"><div class="row"  style="margin-top:10px;margin-left:3px;margin-right:3px;"><input type="number" style="width:40%" class="form-control" name="kuantitase[]" required placeholder="Jumlah Kuantitas"><input type="text" style="width:40%;margin-left:5px" class="form-control" name="satuane[]" placeholder="Satuan Kuantitas"><a  id="delete" style="width:10%;margin-left:5px" class="btn btn-danger"><i class="fa fa-trash"></i></a></div>'
                        ); //add input box
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
