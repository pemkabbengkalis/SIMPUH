<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AkunSkpdController extends Controller
{
  function akunskpd(){
    return view($this->view.'index',['data'=>$this->model]);
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
  return view($this->view.'form');
  }
}
