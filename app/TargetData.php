<?php
namespace App;
use DB;
class TargetData
{
    function get_detail_program($id_skpd,$tahun){
        $q_program = DB::table('tbl_target')
        ->join('tbl_sub_kegiatan','tbl_target.id_sub_kegiatan','tbl_sub_kegiatan.id_sub_kegiatan')
        ->join('tbl_kegiatan','tbl_kegiatan.id_kegiatan','tbl_sub_kegiatan.id_kegiatan')
        ->join('tbl_program','tbl_program.id_program','tbl_kegiatan.id_program')
        ->where('tbl_target.id_skpd',$id_skpd)
        ->where('tbl_target.target_tahun',$tahun)
        ->select('tbl_program.nama_program','tbl_program.id_program')
        ->groupby('tbl_program.id_program')->get();

        $data = array();
        foreach($q_program as $r){
        $a['nama_program']=$r->nama_program;
        $a['target_rp'] = 0;
        $a['kegiatan'] = array();

        foreach($this->get_kegiatan($r->id_program,$id_skpd,$tahun) as $r2)
        {
        $d['nama_kegiatan'] = $r2->nama_kegiatan;
        $d['target_rp'] = 0;
        $d['sub_kegiatan'] = array();
        foreach($this->get_sub_kegiatan($r2->id_kegiatan,$tahun) as $r3)
        {
            $qsbk = $this->get_target_sub_kegiatan($r3->id_sub_kegiatan,$tahun);
            $b['nama_sub_kegiatan']=$r3->nama_sub_kegiatan;
            $b['satuan']=$qsbk['satuan'];
            $b['kuantitas']=$qsbk['kuantitas'];
            $b['target_rp']=$qsbk['rp'];
            $d['target_rp'] = $qsbk['rp']+$d['target_rp'];
            array_push($d['sub_kegiatan'],$b);
        }
        $a['target_rp'] = $d['target_rp'] + $a['target_rp'];
        array_push($a['kegiatan'],$d);
        }
        array_push($data,$a);
        }
        return json_decode(json_encode($data));
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
        $q = DB::table('tbl_target')
        ->where('id_sub_kegiatan',$id_sub_kegiatan)
        ->where('target_tahun',$tahun)
        ->first();
        return array('satuan'=>$q->satuan,'kuantitas'=>$q->kuantitas,'rp'=>$q->pagu);
    }
}