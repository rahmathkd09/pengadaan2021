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
//use model admin
use App\M_Admin;
use App\M_Suplier;

class Admin extends Controller {
    //

    public function index() {
        return view( 'admin.login' );
    }

    /* fungsi untuk membuat dummy data admin utk login

    public function adminGenerate() {
        M_admin::create(
            [
                'nama' => 'admin',
                'email' => 'admin@gmail.com',
                'alamat' => 'Jl. Ahmad Yani Nomor 1',
                'password' => encrypt( 'admin@gmail.com' )
            ] );
        }
        */

        public function loginAdmin( Request $request ) {
            $this->validate( $request,
            [
                'email'=>'required',
                'password' =>'required'
            ]
        );
        $cek = M_Admin::where( 'email', $request->email )->count();
        //echo $cek;

        $adm = M_Admin::where( 'email', $request->email )->get();
        if ( $cek > 0 ) {
            foreach ( $adm as $ad ) {
                if ( decrypt( $ad->password ) == $request->password ) {
                    $key = env( 'APP_KEY' );
                    $data = array(
                        'id_admin'  => $ad->id_admin,
                    );
                    $jwt =   JWT::encode( $data, $key );
                    M_admin::where( 'id_admin', $ad->id_admin )->update( [
                        'token' => $jwt,
                    ] );
                    Session::put( 'token', $jwt );
                    return redirect( '/pengajuan' )->with( 'berhasil', 'Selamat Datang Admin' );
                } else {
                    return redirect( '/masukadmin' )->with( 'gagal', 'Password Salah' );
                }
            }

        } else {
            return redirect( '/masukadmin' )->with( 'gagal', 'Data Email tidak terdaftar' );

        }
    }

    public function keluarAdmin() {
        $token = Session::get( 'token' );

        if ( M_Admin::where( 'token', $token )->update(
            [
                'token' => 'keluar'
            ]
        ) ) {

            Session::put( 'token', 'kosong' );
            return redirect( '/masukadmin' )->with( 'gagal', 'Anda sudah Logout' );
        } else {
            return redirect( '/masukadmin' )->with( 'gagal', 'Anda Gagal Logout' );
        }

    }

    public function listAdmin() {
        $token = Session::get( 'token' );
        $tokenDb = M_Admin::where( 'token', $token )->count();

        if ( $tokenDb > 0 ) {
          $data['adm'] = M_Admin::where( 'token', $token )->first();
            $data['admin'] = M_Admin::where( 'status', '1' )->paginate( 15 );
            // print_r( $data );
            return view( 'admin.list', $data );

        } else {
            return redirect( '/masukadmin' )->with( 'gagal', 'Anda sudah Logout,silahkan masuk kembali' );

        }

    }

    public function tambahAdmin( Request $request ) {
        $this->validate( $request,
        [
            'nama'=>'required',
            'email'=>'required',
            'alamat'=>'required',
            'password' =>'required'
        ] );

        $token = Session::get( 'token' );
        $tokenDb = M_Admin::where( 'token', $token )->count();

        if ( $tokenDb > 0 ) {
            if ( M_Admin::create( [
                'nama' => $request -> nama,
                'email' => $request -> email,
                'alamat' => $request -> alamat,
                'password'=> encrypt( $request->password )
            ] ) ) {
                return redirect( '/listadmin' )->with( 'berhasil', 'Data berhasil disimpan' );

            } else {
                return redirect( '/listadmin' )->with( 'gagal', 'Data Gagal disimpan' );

            }

        } else {
            return redirect( '/masukadmin' )->with( 'gagal', 'Anda sudah Logout,silahkan masuk kembali' );

        }

    }

    public function ubahAdmin( Request $request ) {
        $this->validate( $request,
        [
            'u_nama'=>'required',
            'u_email'=>'required',
            'u_alamat'=>'required'
        ] );

        $token = Session::get( 'token' );
        $tokenDb = M_Admin::where( 'token', $token )->count();

        if ( $tokenDb > 0 ) {
            if ( M_Admin::where( 'id_admin', $request->id_admin )->update( [
                'nama' => $request -> u_nama,
                'email' => $request -> u_email,
                'alamat' => $request -> u_alamat,

            ] ) ) {
                return redirect( '/listadmin' )->with( 'berhasil', 'Data berhasil diubah' );

            } else {
                return redirect( '/listadmin' )->with( 'gagal', 'Data Gagal diubah' );

            }

        } else {
            return redirect( '/masukadmin' )->with( 'gagal', 'Anda sudah Logout,silahkan masuk kembali' );

        }

    }

    public function hapusAdmin( $id ) {

        $token = Session::get( 'token' );
        $tokenDb = M_Admin::where( 'token', $token )->count();

        if ( $tokenDb > 0 ) {
            if ( M_Admin::where( 'id_admin', $id )->delete() ) {
                return redirect( '/listadmin' )->with( 'berhasil', 'Data berhasil diubah' );

            } else {
                return redirect( '/listadmin' )->with( 'gagal', 'Data Gagal diubah' );

            }

        } else {
            return redirect( '/masukadmin' )->with( 'gagal', 'Anda sudah Logout,silahkan masuk kembali' );

        }

    }
    public function listSup() {
        $token = Session::get( 'token' );
        $tokenDb = M_Admin::where( 'token', $token )->count();

        if ( $tokenDb > 0 ) {
            $data['suplier'] = M_Suplier::paginate( 15 );
            // print_r( $data );
            return view( 'admin.listSup', $data );

        } else {
            return redirect( '/masukadmin' )->with( 'gagal', 'Anda sudah Logout,silahkan masuk kembali' );

        }

    }

    public function ubahPassword(Request $request){
      $token = Session::get( 'token' );
      $tokenDb = M_Admin::where( 'token', $token )->count();

      if ( $tokenDb > 0 ) {
      $sup = M_Admin::where( 'token', $token )->first();
              $key =  env( 'APP_KEY' );

        $decode = JWT::decode( $token, $key, array( 'HS256' ) );
        $decode_array = ( array ) $decode;

        if(decrypt($sup->password) == $request->passwordlama){
          if(M_Admin::where('id_admin',$decode_array['id_admin'])->update(
            [
            "password" =>encrypt($request->password)
            ])){
            return redirect( '/masukadmin' )->with( 'gagal', 'password berhasil diupdate' );
          }else{
        return redirect( '/masukadmin' )->with( 'gagal', 'password Gagal diupdate' );
          }

        }else {
          // code...
          return redirect( '/masukadmin' )->with( 'gagal', 'password Gagal diupdate,password lama tidak sama' );
        }

    } else {
          return redirect( '/masukadmin' )->with( 'gagal', 'Anda sudah Logout,silahkan masuk kembali' );

      }


        }
      }
