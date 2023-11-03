<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class SkpdModel extends Model
{
  protected $table = 'tbl_skpd';
  public $timestamps = false;

function __construct(){
  $this->modul = 'SKPD';
}

function whereid($id){
  $q = self::where('id_skpd',$id);
  if(empty($q->first()))
  return redirect(modul('path'))->send()->with('danger',$this->modul.' Tidak Ditemukan');
  return $q;
}

function input($data){

  self::insertgetid([
    'nama_skpd'=>$data->nama_skpd,
    'type'=>$data->type,
  ]);

  return redirect(modul('path'))->send()->with('success',$this->modul.' Berhasil ditambah');
}
function remove($id){
  $q = self::where('id_skpd',$id);
  if(empty($q->first()))
  return redirect(modul('path'))->send()->with('danger',$this->modul.' Tidak Ditemukan');
  $q->delete();
  return redirect(modul('path'))->send()->with('success',$this->modul.' Berhasil Dihapus');
}
function edit($id,$data){

  self::where('id_skpd',$id)->update([
    'nama_skpd'=>$data->nama_skpd,
    'type'=>$data->type,
  ]);
  return redirect(modul('path'))->send()->with('success',$this->modul.' Berhasil Diedit');
}
protected $enum = ['organisasi', 'kecamatan'];
}
