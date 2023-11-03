<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Session;
class Realisasi extends Model
{
  protected $table = 'tbl_realisasi';
  public $timestamps = false;
function __construct(){
  $this->modul = 'Realisasi';
}

static function getdata($idskpd){
    return Self::join('tbl_sub_kegiatan','tbl_sub_kegiatan.id_sub_kegiatan','tbl_target.id_sub_kegiatan')
    ->where('id_skpd',Session::get('id_skpd'))->get();
}

function input($data){
  self::insert([
    'id_target'=>$data->idtarget,
    'id_skpd'=>Session::get('id_skpd'),
    'realisasi_tahun'=>date('Y'),
    'realisasi_bulan'=>$this->bulantahapan($data->tahapan),
    'realisasi_pagu'=>$data->realisasi,
    'realisasi_kuantitas'=>$data->kuantitas,
    'realisasi_satuan'=>$data->satuan,
    'triwulan'=>$data->tahapan,
    'keterangan'=>$data->keterangan,
    'kendala'=>$data->kendala,
    'tindakan'=>$data->tindakan,
  ]);
  return back()->with('success',$this->modul.' Berhasil ditambah');
}

function updaterel($data){
  
  self::where('id_realisasi',$data->id_realisasi)->update([
    'id_target'=>$data->idtarget,
    'id_skpd'=>Session::get('id_skpd'),
    'realisasi_bulan'=>$this->bulantahapan($data->tahapan),
    'realisasi_pagu'=>$data->realisasi,
    'realisasi_kuantitas'=>$data->kuantitas,
    'realisasi_satuan'=>$data->satuan,
    'triwulan'=>$data->tahapan,
    'keterangan'=>$data->keterangan,
    'kendala'=>$data->kendala,
    'tindakan'=>$data->tindakan,
  ]);
  return back()->with('success',$this->modul.' Data berhasil diupdate');

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
