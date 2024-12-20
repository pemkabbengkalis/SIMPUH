<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Redirect;
use App\Models\JenisSatuan;
use App\Models\Program;
use App\Models\SkpdModel;
use App\Models\Kegiatan;
use App\Models\refprogram;
use View;
class KegiatanController extends Controller
{
  function __construct(Kegiatan $model,Program $prog,SkpdModel $skpd,refprogram $ref){
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
    $this->view = 'back.admin.kegiatan.';
    $this->viewSkpd = 'back.skpd.kegiatan.';
    View::share(['program'=>$ref,'skpd'=>$skpd,'programs'=>$prog]);
  }
  function kegiatan(){
    return view($this->view.'index',['data'=>$this->model]);
  }

  function kegiatanskpd(){
    return view($this->viewSkpd.'index',['data'=>$this->model]);
  }

  function edit(Request $req, $id){
    $edit = $this->model->whereid(de($id))->first();
    if($req->submit){
      $this->model->edit(de($id),$req);
    }
    return view($this->view.'form',compact('edit'));
  }

  function delete($id){
    $this->model->remove(de($id));
  }

  function create(Request $req){
    if($req->submit){
      $this->model->input($req);
    }
    if('admin' == Session::get('level')){
     return view($this->view.'form');
    }else{
      return view($this->viewSkpd.'form');
    }
  }

  function getsubkegiatans(Request $r){
     $data   = refprogram::all();

     //$cities = City::where('status', 1)->where('state_id', $request->state_id)->get();
     $html = '<option value="">Pilih Kegiatan</option>';

        foreach ($data as $row) {
            $indexawal = explode(' ',$row->nama_ref);
            if($indexawal[0]){
              $arraydot = explode('.',$indexawal[0]);
              if(count($arraydot) == 5){
                $array = array($arraydot[0],$arraydot[1],$arraydot[2]);
                $arr   = implode(".",$array);
                if($r->has('id_program') && $r->has('id_kegiatan') && $r->id_kegiatan != ''){
                if($r->id_program==$arr){
                  $temKodeKegiatan = explode(' ',$row->nama_ref);
                  $selected = ($temKodeKegiatan[0]==$r->id_kegiatan['kode_kegiatan']) ? 'selected':'';
                  $html .= '<option value="' . $row->nama_ref . '" '.$selected.'>' . $row->nama_ref . '</option>';
                }
                }else{
                  if($r->id_program==$arr){
                  $temKodeKegiatan = explode(' ',$row->nama_ref);
                  $html .= '<option value="' . $row->nama_ref . '">' . $row->nama_ref . '</option>';
                  }
                }


              }
            }
        }

        echo json_encode($html);
  }

  function getsubsubkegiatans(Request $r){
    $idkegiatan = explode(' ',$r->id_kegiatan);
    $data   = refprogram::where('kode2',2)->get();
     //$cities = City::where('status', 1)->where('state_id', $request->state_id)->get();
     $html = '<option value="">Pilih Sub Kegiatan</option>';

        foreach ($data as $row) {
            $indexawal = explode(' ',$row->nama_ref);
            if($indexawal[0]){
              $arraydot = explode('.',$indexawal[0]);
              if(count($arraydot) == 6){
                $array = array($arraydot[0],$arraydot[1],$arraydot[2],$arraydot[3],$arraydot[4]);
                $arr   = implode(".",$array);
                if($r->has('id_sub_kegiatan') && $r->has('id_kegiatan') && $r->id_sub_kegiatan != ''){
                    if($idkegiatan[0]==$arr){
                    $temKodeKegiatan = explode(' ',$row->nama_ref);
                    $selected = ($temKodeKegiatan[0]==$r->id_sub_kegiatan['kode_sub_kegiatan']) ? 'selected':'';
                    $html .= '<option value="' . $row->nama_ref . '" '.$selected.'>' . $row->nama_ref . '</option>';
                    }
                }else{
                  if($idkegiatan[0]==$arr){
                    $html .= '<option value="' . $row->nama_ref . '">' . $row->nama_ref . '</option>';
                  }
                }


              }
            }
        }

        echo json_encode($html);
  }

}
