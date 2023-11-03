<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Session;
class KuantitasGanda extends Model
{
  protected $table = 'kuantitas_ganda';
  protected $casts = [
    'id' => 'string',
  ];
}