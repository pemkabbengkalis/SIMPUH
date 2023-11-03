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
  function index(){
    $tahun = getTahun();
    $data  = $this->model->getdata(Session::get('id_skpd'));
    $result = array();
    foreach ($data as $key => $v) {
        $tw1         = $this->tw1($v->id,'I',date('Y'));
        $tw2         = $this->tw2($v->id,'II',date('Y'));
        $tw3         = $this->tw3($v->id,'III',date('Y'));
        $tw4         = $this->tw4($v->id,'IV',date('Y'));
        //Realisasi Pagu
        $relpagutw1  = (!empty($tw1->realisasi_pagu)) ? $tw1->realisasi_pagu : 0;
        $relpagutw2  = (!empty($tw2->realisasi_pagu)) ? $tw2->realisasi_pagu : 0;
        $relpagutw3  = (!empty($tw3->realisasi_pagu)) ? $tw3->realisasi_pagu : 0;
        $relpagutw4  = (!empty($tw4->realisasi_pagu)) ? $tw4->realisasi_pagu : 0;
        //Realisasi kuantitas
        $relkuantw1  = (!empty($tw1->realisasi_kuantitas)) ? (int) $tw1->realisasi_kuantitas : 0;
        $relkuantw2  = (!empty($tw2->realisasi_kuantitas)) ? $tw2->realisasi_kuantitas : 0;
        $relkuantw3  = (!empty($tw3->realisasi_kuantitas)) ? $tw3->realisasi_kuantitas : 0;
        $relkuantw4  = (!empty($tw4->realisasi_kuantitas)) ? $tw4->realisasi_kuantitas : 0;
        //END REALPAGU
        $totpagu      = $relpagutw1+$relpagutw2+$relpagutw3+$relpagutw4;
        $totkuantitas = $relkuantw1+$relkuantw2+$relkuantw3+$relkuantw4;
        $tcp_pagu     = ($totpagu/$v->pagu) * 100;
        $tcp_kuantitas= ($totkuantitas/$v->kuantitas) * 100;
        $da=[
        'nama_sub_kegiatan'=>$v->nama_sub_kegiatan,
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
    //return $result;
    return view($this->view.'index',compact('result','tahun'));
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
    if($req->submit){
      return $this->rel->updaterel($req);
    }else{
      return back();
    }
    
  }

  function delete($id){
    try {
      Target::where('id',base64_decode($id))->delete();
      return back()->with('success','Data berhasil dihapus');
    } catch (\Throwable $th) {
      return back()->with('danger',$th->getmessage());
    }
    
  }

  function create(Request $req){
    if($req->submit){
      return $this->rel->input($req);
    }else{
      return back();
    }
    
  }

}
