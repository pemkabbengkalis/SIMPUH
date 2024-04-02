<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\ProgramUnggulan;
class ProgramController extends Controller
{
  function __construct(Program $model){
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
    $this->view = 'back.admin.program.';
  }
  function program(){
    return view($this->view.'index',['data'=>$this->model->orderBy('id_program', 'asc')]);
  }
  function edit(Request $req, $id){
    $edit = $this->model->whereid(de($id))->first();
    $data = ProgramUnggulan::all();
    if($req->submit){
      $this->model->edit(de($id),$req);
    }
    return view($this->view.'form',compact('edit','data'));
  }

  function delete($id){
    $this->model->remove(de($id));
  }

  function input($data){
    self::insert([
      'kode_program'=>$data->kode_program,
      'nama_program'=>$data->nama_program,
    ]);
    return redirect(modul('path'))->send()->with('success',$this->modul.' Berhasil ditambah');
  }
  function create(Request $req){
    $data = ProgramUnggulan::all();
    if($req->submit){
      $this->model->input($req);
    }
  return view($this->view.'form',compact('data'));
  }

}
