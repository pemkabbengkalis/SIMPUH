<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
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
function kegiatan(){
    return $this->hasMany(Kegiatan::class, 'id_program', 'id_program');
}
function program_unggulan(){
    return $this->belongsTo(ProgramUnggulan::class, 'id_program_unggulan', 'id_program_unggulan');
}
function input($data){
  DB::beginTransaction(); // Mulai transaksi
  try {
      // Insert data ke tabel utama
      self::insert([
          'kode_program' => $data->kode_program,
          'nama_program' => $data->nama_program,
          'id_program_unggulan' => $data->unggulan
      ]);
      
      // Insert data ke tabel referensi
      $refData = [
          'nama_ref' => $data->kode_program . ' ' . $data->nama_program
      ];
      DB::table('refprograms')->insert($refData);

      DB::commit(); // Commit jika semua berhasil
      return redirect(modul('path'))->with('success', $this->modul . ' Berhasil ditambah');
  } catch (\Exception $e) {
      DB::rollBack(); // Rollback jika terjadi error
      return redirect(modul('path'))->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
  }
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
