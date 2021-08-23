<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//import lib validator laravel
use Illuminate\Support\Facades\Validator;

//import lib encript
use Illuminate\Contracts\Encryption\DecryptException;

use Illuminate\Support\Facades\Session;

//memanggil model M_suplier
use App\M_Suplier;

class Registrasi extends Controller
{
    //fungsi memanggil view registrasi
    public function index(){
        $token = session ::get('token');
        $tokenDb = M_suplier::where('token',$token)->count();
        if($tokenDb>0){
            $data['token']=$token;

        }else{

            $data['token']='kosong';
        }
        return view('registrasi.registrasi',$data);
    }

    //fungsi validasi input form
    public function regis(Request $request){
        $this->validate($request,
        [
            'nama_usaha'=>'required',
            'email' =>'required',
            'alamat' => 'required',
            'no_npwp' => 'required',
            'password' =>'required'
        ]
    );

    if(M_suplier::create(
        [
            'nama_suplier'=> $request->nama_usaha,
            'email'=> $request->email,
            'alamat'=> $request->alamat,
            'no_npwp'=> $request->no_npwp,
            'password'=> encrypt($request->password)
        ]
    )){
        //redirect ke controlr registrasi
        return redirect('/registrasi')->with('berhasil','Data Berhasil disimpan');

    } else {
        return redirect('/registrasi')->with('gagal','Data gagal disimpan');

    }

    }
}

