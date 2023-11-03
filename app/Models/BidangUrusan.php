<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
class BidangUrusan extends Model
{
  protected $table = 'tbl_bidang_urusan';
  public $timestamps = false;
function __construct(){
  $this->modul = 'Bidang Urusan';
}
function listjoin(){
 // return self::join('tbl_program_unggulan','tbl_program_unggulan.id_program_unggulan','tbl_urusan.id_program_unggulan')->get();
}
function whereid($id){
  $q = self::where('kode_bidang_urusan',$id);
  if(empty($q->first()))
  return redirect(modul('path'))->send()->with('danger',$this->modul.' Tidak Ditemukan');
  return $q;
}

function input($data){
  self::insert([
    'kode_urusan'=>$data->kode_urusan,
    'kode_bidang_urusan'=>$data->kode_bidang_urusan,
    'nama_bidang_urusan'=>$data->nama_bidang_urusan
  ]);
  // if($data->id_skpd){
  //   foreach ($data->id_skpd as $value) {
  //     DB::table('tbl_urusan_skpd')->insert(['id_skpd'=>$value,'id_urusan'=>self::latest('id_urusan')->first()->id_urusan]);
  //   }
  // }
  return redirect(modul('path'))->send()->with('success',$this->modul.' Berhasil ditambah');
}
function remove($id){
  $q = self::where('id_urusan',$id);
  if(empty($q->first()))
  return redirect(modul('path'))->send()->with('danger',$this->modul.' Tidak Ditemukan');
  $q->delete();
  return redirect(modul('path'))->send()->with('success',$this->modul.' Berhasil Dihapus');
}
function edit($id,$data){
  // if($data->id_skpd){
  //   DB::table('tbl_urusan_skpd')->where('id_urusan',$id)->wherein('id_skpd',explode(',',self::where('id_urusan',$id)->first()->id_skpd))->delete();
  //   foreach ($data->id_skpd as $value) {
  //     DB::table('tbl_urusan_skpd')->insert(['id_skpd'=>$value,'id_urusan'=>$id]);
  //   }
  // }
  self::where('kode_bidang_urusan',$id)->update([
    'kode_urusan'=>$data->kode_urusan,
    'kode_bidang_urusan'=>$data->kode_bidang_urusan,
    'nama_bidang_urusan'=>$data->nama_bidang_urusan
  ]);
  return redirect(modul('path'))->send()->with('success',$this->modul.' Berhasil Diedit');
}
}
