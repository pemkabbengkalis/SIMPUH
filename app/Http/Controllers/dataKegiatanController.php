<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Redirect;
use App\Models\JenisSatuan;
use App\Models\Program;
use App\Models\SkpdModel;
use App\Models\dataKegiatan;
use App\Models\refprogram;
use View;
class dataKegiatanController extends Controller
{
  function __construct(dataKegiatan $model,Program $prog,SkpdModel $skpd,refprogram $ref){
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
    $this->view = 'back.admin.datakegiatan.';
    View::share(['program'=>$ref,'skpd'=>$skpd]);
  }
  function kegiatan(){
    return view($this->view.'index',['data'=>$this->model]);
  }
  function edit(Request $req, $id){
    $edit = $this->model->whereid(de($id))->first();
    $kode = explode(' ',$edit->nama_ref);
    $kode = $kode[0];
    $parts = explode(' ', $edit->nama_ref, 2); // Split into two parts, limit to 2 elements
    $nama_keg = isset($parts[1]) ? $parts[1] : ''; 
    $edit =[
      'kode'=>$kode,
      'nama_keg'=>$nama_keg,
    ];
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
  return view($this->view.'form');
  }

  function getsubkegiatans(Request $r){
     $data   = refprogram::all();
     //$cities = City::where('status', 1)->where('state_id', $request->state_id)->get();
     try {
        $html = '<option value="">Pilih Kegiatan</option>';

        foreach ($data as $row) {
            $indexawal = explode(' ',$row->nama_ref);
            if($indexawal[0]){
              $arraydot = explode('.',$indexawal[0]);
              if(count($arraydot) == 5){
                $array = array($arraydot[0],$arraydot[1],$arraydot[2]);
                $arr   = implode(".",$array);
                if($r->id_program==$arr){
                  $html .= '<option value="' . $row->nama_ref . '">' . $row->nama_ref . '</option>';
                }


              }
            }
        }

        echo json_encode($html);
     } catch (\Throwable $th) {
        print $th->getmessage();
     }

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
                if($idkegiatan[0]==$arr){
                  $html .= '<option value="' . $row->nama_ref . '">' . $row->nama_ref . '</option>';
                }


              }
            }
        }

        echo json_encode($html);
  }

}
