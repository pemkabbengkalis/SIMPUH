<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Redirect;
use App\Models\JenisSatuan;
use App\Models\Program;
use App\Models\Target;
use App\Models\Realisasi;
use View;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
class RealisasiSkpdController extends Controller
{
  function __construct(Target $model,Program $prog,Realisasi $realisasi){
    $this->middleware(function ($request, $next){
      if(!session()->has('id_user')) {
        return Redirect::to('admsimpuh')->send();
      }else {
        if(session()->get('level')!=config('app.module')['level'])
        return Redirect::to(session('level').'/dashboard')->send()->with('danger','Akses Ditolak');
      }
        return $next($request);
  });
    $this->model = $model;
    $this->rel   = $realisasi;
    $this->view = 'back.skpd.realisasi.';
    View::share('program',$prog);
  }
  function index(Request $r){
    $tahun = getTahun();
    $data  = array();
    $kegiatan = array();
    $result  = (object)$this->model->getdataall(Session::get('id_skpd'),(isset($_GET['periode'])?$_GET['periode']:date('Y')));
    foreach ($result as $key => $value) {
      array_push($data,$value);
    }





    return view('back.skpd.realisasi.index',compact('data'));
    //print json_encode($data);
  }

  function index2(Request $r){
    $tahun = getTahun();
    $data  = array();
    $kegiatan = array();
    $result  = (object)$this->model->listprogram(Session::get('id_skpd'),(isset($_GET['periode'])?$_GET['periode']:date('Y')));
    foreach ($result as $key => $value) {
      array_push($data,$value);
    }

    $tahuncatch = isset($_GET['periode'])?$_GET['periode']:date('Y');





    return view('back.skpd.realisasi.index2',compact('data','tahuncatch'));
    //print json_encode($data);
  }




 function tw4($id,$tahap,$tahun){
    return Realisasi::where('realisasi_tahun',$tahun)
            ->where('triwulan',$tahap)
            ->where('id_target',$id)
            ->first();
  }
  function tw1($id,$tahap,$tahun){
    return Realisasi::where('realisasi_tahun',$tahun)
            ->where('triwulan',$tahap)
            ->where('id_target',$id)
            ->first();
  }
   function tw3($id,$tahap,$tahun){
    return Realisasi::where('realisasi_tahun',$tahun)
            ->where('triwulan',$tahap)
            ->where('id_target',$id)
            ->first();
  }
   function tw2($id,$tahap,$tahun){
    return Realisasi::where('realisasi_tahun',$tahun)
            ->where('triwulan',$tahap)
            ->where('id_target',$id)
            ->first();
  }
  function update(Request $req){
    foreach($req->realisasi as $key => $vs) {
      // print 'Realisasi : '.$key.'<br>';
      // print 'Id Target : '.$req->idtarget[$key].'<br>';
      DB::table('tbl_realisasi')->where('id_realisasi',$req->id_realisasi[$key])->update([
          'id_target'=>$req->idtarget[$key],
          'id_skpd'=>Session::get('id_skpd'),
          'realisasi_tahun'=>$req->tahun[$key],
          'realisasi_bulan'=>$this->bulantahapan($req->tahapan[$key]),
          'realisasi_pagu'=>$vs,
          'realisasifisik'=>$req->realisasifisik[$key],
          'realisasi_kuantitas'=>$req->kuantitas[$key],
          'realisasi_satuan'=>$req->satuan[$key],
          'triwulan'=>$req->tahapan[$key],
          'keterangan'=>$req->keterangan[$key],
          'kendala'=>$req->kendala[$key],
          'tindakan'=>$req->tindakan[$key],
      ]);
    }

    return back()->with('success',' Data berhasil diupdate');

  }

  function delete($id){
    try {
      Target::where('id',base64_decode($id))->delete();
      return back()->with('success','Data berhasil dihapus');
    } catch (\Throwable $th) {
      return back()->with('danger',$th->getmessage());
    }

  }


  function realisasiganda($id){
    $target = DB::table('tbl_target')->where('id',base64_decode($id))->first();
    $tw1    = Realisasi::where('triwulan','I')
              ->where('id_target',base64_decode($id))
              ->first();
    $tw2    = Realisasi::where('triwulan','II')
              ->where('id_target',base64_decode($id))
              ->first();
    $tw3    = Realisasi::where('triwulan','III')
              ->where('id_target',base64_decode($id))
              ->first();
    $tw4    = Realisasi::where('triwulan','IV')
              ->where('id_target',base64_decode($id))
              ->first();

    return view('back.skpd.realisasi.inputrealisasi',compact('target','tw1','tw2','tw3','tw4'));
  }

  function create(Request $req){
    $validator = Validator::make($req->all(), [
        'idtarget.*' => 'required',
        'tahun.*' => 'required',
        'tahapan.*' => 'required',
        'realisasi.*' => 'required',
        'kuantitas.*' => 'required',
        'satuan.*' => 'required',
        // Add other validation rules for your fields
    ]);

    if ($validator->fails()) {
        return back()
            ->withErrors($validator)
            ->withInput();
    }

    foreach($req->realisasi as $key => $vs) {
    $check = DB::table('tbl_realisasi')->where('id_target',$req->idtarget[$key])
                                ->where('id_skpd',Session::get('id_skpd'))
                                ->where('realisasi_tahun',$req->tahun[$key])
                                ->where('triwulan',$req->tahapan[$key])
                                ->count();
        if($check == 0){
                DB::table('tbl_realisasi')->insert([
                    'id_target'=>$req->idtarget[$key],
                    'id_skpd'=>Session::get('id_skpd'),
                    'realisasi_tahun'=>$req->tahun[$key],
                    'realisasi_bulan'=>$this->bulantahapan($req->tahapan[$key]),
                    'realisasi_pagu'=>$vs,
                    'realisasi_kuantitas'=>$req->kuantitas[$key],
                    'realisasi_satuan'=>$req->satuan[$key],
                    'triwulan'=>$req->tahapan[$key],
                    'keterangan'=>$req->keterangan[$key],
                    'kendala'=>$req->kendala[$key],
                    'tindakan'=>$req->tindakan[$key],
                ]);
            }
    }
    return back()->with('success','Data berhasil diupdate');
  }
//   function create(Request $req){
//     // if($req->submit){
//     //   return $this->rel->input($req);
//     // }else{
//     //   return back();
//     // }
//     foreach($req->realisasi as $key => $vs) {
//       // print 'Realisasi : '.$key.'<br>';
//       // print 'Id Target : '.$req->idtarget[$key].'<br>';
//       DB::table('tbl_realisasi')->insert([
//           'id_target'=>$req->idtarget[$key],
//           'id_skpd'=>Session::get('id_skpd'),
//           'realisasi_tahun'=>$req->tahun[$key],
//           'realisasi_bulan'=>$this->bulantahapan($req->tahapan[$key]),
//           'realisasi_pagu'=>$vs,
//           'realisasi_kuantitas'=>$req->kuantitas[$key],
//           'realisasi_satuan'=>$req->satuan[$key],
//           'triwulan'=>$req->tahapan[$key],
//           'keterangan'=>$req->keterangan[$key],
//           'kendala'=>$req->kendala[$key],
//           'tindakan'=>$req->tindakan[$key],
//       ]);
//     }



//     // if($req->has('kuantitas_rck') && $req->has('dana_rck') && $req->has('kuantitas_tcp') && $req->has('dana_tcp')){
//     //   $data = [
//     //     ''
//     //   ]
//     // }

//     return back()->with('success',' Data berhasil diupdate');

//   }


  function createganda(Request $req){
    if($req->has('id_realisasi')){

      $kuantitas = implode(',',$req->kuantitas);
      $satuan    = implode(',',$req->satuan);
      try {
        DB::table('tbl_realisasi')->where('id_realisasi',$req->id_realisasi)->update([
          'id_target'=>$req->idtarget,
          'id_skpd'=>Session::get('id_skpd'),
          'realisasi_tahun'=>$req->tahun,
          'realisasi_bulan'=>$this->bulantahapan($req->tahapan),
          'realisasi_pagu'=>$req->realisasi,
          'realisasi_kuantitas'=>$kuantitas,
          'realisasi_satuan'=>$satuan,
          'triwulan'=>$req->tahapan,
          'keterangan'=>$req->keterangan,
          'kendala'=>$req->kendala,
          'tindakan'=>$req->tindakan
      ]);
      return back()->with('success',' Data berhasil diupdate');
      } catch (\Throwable $th) {
        return back()->with('danger',$th->getMessage());
      }

    }else{
      $kuantitas = implode(',',$req->kuantitas);
      $satuan    = implode(',',$req->satuan);

    // print $kuantitas;
    // print $satuan;
    // print $req->idtarget.'<br>';
    // print $req->tahun.'<br>';
    // print $req->realisasi.'<br>';
    // print $req->tahapan.'<br>';
    // print $req->keterangan.'<br>';
    // print $req->kendala.'<br>';
    try {
      DB::table('tbl_realisasi')->insert([
        'id_target'=>$req->idtarget,
        'id_skpd'=>Session::get('id_skpd'),
        'realisasi_tahun'=>$req->tahun,
        'realisasi_bulan'=>$this->bulantahapan($req->tahapan),
        'realisasi_pagu'=>$req->realisasi,
        'realisasi_kuantitas'=>$kuantitas,
        'realisasi_satuan'=>$satuan,
        'triwulan'=>$req->tahapan,
        'keterangan'=>$req->keterangan,
        'kendala'=>$req->kendala,
        'tindakan'=>$req->tindakan
    ]);
    return back()->with('success',' Data berhasil diupdate');
    } catch (\Throwable $th) {
      return back()->with('danger',$th->getMessage());
    }
    }



  }



  function bulantahapan($data){
    if($data=='I'){
        return '01';
    }elseif ($data=='II') {
        return '04';
    }
    elseif ($data=='III') {
        return '07';
    }elseif ($data=='IV') {
        return '10';
    }
}

}
