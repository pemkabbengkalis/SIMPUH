<!-- Modal -->
<div id="myModal{{ $vk['id'] }}" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Input Realisasi Program Unggulan </h4>
        <button type="button" class="btn btn-danger" data-dismiss="modal">&times;</button>
      </div>

        <div class="modal-body">
          <div class="card-body">
            <div class="col-12 col-md-12">
              <div class="card card-info card-tabs">
                <div class="card-header p-0 pt-1">
                  <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill"
                        href="#custom-tabs-one-home{{ $vk['id'] }}" role="tab" aria-controls="custom-tabs-one-home"
                        aria-selected="true">TW I</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                        href="#custom-tabs-one-profile{{ $vk['id'] }}" role="tab" aria-controls="custom-tabs-one-profile"
                        aria-selected="false">TW II</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill"
                        href="#custom-tabs-one-messages{{ $vk['id'] }}" role="tab" aria-controls="custom-tabs-one-messages"
                        aria-selected="false">TW III</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill"
                        href="#custom-tabs-one-settings{{ $vk['id'] }}" role="tab" aria-controls="custom-tabs-one-settings"
                        aria-selected="false">TW IV</a>
                    </li>
                  </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade active show" id="custom-tabs-one-home{{ $vk['id'] }}" role="tabpanel"
                      aria-labelledby="custom-tabs-one-home-tab">
                      <!--===TW 1 FORM-->
                      <?php
                        $furl = Request::url();
                      ?>
                      <form action="@if(!empty($vk['tw1_id'])){{ $furl.'/update' }} @else {{ $furl.'/create' }} @endif" method="POST">{{ csrf_field() }}
                        <label>Pilih Tahapan</label>
                          <input type="hidden" value="{{ $vk['id'] }}" name="idtarget[]">
                          <input type="hidden" value="I" name="tahapan[]">
                          <label>Kuantitas Item</label>
                          <div class="container">
                          <div class="row">
                            <input value="@if($vk['tw1_kuantitas'] > 0 ){{ $vk['tw1_kuantitas'] }} @else 0 @endif" name="kuantitas[]" style="width:50%" type="text" placeholder="Jumlah Kuantitas" class="form-control" required>
                            <input  value="<?php (!empty($vk['tw1_rel_satuan']))? print $vk['tw1_rel_satuan'] : print $vk['satuan'] ?>" name="satuan[]" style="width:50%" type="text" class="form-control" placeholder="Satuan" required>
                          </div>
                          </div>

                          <input type="hidden" name="id_realisasi[]" value="{{ $vk['tw1_id'] }}">


                          <label>Realisasi Keuangan</label>
                          <input value="{{ $vk['tw1_rel_pagu'] }}" type="text" pattern="[0-9,]+" name="realisasi[]" class="form-control" required>
                         <input type="hidden" value="{{ isset($_GET['periode']) ? $_GET['periode'] : date('Y') }}" name="tahun[]">

                         <label>Realisasi Fisik</label>
                         <input value="{{ $vk['tw1_rel_fisik'] }}" type="text" pattern="[0-9,]+" name="realisasifisik[]" class="form-control" required>
                         <input type="hidden" name="keterangan[]" value="-">
                         <!-- <label>Keterangan</label>
                          
                          <Textarea type="hidden" class="form-control" required name="keterangan[]">@if(!empty($vk['tw1_keterangan'])){{ $vk['tw1_keterangan'] }} @else - @endif</Textarea> -->
                          <label>Kendala</label>

                          <Textarea class="form-control" required name="kendala[]">@if(!empty($vk['tw1_kendala'])){{ $vk['tw1_kendala'] }}@else @endif</Textarea>
                          <label>Tindak Lanjut</label>

                          <Textarea class="form-control" required name="tindakan[]">@if(!empty($vk['tw1_tindakan'])){{ $vk['tw1_tindakan'] }}@else - @endif</Textarea>
                          {{-- <button name="submit"  value="true" style="width:100%;margin-top:10px;" type="submit" class="btn btn-success">Simpan</button>
                      </form> --}}
                      <!--===TW 1 FORM-->
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-profile{{ $vk['id'] }}" role="tabpanel"
                      aria-labelledby="custom-tabs-one-profile-tab">
                      <!--===TW II FORM-->
                      {{-- <form action=" @if(!empty($vk['tw2_id'])){{ Request::url().'/update' }} @else {{ Request::url().'/create' }} @endif" method="POST">{{ csrf_field() }}
                         --}}
                        <label>Pilih Tahapan</label>
                          <input type="hidden" value="{{ $vk['id'] }}" name="idtarget[]">
                          <input type="hidden" value="II" name="tahapan[]">
                          <label>Kuantitas Item</label>
                          <div class="container">
                          <div class="row">
                            <input value="@if($vk['tw2_kuantitas'] > 0 ){{ $vk['tw2_kuantitas'] }} @else 0 @endif" name="kuantitas[]" style="width:50%" type="text" placeholder="Jumlah Kuantitas" class="form-control" required>
                            <input  value="<?php (!empty($vk['tw2_rel_satuan']))? print $vk['tw2_rel_satuan'] : print $vk['satuan'] ?>" name="satuan[]" style="width:50%" type="text" class="form-control" placeholder="Satuan" required>
                          </div>
                          </div>
                          <input type="hidden" name="id_realisasi[]" value="{{ $vk['tw2_id'] }}">
                          <label>Realisasi Keuangan</label>
                          <input value="{{ $vk['tw2_rel_pagu'] }}" type="text" pattern="[0-9,]+" name="realisasi[]" class="form-control" required>
                          <input type="hidden" value="{{ isset($_GET['periode']) ? $_GET['periode'] : date('Y') }}" name="tahun[]">

                          <label>Realisasi Fisik</label>
                         <input value="{{ $vk['tw2_rel_fisik'] }}" type="text" pattern="[0-9,]+" name="realisasifisik[]" class="form-control" required>
                         <input type="hidden" name="keterangan[]" value="-">
                          <!-- <label>Keterangan</label>

                          <Textarea class="form-control" required name="keterangan[]"> @if(!empty($vk['tw2_keterangan']))  {{ $vk['tw2_keterangan'] }} @else - @endif</Textarea> -->
                          <label>Kendala</label>

                          <Textarea class="form-control" required name="kendala[]">@if(!empty($vk['tw2_kendala'])) {{ $vk['tw2_kendala'] }} @else - @endif</Textarea>
                          <label>Tindak Lanjut</label>

                          <Textarea class="form-control" required name="tindakan[]">@if(!empty($vk['tw2_tindakan'])){{ $vk['tw2_tindakan'] }}@else - @endif</Textarea>
                          {{-- <button style="width:100%;margin-top:10px;" type="submit" name="submit"  value="true" class="btn btn-success">Simpan</button>
                      </form> --}}
                      <!--==TW II FORM-->
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-messages{{ $vk['id'] }}" role="tabpanel"
                      aria-labelledby="custom-tabs-one-messages-tab">
                        <!--===TW III FORM-->
                      {{-- <form action=" @if(!empty($vk['tw3_id'])){{ Request::url().'/update' }} @else {{ Request::url().'/create' }} @endif" method="POST">{{ csrf_field() }}
                         --}}

                        <label>Pilih Tahapan</label>
                          <input type="hidden" value="{{ $vk['id'] }}" name="idtarget[]">
                          <input type="hidden" value="III" name="tahapan[]">
                          <label>Kuantitas Item</label>
                          <div class="container">
                          <div class="row">
                            <input value="@if($vk['tw3_kuantitas'] > 0 ){{ $vk['tw3_kuantitas'] }} @else 0 @endif" name="kuantitas[]" style="width:50%" type="text" placeholder="Jumlah Kuantitas" class="form-control" required>
                            <input  value="<?php (!empty($vk['tw3_rel_satuan']))? print $vk['tw3_rel_satuan'] : print $vk['satuan'] ?>" name="satuan[]" style="width:50%" type="text" class="form-control" placeholder="Satuan" required>
                          </div>
                          </div>
                          <input type="hidden" name="id_realisasi[]" value="{{ $vk['tw3_id'] }}">
                          <label>Realisasi Keuangan</label>
                          <input value="{{ $vk['tw3_rel_pagu'] }}" type="text" pattern="[0-9,]+" name="realisasi[]" class="form-control" required>
                          <input type="hidden" value="{{ isset($_GET['periode']) ? $_GET['periode'] : date('Y') }}" name="tahun[]">

                          <label>Realisasi Fisik</label>
                         <input value="{{ $vk['tw3_rel_fisik'] }}" type="text" pattern="[0-9,]+" name="realisasifisik[]" class="form-control" required>
                         <input type="hidden" name="keterangan[]" value="-">
                          <!-- <label>Keterangan</label>

                          <Textarea class="form-control" required name="keterangan[]"> @if(!empty($vk['tw3_keterangan']))  {{ $vk['tw3_keterangan'] }} @else - @endif</Textarea> -->
                          <label>Kendala</label>

                          <Textarea class="form-control" required name="kendala[]">@if(!empty($vk['tw3_kendala'])) {{ $vk['tw3_kendala'] }} @else - @endif</Textarea>
                          <label>Tindak Lanjut</label>

                          <Textarea class="form-control" required name="tindakan[]">@if(!empty($vk['tw3_tindakan'])) {{ $vk['tw3_tindakan'] }} @else - @endif</Textarea>
                          {{-- <button style="width:100%;margin-top:10px;" type="submit" name="submit"  value="true" class="btn btn-success">Simpan</button>
                      </form> --}}
                      <!--==TW III FORM-->
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-settings{{ $vk['id'] }}" role="tabpanel"
                      aria-labelledby="custom-tabs-one-settings-tab">
                       <!--===TW III FORM-->
                      {{-- <form action=" @if(!empty($vk['tw4_id'])){{ Request::url().'/update' }} @else {{ Request::url().'/create' }} @endif" method="POST">{{ csrf_field() }}
                         --}}
                        <label>Pilih Tahapan</label>
                          <input type="hidden" value="{{ $vk['id'] }}" name="idtarget[]">
                          <input type="hidden" value="IV" name="tahapan[]">
                          <label>Kuantitas Item</label>
                          <div class="container">
                          <div class="row">
                            <input value="@if($vk['tw4_kuantitas'] > 0 ){{ $vk['tw4_kuantitas'] }} @else 0 @endif"name="kuantitas[]" style="width:50%" type="text" placeholder="Jumlah Kuantitas" class="form-control" required>
                            <input  value="<?php (!empty($vk['tw4_rel_satuan']))? print $vk['tw4_rel_satuan'] : print $vk['satuan'] ?>" name="satuan[]" style="width:50%" type="text" class="form-control" placeholder="Satuan" required>
                          </div>
                          </div>
                          <input type="hidden" name="id_realisasi[]" value="{{ $vk['tw4_id'] }}">
                          <label>Realisasi Keuangan</label>
                          <input value="{{ $vk['tw4_rel_pagu'] }}" type="text" pattern="[0-9,]+" name="realisasi[]" class="form-control" required>
                          <input type="hidden" value="{{ isset($_GET['periode']) ? $_GET['periode'] : date('Y') }}" name="tahun[]">

                          <label>Realisasi Fisik</label>
                         <input value="{{ $vk['tw4_rel_fisik'] }}" type="text" pattern="[0-9,]+" name="realisasifisik[]" class="form-control" required>
 <input type="hidden" name="keterangan[]" value="-">
                          <!-- <label>Keterangan</label>

                          <Textarea class="form-control" required name="keterangan[]">@if(!empty($vk['tw4_keterangan'])) {{ $vk['tw4_keterangan'] }} @else -  @endif</Textarea> -->
                          <label>Kendala</label>

                          <Textarea class="form-control" required name="kendala[]">@if(!empty($vk['tw4_kendala'])) {{ $vk['tw4_kendala'] }} @else - @endif</Textarea>
                          <label>Tindak Lanjut</label>

                          <Textarea class="form-control" required name="tindakan[]">@if(!empty($vk['tw4_tindakan'])){{ $vk['tw4_tindakan'] }} @else - @endif</Textarea>
                          <hr>
                          <!-- if($kegiatan_lain != null)
                          <label>Realisasi Capaian Kinerja</label>
                          <div class="row" style="margin-left: 2px;margin-right: 2px;">
                            <input placeholder="Kuantitas" style="width:50%" type="text" name="kuantitas_rck" id="" class="form-control" required>
                            <input placeholder="Realisasi Keuangan" style="width:50%" type="text" name="dana_rck" id="" class="form-control" required>
                          </div>

                          <label>Tingkat Capaian</label>
                          <div class="row" style="margin-left: 2px;margin-right: 2px;">
                            <input placeholder="Kuantitas" type="text" style="width:50%" name=kuantitas_tcp" id="" class="form-control" required>
                            <input placeholder="Realisasi Keuangan" type="text" style="width:50%" name=dana_tcp" id="" class="form-control" required>
                          </div>

                          endif -->

                          <button style="width:100%;margin-top:10px;" type="submit" name="submit"  value="true" class="btn btn-success">Simpan</button>
                      </form>
                      <!--==TW III FORM-->
                    </div>
                  </div>
                </div>

              </div>
            </div>




          </div>
          <div class="modal-footer">
            <i style="text-align: justify">Nb: Input Data sesuai dengan tahapan Triwulan yang telah di laksanakan,jika belum anda bisa mengabaikannya</i>

          </div>
      </form>
    </div>

  </div>
</div>

<script>
  // function validateInputs() {
  //   const inputs = document.getElementsByName('my-input');
  //   const pattern = /^[0-9,]+$/;
  //   let isValid = true;

  //   inputs.forEach(input => {
  //     const value = input.value;
  //     if (!pattern.test(value)) {
  //       alert(`Input ${input.id} is invalid! Please enter a number with commas.`);
  //       isValid = false;
  //     }
  //   });

  //   if (isValid) {
  //     alert("Inputs are valid!");
  //     // Submit the form or perform other actions
  //   } else {
  //     // Do not submit the form or perform other actions
  //   }
  // }

  document.querySelectorAll('input[name="realisasi[]"]').forEach(input => {
    input.addEventListener('keydown', event => {
      const keyCode = event.keyCode;
      const value = input.value;
      const pattern = /^[0-9.]*$/;

      if (keyCode === 8) { // backspace
        return;
      }

      if (keyCode === 46) { // delete
        input.value = "";
        return;
      }

      if (!pattern.test(value)) {
        input.value = value.replace(/[^0-9.]/g, '');
        event.preventDefault();
      }
    });
  });


  // document.querySelectorAll('input[name="kuantitas[]"]').forEach(input => {
  //   input.addEventListener('keydown', event => {
  //     const keyCode = event.keyCode;
  //     const value = input.value;
  //     const pattern = /^[0-9.]*$/;

  //     if (keyCode === 8) { // backspace
  //       return;
  //     }

  //     if (keyCode === 46) { // delete
  //       input.value = "";
  //       return;
  //     }

  //     if (!pattern.test(value)) {
  //       input.value = value.replace(/[^0-9.]/g, '');
  //       event.preventDefault();
  //     }
  //   });
  // });
  </script>
