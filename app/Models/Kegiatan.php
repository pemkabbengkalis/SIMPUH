<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubKegiatan;
use DB;
class Kegiatan extends Model
{
  protected $table = 'tbl_kegiatan';
  public $timestamps = false;
function __construct(){
  $this->modul = 'Kegiatan';
}
function listjoin(){
  return self::join('tbl_program','tbl_program.id_program','tbl_kegiatan.id_program')->join('tbl_skpd','tbl_skpd.id_skpd','tbl_kegiatan.id_skpd')->get();
}
function whereid($id){
  $q = self::where('tbl_kegiatan.id_kegiatan',$id)->join('tbl_program','tbl_program.id_program','tbl_kegiatan.id_program')->join('tbl_sub_kegiatan','tbl_sub_kegiatan.id_kegiatan','tbl_kegiatan.id_kegiatan');
  if(empty($q->first()))
  return redirect(modul('path'))->send()->with('danger',$this->modul.' Tidak Ditemukan');
  return $q;
}

function input($data){
  $kegiatan    = explode(' ',$data->kode_kegiatan);
  $subkegiatan = explode(' ',$data->kode_sub_kegiatan);
  $program  = findProgram($data->id_program);
  $keg      = DB::table('tbl_kegiatan')->insertgetId([
    'kode_kegiatan'=>$kegiatan[0],
    'id_skpd'=>$data->id_skpd,
    'nama_kegiatan'=>str_replace($kegiatan[0],'',$data->kode_kegiatan),
    'id_program'=>$program['id_program'],
  ]);
  $subkeg   = SubKegiatan::insert([
    'nama_sub_kegiatan'=>str_replace($subkegiatan[0],'',$data->kode_sub_kegiatan),
    'kode_sub_kegiatan'=>$subkegiatan[0],
    'id_kegiatan'=>$keg,
  ]);
  return redirect(modul('path'))->send()->with('success',$this->modul.' Berhasil ditambah');
}


function remove($id){
  $q = self::where('id_kegiatan',$id);
  if(empty($q->first()))
  return redirect(modul('path'))->send()->with('danger',$this->modul.' Tidak Ditemukan');
  $q->delete();
  return redirect(modul('path'))->send()->with('success',$this->modul.' Berhasil Dihapus');
}
function edit($id,$data){
    $kegiatan    = explode(' ',$data->kode_kegiatan);
    $subkegiatan = explode(' ',$data->kode_sub_kegiatan);
    $program  = findProgram($data->id_program);
    $keg      = DB::table('tbl_kegiatan')->where('id_kegiatan',$data->idkegiatan)->update([
      'kode_kegiatan'=>$kegiatan[0],
      'id_skpd'=>$data->id_skpd,
      'nama_kegiatan'=>str_replace($kegiatan[0],'',$data->kode_kegiatan),
      'id_program'=>$program['id_program'],
    ]);
    $subkeg   = SubKegiatan::where('id_sub_kegiatan',$data->idsubkegiatan)->update([
      'nama_sub_kegiatan'=>str_replace($subkegiatan[0],'',$data->kode_sub_kegiatan),
      'kode_sub_kegiatan'=>$subkegiatan[0],
      'id_kegiatan'=>$keg,
    ]);
    return redirect(modul('path'))->send()->with('success',$this->modul.' Berhasil ditambah');
}
}
