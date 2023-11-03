<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Str;
class Periode extends Model
{
  protected $table = 'tbl_periode';
  public $timestamps = false;
function __construct(){
  $this->modul = 'Periode Pemerintahan';
}

function whereid($id){
  $q = self::where('id_periode',$id);
  if(empty($q->first()))
  return redirect(modul('path'))->send()->with('danger',$this->modul.' Tidak Ditemukan');
  return $q;
}

function input($data){
  self::insert([
    'nama_periode'=>$data->nama_periode,
    'tahun_mulai'=>$data->tahun_mulai,
    'tahun_akhir'=>$data->tahun_akhir,
    'wakil'=>$data->wakil,
    'bupati'=>$data->bupati,
    'visimisi'=>$data->visimisi,
    'aktif'=>$data->aktif,
    'keterangan'=>$data->keterangan,
    'foto_wakil'=>$this->upload_file($data->file('foto_wakil'),Str::random(5)),
    'foto_bupati'=>$this->upload_file($data->file('foto_bupati'),Str::random(5)),
  ]);
  return redirect(modul('path'))->send()->with('success',$this->modul.' Berhasil ditambah');
}
function remove($id){
  $q = self::where('id_periode',$id);
  if(empty($q->first()))
  return redirect(modul('path'))->send()->with('danger',$this->modul.' Tidak Ditemukan');
  $q->delete();
  return redirect(modul('path'))->send()->with('success',$this->modul.' Berhasil Dihapus');
}
function edit($id,$data){
  self::where('id_periode',$id)->update([
    'nama_periode'=>$data->nama_periode,
    'tahun_mulai'=>$data->tahun_mulai,
    'tahun_akhir'=>$data->tahun_akhir,
    'wakil'=>$data->wakil,
    'bupati'=>$data->bupati,
    'visimisi'=>$data->visimisi,
    'aktif'=>$data->aktif,
    'keterangan'=>$data->keterangan,
    'foto_wakil'=>$data->file('foto_wakil') ? (($this->upload_file($data->file('foto_wakil'),Str::random(5)))) : $data->foto_wakil_old,
    'foto_bupati'=>$data->file('foto_bupati') ? (($this->upload_file($data->file('foto_bupati'),Str::random(5)))) : $data->foto_bupati_old,
  ]);
  if($data->file('foto_wakil')){
    unlink(public_path($data->foto_wakil_old));
  }
  if($data->file('foto_bupati')){
    unlink(public_path($data->foto_bupati_old));
  }
  return redirect(modul('path'))->send()->with('success',$this->modul.' Berhasil Diedit');
}

function upload_file($file,$nama){
  $nama = $nama.'.'.$file->getClientOriginalExtension();
  if(in_array($file->getClientOriginalExtension(),['jpg','png'])){
  $file->move(public_path('upload/'),$nama);
  return 'upload/'.$nama;

  }
  return null;
  
}
}
