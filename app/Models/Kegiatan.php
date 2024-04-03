<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubKegiatan;
use DB;
use Session;
class Kegiatan extends Model
{
  protected $table = 'tbl_kegiatan';
  public $timestamps = false;
function __construct(){
  $this->modul = 'Kegiatan';
}
function listjoin(){
   if('admin' == Session::get('level')){
      return self::join('tbl_program','tbl_program.id_program','tbl_kegiatan.id_program')->join('tbl_skpd','tbl_skpd.id_skpd','tbl_kegiatan.id_skpd')->join('tbl_sub_kegiatan','tbl_sub_kegiatan.id_kegiatan','tbl_kegiatan.id_kegiatan')->get();
   }else{
    return self::where('tbl_kegiatan.id_skpd',Session::get('id_skpd'))->join('tbl_program','tbl_program.id_program','tbl_kegiatan.id_program')->join('tbl_skpd','tbl_skpd.id_skpd','tbl_kegiatan.id_skpd')->join('tbl_sub_kegiatan','tbl_sub_kegiatan.id_kegiatan','tbl_kegiatan.id_kegiatan')->get();
   }
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
  /***
     * check Target
     * jika terdapat kegiatan yang sudah di tetapkan target oleh SKPD terkait dan admin ingin mengubah data SKPD pada kegiatan
     */
    $subKegiatan = DB::table('tbl_sub_kegiatan')
    ->where('tbl_kegiatan.id_kegiatan',$id)
    ->join('tbl_kegiatan','tbl_sub_kegiatan.id_kegiatan','tbl_kegiatan.id_kegiatan')
    ->first();
    $checkTarget = DB::table('tbl_target')->where('id_skpd',$subKegiatan->id_skpd)->where('id_sub_kegiatan',$subKegiatan->id_sub_kegiatan)->count();
    if($checkTarget > 0){
      return redirect(modul('path'))->send()->with('danger','SKPD tersebut sudah menetapkan target berdasarkan kegiatan yang dipilih');
    }else{
      SubKegiatan::where('id_kegiatan',$id)->delete();
      $q = self::where('id_kegiatan',$id);
      if(empty($q->first()))
      return redirect(modul('path'))->send()->with('danger',$this->modul.' Tidak Ditemukan');
      $q->delete();
      return redirect(modul('path'))->send()->with('success',$this->modul.' Berhasil Dihapus');
    }
 
}
function edit($id,$data){
    $kegiatan    = explode(' ',$data->kode_kegiatan);
    $subkegiatan = explode(' ',$data->kode_sub_kegiatan);
    $program  = findProgram($data->id_program);
    /***
     * check Target
     * jika terdapat kegiatan yang sudah di tetapkan target oleh SKPD terkait dan admin ingin mengubah data SKPD pada kegiatan
     */
    $checkTarget = DB::table('tbl_target')->where('id_skpd',$data->idskpdold)->where('id_sub_kegiatan',$data->idsubkegiatan)->count();
    if($checkTarget > 0){
      return redirect(modul('path'))->send()->with('danger','SKPD tersebut sudah menetapkan target berdasarkan kegiatan yang dipilih');
    }else{
      $keg      = DB::table('tbl_kegiatan')->where('id_kegiatan',$data->idkegiatan)->update([
        'kode_kegiatan'=>$kegiatan[0],
        'id_skpd'=>$data->id_skpd,
        'nama_kegiatan'=>str_replace($kegiatan[0],'',$data->kode_kegiatan),
        'id_program'=>$program['id_program'],
      ]);
      $subkeg   = SubKegiatan::where('id_sub_kegiatan',$data->idsubkegiatan)->update([
        'nama_sub_kegiatan'=>str_replace($subkegiatan[0],'',$data->kode_sub_kegiatan),
        'kode_sub_kegiatan'=>$subkegiatan[0],
        'id_kegiatan'=>$data->idkegiatan,
      ]);
      return redirect(modul('path'))->send()->with('success',$this->modul.' Berhasil ditambah');
    }
   
    
}

function program(){
    return $this->belongsTo(Program::class, 'id_program', 'id_program');
}
function sub_kegiatan(){
    return $this->hasMany(SubKegiatan::class, 'id_kegiatan', 'id_kegiatan');
}
}
