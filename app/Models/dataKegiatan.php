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

}
