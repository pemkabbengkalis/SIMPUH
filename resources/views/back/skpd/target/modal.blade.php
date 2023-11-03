<div id="myModal{{ $v->id }}" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 style="font-weight: bold" class="modal-title"><i class="nav-icon fas fa-bullseye"></i> Update Data
                    Target</h4>

                <button type="button" class="btn btn-danger" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form action="{{ Request::url() . '/update' }}" method="POST">
                        <input type="hidden" name="id" value="{{ $v->id }}">
                        {{ csrf_field() }}
                        <label>SubKegiatan</label>
                        <select name="idsubkeg" class="form-control select2 select2-danger"
                            data-dropdown-css-class="select2-danger" style="width: 100%;">
                            <option value="">--Pilih Sub Kegiatan--</option>
                            @foreach ($subkeg as $i => $vs)
                                <option value="{{ $vs->id_sub_kegiatan }}"
                                    @if ($vs->id_sub_kegiatan == $v->id_sub_kegiatan) selected @endif>{{ $vs->nama_sub_kegiatan }}
                                </option>
                            @endforeach
                        </select>
                        <label>Kuantitas Target</label>
                        <br>
                        <i style="color:grey">*Jika kuantitas target berbeda anda dapat menambahkan dengan mengklik icon
                            tambah</i>
                        <div class="tambah-target{{ $v->id }}">
                            <div class="row" style="margin-left:3px;margin-right:3px;">
                                <input type="number" value="{{ $v->kuantitas }}" style="width:40%" class="form-control"
                                    name="kuantitase[]" required placeholder="Jumlah Kuantitas">
                                <input type="text" value="{{ $v->satuan }}" style="width:40%;margin-left:5px;"
                                    class="form-control" name="satuane[]" placeholder="Satuan Kuantitas">
                                <a id="add_form_field{{ $v->id }}" onclick="updateinput('{{ $v->id }}')"
                                    style="width:10%;margin-left:5px" class="btn btn-primary"><i
                                        class="fa fa-plus"></i></a>
                            </div>

                            {{ checkkuantitaslain($v->id) }}



                        </div>

                        <label>Target Tahun</label>
                        <select name="targettahun" class="form-control" required>
                            <option value="">--Pilih Tahun--</option>
                            @foreach ($tahun as $dt)
                                <option value="{{ $dt }}" @if ($dt == $v->target_tahun) selected @endif>
                                    {{ $dt }}</option>
                            @endforeach
                        </select>
                        <label>Pagu 1 Tahun</label>
                        <input type="number" value="{{ $v->pagu }}" class="form-control" name="pagu" required>
                        <label>Jenis Pagu</label>
                        <select name="jenis" class="form-control" required>
                            <option value="">--Pilih Jenis--</option>
                            @foreach ($jenis as $dj)
                                <option value="{{ $dj }}" @if ($dj == $v->jenis) selected @endif>
                                    {{ $dj }}</option>
                            @endforeach
                        </select>

                </div>
            </div>

            <div class="card-body">
                <div class="modal-footer">
                    <button type="reset" class="btn btn-warning"><i class="fa fa-redo"></i> Reset</button>
                    <button type="submit" name="submit" value="true" class="btn btn-success"><i
                            class="fa fa-save"></i> Simpan</button>
                </div>
            </div>
            </form>
        </div>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    function deleteId(id) {
        var wrapper = $(".tambah-target" + id);
        $(wrapper).on("click", "#delete", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })

    }

    function updateinput(id) {

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

    function deleteinput(id) {
        var max_fields = 100;
        var wrapper = $(".tambah-target" + id);
        $(wrapper).on("click", "#delete" + id, function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
            alert(x);
        });

    }
</script>
