<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Redirect;
use App\Models\JenisSatuan;
use App\Models\PD;
use DB;
use Carbon\Carbon;
class AdminSkpdController extends Controller
{
  function __construct(){
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

  // dashbord count
  $jmlhPrgUngg = DB::table('tbl_program_unggulan')->count();
  $targetSKPD = DB::table('tbl_target')->where('id_skpd',Session::get('id_skpd'))->count();
  $jmlahRealisasiSKPD = DB::table('tbl_realisasi')->where('id_skpd',Session::get('id_skpd'))->sum('realisasi_pagu');
  $jmlahKegiatanSKPD = DB::table('tbl_kegiatan')->where('id_skpd',Session::get('id_skpd'))->count();

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
  
if(Session::get('level')=='skpd'){
          // dd($persentase);
          return view('back.skpd.dashboard', compact('jmlhPrgUngg', 'targetSKPD','jmlahRealisasiSKPD', 'jmlahKegiatanSKPD','persentase', 'tahun', 'periode'));
        }else{
          return view('back.index');  
        }

}
function skpd(){
  return view('back.admin.skpd.index');
}
function skpd_create(){
  return view('back.admin.skpd.index');
}

function getTahun()
    {
        if (!isset($_GET['tahun'])) {
            $pembanding = Carbon::now()->isoFormat('Y');
        } else {
            $pembanding = $_GET['tahun'];
        }
        return $pembanding;
    }
}
