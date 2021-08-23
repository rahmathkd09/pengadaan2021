<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//import lib session
use Illuminate\Support\Facades\Session;

//import lib jwt
use \Firebase\JWT\JWT;

//import lib respon
use Illuminate\Response;

//import lib validator laravel
use Illuminate\Support\Facades\Validator;

//import lib encript
use Illuminate\Contracts\Encryption\DecryptException;
//use model suplier,M_admin
use App\M_Suplier;
use App\M_Admin;

class Suplier extends Controller
{
    public function login(){
        return view('login_sup.login');
    }

    public function masukSuplier(Request $request){
        $this->validate($request,
        [
            'email'=>'required',
            'password' =>'required'
         ]
        );

        $cek= M_suplier::where('email',$request->email)->count();
        //echo $cek;

        $sup= M_suplier::where('email',$request->email)->get();

        if ($cek>0){
            //email terdaftar
            foreach($sup as $su){
                if(decrypt($su->password) == $request->password){
                //jika password benar
                $key= env('APP_KEY');
                $data =  array(
                    "id_suplier" => $su->id_suplier
                );
                //print_r($data);
               // echo $key;
               $jwt = JWT::encode($data,$key);
              // echo $jwt;
                if(M_suplier:: where('id_suplier',$su->id_suplier)->update(
                    [
                        'token' =>$jwt
                    ]
                )){
                    //klo berhasil update token di db
                    session::put('token',$jwt);
                    return redirect('/listsuplier');

               }else {
                    //jika password salah
                    return redirect('/login')->with('gagal','token gagal diupdate');

                }

                }else{
                //jika password salah
                return redirect('/login')->with('gagal','password tidak sama');
                }
            }

        }else{
            return redirect('/login')->with('gagal','Email tidak terdaftar');
        }

    }


    public function suplierKeluar(){
        $token = Session::get('token');

    if(M_suplier::where('token',$token)->update(
        [
            'token' => 'keluar'
        ]
    )){
        Session::put('token',"kosong");
        return redirect('/');
    }else{
        return redirect('/')->with('gagal','Anda Gagal Logout');
    }

          }
          public function listSup() {
              $token = Session::get( 'token' );
              $tokenDb = M_Admin::where( 'token', $token )->count();

              if ( $tokenDb > 0 ) {
                $data['adm'] = M_Admin::where( 'token', $token )->first();
                  $data['suplier'] = M_Suplier::paginate( 15 );
                  // print_r( $data );
                  return view( 'admin.listSup', $data );

              } else {
                  return redirect( '/masukadmin' )->with( 'gagal', 'Anda sudah Logout,silahkan masuk kembali' );

              }

          }

          public function nonAktif($id) {
              $token = Session::get( 'token' );
              $tokenDb = M_Admin::where( 'token', $token )->count();

              if ( $tokenDb > 0 ) {
              if(M_Suplier::where('id_suplier',$id)->update(
                [
                "status" =>"0"
                ])){
                return redirect( '/listSup' )->with( 'berhasil', 'Data berhasil diupdate' );
              }else{
      return redirect( '/listSup' )->with( 'gagal', 'Data Gagal diupdate' );
              }

              } else {
                  return redirect( '/masukadmin' )->with( 'gagal', 'Anda sudah Logout,silahkan masuk kembali' );

              }

          }

          public function Aktif($id) {
              $token = Session::get( 'token' );
              $tokenDb = M_Admin::where( 'token', $token )->count();

              if ( $tokenDb > 0 ) {
              if(M_Suplier::where('id_suplier',$id)->update(
                [
                "status" =>"1"
                ])){
                return redirect( '/listSup' )->with( 'berhasil', 'Data berhasil diupdate' );
              }else{
      return redirect( '/listSup' )->with( 'gagal', 'Data Gagal diupdate' );
              }

              } else {
                  return redirect( '/masukadmin' )->with( 'gagal', 'Anda sudah Logout,silahkan masuk kembali' );

              }

          }

public function ubahPassword(Request $request){
  $token = Session::get( 'token' );
  $tokenDb = M_Suplier::where( 'token', $token )->count();

  if ( $tokenDb > 0 ) {
  $sup = M_Suplier::where( 'token', $token )->first();
          $key =  env( 'APP_KEY' );

    $decode = JWT::decode( $token, $key, array( 'HS256' ) );
    $decode_array = ( array ) $decode;

    if(decrypt($sup->password) == $request->passwordlama){
      if(M_Suplier::where('id_suplier',$decode_array['id_suplier'])->update(
        [
        "password" =>encrypt($request->password)
        ])){
        return redirect( '/listsuplier' )->with( 'gagal', 'password berhasil diupdate' );
      }else{
    return redirect( '/listsuplier' )->with( 'gagal', 'password Gagal diupdate' );
      }

    }else {
      // code...
      return redirect( '/listsuplier' )->with( 'gagal', 'password Gagal diupdate,password lama tidak sama' );
    }

} else {
      return redirect( '/masukSuplier' )->with( 'gagal', 'Anda sudah Logout,silahkan masuk kembali' );

  }


    }
  }
