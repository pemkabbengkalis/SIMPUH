<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Session;
class Target extends Model
{
  protected $table = 'tbl_target';
  public $timestamps = false;
function __construct(){
  $this->modul = 'Target';
}
function kuantitas_lain(){
    return $this->hasOne(KuantitasLain::class, 'id_target', 'id');
}
static function getdata($idskpd){
    return Self::join('tbl_sub_kegiatan','tbl_sub_kegiatan.id_sub_kegiatan','tbl_target.id_sub_kegiatan')
    ->where('id_skpd',Session::get('id_skpd'))->get();
}

function inputunggulan($data){
  self::insert([
    'id_sub_kegiatan'=>$data->idsubkeg,
    'id_skpd'=>Session::get('id_skpd'),
    'target_tahun'=>$data->targettahun,
    'pagu'=>$data->pagu,
    'kuantitas'=>$data->kuantitas,
    'satuan'=>$data->satuan,
    'jenis'=>$data->jenis,
    'jenis_target'=>'unggulan'
  ]);
  return redirect(modul('path'))->send()->with('success',$this->modul.' Berhasil ditambah');
}

function getdataall($idskpd,$tahun){
  return Self::join('tbl_sub_kegiatan','tbl_sub_kegiatan.id_sub_kegiatan','tbl_target.id_sub_kegiatan')
    ->join('tbl_kegiatan','tbl_kegiatan.id_kegiatan','tbl_sub_kegiatan.id_kegiatan')
    ->join('tbl_program','tbl_program.id_program','tbl_kegiatan.id_program')
    ->join('tbl_program_unggulan','tbl_program_unggulan.id_program_unggulan','tbl_program.id_program_unggulan')
    ->where('tbl_target.id_skpd',$idskpd)->where('tbl_target.target_tahun',$tahun)
    ->groupby('tbl_program_unggulan.id_program_unggulan')
    ->get();
}

function getdatakegiatan($id){
  return Self::join('tbl_sub_kegiatan','tbl_sub_kegiatan.id_sub_kegiatan','tbl_target.id_sub_kegiatan')
    ->join('tbl_kegiatan','tbl_kegiatan.id_kegiatan','tbl_sub_kegiatan.id_kegiatan')
    ->join('tbl_program','tbl_program.id_program','tbl_kegiatan.id_program')
    ->join('tbl_program_unggulan','tbl_program_unggulan.id_program_unggulan','tbl_program.id_program_unggulan')
    ->where('tbl_target.id_skpd',Session::get('id_skpd'))
    ->where('tbl_program_unggulan.id_program_unggulan',$id)->get();
}

function updatetargetunggulan($data,$id){
  try {
    self::where('id',$id)->update([
    'id_sub_kegiatan'=>$data->idsubkeg,
    'id_skpd'=>Session::get('id_skpd'),
    'target_tahun'=>$data->targettahun,
    'pagu'=>$data->pagu,
    'kuantitas'=>$data->kuantitas,
    'satuan'=>$data->satuan,
    'jenis'=>$data->jenis,
    'jenis_target'=>'unggulan'
  ]);
    return back()->with('success',$this->modul.' Berhasil diupdate');
  } catch (\Throwable $th) {
    return back()->with('success','Data berhasil diupdate');
  }

}


function listprogram($idskpd,$tahun){
  return Self::join('tbl_sub_kegiatan','tbl_sub_kegiatan.id_sub_kegiatan','tbl_target.id_sub_kegiatan')
    ->join('tbl_kegiatan','tbl_kegiatan.id_kegiatan','tbl_sub_kegiatan.id_kegiatan')
    ->join('tbl_program','tbl_program.id_program','tbl_kegiatan.id_program')
    ->join('tbl_program_unggulan','tbl_program_unggulan.id_program_unggulan','tbl_program.id_program_unggulan')
    ->where('tbl_target.id_skpd',$idskpd)->where('tbl_target.target_tahun',$tahun)
    ->groupby('tbl_program_unggulan.id_program_unggulan')
    ->get();
}

function sub_kegiatan(){
    return $this->hasMany(SubKegiatan::class, 'id_sub_kegiatan', 'id_sub_kegiatan');
}

function realisasi(){
    return $this->hasMany(Realisasi::class, 'id_target', 'id_target');
}
function skpd(){
    return $this->belongsTo(SkpdModel::class, 'id_skpd', 'id_skpd');
}
}
