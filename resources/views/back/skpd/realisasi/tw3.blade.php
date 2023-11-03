<!-- Modal -->
<div id="tw3{{ $v['id'] }}" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Input Realisasi Program Unggulan </h4>
        <button type="button" class="btn btn-danger" data-dismiss="modal">&times;</button>
      </div>
     <form action="{{ Request::url().'/create' }}" method="POST">{{ csrf_field() }} 
      <div class="modal-body">
        <div class="card-body">
            <p>SUB KEGIATAN : {{ $v['nama_sub_kegiatan'] }}</p>
        <label>Pilih Tahapan</label>
        <input type="hidden" value="{{ $v['id'] }}" name="idtarget">
        <select class="form-control" name="tahapan" id="tahapan" required>
          
          @if(empty($v['tw1_rel_pagu']))<option value="I">TW1</option>@endif
          @if(empty($v['tw2_rel_pagu']))<option value="II">TW2</option>@endif
          @if(empty($v['tw3_rel_pagu']))<option value="III">TW3</option>@endif
          @if(empty($v['tw4_rel_pagu']))<option value="IV">TW4</option>@endif
        </select>
        <label>Kuantitas Item</label>
        <div class="container">
        <div class="row">
          <input id="kuantitas{{ $v['id'] }}" name="kuantitas" style="width:50%" type="number" placeholder="Jumlah Kuantitas" class="form-control" required>
          <input id="satuan{{ $v['id'] }}" value="{{ $v['satuan'] }}" name="satuan" style="width:50%" type="text" class="form-control" placeholder="Satuan" required>
        </div>
        </div>
        
        <label>Dana Realisasi</label>
        <input id="realisasi{{ $v['id'] }}" type="number" name="realisasi" class="form-control" required>
      
        <label>Keterangan</label>
       
        <Textarea class="form-control" required name="keterangan"></Textarea>
        <label>Kendala</label>
       
        <Textarea class="form-control" required name="kendala"></Textarea>
        <label>tindakan</label>
       
        <Textarea class="form-control" required name="tindakan"></Textarea>
   
        
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-redo"></i> Reset</button>
        <button type="submit" name="submit"  value="true" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
      </div>
      </form>
    </div>

  </div>
</div>

<script type="text/javascript">
		$('#tahapan').change(function() { 
      alert('test');
			/*var tahap = $(this).val(); 
      var tahun = <?php print date('Y') ?>;
      var target= {{ $v['id'] }}
			$.ajax({
				type: 'POST', 
				url: {{ url('getdatapertahap') }}, 
				data: {tahap : 'tahap', tahun : 'tahun',target,'target'}, 
				success: function(response) { 
				  alert('TEST');
				}
			});*/
		});
 
	</script>