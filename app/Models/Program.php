<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Program extends Model
{
  protected $table = 'tbl_program';
  public $timestamps = false;
function __construct(){
  $this->modul = 'Program';
}
function listjoin(){
  return self::join('tbl_program','tbl_program.id_program','tbl_program.id_program')->orderby('id_program','ASC')->get();
}
function whereid($id){
  $q = self::where('id_program',$id);
  if(empty($q->first()))
  return redirect(modul('path'))->send()->with('danger',$this->modul.' Tidak Ditemukan');
  return $q;
}

function input($data){
  self::insert([
    'kode_program'=>$data->kode_program,
    'nama_program'=>$data->nama_program,
    'id_program_unggulan'=>$data->unggulan
  ]);
  return redirect(modul('path'))->send()->with('success',$this->modul.' Berhasil ditambah');
}
function remove($id){
  $q = self::where('id_program',$id);
  if(empty($q->first()))
  return redirect(modul('path'))->send()->with('danger',$this->modul.' Tidak Ditemukan');
  $q->delete();
  return redirect(modul('path'))->send()->with('success',$this->modul.' Berhasil Dihapus');
}
function edit($id,$data){
  self::where('id_program',$id)->update([
    'kode_program'=>$data->kode_program,
    'nama_program'=>$data->nama_program,
    'id_program_unggulan'=>$data->unggulan

  ]);
  return redirect(modul('path'))->send()->with('success',$this->modul.' Berhasil Diedit');
}
}
