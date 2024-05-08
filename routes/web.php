<?php
use Illuminate\Support\Facades\Route;
use App\TargetData;
use App\RealisasiData;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/cekdd', function () {
  return number_format(100000000000000,0,',','.');
});
Route::get('/', function () {
    return view('front.index');
});
Route::match(['get','post'],'admin', function () {
    return redirect('admin/dashboard');
});
Route::match(['get', 'post'], 'skpdGrafik/{th}', function ($th) {
  return listSKPDGrafik($th);
})->name('skpdGrafik');
Route::match(['get', 'post'], 'getrealisasiKIA/{th}', function ($th) {
  return getrealisasiKIA($th);
})->name('getrealisasiKIA');

Route::match(['get', 'post'], 'getChartBYunggulan/{th}', function ($th) {
  return getChartBYunggulan($th);
})->name('getChartBYunggulan');


Route::match(['get','post'],'skpds', function (RealisasiData $b) {
  return $b->get_detail_program(250,2022);
});
Route::match(['get','post'],'tr', function (RealisasiData $b) {
  dd(cek_tw(2022,250));
});

Route::match(['get','post'],'cetak_realisasi_new/{skpd}/{tahun}/{trw}', 'App\RealisasiDataNew@cetak_realisasi_skpd');

Route::match(['get','post'],'cetak_realisasi/{skpd}/{tahun}/{trw}', 'App\RealisasiDataNew@cetak_realisasi_skpd');

Route::match(['get','post'],'cetak_realisasi_all/{tahun}/{trw}', 'App\RealisasiAll@cetak_realisasi_all');
//Route::match(['get','post'],'getsubkegiatans', 'App\Http\Controllers\KegiatanController@getsubkegiatans')->name('get-subkegiatan');
//KegiatanController


Route::match(['get','post'],'admsimpuh', 'App\Http\Controllers\LoginController@loginform');
Route::match(['get','post'],'logout', 'App\Http\Controllers\LoginController@logout');
Route::match(['get','post'],'settings', 'App\Http\Controllers\SettingsController@index');
Route::put('settings', 'App\Http\Controllers\SettingsController@edit');
if(request()->is('settings')){
  config(['app.module'=>[
    "nama_menu" => 'Pengaturan Akun',
    "path"  => 'settings',
    "icon"  => 'fas fa-cog',
    "level"  => 'all',
    "action"  => '-',

    ]]);
}
  if(count(json_decode(json_encode(config('app.menu'))))>0){
    foreach (json_decode(json_encode(config('app.menu'))) as $key => $value) {

      if($value->child){
        foreach($value->child as $child):
          if(request()->is($child->path) || request()->is($child->path.'/*') || request()->is($child->path.'/*/*')){
            $url = request()->path();
                    $title = match (true) {
                        Str::contains($url, 'create') => 'Tambah ',
                        Str::contains($url, 'edit') => 'Edit ',
                        default => ''
                    };
            config(['app.module'=>[
              "nama_menu" => $title.$child->nama_menu,
              "path"  => $child->path,
              "icon"  => $child->icon,
              "level"  => $value->level,
              "action"  => mb_strtolower(trim($title)),
              ]]);
          }
          if($child->crud){
            foreach ($child->crud as $cr) {
              $urc = $cr == 'edit' || $cr == 'delete' ? $cr.'/{id}' : $cr;

              Route::match(['get','post'],$child->path.'/'.$urc, 'App\Http\Controllers\\'.$child->controller.'@'.$cr);
            }
          }
          Route::match(['get','post'],$child->path, 'App\Http\Controllers\\'.$child->controller.'@'.$child->function);
        endforeach;
      }else {
        if(request()->is($value->path) || request()->is($value->path.'/*') || request()->is($value->path.'/*/*')){
          $url = request()->path();
            $title = match(true) {
              Str::contains($url,'create') => 'Tambah ',
              Str::contains($url,'edit')  => 'Edit ',
              default => ''
            };
          config(['app.module'=>[
            "nama_menu" => $title.$value->nama_menu,
            "path"  => $value->path,
            "icon"  => $value->icon,
            "level"  => $value->level,
            "action"  => mb_strtolower(trim($title)),

            ]]);
        }
        if($value->crud){
          foreach ($value->crud as $cr) {
            $urc = $cr == 'edit' || $cr == 'delete' ? $cr.'/{id}' : $cr;
            Route::match(['get','post'],$value->path.'/'.$urc, 'App\Http\Controllers\\'.$value->controller.'@'.$cr);
          }
        }
        Route::match(['get','post'],$value->path, 'App\Http\Controllers\\'.$value->controller.'@'.$value->function);
      }

    }
  }

