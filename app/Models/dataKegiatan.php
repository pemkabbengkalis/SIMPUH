<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubKegiatan;
use DB;
class dataKegiatan extends Model
{
  protected $table = 'refprograms';
  public $timestamps = false;
function __construct(){
  $this->modul = 'dataKegiatan';
}
function listjoin(){
  return self::where('kode2','2')->get();
}
function input($data){
  self::insert([
    'nama_ref'=>$data->kode_program.' '.$data->nama_program,
    'kode2'=>'2',
  ]);
  return redirect(modul('path'))->send()->with('success',$this->modul.' Berhasil ditambah');
}
function edit($id,$data){
  self::where('id',$id)->update([
    'nama_ref'=>$data->kode_program.' '.$data->nama_program,
  ]);
  return redirect(modul('path'))->send()->with('success',$this->modul.' Berhasil Diedit');
}
function remove($id){
  $q = self::where('id',$id);
  if(empty($q->first()))
  return redirect(modul('path'))->send()->with('danger',$this->modul.' Tidak Ditemukan');
  $q->delete();
  return redirect(modul('path'))->send()->with('success',$this->modul.' Berhasil Dihapus');
}
}
