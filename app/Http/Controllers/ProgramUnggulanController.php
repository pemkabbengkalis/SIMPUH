<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Redirect;
use App\Models\ProgramUnggulan;
use App\Models\Urusan;
use View;
class ProgramUnggulanController extends Controller
{
  function __construct(ProgramUnggulan $model){
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
    $this->view = 'back.admin.program-unggulan.';

  }
  function programunggulan(){
    return view($this->view.'index',['data'=>$this->model]);
  }
  function edit(Request $req,  Urusan $ur, $id){
    $edit = $this->model->whereid(de($id))->first();
    // View::share('urusan',$ur->where('id_program_unggulan',de($id))->get());
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

}
