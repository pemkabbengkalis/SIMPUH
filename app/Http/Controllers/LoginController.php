<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use DB;
class LoginController
{
function loginform(Request $req){
  if($req->username && $req->password){
    // if($_POST['g-recaptcha-response'] != null){
    //$captcha=$_POST['g-recaptcha-response'];

    $cek = DB::table('users')->where('username',$req->username)->where('password',md5($req->password))->first();
        if(!empty($cek)){
          Session::put('id_user',$cek->id);
          Session::put('id_skpd',$cek->id_skpd);
          Session::put('level',$cek->level);
          Session::put('nama',$cek->nama);
        return redirect($cek->level.'/dashboard');
        }
        else {
          return back()->with('danger','USERNAME DAN PASSWORD SALAH');
        }
    // }else{
    //     return back()->with('danger','Chapta Harus dipilih');
    // }
    
  }
  else {
    if(Session::has('id_user')){
      return redirect(session('level').'/dashboard');
    }
    return view('login');
  }
}
function logout(){
  if(Session::has('id_user')){
    Session::flush();
  }
  return redirect('admsimpuh');

}
}
