<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Redirect;
use App\Models\JenisSatuan;
use App\Models\Program;
use App\Models\Target;
use App\Models\Realisasi;
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
        $kuantitas = implode(',',$req->kuantitase);
        $satuan    = implode(',',$req->satuane);
        $data = [
        'id_sub_kegiatan'=>$req->idsubkeg,
        'id_skpd'=>Session::get('id_skpd'),
        'target_tahun'=>$req->targettahun,
        'pagu'=>$req->pagu,
        'kuantitas'=>$kuantitas,
        'satuan'=>$satuan,
        'jenis'=>$req->jenis,
        'jenis_target'=>'unggulan'];
        try {
          Target::where('id',$req->id)->update($data);
          return redirect(modul('path'))->send()->with('success','Target Berhasil diupdate');
        } catch (\Throwable $th) {
          return redirect(modul('path'))->send()->with('danger',$th->getmessage());
        }

      }
   
  }
  

  function delete($id){
    try {
      /**
       * cek realisasi target berdasarkan target yang akan dihapus
       */
      $checkRealisasi = Realisasi::where('id_target',base64_decode($id))->count();
      if($checkRealisasi > 0){
        return back()->with('danger','Target ini sudah dilakukan realisasi');
      }else{
        $act = DB::table('tbl_target')->where('id',base64_decode($id))->delete();
        if($act){
          return back()->with('success','Data berhasil dihapus');
        }
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
    
      $id= hexdec(uniqid());
      if($req->submit){
        $kuantitas = implode(',',$req->kuantitas);
        $satuan    = implode(',',$req->satuan);
            $data = [
            'id'=>$id,
            'id_sub_kegiatan'=>$req->idsubkeg,
            'id_skpd'=>Session::get('id_skpd'),
            'target_tahun'=>$req->targettahun,
            'pagu'=>$req->pagu,
            'kuantitas'=>$kuantitas,
            'satuan'=>$satuan,
            'jenis'=>$req->jenis,
            'jenis_target'=>'unggulan'];
            try {
              Target::insert($data);
              return redirect(modul('path'))->send()->with('success','Target Berhasil ditambah');
            } catch (\Throwable $th) {
              return redirect(modul('path'))->send()->with('danger',$th->getmessage());
            }
        
      }

  }

}
