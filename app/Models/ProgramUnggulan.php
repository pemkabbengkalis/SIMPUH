<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ProgramUnggulan extends Model
{
  protected $table = 'tbl_program_unggulan';
  public $timestamps = false;
function __construct(){
  $this->modul = 'Program Unggulan';
}
function whereid($id){
  $q = self::where('id_program_unggulan',$id);
  if(empty($q->first()))
  return redirect(modul('path'))->send()->with('danger',$this->modul.' Tidak Ditemukan');
  return $q;
}

function input($data){
  self::insert([
    'nama_program_unggulan'=>$data->nama_program_unggulan,
  ]);
  return redirect(modul('path'))->send()->with('success',$this->modul.' Berhasil ditambah');
}
function remove($id){
  $q = self::where('id_program_unggulan',$id);
  if(empty($q->first()))
  return redirect(modul('path'))->send()->with('danger',$this->modul.' Tidak Ditemukan');
  $q->delete();
  return redirect(modul('path'))->send()->with('success',$this->modul.' Berhasil Dihapus');
}
function edit($id,$data){
  self::where('id_program_unggulan',$id)->update([
    'nama_program_unggulan'=>$data->nama_program_unggulan,
  ]);
  return redirect(modul('path'))->send()->with('success',$this->modul.' Berhasil Diedit');
}
}
