<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Redirect;
use App\Models\BidangUrusan;
use App\Models\Urusan;
use View;
use DB;
class BidangUrusanController extends Controller
{
  function __construct(BidangUrusan $model,Urusan $urusan){
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
    $this->view = 'back.admin.bidangurusan.';
    View::share('urusan',$urusan);
  }
  function bidangurusan(){
    return view($this->view.'index',['data'=>$this->model]);
  }
  function edit(Request $req, $id){
    // dd(DB::table('tbl_urusan_skpd')->where('id_urusan',de($id))->pluck('id_skpd'));

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
  return view($this->view.'form');
  }

}
