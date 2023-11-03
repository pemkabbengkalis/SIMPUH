@extends('back.layouts.templating')

@section('content')
<!-- Content Header (Page header) -->

<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-12">
                
                <div class="card" style="margin-top:20px;">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{'/skpd/realisasi?periode='.$_GET['tahun']}}" style="float:right" class="btn btn-danger">x</a>
                                <h3 style="font-weight:bold" class="card-title mt-2"><i class="fa fa-bullseye"></i> Data
                                    Target</h3>
                                <!--<a href="https://simpuh.bengkaliskab.go.id/skpd/target/create"
                                    type="button" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"
                                        aria-hidden="true"></i> Tambah</a>-->
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="col-12 col-md-12">
                            <div class="card card-info card-tabs">
                              <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                  <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home44" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">TW I</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile44" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">TW II</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages44" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">TW III</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings44" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">TW IV</a>
                                  </li>
                                </ul>
                              </div>
                              <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                  
                                  <div class="tab-pane fade active show" id="custom-tabs-one-home44" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                    <!--===TW 1 FORM-->
                                    <form action=" https://simpuh.bengkaliskab.go.id/skpd/realisasi/createganda " method="POST">
                                    @php
                                    $indexsat = 0;
                                    if($tw1 != null){
                                      $ex_kuantitas  = explode(',',$tw1->realisasi_kuantitas);
                                      $ex_satuan     = explode(',',$tw1->realisasi_satuan);
                                    }
                                      

                                    @endphp
                                    {{csrf_field()}}
                                      <label>Pilih Tahapan</label>
                                        <input type="hidden" value="{{$target->id}}" name="idtarget">
                                        <input type="hidden" value="I" name="tahapan">
                                        <label>Kuantitas Item</label>
                                        @if($target != null)
                                        <div class="row" style="margin-right:5px;margin-left: 5px;">
                                          <input value="@if($tw1 != null) {{$ex_kuantitas[0]}} @endif" name="kuantitas[]" style="width:50%" type="text" placeholder="Jumlah Kuantitas" class="form-control" required="">
                                          <input value="@if($tw1 != null) {{$ex_satuan[0]}} @else {{$target->satuan}} @endif" name="satuan[]" style="width:50%" type="text" class="form-control" placeholder="Satuan" required="">
                                        </div>
                                        @endif
                                        <br>
                                        @foreach(getkuantitas_lain($target->id) as $i => $v)
                    
                                        <div class="row" style="margin-right:5px;margin-left: 5px;">
                                            <input value="@if($tw1 != null AND !empty($ex_kuantitas[$i+1])) {{$ex_kuantitas[$i+1]}}  @endif" name="kuantitas[]" style="width:50%" type="text" placeholder="Jumlah Kuantitas" class="form-control" required="">
                                            <input value="@if($tw1 != null AND !empty($ex_satuan[$i+1])) {{$ex_satuan[$i+1]}} @else {{$v->satuan_lain}}@endif" name="satuan[]" style="width:50%" type="text" class="form-control" placeholder="Satuan" required="">
                                        </div>
                                        <br>

                                        @endforeach
                                        
                                        @if($tw1 != null)<input type="hidden" name="id_realisasi" value="{{$tw1->id_realisasi}}">@endif
                                        <label>Dana Realisasi</label>
                                        <input value="@if($tw1 != null) {{$tw1->realisasi_pagu}} @endif" type="text"  name="realisasi" class="form-control" required="">
                                       <input type="hidden" value="{{$target->target_tahun}}" name="tahun">
                                        <label>Keterangan</label>
                                      
                                        <textarea class="form-control" required="" name="keterangan">@if($tw1 != null) {{$tw1->keterangan}} @endif</textarea>
                                        <label>Kendala</label>
                                      
                                        <textarea class="form-control" required="" name="kendala">@if($tw1 != null) {{$tw1->kendala}} @endif</textarea>
                                        <label>tindakan</label>
                                      
                                        <textarea class="form-control" required="" name="tindakan">@if($tw1 != null) {{$tw1->tindakan}} @endif</textarea>
                                        
                                    <!--===TW 1 FORM-->
                                    <br>
                                    <button  type="submit" name="submit" value="true" class="btn btn-success">Simpan</button>
                                  </form>
                                  </div>
                                
                                  <div class="tab-pane fade" id="custom-tabs-one-profile44" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                    <!--===TW II FORM-->
                                    <form action=" https://simpuh.bengkaliskab.go.id/skpd/realisasi/createganda " method="POST">
                                     <!--===TW 1 FORM-->
                                     @php
                                     $indexsat = 0;
                                     if($tw2 != null){
                                       $ex_kuantitas  = explode(',',$tw2->realisasi_kuantitas);
                                       $ex_satuan     = explode(',',$tw2->realisasi_satuan);
                                     }
                                       
 
                                     @endphp
                                     {{csrf_field()}}
                                       <label>Pilih Tahapan</label>
                                         <input type="hidden" value="{{$target->id}}" name="idtarget">
                                         <input type="hidden" value="II" name="tahapan">
                                         <label>Kuantitas Item</label>
                                         @if($target != null)
                                         <div class="row" style="margin-right:5px;margin-left: 5px;">
                                           <input value="@if($tw2 != null ) {{$ex_kuantitas[0]}} @endif" name="kuantitas[]" style="width:50%" type="text" placeholder="Jumlah Kuantitas" class="form-control" required="">
                                           <input value="@if($tw2 != null ) {{$ex_satuan[0]}} @else {{$target->satuan}} @endif" name="satuan[]" style="width:50%" type="text" class="form-control" placeholder="Satuan" required="">
                                         </div>
                                         @endif
                                         <br>
                                         @foreach(getkuantitas_lain($target->id) as $i => $v)
                     
                                         <div class="row" style="margin-right:5px;margin-left: 5px;">
                                             <input value="@if($tw2 != null AND !empty($ex_kuantitas[$i+1])) {{$ex_kuantitas[$indexsat++]}}  @endif" name="kuantitas[]" style="width:50%" type="text" placeholder="Jumlah Kuantitas" class="form-control" required="">
                                             <input value="@if($tw2 != null AND !empty($ex_satuan[$i+1])) {{$ex_satuan[$indexsat++]}} @else {{$v->satuan_lain}}@endif" name="satuan[]" style="width:50%" type="text" class="form-control" placeholder="Satuan" required="">
                                         </div>
                                         <br>
 
                                         @endforeach
                                         
                                         @if($tw2 != null)<input type="hidden" name="id_realisasi" value="{{$tw2->id_realisasi}}">@endif
                                         <label>Dana Realisasi</label>
                                         <input value="@if($tw2 != null) {{$tw2->realisasi_pagu}} @endif" type="text"  name="realisasi" class="form-control" required="">
                                        <input type="hidden" value="{{$target->target_tahun}}" name="tahun">
                                         <label>Keterangan</label>
                                       
                                         <textarea class="form-control" required="" name="keterangan">@if($tw2 != null) {{$tw2->keterangan}} @endif</textarea>
                                         <label>Kendala</label>
                                       
                                         <textarea class="form-control" required="" name="kendala">@if($tw2 != null) {{$tw2->kendala}} @endif</textarea>
                                         <label>tindakan</label>
                                       
                                         <textarea class="form-control" required="" name="tindakan">@if($tw2 != null) {{$tw2->tindakan}} @endif</textarea>
                                         
                                     <!--===TW 1 FORM-->
                                     <br>
                                     <button  type="submit" name="submit" value="true" class="btn btn-success">Simpan</button>
                                    
                                    </form>
                                  </div>
                                  <div class="tab-pane fade" id="custom-tabs-one-messages44" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                                      <!--===TW III FORM-->
                                      <form action=" https://simpuh.bengkaliskab.go.id/skpd/realisasi/createganda " method="POST">
                                       <!--===TW 1 FORM-->
                                     @php
                                     $indexsat = 0;
                                     if($tw3 != null){
                                       $ex_kuantitas  = explode(',',$tw3->realisasi_kuantitas);
                                       $ex_satuan     = explode(',',$tw3->realisasi_satuan);
                                     }
                                       
 
                                     @endphp
                                     {{csrf_field()}}
                                       <label>Pilih Tahapan</label>
                                         <input type="hidden" value="{{$target->id}}" name="idtarget">
                                         <input type="hidden" value="III" name="tahapan">
                                         <label>Kuantitas Item</label>
                                         @if($target != null)
                                         <div class="row" style="margin-right:5px;margin-left: 5px;">
                                           <input value="@if($tw3 != null ) {{$ex_kuantitas[0]}} @endif" name="kuantitas[]" style="width:50%" type="text" placeholder="Jumlah Kuantitas" class="form-control" required="">
                                           <input value="@if($tw3 != null ) {{$ex_satuan[0]}} @else {{$target->satuan}} @endif" name="satuan[]" style="width:50%" type="text" class="form-control" placeholder="Satuan" required="">
                                         </div>
                                         @endif
                                         <br>
                                         @foreach(getkuantitas_lain($target->id) as $i => $v)
                     
                                         <div class="row" style="margin-right:5px;margin-left: 5px;">
                                             <input value="@if($tw3 != null AND !empty($ex_kuantitas[$i+1])) {{$ex_kuantitas[$indexsat++]}}  @endif" name="kuantitas[]" style="width:50%" type="text" placeholder="Jumlah Kuantitas" class="form-control" required="">
                                             <input value="@if($tw3 != null AND !empty($ex_satuan[$i+1])) {{$ex_satuan[$indexsat++]}} @else {{$v->satuan_lain}}@endif" name="satuan[]" style="width:50%" type="text" class="form-control" placeholder="Satuan" required="">
                                         </div>
                                         <br>
 
                                         @endforeach
                                         
                                         @if($tw3 != null)<input type="hidden" name="id_realisasi" value="{{$tw3->id_realisasi}}">@endif
                                         <label>Dana Realisasi</label>
                                         <input value="@if($tw3 != null) {{$tw3->realisasi_pagu}} @endif" type="text"  name="realisasi" class="form-control" required="">
                                        <input type="hidden" value="{{$target->target_tahun}}" name="tahun">
                                         <label>Keterangan</label>
                                       
                                         <textarea class="form-control" required="" name="keterangan">@if($tw3 != null) {{$tw3->keterangan}} @endif</textarea>
                                         <label>Kendala</label>
                                       
                                         <textarea class="form-control" required="" name="kendala">@if($tw3 != null) {{$tw3->kendala}} @endif</textarea>
                                         <label>tindakan</label>
                                       
                                         <textarea class="form-control" required="" name="tindakan">@if($tw3 != null) {{$tw3->tindakan}} @endif</textarea>
                                         
                                     <!--===TW 1 FORM-->
                                     <br>
                                     <button  type="submit" name="submit" value="true" class="btn btn-success">Simpan</button>
                                    </form>
                                    <!--==TW III FORM-->
                                  </div>
                                  <div class="tab-pane fade" id="custom-tabs-one-settings44" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
                                     <!--===TW III FORM-->
                                     <form action=" https://simpuh.bengkaliskab.go.id/skpd/realisasi/createganda " method="POST">
                                        <!--===TW 1 FORM-->
                                        @php
                                        $indexsat = 0;
                                        if($tw4 != null){
                                          $ex_kuantitas  = explode(',',$tw4->realisasi_kuantitas);
                                          $ex_satuan     = explode(',',$tw4->realisasi_satuan);
                                        }
                                          
    
                                        @endphp
                                        {{csrf_field()}}
                                          <label>Pilih Tahapan</label>
                                            <input type="hidden" value="{{$target->id}}" name="idtarget">
                                            <input type="hidden" value="IV" name="tahapan">
                                            <label>Kuantitas Item</label>
                                            @if($target != null)
                                            <div class="row" style="margin-right:5px;margin-left: 5px;">
                                              <input value="@if($tw4 != null ) {{$ex_kuantitas[0]}} @endif" name="kuantitas[]" style="width:50%" type="text" placeholder="Jumlah Kuantitas" class="form-control" required="">
                                              <input value="@if($tw4 != null ) {{$ex_satuan[0]}} @else {{$target->satuan}} @endif" name="satuan[]" style="width:50%" type="text" class="form-control" placeholder="Satuan" required="">
                                            </div>
                                            @endif
                                            <br>
                                            @foreach(getkuantitas_lain($target->id) as $i => $v)
                        
                                            <div class="row" style="margin-right:5px;margin-left: 5px;">
                                                <input value="@if($tw4 != null AND !empty($ex_kuantitas[$i+1])) {{$ex_kuantitas[$indexsat++]}}  @endif" name="kuantitas[]" style="width:50%" type="text" placeholder="Jumlah Kuantitas" class="form-control" required="">
                                                <input value="@if($tw4 != null AND !empty($ex_satuan[$i+1])) {{$ex_satuan[$indexsat++]}} @else {{$v->satuan_lain}}@endif" name="satuan[]" style="width:50%" type="text" class="form-control" placeholder="Satuan" required="">
                                            </div>
                                            <br>
    
                                            @endforeach
                                            
                                            @if($tw3 != null)<input type="hidden" name="id_realisasi" value="{{$tw4->id_realisasi}}">@endif
                                            <label>Dana Realisasi</label>
                                            <input value="@if($tw4 != null) {{$tw4->realisasi_pagu}} @endif" type="text"  name="realisasi" class="form-control" required="">
                                           <input type="hidden" value="{{$target->target_tahun}}" name="tahun">
                                            <label>Keterangan</label>
                                          
                                            <textarea class="form-control" required="" name="keterangan">@if($tw4 != null) {{$tw4->keterangan}} @endif</textarea>
                                            <label>Kendala</label>
                                          
                                            <textarea class="form-control" required="" name="kendala">@if($tw4 != null) {{$tw4->kendala}} @endif</textarea>
                                            <label>tindakan</label>
                                          
                                            <textarea class="form-control" required="" name="tindakan">@if($tw4 != null) {{$tw4->tindakan}} @endif</textarea>
                                            
                                        <!--===TW 1 FORM-->
                                        <br>
                                        <button  type="submit" name="submit" value="true" class="btn btn-success">Simpan</button>
                                    </form>
                                    <!--==TW III FORM-->
                                  </div>
                                </div>
                              </div>
              
                            </div>
                          </div>
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