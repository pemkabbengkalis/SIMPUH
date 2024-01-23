<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Redirect;
use App\Models\JenisSatuan;
use App\Models\Program;
use App\Models\Target;
use App\Models\KuantitasLain;
use View;
use DB;
class TargetSkpdController extends Controller
{
  function __construct(Target $model,Program $prog){
    $this->middleware(function ($request, $next){
      if(!session()->has('id_user')) {
        return Redirect::to('admsimpuh')->send();
      }else {
        if(session()->get('level')!=config('app.module')['level'])
        return Redirect::to(session('level').'/dashboard')->send()->with('danger','Akses Ditolak');
      }
        return $next($request);
  });
    $this->model = $model;
    $this->view = 'back.skpd.target.';
    View::share('program',$prog);
  }
  function index(){
    $tahun = getTahun();
    $subkeg= getsubkegiatan(Session::get('id_skpd'));
    $jenis = getjenistarget();
    $data  = $this->model->getdata(Session::get('id_skpd'));
    return view($this->view.'index',compact('tahun','subkeg','jenis','data'));
  }

  function edit($v){
    $v     = base64_decode($v);
    // print $v;
    $edit  = json_decode($v);
    $tahun = getTahun();
    $subkeg= getsubkegiatan(Session::get('id_skpd'));
    $jenis = getjenistarget();
    return view($this->view.'edit',compact('tahun','subkeg','jenis','edit'));
  }
  function update(Request $req){
    if($req->submit){
    $kuantitaslain = $req->id_kuantitaslain;
    $i = 0;

    foreach ($kuantitaslain as $key) {

      // print $key."<br>";
      if($i == 0){
        $data = [
        'id_sub_kegiatan'=>$req->idsubkeg,
        'id_skpd'=>Session::get('id_skpd'),
        'target_tahun'=>$req->targettahun,
        'pagu'=>$req->pagu,
        'kuantitas'=>$req->kuantitase[$key],
        'satuan'=>$req->satuane[$i],
        'jenis'=>$req->jenis,
        'jenis_target'=>'unggulan'];
        try {
          Target::where('id',$req->id)->update($data);

        } catch (\Throwable $th) {
          // return redirect(modul('path'))->send()->with('danger',$th->getmessage());
        }

      }else{
        $check = KuantitasLain::where('id_kuantitas_lain',$key)->count();
        if($check > 0){
          $data =[
            'kuantitas_lain'=>$req->kuantitase[$i],
            'satuan_lain'=>$req->satuane[$i],
            'id_target'=>$req->id
          ];
          try {
            KuantitasLain::where('id_kuantitas_lain',$key)->update($data);

            // return redirect(modul('path'))->send()->with('success','Target Berhasil ditambah');
          } catch (\Throwable $th) {

            // return redirect(modul('path'))->send()->with('danger',$th->getmessage());
          }
        }else{
          $data =[
            'kuantitas_lain'=>$req->kuantitase[$i],
            'satuan_lain'=>$req->satuane[$i],
            'id_target'=>$req->id
          ];
          try {
            KuantitasLain::insert($data);


          } catch (\Throwable $th) {

          }
        }


      }
      $i++;

    }
    return redirect(modul('path'))->send()->with('success','Target Berhasil diupdate');
  }
  }

  function delete($id){
    try {
      $act = DB::table('tbl_target')->where('id',base64_decode($id))->delete();
      if($act){
        return back()->with('success','Data berhasil dihapus');
      }

    } catch (\Throwable $th) {
      return back()->with('danger',$th->getmessage());
    }

  }
  function deletekuantitaslain($id){
    try {
      KuantitasLain::where('id_kuantitas_lain',$id)->delete();
      return 'success';
    } catch (\Throwable $th) {
      return print $th->getmessage();
    }

  }


  function create(Request $req){
    if($req->submit){
      $kuantitas = $req->kuantitas;
      $i = 0;
      $id= hexdec(uniqid());
      foreach ($kuantitas as $key) {


        if($i == 0){
          $data = [
          'id'=>$id,
          'id_sub_kegiatan'=>$req->idsubkeg,
          'id_skpd'=>Session::get('id_skpd'),
          'target_tahun'=>$req->targettahun,
          'pagu'=>$req->pagu,
          'kuantitas'=>$key,
          'satuan'=>$req->satuan[$i],
          'jenis'=>$req->jenis,
          'jenis_target'=>'unggulan'];
          try {
            Target::insert($data);

            // print $id;

          } catch (\Throwable $th) {
            //return redirect(modul('path'))->send()->with('danger',$th->getmessage());
          }

        }else{
         $data =[
            'kuantitas_lain'=>$key,
            'satuan_lain'=>$req->satuan[$i],
            'id_target'=>$id
          ];
          try {
            KuantitasLain::insert($data);

          } catch (\Throwable $th) {
            return redirect(modul('path'))->send()->with('danger',$th->getmessage());
          }
        }
        $i++;
      }
      // print $id;
      return redirect(modul('path'))->send()->with('success','Target Berhasil ditambah');
    }

  }

}
