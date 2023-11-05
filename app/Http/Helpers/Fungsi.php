<?php
use App\Models\SubKegiatan;
use App\Models\Kegiatan;
use App\Models\Program;
use App\Models\KuantitasLain;
use App\Models\KuantitasGanda;

function checkimplode($data,$data2){
  $data = explode(',',$data);
  $data2 = explode(',',$data2);
  $no = 0;
  if(count($data) <= 1){
      print $data[0].' '.$data2[0];
  }else{
    foreach ($data as $v) {
      print $v." ".$data2[$no++]."<br>";
    }
  }
}
function rp($num){
  return number_format($num ?? 0,0,',','.');
}
function getTotalQuantityTarget($target_id){

}
function gettarget($id,$tahun){
  $data = DB::table('tbl_program')
        ->join('tbl_program_unggulan','tbl_program_unggulan.id_program_unggulan','tbl_program.id_program_unggulan')
        ->join('tbl_kegiatan','tbl_kegiatan.id_program','tbl_program.id_program')
        ->join('tbl_sub_kegiatan','tbl_sub_kegiatan.id_kegiatan','tbl_kegiatan.id_kegiatan')
        ->join('tbl_target','tbl_target.id_sub_kegiatan','tbl_sub_kegiatan.id_sub_kegiatan')
        ->where('tbl_program_unggulan.id_program_unggulan',$id)
        ->where('tbl_target.target_tahun',$tahun)
        ->sum('pagu');
  return 'Rp '.number_format($data);
}

function getrealisasi($id,$tahun){
  $data = DB::table('tbl_program')
        ->join('tbl_program_unggulan','tbl_program_unggulan.id_program_unggulan','tbl_program.id_program_unggulan')
        ->join('tbl_kegiatan','tbl_kegiatan.id_program','tbl_program.id_program')
        ->join('tbl_sub_kegiatan','tbl_sub_kegiatan.id_kegiatan','tbl_kegiatan.id_kegiatan')
        ->join('tbl_target','tbl_target.id_sub_kegiatan','tbl_sub_kegiatan.id_sub_kegiatan')
        ->join('tbl_realisasi','tbl_realisasi.id_target','tbl_target.id')
        ->where('tbl_program_unggulan.id_program_unggulan',$id)
        ->where('tbl_target.target_tahun',$tahun)
        ->sum('realisasi_pagu');
  return 'Rp '.number_format($data);
}

function kuantitasganda($id_target){
     $data = KuantitasGanda::where('id_target',$id_target)->first();
     return $data;
}
function checkkuantitaslain($id){
   $data = KuantitasLain::where('id_target',$id)->get();
   if($data->count() > 0){
    foreach ($data as $i => $v) {
     print '<div class="row" style="margin-top:10px;margin-left:3px;margin-right:3px;"><input type="hidden" name="id_kuantitaslain[]" value="'.$v->id_kuantitas_lain.'"><input type="number" style="width:40%" class="form-control" value="'.$v->kuantitas_lain.'" name="kuantitase[]" required placeholder="Jumlah Kuantitas"><input value="'.$v->satuan_lain.'" type="text" style="width:40%;margin-left:5px" class="form-control" name="satuane[]" placeholder="Satuan Kuantitas"><a id="delete'.$v->id_kuantitas_lain.'" onclick="deleteInput('.$v->id_kuantitas_lain.')"  style="width:10%;margin-left:5px" class="btn btn-danger"><i class="fa fa-trash"></i></a></div>';
    }
   }else{

   }
}

function getkuantitas_lain($id){
  $data = KuantitasLain::where('id_target',$id)->get();
  return $data;
}

function kuantitaslain($id){
  $data = KuantitasLain::where('id_target',$id)->get();
  if($data->count() > 0){
   foreach ($data as $i => $v) {
    print '<br>'.$v->kuantitas_lain.''.$v->satuan_lain.'<br>';
   }
  }else{

  }
}


function getChartBYunggulan($tahun){
  $data =  DB::table('tbl_program_unggulan')
  ->get();
  $target = DB::table('tbl_target')->where('target_tahun', $tahun)->get();
  $jumlahkegiatan = count($target);

  $result = array();
  foreach ($data as $key => $value) {
    $pagu =  DB::table('tbl_program_unggulan')
    ->join('tbl_program','tbl_program_unggulan.id_program_unggulan','tbl_program.id_program_unggulan')
    ->join('tbl_kegiatan','tbl_program.id_program','tbl_kegiatan.id_program')
    ->join('tbl_sub_kegiatan','tbl_kegiatan.id_kegiatan','tbl_sub_kegiatan.id_kegiatan')
    ->join('tbl_target','tbl_sub_kegiatan.id_sub_kegiatan','tbl_target.id_sub_kegiatan')
    ->where('tbl_target.target_tahun',$tahun)
    ->where('tbl_program_unggulan.id_program_unggulan',$value->id_program_unggulan)
    ->sum('pagu');

    $realisasi = DB::table('tbl_program_unggulan')
    ->join('tbl_program','tbl_program_unggulan.id_program_unggulan','tbl_program.id_program_unggulan')
    ->join('tbl_kegiatan','tbl_program.id_program','tbl_kegiatan.id_program')
    ->join('tbl_sub_kegiatan','tbl_kegiatan.id_kegiatan','tbl_sub_kegiatan.id_kegiatan')
    ->join('tbl_target','tbl_sub_kegiatan.id_sub_kegiatan','tbl_target.id_sub_kegiatan')
    ->join('tbl_realisasi','tbl_target.id','tbl_realisasi.id_target')
    ->where('tbl_target.target_tahun',$tahun)
    ->where('tbl_program_unggulan.id_program_unggulan',$value->id_program_unggulan)
    ->sum('realisasi_pagu');

    $target_kuantitas =  DB::table('tbl_program_unggulan')
    ->join('tbl_program','tbl_program_unggulan.id_program_unggulan','tbl_program.id_program_unggulan')
    ->join('tbl_kegiatan','tbl_program.id_program','tbl_kegiatan.id_program')
    ->join('tbl_sub_kegiatan','tbl_kegiatan.id_kegiatan','tbl_sub_kegiatan.id_kegiatan')
    ->join('tbl_target','tbl_sub_kegiatan.id_sub_kegiatan','tbl_target.id_sub_kegiatan')
    ->where('tbl_target.target_tahun',$tahun)
    ->where('tbl_program_unggulan.id_program_unggulan',$value->id_program_unggulan)
    ->sum('kuantitas');

    $realisasi_kuantitas = DB::table('tbl_program_unggulan')
    ->join('tbl_program','tbl_program_unggulan.id_program_unggulan','tbl_program.id_program_unggulan')
    ->join('tbl_kegiatan','tbl_program.id_program','tbl_kegiatan.id_program')
    ->join('tbl_sub_kegiatan','tbl_kegiatan.id_kegiatan','tbl_sub_kegiatan.id_kegiatan')
    ->join('tbl_target','tbl_sub_kegiatan.id_sub_kegiatan','tbl_target.id_sub_kegiatan')
    ->join('tbl_realisasi','tbl_target.id','tbl_realisasi.id_target')
    ->where('tbl_target.target_tahun',$tahun)
    ->where('tbl_program_unggulan.id_program_unggulan',$value->id_program_unggulan)
    ->sum('realisasi_kuantitas');

    $percentage = ($realisasi > 0 && $pagu > 0) ? (($realisasi / $pagu) * 100):0;
    $percentage_kuantitas = ($realisasi_kuantitas > 0 && $target_kuantitas > 0)? (($realisasi_kuantitas / $target_kuantitas) * 100):0;
    $d = [
      'program_unggulan'=>$value->nama_program_unggulan,
      'realisasi'=>($percentage > 100) ? '100%':round($percentage,2).'%',
      'kuantitas'=>($percentage_kuantitas > 100) ? '100%' : round($percentage_kuantitas,2).'%'
    ];

    array_push($result,$d);

  }

  print json_encode($result);

}


function getrealisasiKIA($tahun){
  $target = DB::table('tbl_target')->where('target_tahun', $tahun)->get();
  $tw = ['I','II','III','IV'];
  $result= array();
  $counttw1 = 0;
  $counttw2 = 0;
  $counttw3 = 0;
  $counttw4 = 0;

  $count_kuanttw1 = 0;
  $count_kuanttw2 = 0;
  $count_kuanttw3 = 0;
  $count_kuanttw4 = 0;
  $targets  = count($target);
  foreach ($target as $key => $v) {


    foreach($tw as $triwulan){
      $realisasi = DB::table('tbl_realisasi')
      ->join('tbl_target', 'tbl_target.id', 'tbl_realisasi.id_target')
      ->where('tbl_target.id', $v->id)
      ->where('triwulan',$triwulan)
      ->where('realisasi_tahun', $tahun)
      ->sum('realisasi_pagu');

      $realisasi_kuantitas = DB::table('tbl_realisasi')
      ->join('tbl_target', 'tbl_target.id', 'tbl_realisasi.id_target')
      ->where('tbl_target.id', $v->id)
      ->where('triwulan',$triwulan)
      ->where('realisasi_tahun', $tahun)
      ->sum('realisasi_kuantitas');


      $taret_kuantitas = $v->kuantitas;
      $target = $v->pagu;
      if ($target > 0) {
        $percentage = ($realisasi / $target) * 100;
        $percentage_k = ($realisasi_kuantitas / $taret_kuantitas) * 100;
      } else {
          $percentage = 0;
          $percentage_k = 0;
      }

      if($triwulan=='I'){
        $counttw1 +=$percentage;
        $count_kuanttw1 +=$percentage_k;
      }
      if($triwulan=='II'){
        $counttw2 +=$percentage;
        $count_kuanttw2 +=$percentage_k;
      }
      if($triwulan=='III'){
        $counttw3 +=$percentage;
        $count_kuanttw3 +=$percentage_k;
      }
      if($triwulan=='IV'){
        $counttw4 +=$percentage;
        $count_kuanttw4 +=$percentage_k;
      }

    }



  }
  $d = [
    [
    'triwulan' => 'TW I',
    'realisasi' => round(($counttw1 / $targets), 2) . '%',
    'kuantitas' => round(($count_kuanttw1 / $targets), 2) . '%',
    ],
    [
      'triwulan' => 'TW II',
      'realisasi' => round(($counttw2 / $targets), 2) . '%',
      'kuantitas' => round(($count_kuanttw2 / $targets), 2) . '%',
    ],
    [
      'triwulan' => 'TW III',
      'realisasi' => round(($counttw3 / $targets), 2) . '%',
      'kuantitas' => round(($count_kuanttw3 / $targets), 2) . '%',
    ],
    [
      'triwulan' => 'TW IV',
      'realisasi' => round(($counttw4 / $targets), 2) . '%',
      'kuantitas' => round(($count_kuanttw4 / $targets), 2) . '%',
    ]]
    ;

    $result = [];
    foreach ($d as $item) {
        $result[] = [
            'triwulan' => $item['triwulan'],
            'realisasi' => $item['realisasi'],
            'kuantitas' => $item['kuantitas'],
        ];
    }


  print json_encode($result);

}


function getpersenanggaranfromskpd($id,$tahun){
  try {

    $target = DB::table('tbl_target')->where('id_skpd', $id)->where('target_tahun', $tahun)->sum('pagu');
    $target_k = DB::table('tbl_target')->where('id_skpd', $id)->where('target_tahun', $tahun)->sum('kuantitas');
    $target = ($target != null) ? $target : 0;

    $realisasi = DB::table('tbl_realisasi')
        ->join('tbl_target', 'tbl_target.id', 'tbl_realisasi.id_target')
        ->where('tbl_realisasi.id_skpd', $id)
        ->where('realisasi_tahun', $tahun)
        ->sum('realisasi_pagu');

    $realisasi_k = DB::table('tbl_realisasi')
        ->join('tbl_target', 'tbl_target.id', 'tbl_realisasi.id_target')
        ->where('tbl_realisasi.id_skpd', $id)
        ->where('realisasi_tahun', $tahun)
        ->sum('realisasi_kuantitas');

    $realisasi = ($realisasi != null) ? $realisasi : 0;

    $persen = ($target != 0) ? ((($realisasi / $target) * 100) > 100)? 100 : ($realisasi / $target) * 100 : 0;
    $persenkinerja = ($target != 0) ? ((($realisasi_k / $target_k) * 100) > 100)? 100 : ($realisasi_k / $target_k) * 100 : 0;
    $data = [
      'persen'=>$persenkinerja,
      'anggaran'=>$persen
    ];
    return $data;

  } catch (\Throwable $th) {
    return $th->getmessage();
  }
}

function getDataGrafikBYTW($id,$tahun,$tw){
  try {
    $persenkinerja = 0;
    $persenanggaran = 0;
    $targetdata = DB::table('tbl_target')->where('id_skpd', $id)->where('target_tahun', $tahun)->get();
    foreach($targetdata as $i => $v){
      $target_k = $v->kuantitas;
      $target_a = $v->pagu;
      $realisasi_k = DB::table('tbl_realisasi')
        ->join('tbl_target', 'tbl_target.id', 'tbl_realisasi.id_target')
        ->where('tbl_realisasi.id_skpd', $id)
        ->where('realisasi_tahun', $tahun)
        ->where('id_target',$v->id)
        ->sum('realisasi_kuantitas');
        $hasil = (($realisasi_k / $target_k) * 100) > 100 ? 100 : ($realisasi_k / $target_k) * 100;
        $persenkinerja +=$hasil;


      $realisasi_a = DB::table('tbl_realisasi')
        ->join('tbl_target', 'tbl_target.id', 'tbl_realisasi.id_target')
        ->where('tbl_realisasi.id_skpd', $id)
        ->where('realisasi_tahun', $tahun)
        ->where('id_target',$v->id)
        ->sum('realisasi_pagu');

        $hasil_a = (($realisasi_a / $target_a) * 100) > 100 ? 100 : ($realisasi_a / $target_a) * 100;
        $persenanggaran +=$hasil_a;


    }


    $target = DB::table('tbl_target')->where('id_skpd', $id)->where('target_tahun', $tahun)->sum('pagu');
    $target = ($target != null) ? ($target/4) : 0;

    $realisasi = DB::table('tbl_realisasi')
        ->join('tbl_target', 'tbl_target.id', 'tbl_realisasi.id_target')
        ->where('tbl_realisasi.id_skpd', $id)
        ->where('triwulan',$tw)
        ->where('realisasi_tahun', $tahun)
        ->sum('realisasi_pagu');
    $realisasi = ($realisasi != null) ? $realisasi : 0;

    $persen = ($target != 0) ? ((($realisasi / $target) * 100) > 100)? 100 : ($realisasi / $target) * 100 : 0;
    $data = [
      'persen'=>$persenkinerja,
      'anggaran'=>$persenanggaran
    ];
    return $data;

  } catch (\Throwable $th) {
    return $th->getmessage();
  }
}

function tw4notarget($id,$tahap,$tahun){
  return DB::table('tbl_realisasi')->where('realisasi_tahun',$tahun)
          ->where('triwulan',$tahap)
          ->where('id_skpd',$id)
          ->sum('realisasi_pagu');
}
function tw1notarget($id,$tahap,$tahun){
  return DB::table('tbl_realisasi')->where('realisasi_tahun',$tahun)
          ->where('triwulan',$tahap)
          ->where('id_skpd',$id)
          ->sum('realisasi_pagu');
}
 function tw3notarget($id,$tahap,$tahun){
  return DB::table('tbl_realisasi')->where('realisasi_tahun',$tahun)
          ->where('triwulan',$tahap)
          ->where('id_skpd',$id)
          ->sum('realisasi_pagu');
}
 function tw2notarget($id,$tahap,$tahun){
  return DB::table('tbl_realisasi')->where('realisasi_tahun',$tahun)
          ->where('triwulan',$tahap)
          ->where('id_skpd',$id)
          ->sum('realisasi_pagu');
}

function listSKPDGrafik($tahun){

 $result = array();
  $skpd = DB::table('tbl_skpd')->join('tbl_target','tbl_target.id_skpd','tbl_skpd.id_skpd')->groupby('tbl_skpd.id_skpd')->get();
  foreach($skpd as $i =>$v){
    $tw_data = [
      'TW 1' => tw1notarget($v->id_skpd,'I',$tahun),
      'TW 2' => tw1notarget($v->id_skpd,'II',$tahun),
      'TW 3' => tw1notarget($v->id_skpd,'III',$tahun),
      'TW 4' => tw1notarget($v->id_skpd,'IV',$tahun)
    ];
    $data = [
      'nama_skpd' => $v->nama_skpd,
      'data_tw' => $tw_data
    ];
    array_push($result,$data);
  }

  return $result;

}



function get_kegiatan_lain($id){
  $data = KuantitasLain::where('id_target',$id)->get();
  if($data->count() > 0){
   foreach ($data as $i => $v) {
    return  '<br>'.$v->kuantitas_lain.' '.$v->satuan_lain.'<br>';
   }
  }else{

  }
}
function namaperiode($p){
  return DB::table('tbl_periode')->where('id_periode',$p)->first()->nama_periode;
}
function cek_tw($tahun,$skpd){
  $totalkeg =  cek_total_target_skpd($skpd,$tahun);

$cek = DB::table('tbl_realisasi')->where('id_skpd',$skpd)->where('realisasi_tahun',$tahun)->wherein('triwulan',['I','II','III','IV'])->get();
$data = array();
foreach(['I','II','III','IV'] as $r)
{
  if(count($cek->where('triwulan',$r)) == $totalkeg ){
    $i = "sudah";
  }else{
    $i = "belum";
  }
  array_push($data,['triwulan'=>$r,'status'=>$i]);
}
return json_decode(json_encode($data));
}
function cek_total_target_skpd($skpd,$tahun){
  return DB::table('tbl_target')->where('id_skpd',$skpd)->where('target_tahun',$tahun)->count();
}
function colorPrediket($nilai){
  return match (true) {
    $nilai <= 50.00 =>  'style="background-color: red;color: white;"',
    $nilai >= 51.00 && $nilai <=65.00 => 'style="background-color: #ee8585;color: white;"',
    $nilai > 65.00 && $nilai <=75.00 => 'style="background-color: #f39c12;color: white;"',
    $nilai > 75.00 && $nilai <=90.00 => 'style="background-color: #00bc8c;color: white;"',
    $nilai > 90.00 => 'style="background-color: #027759;color: white;"',
    default => 'style="background-color: #ee8585;color: white;"'
  };
}
function prediket($nilai){
return match (true) {
  $nilai <= 50.00 => 'Sangat Rendah',
  $nilai > 50.00 && $nilai <=65.00 => 'Rendah',
  $nilai > 65.00 && $nilai <=75.00 => 'Sedang',
  $nilai > 75.00 && $nilai <=90.00 => 'Tinggi',
  $nilai > 90.00  => 'Sangat Tinggi',
  default => 'N/A'
};
}
function findProgram($id){
  return Program::where('kode_program',$id)->first();
}
function get_programfromidunggulan($id,$tahun,$idskpd){
  return DB::table('tbl_program')->where('tbl_target.id_skpd',$idskpd)->where('id_program_unggulan',$id)->where('target_tahun',$tahun)

          ->join('tbl_kegiatan','tbl_kegiatan.id_program','tbl_program.id_program')
          ->join('tbl_sub_kegiatan','tbl_sub_kegiatan.id_kegiatan','tbl_kegiatan.id_kegiatan')
          ->join('tbl_target','tbl_target.id_sub_kegiatan','tbl_sub_kegiatan.id_sub_kegiatan')->groupby('nama_program')->get();
}

function getDataKegiatanByIdProgram($idprogram){
   return DB::table('tbl_kegiatan')->where('id_program',$idprogram)->where('id_skpd',session('id_skpd'))->groupby('id_kegiatan')->get();
}
function getDataSubKegiatanFromIdKegiatan($idkegiatan){
  return DB::table('tbl_sub_kegiatan')->where('id_kegiatan',$idkegiatan)->get();

}

function get_kegiatanone($id,$tahun,$idskpd,$idkegiatan,$idsub){
  $result = array();
  $v   = DB::table('tbl_program')->where('tbl_program.id_program',$id)->where('target_tahun',$tahun)
            ->where('tbl_target.id_skpd',$idskpd)
            ->where('tbl_kegiatan.id_kegiatan',$idkegiatan)
            ->where('tbl_sub_kegiatan.id_sub_kegiatan',$idsub)
            ->join('tbl_kegiatan','tbl_kegiatan.id_program','tbl_program.id_program')
            ->join('tbl_sub_kegiatan','tbl_sub_kegiatan.id_kegiatan','tbl_kegiatan.id_kegiatan')
            ->join('tbl_target','tbl_target.id_sub_kegiatan','tbl_sub_kegiatan.id_sub_kegiatan')->first();

        $tw1         = tw1($v->id,'I',$tahun);
        $tw2         = tw2($v->id,'II',$tahun);
        $tw3         = tw3($v->id,'III',$tahun);
        $tw4         = tw4($v->id,'IV',$tahun);
        //Realisasi Pagu
        $relpagutw1  = (!empty($tw1->realisasi_pagu)) ? $tw1->realisasi_pagu : 0;
        $relpagutw2  = (!empty($tw2->realisasi_pagu)) ? $tw2->realisasi_pagu : 0;
        $relpagutw3  = (!empty($tw3->realisasi_pagu)) ? $tw3->realisasi_pagu : 0;
        $relpagutw4  = (!empty($tw4->realisasi_pagu)) ? $tw4->realisasi_pagu : 0;
        //Realisasi kuantitas
        $relkuantw1 = (!empty($tw1->realisasi_kuantitas) && is_numeric($tw1->realisasi_kuantitas)) ? (int) $tw1->realisasi_kuantitas : 0;
        $relkuantw2 = (!empty($tw2->realisasi_kuantitas) && is_numeric($tw2->realisasi_kuantitas)) ? (int) $tw2->realisasi_kuantitas : 0;
        $relkuantw3 = (!empty($tw3->realisasi_kuantitas) && is_numeric($tw3->realisasi_kuantitas)) ? (int) $tw3->realisasi_kuantitas : 0;
        $relkuantw4 = (!empty($tw4->realisasi_kuantitas) && is_numeric($tw4->realisasi_kuantitas)) ? (int) $tw4->realisasi_kuantitas : 0;
        //END REALPAGU
        $totpagu      = $relpagutw1+$relpagutw2+$relpagutw3+$relpagutw4;
        $totkuantitas = $relkuantw1+$relkuantw2+$relkuantw3+$relkuantw4;
        $tcp_pagu     = ($totpagu/$v->pagu) * 100;
        $tcp_kuantitas= ($totkuantitas/$v->kuantitas) * 100;
        $da=[
        'nama_sub_kegiatan'=>$v->nama_sub_kegiatan,
        'nama_kegiatan'=>$v->nama_kegiatan,
        'kuantitas'=>$v->kuantitas,
        'satuan'=>$v->satuan,
        'pagu'=>$v->pagu,
        'id'=>$v->id,
        'tw1_kuantitas'=>(!empty($tw1->realisasi_kuantitas)) ? $tw1->realisasi_kuantitas : '',
        'tw1_rel_satuan'=>(!empty($tw1->realisasi_satuan)) ? $tw1->realisasi_satuan : '',
        'tw1_rel_pagu'=>(!empty($tw1->realisasi_pagu)) ? $tw1->realisasi_pagu : 0,
        'tw1_keterangan'=>(!empty($tw1->keterangan)) ? $tw1->keterangan : '',
        'tw1_kendala'=>(!empty($tw1->kendala)) ? $tw1->kendala : '',
        'tw1_tindakan'=>(!empty($tw1->tindakan))? $tw1->kendala : '',
        'tw1_rel_fisik'=>(!empty($tw1->rel_fisik))? $tw1->rel_fisik:'',
        'tw2_kuantitas'=>(!empty($tw2->realisasi_kuantitas)) ? $tw2->realisasi_kuantitas : '',
        'tw2_rel_satuan'=>(!empty($tw2->realisasi_satuan)) ? $tw2->realisasi_satuan : '',
        'tw2_rel_pagu'=>(!empty($tw2->realisasi_pagu)) ? $tw2->realisasi_pagu : 0,
        'tw2_keterangan'=>(!empty($tw2->keterangan)) ? $tw2->keterangan : '',
        'tw2_kendala'=>(!empty($tw2->kendala)) ? $tw2->kendala : '',
        'tw2_tindakan'=>(!empty($tw2->tindakan))? $tw2->kendala : '',
        'tw2_rel_fisik'=>(!empty($tw2->rel_fisik))? $tw2->rel_fisik:'',
        'tw3_kuantitas'=>(!empty($tw3->realisasi_kuantitas)) ? $tw3->realisasi_kuantitas : '',
        'tw3_rel_satuan'=>(!empty($tw3->realisasi_satuan)) ? $tw3->realisasi_satuan : '',
        'tw3_rel_pagu'=>(!empty($tw3->realisasi_pagu)) ? $tw3->realisasi_pagu : 0,
        'tw3_keterangan'=>(!empty($tw3->keterangan)) ? $tw3->keterangan : '',
        'tw3_kendala'=>(!empty($tw3->kendala)) ? $tw3->kendala : '',
        'tw3_tindakan'=>(!empty($tw3->tindakan))? $tw3->kendala : '',
        'tw3_rel_fisik'=>(!empty($tw3->rel_fisik))? $tw3->rel_fisik:'',
        'tw4_kuantitas'=>(!empty($tw4->realisasi_kuantitas)) ? $tw4->realisasi_kuantitas : '',
        'tw4_rel_satuan'=>(!empty($tw4->realisasi_satuan)) ? $tw4->realisasi_satuan : '',
        'tw4_rel_pagu'=>(!empty($tw4->realisasi_pagu)) ? $tw4->realisasi_pagu : 0,
        'tw4_keterangan'=>(!empty($tw4->keterangan)) ? $tw4->keterangan : '',
        'tw4_kendala'=>(!empty($tw4->kendala)) ? $tw4->kendala : '',
        'tw4_tindakan'=>(!empty($tw4->tindakan))? $tw4->kendala : '',
        'tw4_rel_fisik'=>(!empty($tw4->rel_fisik))? $tw4->rel_fisik:'',
        'tw1_id'=>(!empty($tw1->id_realisasi))? $tw1->id_realisasi : null,
        'tw2_id'=>(!empty($tw2->id_realisasi))? $tw2->id_realisasi : null,
        'tw3_id'=>(!empty($tw3->id_realisasi))? $tw3->id_realisasi : null,
        'tw4_id'=>(!empty($tw4->id_realisasi))? $tw4->id_realisasi : null,
        'totkuantitas'=>$totkuantitas,
        'totpagu'=>$totpagu,
        'tcp_pagu'=>$tcp_pagu,
        'tcp_kuantitas'=>$tcp_kuantitas,
       ];



    return $da;
}

function count_kegiatan($id,$tahun,$idskpd){
  return DB::table('tbl_program')->where('tbl_target.id_skpd',$idskpd)->where('id_program_unggulan',$id)->where('target_tahun',$tahun)
          ->join('tbl_kegiatan','tbl_kegiatan.id_program','tbl_program.id_program')
          ->join('tbl_sub_kegiatan','tbl_sub_kegiatan.id_kegiatan','tbl_kegiatan.id_kegiatan')
          ->join('tbl_target','tbl_target.id_sub_kegiatan','tbl_sub_kegiatan.id_sub_kegiatan')->count();
}

function get_kegiatan($id,$tahun,$idskpd){
  $result = array();
  $data   = DB::table('tbl_program')->where('tbl_program.id_program',$id)->where('target_tahun',$tahun)
            ->where('tbl_target.id_skpd',$idskpd)
            ->join('tbl_kegiatan','tbl_kegiatan.id_program','tbl_program.id_program')
            ->join('tbl_sub_kegiatan','tbl_sub_kegiatan.id_kegiatan','tbl_kegiatan.id_kegiatan')
            ->join('tbl_target','tbl_target.id_sub_kegiatan','tbl_sub_kegiatan.id_sub_kegiatan')->get();
            foreach ($data as $key => $v) {
        $tw1         = tw1($v->id,'I',$tahun);
        $tw2         = tw2($v->id,'II',$tahun);
        $tw3         = tw3($v->id,'III',$tahun);
        $tw4         = tw4($v->id,'IV',$tahun);
        //Realisasi Pagu
        $relpagutw1  = (!empty($tw1->realisasi_pagu)) ? $tw1->realisasi_pagu : 0;
        $relpagutw2  = (!empty($tw2->realisasi_pagu)) ? $tw2->realisasi_pagu : 0;
        $relpagutw3  = (!empty($tw3->realisasi_pagu)) ? $tw3->realisasi_pagu : 0;
        $relpagutw4  = (!empty($tw4->realisasi_pagu)) ? $tw4->realisasi_pagu : 0;
        //Realisasi kuantitas
        $relkuantw1 = (!empty($tw1->realisasi_kuantitas) && is_numeric($tw1->realisasi_kuantitas)) ? (int) $tw1->realisasi_kuantitas : 0;
        $relkuantw2 = (!empty($tw2->realisasi_kuantitas) && is_numeric($tw2->realisasi_kuantitas)) ? (int) $tw2->realisasi_kuantitas : 0;
        $relkuantw3 = (!empty($tw3->realisasi_kuantitas) && is_numeric($tw3->realisasi_kuantitas)) ? (int) $tw3->realisasi_kuantitas : 0;
        $relkuantw4 = (!empty($tw4->realisasi_kuantitas) && is_numeric($tw4->realisasi_kuantitas)) ? (int) $tw4->realisasi_kuantitas : 0;
        //END REALPAGU
        $totpagu      = $relpagutw1+$relpagutw2+$relpagutw3+$relpagutw4;
        $totkuantitas = $relkuantw1+$relkuantw2+$relkuantw3+$relkuantw4;
        $tcp_pagu     = ($totpagu/$v->pagu) * 100;
        $tcp_kuantitas= ($totkuantitas/$v->kuantitas) * 100;
        $da=[
        'nama_sub_kegiatan'=>$v->nama_sub_kegiatan,
        'nama_kegiatan'=>$v->nama_kegiatan,
        'kuantitas'=>$v->kuantitas,
        'satuan'=>$v->satuan,
        'pagu'=>$v->pagu,
        'id'=>$v->id,
        'tw1_kuantitas'=>(!empty($tw1->realisasi_kuantitas)) ? $tw1->realisasi_kuantitas : '',
        'tw1_rel_satuan'=>(!empty($tw1->realisasi_satuan)) ? $tw1->realisasi_satuan : '',
        'tw1_rel_pagu'=>(!empty($tw1->realisasi_pagu)) ? $tw1->realisasi_pagu : 0,
        'tw1_keterangan'=>(!empty($tw1->keterangan)) ? $tw1->keterangan : '',
        'tw1_kendala'=>(!empty($tw1->kendala)) ? $tw1->kendala : '',
        'tw1_tindakan'=>(!empty($tw1->tindakan))? $tw1->kendala : '',
        'tw2_kuantitas'=>(!empty($tw2->realisasi_kuantitas)) ? $tw2->realisasi_kuantitas : '',
        'tw2_rel_satuan'=>(!empty($tw2->realisasi_satuan)) ? $tw2->realisasi_satuan : '',
        'tw2_rel_pagu'=>(!empty($tw2->realisasi_pagu)) ? $tw2->realisasi_pagu : 0,
        'tw2_keterangan'=>(!empty($tw2->keterangan)) ? $tw2->keterangan : '',
        'tw2_kendala'=>(!empty($tw2->kendala)) ? $tw2->kendala : '',
        'tw2_tindakan'=>(!empty($tw2->tindakan))? $tw2->kendala : '',
        'tw3_kuantitas'=>(!empty($tw3->realisasi_kuantitas)) ? $tw3->realisasi_kuantitas : '',
        'tw3_rel_satuan'=>(!empty($tw3->realisasi_satuan)) ? $tw3->realisasi_satuan : '',
        'tw3_rel_pagu'=>(!empty($tw3->realisasi_pagu)) ? $tw3->realisasi_pagu : 0,
        'tw3_keterangan'=>(!empty($tw3->keterangan)) ? $tw3->keterangan : '',
        'tw3_kendala'=>(!empty($tw3->kendala)) ? $tw3->kendala : '',
        'tw3_tindakan'=>(!empty($tw3->tindakan))? $tw3->kendala : '',
        'tw4_kuantitas'=>(!empty($tw4->realisasi_kuantitas)) ? $tw4->realisasi_kuantitas : '',
        'tw4_rel_satuan'=>(!empty($tw4->realisasi_satuan)) ? $tw4->realisasi_satuan : '',
        'tw4_rel_pagu'=>(!empty($tw4->realisasi_pagu)) ? $tw4->realisasi_pagu : 0,
        'tw4_keterangan'=>(!empty($tw4->keterangan)) ? $tw4->keterangan : '',
        'tw4_kendala'=>(!empty($tw4->kendala)) ? $tw4->kendala : '',
        'tw4_tindakan'=>(!empty($tw4->tindakan))? $tw4->kendala : '',
        'tw1_id'=>(!empty($tw1->id_realisasi))? $tw1->id_realisasi : null,
        'tw2_id'=>(!empty($tw2->id_realisasi))? $tw2->id_realisasi : null,
        'tw3_id'=>(!empty($tw3->id_realisasi))? $tw3->id_realisasi : null,
        'tw4_id'=>(!empty($tw4->id_realisasi))? $tw4->id_realisasi : null,
        'totkuantitas'=>$totkuantitas,
        'totpagu'=>$totpagu,
        'tcp_pagu'=>$tcp_pagu,
        'tcp_kuantitas'=>$tcp_kuantitas,
       ];
       array_push($result,$da);
    }

    return (object)$result;
}

function tw4($id,$tahap,$tahun){
    return DB::table('tbl_realisasi')->where('realisasi_tahun',$tahun)
            ->where('triwulan',$tahap)
            ->where('id_target',$id)
            ->first();
  }
  function tw1($id,$tahap,$tahun){
    return DB::table('tbl_realisasi')->where('realisasi_tahun',$tahun)
            ->where('triwulan',$tahap)
            ->where('id_target',$id)
            ->first();
  }
   function tw3($id,$tahap,$tahun){
    return DB::table('tbl_realisasi')->where('realisasi_tahun',$tahun)
            ->where('triwulan',$tahap)
            ->where('id_target',$id)
            ->first();
  }
   function tw2($id,$tahap,$tahun){
    return DB::table('tbl_realisasi')->where('realisasi_tahun',$tahun)
            ->where('triwulan',$tahap)
            ->where('id_target',$id)
            ->first();
  }

function add_module($array){
  $data = config('app.menu');
  array_push($data,$array);
  config(['app.menu'=>$data]);
}
function nama_skpd($id,$val=false){
  $data = DB::table('tbl_skpd')->where('id_skpd', $id)->first();
  return $val ? $data->$val : $data->nama_skpd;
}
function page_name($name){
  config(['app.module'=>$name]);
}
function user($lev=false){
  if(Session::has('id_user')){
    $level = Session::get('level');
    if($lev){
      if($level == $lev){
        return true;
      }else {
        return Redirect::to('dashboard')->send();
      }
    }else {
    return DB::table('users')->where('id',Session::get('id_user'))->first();
  }
  }
}
function getTahun(){
  $data =['2022','2023','2024','2025'];
  return $data;
}
function getsubkegiatan($idskpd){
  return Subkegiatan::where('id_skpd',$idskpd)->join('tbl_kegiatan','tbl_kegiatan.id_kegiatan','tbl_sub_kegiatan.id_kegiatan')->get();
}
function getjenistarget(){
  $data=['awal','perubahan'];
  return $data;
}
function get_menu($name){
  $file = app_path('Menu/kaban.json');
  $fn = fopen($file,"r");
  $l = '';
  while(! feof($fn))  {
  $result = fgets($fn);
  $l .= $result;
  }
  fclose($fn);
  return json_decode(trim(str_replace(array("\r", "\n"), '',$l)));
}
function menuactive($req){
  if(is_array($req)){
  foreach ($req as $value) {
    if(Request::is('admin/'.$value)){
      return "menu-is-opening menu-open";
    }
  }
}else {
  if(Request::is('admin/'.$req)){
  return "active";
}
}
}

function en($val){
  return base64_encode($val);
}
function de($val){
  return base64_decode($val);
}

function modul($val){
if(isset(config('app.module')[$val])) {
  return config('app.module')[$val];
}
else {
  return 'undefined';
}
}

function sesiowner(){
 return match(session('level')){
    'kaban'=> 'Kepala Badan ',
    'skpd'=>  DB::table('tbl_skpd')->where('id_skpd',session('id_skpd'))->first()->nama_skpd,
    'admin'=>  'Administrator'
  };
}
function get_skpd($data){
  return App\Models\SkpdModel::wherein('id_skpd',explode(',',$data))->get();
}
function get_client_ip() {
  $ipaddress = '';
  if (isset($_SERVER['HTTP_CLIENT_IP']))
      $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
  else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
      $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
  else if(isset($_SERVER['HTTP_X_FORWARDED']))
      $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
  else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
      $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
  else if(isset($_SERVER['HTTP_FORWARDED']))
      $ipaddress = $_SERVER['HTTP_FORWARDED'];
  else if(isset($_SERVER['REMOTE_ADDR']))
      $ipaddress = $_SERVER['REMOTE_ADDR'];
  else
      $ipaddress = 'UNKNOWN';
  return $ipaddress;
}
function tglindo($val)
{

  $waktu = date('Y-m-d', strtotime($val));
    $hari_array = array(
        'Minggu',
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu'
    );
    $hr = date('w', strtotime($waktu));
    $hari = $hari_array[$hr];
    $tanggal = date('j', strtotime($waktu));
    $bulan_array = array(
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    );
    $bl = date('n', strtotime($waktu));
    $bulan = $bulan_array[$bl];
    $tahun = date('Y', strtotime($waktu));
    $jam = date( 'H:i:s', strtotime($val));

    //untuk menampilkan hari, tanggal bulan tahun jam
    //return "$hari, $tanggal $bulan $tahun $jam";

    //untuk menampilkan hari, tanggal bulan tahun
    return "$tanggal $bulan $tahun";
}
