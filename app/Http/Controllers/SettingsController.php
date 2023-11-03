<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;
use App\Models\User;
use Redirect;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Session;
use App\Menu\Skpd;
use View;

class SettingsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     function __construct(){
        $this->middleware(function ($request, $next){
          if(!session()->has('id_user')) {
            return Redirect::to('admsimpuh')->send();
          }else {
            return $next($request);
          }
      });
      }      

    public function index()
    {
        $data = user::where('id',session('id_user'))->first();
        return view('back.settings.index', compact('data'));

    }

    public function edit(Request $request){
      $request->validate([
        'nama' => ['string', 'min:3', 'max:255'],
        // 'no_hp' => ['min:11', 'max:15'],
        // 'password' => ['min:6', 'max:255'],
      ]);

      if($request->submit){
        $data = user::where('id',session('id_user'))->first();
        $data->nama = $request->nama;
        $data->email = $request->email;
        $data->no_hp = $request->no_hp;
        $data->jenis_kelamin = $request->jenis_kelamin;
        $data->password = md5($request->password);
        $data->save();
        return redirect('settings')->with('success','Data akun berhasil diubah');
      }
    }
        
}
