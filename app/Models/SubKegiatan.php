<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class SubKegiatan extends Model
{
  protected $table = 'tbl_sub_kegiatan';
  public $timestamps = false;
function __construct(){
  $this->modul = 'Sub Kegiatan';
}
static function listjoin(){
  return self::join('tbl_kegiatan','tbl_kegiatan.id_kegiatan','tbl_sub_kegiatan.id_kegiatan')->get();
}
function whereid($id){
  $q = self::where('id_sub_kegiatan',$id);
  if(empty($q->first()))
  return redirect(modul('path'))->send()->with('danger',$this->modul.' Tidak Ditemukan');
  return $q;
}

function input($data){
  self::insert([
    'kode_sub_kegiatan'=>$data->kode_sub_kegiatan,
    'nama_sub_kegiatan'=>$data->nama_sub_kegiatan,
    'id_kegiatan'=>$data->id_kegiatan,
  ]);
  return redirect(modul('path'))->send()->with('success',$this->modul.' Berhasil ditambah');
}
function remove($id){
  $q = self::where('id_sub_kegiatan',$id);
  if(empty($q->first()))
  return redirect(modul('path'))->send()->with('danger',$this->modul.' Tidak Ditemukan');
  $q->delete();
  return redirect(modul('path'))->send()->with('success',$this->modul.' Berhasil Dihapus');
}
function edit($id,$data){
  self::where('id_sub_kegiatan',$id)->update([
    'kode_sub_kegiatan'=>$data->kode_sub_kegiatan,
    'nama_sub_kegiatan'=>$data->nama_sub_kegiatan,
    'id_kegiatan'=>$data->id_kegiatan,

  ]);
  return redirect(modul('path'))->send()->with('success',$this->modul.' Berhasil Diedit');
}

function target(){
    return $this->belongsTo(Target::class, 'id_sub_kegiatan', 'id_sub_kegiatan');
}
function kegiatan(){
    return $this->belongsTo(Kegiatan::class, 'id_kegiatan', 'id_kegiatan');
}
}
