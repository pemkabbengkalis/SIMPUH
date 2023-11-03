<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Redirect;
use App\Models\JenisSatuan;
use App\Models\PD;
use DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!session()->has('id_user')) {
                return Redirect::to('admsimpuh')->send();
            } else {
                if (session()->get('level') != config('app.module')['level']) {
                    return Redirect::to(session('level') . '/dashboard')
                        ->send()
                        ->with('danger', 'Akses Ditolak');
                }
            }
            return $next($request);
        });
    }
    function dashboard(Request $r)
    {
        $tahun = (isset($_GET['tahun'])) ? $_GET['tahun'] : date('Y');
        $jmlhPrgUngg = DB::table('tbl_program_unggulan')->count();
        $semuaTargetSKPD = DB::table('tbl_kegiatan')->count();
        $semuaRealisasiSKPD = DB::table('tbl_realisasi')->where('realisasi_tahun',$tahun)->sum('realisasi_pagu');
        $TargetSKPD = DB::table('tbl_target')->where('target_tahun',$tahun)->sum('pagu');
        $semuaKegiatanSKPD = DB::table('tbl_kegiatan')->count();

        // untuk mendapatkan persentase
        $result_anggaran = array();
        $skpd = DB::table('tbl_skpd')->join('tbl_target','tbl_target.id_skpd','tbl_skpd.id_skpd')->groupby('tbl_skpd.id_skpd')->get();
        foreach ($skpd as $i => $v) {
            $persen = getpersenanggaranfromskpd($v->id_skpd,$tahun);
            $data_skpd = [
                'nama_skpd'=>$v->nama_skpd,
                'persenkinerja'=>$persen['persen'],
                'anggaran'=>$persen['anggaran']
            ];
            array_push($result_anggaran,$data_skpd);
            
        }
        usort($result_anggaran, function ($a, $b) {
            return $b['persenkinerja'] - $a['persenkinerja'];
        });
        $anggaranpersen = $result_anggaran;
            
        $periode = self::getTahun();
        $tahun = DB::table('tbl_tahun')->get();

        $program =  DB::table('tbl_program_unggulan')->get();
        $th = (isset($_GET['tahun'])) ? $_GET['tahun']:date('Y');

        if (Session::get('level') == 'skpd') {
            return view('back.skpd.dashboard');
        } else {
            // dd($pembanding);
            return view('back.index', compact('TargetSKPD','th','program','jmlhPrgUngg', 'semuaTargetSKPD', 'semuaRealisasiSKPD', 'semuaKegiatanSKPD', 'anggaranpersen', 'tahun', 'periode'));
        }
    }
    function skpd()
    {
        return view('back.admin.skpd.index');
    }
    function skpd_create()
    {
        return view('back.admin.skpd.index');
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
}
