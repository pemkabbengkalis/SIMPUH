<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Redirect;
use DB;
use App\Models\SkpdModel;
use App\Models\Periode;
use View;
class SkpdController extends Controller
{

  function __construct(SkpdModel $model){
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
    $this->view = 'back.admin.skpd.';
  }
  function skpd(){
    return view($this->view.'index',['data'=>$this->model->orderby('sort','asc')]);
  }
  //target skpd
  function cekpagutahun($tahun){
    $d = DB::table('tbl_target')->where('target_tahun',$tahun)->sum('pagu');
    return $d;
  }
  function updatepimpinan(Request $request){
    // $d = DB::table('tbl_target')->where('target_tahun',$tahun)->sum('pagu');
    // return $d;
    $data = DB::table('tbl_skpd')->where('id_skpd', session('id_skpd'))->first();
    if($request->submit){
      DB::table('tbl_skpd')->where('id_skpd', session('id_skpd'))->update([
        'nama_pimpinan'=>$request->nama,
        'nip_pimpinan'=>$request->nip,
        'tingkat_pimpinan'=>$request->tingkat,
      ]
      );
      return back()->with('success','Data Pimpinan Berhasil diupdate');
    }
    return view('back.settings.pimpinan',compact('data'));
  }
  function cekpaguskpd($tahun,$skpd){
    $d = DB::table('tbl_target')->where('target_tahun',$tahun)->where('id_skpd',$skpd)->sum('pagu');
    return $d;
  }
  function cekrealisasiskpd($tahun,$skpd){
    $d = DB::table('tbl_realisasi')->where('realisasi_tahun',$tahun)->where('id_skpd',$skpd)->sum('realisasi_pagu');
    return $d;
  }
  function cekrealisasitahun($tahun){
    $d = DB::table('tbl_realisasi')->where('realisasi_tahun',$tahun)->sum('realisasi_pagu');
    return $d;
  }
function realisasi(Periode $periode){
    View::share('periode',$periode->get());
    $data = array();
    $skpd = array();
    $kegiatan = array();
    if(request('periode')){
      $p = $periode->where('id_periode',request('periode'))->first();
      if(empty($p))
      return redirect('admin/realisasi-skpd');
      for($a=$p->tahun_mulai+1; $a<=$p->tahun_akhir; $a++){
        array_push($data,['tahun'=>$a,'pagu'=>$this->cekpagutahun($a),'realisasi'=>$this->cekrealisasitahun($a)]);
      }
      if(request('periode') && request('tahun')){
      $d = DB::table('tbl_target')->join('tbl_skpd','tbl_skpd.id_skpd','tbl_target.id_skpd')->where('tbl_target.target_tahun',request('tahun'))->groupby('tbl_target.id_skpd')->get();
      foreach($d as $r){
        array_push($skpd,['id_skpd'=>$r->id_skpd,'nama_skpd'=>$r->nama_skpd,'pagu'=>$this->cekpaguskpd(request('tahun'),$r->id_skpd),'realisasi'=>$this->cekrealisasiskpd(request('tahun'),$r->id_skpd)]);
      }
      }

      if(request('skpd')){
        $td = new \App\RealisasiData;
        return view('back.admin.realisasi.rincian',['rincian'=> $td->get_detail_program(request('skpd'),request('tahun'))]);
      }
    }
    return view('back.admin.realisasi.index',['data'=>json_decode(json_encode($data)),'skpd'=>json_decode(json_encode($skpd)),'kegiatan'=>json_decode(json_encode($kegiatan))]);
    return view('back.admin.realisasi.index');
}
  function target(Periode $periode){
    $data = array();
    $skpd = array();
    $kegiatan = array();
    View::share('periode',$periode->get());
    if(request('periode')){
      $p = $periode->where('id_periode',request('periode'))->first();
      if(empty($p))
      return redirect('admin/target-skpd');
      for($a=$p->tahun_mulai+1; $a<=$p->tahun_akhir; $a++){
        array_push($data,['tahun'=>$a,'pagu'=>$this->cekpagutahun($a)]);
      }
      if(request('periode') && request('tahun')){
      $d = DB::table('tbl_target')->join('tbl_skpd','tbl_skpd.id_skpd','tbl_target.id_skpd')->where('tbl_target.target_tahun',request('tahun'))->groupby('tbl_target.id_skpd')->get();
      foreach($d as $r){
        array_push($skpd,['id_skpd'=>$r->id_skpd,'nama_skpd'=>$r->nama_skpd,'pagu'=>$this->cekpaguskpd(request('tahun'),$r->id_skpd)]);
      }
      }

      if(request('skpd')){
        $td = new \App\TargetData;
      return view('back.admin.target.rincian',['rincian'=> $td->get_detail_program(request('skpd'),request('tahun'))]);
      }
    }
    return view('back.admin.target.index',['data'=>json_decode(json_encode($data)),'skpd'=>json_decode(json_encode($skpd)),'kegiatan'=>json_decode(json_encode($kegiatan))]);
  }
  function edit(Request $req, $id){

    $edit = $this->model->whereid(de($id))->first();
    if($req->submit){
      $this->model->edit(de($id),$req);
    }
    return view($this->view.'create',compact('edit'));
  }

  function delete($id){
    $this->model->remove(de($id));
  }

  function create(Request $req){
    if($req->submit){
      $this->model->input($req);
    }
  return view($this->view.'create');
  }

  function programskpd(Request $r){
    return view('back.skpd.program');
  }

}
