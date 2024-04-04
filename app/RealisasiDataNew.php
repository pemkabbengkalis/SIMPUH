<?php
namespace App;
use DB;
use PDF;
use Hash;
use ExcelExport;
use Excel;
use Request;
use Str;
class RealisasiDataNew
{
    function cetak_realisasi_skpd($skpd=null,$tahun=null,$trws=null){
        $trw = isset([1=>'I','II','III','IV'][$trws]) ? [1=>'I','II','III','IV'][$trws] : 'none';

        if(request()->toexcel){
            return Excel::download(new ExportExcel($skpd,$tahun,$trw), Str::slug(nama_skpd($skpd).'-triwulan-'.$trw.'-'.$tahun).'.xlsx');
        }
        $rincian  = self::get_detail_program($skpd,$tahun,$trws);
        // if(get_client_ip()=='103.231.115.123'){
        // return $rincian;

        // }
        // return $rincian;
        // $arr_triwulan = array(1=>'I','II','III','IV');
        // for($i=1;$i<=4; $i++):
        //     if($i > $triwulan){
        //         unset($arr_triwulan[$i]);
        //     }
        // endfor;
        if(request()->exc){
            return view('back.admin.report.pdf_realisasi_skpd_new', compact('rincian', 'trw'));
        }
        $pdf = PDF::loadView('back.admin.report.pdf_realisasi_skpd_new',compact('rincian','trw'))->setOption('page-width', '215')->setOption('page-height', '330')->setOption('footer-font-size','7')->setOption('footer-right', 'Evaluasi Program Unggulan Kabupaten Bengkalis | Halaman [page] dari [topage]')->setOrientation('landscape');
        return $pdf->stream('REALISASI TRIWULAN '.$trw.' '.nama_skpd($skpd).'.pdf');
        // Pdf::loadHTML($html)->setPaper('a4', 'landscape')->setWarnings(false)->save('myfile.pdf')
    }
    function get_detail_program($id_skpd, $tahun, $triwulan)
    {

        $ku = array();
        $arr_triwulan = array(1 => 'I', 'II', 'III', 'IV');
        for ($i = 1; $i <= 4; $i++):
            if ($i > $triwulan) {
                unset($arr_triwulan[$i]);
            }
        endfor;
        $q_program = DB::table('tbl_target')
            ->join('tbl_sub_kegiatan', 'tbl_target.id_sub_kegiatan', 'tbl_sub_kegiatan.id_sub_kegiatan')
            ->join('tbl_kegiatan', 'tbl_kegiatan.id_kegiatan', 'tbl_sub_kegiatan.id_kegiatan')
            ->join('tbl_program', 'tbl_program.id_program', 'tbl_kegiatan.id_program')
            ->join('tbl_program_unggulan', 'tbl_program_unggulan.id_program_unggulan', 'tbl_program.id_program_unggulan')
            ->where('tbl_target.id_skpd', $id_skpd)
            ->where('tbl_target.target_tahun', $tahun)
            ->select('tbl_program.nama_program', 'tbl_program.id_program', 'tbl_program_unggulan.nama_program_unggulan')
            ->groupby('tbl_program.id_program')->get();

        $data['data'] = array();
        $data['target'] = 0;
        foreach ($arr_triwulan as $ar):
            $data[$ar] = 0;
        endforeach;
        $data['evaluasi'] = 0;
        $data['persen_k'] = 0.0;
        $data['persen_rp'] = 0.0;
        foreach ($q_program as $r) {
            $a['nama_program_unggulan'] = $r->nama_program_unggulan;
            $a['nama_program'] = $r->nama_program;
            $a['target_rp'] = 0;
            $a['evaluasi'] = 0;
            $a['kegiatan'] = array();
            $a['realisasi'] = array();
            $a['total_sub'] = 0;
            $a['persen_k'] = 0.0;
            $a['persen_rp'] = 0.0;


            foreach ($this->get_kegiatan($r->id_program, $id_skpd, $tahun) as $r2) {
                $d['nama_kegiatan'] = $r2->nama_kegiatan;
                $d['target_rp'] = 0;
                $d['evaluasi'] = 0;
                $d['sub_kegiatan'] = array();
                $tr = array();
                $d['realisasi'] = null;
                foreach ($this->get_sub_kegiatan($r2->id_kegiatan, $tahun) as $r3) {
                    $qsbk = $this->get_target_sub_kegiatan($r3->id_sub_kegiatan, $tahun);
                    $b['nama_sub_kegiatan'] = $r3->nama_sub_kegiatan;
                    $b['satuan'] = $qsbk['satuan'];
                    $b['kuantitas'] = $qsbk['kuantitas'];
                    $b['target_rp'] = $qsbk['rp'];
                    $b['evaluasi'] = 0;
                    $b['persen_kuantitas'] = 0.0;
                    $b['persen_pagu'] = 0.0;


                    $b['evaluasi_kuantitas'] = 0;
                    $a['total_sub']++;

                    $b['kendala'] = array();
                    $b['tindakan'] = array();
                    $d['target_rp'] = $qsbk['rp'] + $d['target_rp'];
                    $reali = array();
                    $b['realisasi'] = array();
                    foreach ($arr_triwulan as $real) {
                        $rl = $this->get_realisasi_triwulan($qsbk['id_target'], $real, $qsbk['satuan']);
                        array_push($b['realisasi'], $rl);
                        $b['evaluasi'] = $b['evaluasi'] + $this->get_realisasi_triwulan($qsbk['id_target'], $real, $qsbk['satuan'])['pagu'];
                        $d['evaluasi'] = $d['evaluasi'] + $this->get_realisasi_triwulan($qsbk['id_target'], $real, $qsbk['satuan'])['pagu'];
                        array_push($tr, ['triwulan' => $real, 'pagu' => $this->get_realisasi_triwulan($qsbk['id_target'], $real, $qsbk['satuan'])['pagu']]);


                        $b['persen_kuantitas'] = Str::contains($qsbk['kuantitas'],',') ? 0 : $b['persen_kuantitas'] + round($this->get_realisasi_triwulan($qsbk['id_target'], $real, $qsbk['satuan'])['kuantitas'] /  $qsbk['kuantitas'] * 100,2);

                        $b['persen_pagu'] = $b['persen_pagu'] + round($this->get_realisasi_triwulan($qsbk['id_target'], $real, $qsbk['satuan'])['pagu'] / $qsbk['rp'] * 100,2);
                        $b['persen_kuantitas'] = $b['persen_kuantitas'] > 100 ? 100 : $b['persen_kuantitas'];
                        $b['persen_pagu'] = $b['persen_pagu'] > 100 ? 100 : $b['persen_pagu'];
                        $ek = $this->get_realisasi_triwulan($qsbk['id_target'],$real,$qsbk['satuan'])['kuantitas'];
                        $b['evaluasi_kuantitas'] = $b['evaluasi_kuantitas'] + (strpos($ek, ',') !== false ? 0 : $ek);
                        array_push($b['kendala'], $this->get_realisasi_triwulan($qsbk['id_target'], $real, $qsbk['satuan'])['kendala']);
                        array_push($b['tindakan'], $this->get_realisasi_triwulan($qsbk['id_target'], $real, $qsbk['satuan'])['tindakan']);
                    }
                    array_push($d['sub_kegiatan'], $b);
                    $a['persen_k'] = $a['persen_k'] + $b['persen_kuantitas'];
                    $a['persen_rp'] = $a['persen_rp'] + $b['persen_pagu'];
                    // $a['persen_k'] = $a['persen_k'] > 100 ? 100 : $a['persen_k'];
                }

                foreach ($arr_triwulan as $ar):
                    $trw[$ar] = 0;
                endforeach;
                foreach ($tr as $v) {
                    foreach (array('I', 'II', 'III', 'IV') as $bn) {
                        if ($bn == $v['triwulan']) {
                            $trw[$bn] = $trw[$bn] + $v['pagu'];
                            $data[$bn] = $data[$bn] + $v['pagu'];
                            $data['evaluasi'] = $data['evaluasi'] + $v['pagu'];
                        }
                    }
                }
                $a['realisasi'] = $a['realisasi'] + $trw;
                $d['realisasi'] = $trw;
                // $a['evaluasi'] = $a['evaluasi'] +$trw['I'] ?? 0 + $trw['II'] ?? 0 + $trw['III'] ?? 0 + $trw['IV'] ?? 0;
                $a['target_rp'] = $d['target_rp'] + $a['target_rp'];
                array_push($a['kegiatan'], $d);
                $a['evaluasi'] += $d['evaluasi'];
            }
            $data['target'] = $data['target'] + $a['target_rp'];
            // Tes 0,0
            $data['persen_k'] = $data['persen_k'] + $a['persen_k'];
            $data['persen_rp'] = $data['persen_rp']+$a['persen_rp'] ;
            //End Tes 0,0
            array_push($data['data'], $a);
        }
        return json_decode(json_encode($data));
    }
    function get_realisasi_triwulan($id_target,$triwulan,$satuan){
        $q = DB::table('tbl_realisasi')->where('id_target',$id_target)->where('triwulan',$triwulan)->first();
        $trg = \App\Models\Target::with('kuantitas_lain')->whereId($id_target)->first();
        $kuantitas = $trg->kuantitas_lain()->exists() ? 0 : ($q->realisasi_kuantitas ?? 0);
        // $satuan = $q->kuantitas_lain()->exists() ? $q->satuan . ',' . $q->kuantitas_lain->satuan_lain : $q->satuan;
        return $q ? ['satuan'=>$satuan,'kuantitas'=>$kuantitas,'pagu'=>$q->realisasi_pagu,'triwulan'=>$triwulan,'kendala'=>$q->kendala,'tindakan'=>$q->tindakan] : ['satuan'=>null,'kuantitas'=>null,'pagu'=>null,'triwulan'=>$triwulan,'kendala'=>null,'tindakan'=>null];
    }
    function get_kegiatan($id_program,$id_skpd,$tahun){
        $q = DB::table('tbl_target')
        ->join('tbl_sub_kegiatan','tbl_target.id_sub_kegiatan','tbl_sub_kegiatan.id_sub_kegiatan')
        ->join('tbl_kegiatan','tbl_kegiatan.id_kegiatan','tbl_sub_kegiatan.id_kegiatan')
        ->join('tbl_program','tbl_program.id_program','tbl_kegiatan.id_program')
        ->where('tbl_target.id_skpd',$id_skpd)
        ->where('tbl_program.id_program',$id_program)
        ->where('tbl_target.target_tahun',$tahun)
        ->select('tbl_kegiatan.nama_kegiatan','tbl_kegiatan.id_kegiatan')
        ->groupby('tbl_kegiatan.id_kegiatan')->get();
        return $q;
    }

    function get_sub_kegiatan($id_kegiatan,$tahun){
        $q = DB::table('tbl_target')
        ->join('tbl_sub_kegiatan','tbl_target.id_sub_kegiatan','tbl_sub_kegiatan.id_sub_kegiatan')
        ->join('tbl_kegiatan','tbl_kegiatan.id_kegiatan','tbl_sub_kegiatan.id_kegiatan')
        ->join('tbl_program','tbl_program.id_program','tbl_kegiatan.id_program')
        ->where('tbl_kegiatan.id_kegiatan',$id_kegiatan)
        ->where('tbl_target.target_tahun',$tahun)
        ->select('tbl_sub_kegiatan.nama_sub_kegiatan','tbl_sub_kegiatan.id_sub_kegiatan')
        ->get();
        return $q;
    }

    function get_target_sub_kegiatan($id_sub_kegiatan,$tahun){
        $q = \App\Models\Target::with('kuantitas_lain')
        ->where('id_sub_kegiatan',$id_sub_kegiatan)
        ->where('target_tahun',$tahun)
        ->first();
        $kuantitas = $q->kuantitas_lain()->exists() ? $q->kuantitas . ',' . $q->kuantitas_lain->kuantitas_lain : $q->kuantitas;
        $satuan = $q->kuantitas_lain()->exists() ? $q->satuan . ',' . $q->kuantitas_lain->satuan_lain : $q->satuan;
        return array('satuan'=>$satuan,'kuantitas'=>$kuantitas,'rp'=>$q->pagu,'id_target'=>$q->id);
    }

    function cekoma($s){
        if( strpos(',', $s) !== false ) {
            return true;
       }
    }
}
