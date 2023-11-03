<?php
namespace App;

use App\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\RealisasiDataNew;
class ExportExcel implements FromView
{
    public function __construct($skpd,$tahun,$trw)
    {

    $this->skpd = $skpd;
    $this->trw = $trw;
    $this->tahun = $tahun;
    }
    public function view(): View
    {   $d = new RealisasiDataNew;
        $rincian  = $d->get_detail_program($this->skpd,$this->tahun,$this->trw > 0 ? $this->trw : 1);
        // return $rincian;
        $trw = isset([1=>'I','II','III','IV'][$this->trw]) ? [1=>'I','II','III','IV'][$this->trw] : 'I';
        // $arr_triwulan = array(1=>'I','II','III','IV');
        // for($i=1;$i<=4; $i++):
        //     if($i > $triwulan){
        //         unset($arr_triwulan[$i]);
        //     }
        // endfor;
        // $pdf = PDF::loadView('back.admin.report.pdf_realisasi_skpd_new',compact('rincian','trw'))->setOption('page-width', '215')->setOption('page-height', '330')->setOrientation('landscape');
        // return Excel::download(new CardDb($desa,$tahap), $nm.'.xlsx');
        return view('back.admin.report.pdf_realisasi_skpd_new', [
            'rincian' => $rincian,
            'trw' => $trw
        ]);
    }
}
