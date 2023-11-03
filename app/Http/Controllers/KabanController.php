<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Redirect;
use App\Models\JenisSatuan;
use App\Models\Periode;
use App\Models\PD;
use DB;
use View;
use Carbon\Carbon;

class KabanController extends Controller
{
public function __construct(){

  $this->middleware(function ($request, $next){
    if(!session()->has('id_user')) {
      return Redirect::to('admsimpuh')->send();
    }else {
      if(session()->get('level')!=config('app.module')['level'])
      return Redirect::to(session('level').'/dashboard')->send()->with('danger','Akses Ditolak');
    }
      return $next($request);
});
}
function dashboard(){
  $jmlhPrgUngg = DB::table('tbl_program_unggulan')->count();
  $semuaTargetSKPD = DB::table('tbl_target')->count();
  $semuaRealisasiSKPD = DB::table('tbl_realisasi')->sum('realisasi_pagu');
  $semuaKegiatanSKPD = DB::table('tbl_kegiatan')->count();

  // untuk mendapatkan persentase
  $persentase = DB::table('tbl_skpd')
            ->select('tbl_skpd.id_skpd', 'tbl_skpd.nama_skpd', 'tbl_realisasi.realisasi_pagu', 'tbl_target.pagu', 'tbl_realisasi.realisasi_tahun', 'tbl_target.target_tahun' ,DB::raw('SUM(tbl_realisasi.realisasi_pagu) as total_realisasi_pagu'))
            ->where('tbl_target.target_tahun', '=' , self::getTahun())
            ->where('tbl_realisasi.realisasi_tahun', '=' , self::getTahun())
            ->join('tbl_target', 'tbl_target.id_skpd', '=', 'tbl_skpd.id_skpd')
            ->join('tbl_realisasi', 'tbl_realisasi.id_target', '=', 'tbl_target.id')
            ->groupBy('tbl_skpd.id_skpd')
            ->orderBy('total_realisasi_pagu', 'DESC')
            ->get();

  $periode = self::getTahun();
  $tahun = DB::table('tbl_tahun')->get();

return view('back.kaban.dashboard', compact('jmlhPrgUngg', 'semuaTargetSKPD', 'semuaRealisasiSKPD', 'semuaKegiatanSKPD', 'persentase', 'periode', 'tahun'));

}
static function getTahun()
    {
        if (!isset($_GET['tahun'])) {
            $pembanding = Carbon::now()->isoFormat('Y');
        } else {
            $pembanding = $_GET['tahun'];
        }
        return $pembanding;
    }
function cekpagutahun($tahun){
  $d = DB::table('tbl_target')->where('target_tahun',$tahun)->sum('pagu');
  return $d;
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
    return redirect('kaban/realisasi-skpd');
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
      return view('back.kaban.realisasi.rincian',['rincian'=> $td->get_detail_program(request('skpd'),request('tahun'))]);
    }
  }
  return view('back.kaban.realisasi.index',['data'=>json_decode(json_encode($data)),'skpd'=>json_decode(json_encode($skpd)),'kegiatan'=>json_decode(json_encode($kegiatan))]);
  return view('back.kaban.realisasi.index');
}
}
