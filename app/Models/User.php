<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
class User extends Model
{
  protected $table = 'users';
  public $timestamps = false;
function __construct(){
  $this->modul = 'User SKPD';
}
function listjoin(){
 // return self::join('tbl_program_unggulan','tbl_program_unggulan.id_program_unggulan','tbl_urusan.id_program_unggulan')->get();
}
function whereid($id){
  $q = self::where('id',$id);
  if(empty($q->first()))
  return redirect(modul('path'))->send()->with('danger',$this->modul.' Tidak Ditemukan');
  return $q;
}

function input($data){
    if(self::where('id_skpd',$data->id_skpd)->count()>0)
  return back()->with('danger','SKPD Telah memiliki user');
  if(self::where('username',$data->username)->count()>0)
  return back()->with('danger','Username Telah digunakan');

  self::insert([
    'nama'=>$data->nama,
    'email'=>$data->email,
    'username'=>$data->username,
    'password'=>md5($data->password),
    'id_skpd'=>$data->id_skpd,

  ]);

  return redirect(modul('path'))->send()->with('success',$this->modul.' Berhasil ditambah');
}
function remove($id){
  $q = self::where('id',$id);
  if(empty($q->first()))
  return redirect(modul('path'))->send()->with('danger',$this->modul.' Tidak Ditemukan');
  $q->delete();
  return redirect(modul('path'))->send()->with('success',$this->modul.' Berhasil Dihapus');
}
function edit($id,$data){

  self::where('id',$id)->update([
    'nama'=>$data->nama,
    'email'=>$data->email,
    'password'=>$data->password ? md5($data->password) : self::where('id',$id)->first()->password,
    'id_skpd'=>$data->id_skpd,
  ]);
  return redirect(modul('path'))->send()->with('success',$this->modul.' Berhasil Diedit');
}
}
