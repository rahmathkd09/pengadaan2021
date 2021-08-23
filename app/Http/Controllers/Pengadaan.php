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

//import classsstoragw
use Illuminate\Support\Facades\Storage;

//import lib encript
use Illuminate\Contracts\Encryption\DecryptException;
use App\M_Admin;
use App\M_Pengadaan;
use App\M_SUplier;

class Pengadaan extends Controller
{
    public function index(){
    $token = Session::get('token');
    $tokenDb = M_Admin::where('token',$token)->count();
    if ($tokenDb > 0){
      $data['adm'] = M_Admin::where('token',$token)->first();
        $data['pengadaan'] = M_Pengadaan::where('status','1')->paginate(2);

        return view('pengadaan.list',$data);
    }else{
        return redirect('/masukadmin')->with('gagal','Anda sudah Logout,silahkan masuk kembali');
    }
    }

        public function tambahPengadaan(Request $request){
            $token= Session::get('token');
            $tokenDb = M_admin::where('token',$token)->count();

            if ($tokenDb > 0){
                $this->validate($request,
        [
            'nama_pengadaan'=>'required',
            'deskripsi' =>'required',
            'gambar' =>'required|image|mimes:jpg,png,gif,jpeg|max:10000',
            'anggaran' => 'required'
         ]
        );
            $path = $request->file('gambar')->store('public/gambar');

            if (M_pengadaan::create([
                "nama_pengadaan" => $request->nama_pengadaan,
                "deskripsi" => $request->deskripsi,
                "gambar" => $path,
                "anggaran" => $request->anggaran

            ])){
                return redirect('/listpengadaan')->with('berhasil','Data Berhasil disimpan');

            }else{

                return redirect('/listpengadaan')->with('gagal','Data gagal disimpan');
            }

            }else{
                return redirect('/masukadmin')->with('gagal','Anda sudah Logout,silahkan masuk kembali');

            }

        }


        public function hapusGambar($id){
            $token= Session::get('token');
            $tokenDb = M_admin::where('token',$token)->count();
            if($tokenDb > 0){
                $pengadaan = M_Pengadaan::where('id_pengadaan',$id)->count();
                if($pengadaan > 0){
                    $dataPengadaan =  M_pengadaan::where('id_pengadaan',$id)->first();
                    if(Storage::delete($dataPengadaan->gambar)
                    ){
                        if(M_pengadaan::where('id_pengadaan',$id)->update(["gambar" => "-"]))
                        return redirect('/listpengadaan')->with('berhasil','Gambar Berhasil dihapus');

                    }else{
                        return redirect('/listpengadaan')->with('gagal','Data tidak ditemukan');

                    }
                }

            }else{
                return redirect('/listpengadaan')->with('gagal','Gambar gagal dihapus');
            }

        }
        public function uploadGambar(Request $request){
            $token= Session::get('token');
            $tokenDb = M_admin::where('token',$token)->count();

            if ($tokenDb > 0){
                $this->validate($request,
        [

            'gambar' =>'required|image|mimes:jpg,png,gif,jpeg|max:10000',

         ]
        );
            $path = $request->file('gambar')->store('public/gambar');

            if (M_pengadaan::where('id_pengadaan',$request->id_pengadaan)->update( [


                "gambar" => $path,


            ])){
                return redirect('/listpengadaan')->with('berhasil','Data Berhasil disimpan');

            }else{

                return redirect('/listpengadaan')->with('gagal','Data gagal disimpan');
            }

            }else{
                return redirect('/masukadmin')->with('gagal','Anda sudah Logout,silahkan masuk kembali');

            }

        }

        public function ubahPengadaan(Request $request){
            $token= Session::get('token');
            $tokenDb = M_admin::where('token',$token)->count();

            if ($tokenDb > 0){
                $this->validate($request,
        [

            'u_nama_pengadaan'=>'required',
            'u_deskripsi' =>'required',
            'u_anggaran' => 'required'

         ]
        );


            if (M_pengadaan::where('id_pengadaan',$request->id_pengadaan)->update( [


                "nama_pengadaan" => $request->u_nama_pengadaan,
                "deskripsi" => $request->u_deskripsi,
                "anggaran" => $request->u_anggaran



            ])){
                return redirect('/listpengadaan')->with('berhasil','Data Berhasil diubah');

            }else{

                return redirect('/listpengadaan')->with('gagal','Data gagal diubah');
            }

            }else{
                return redirect('/masukadmin')->with('gagal','Anda sudah Logout,silahkan masuk kembali');

            }

        }

        public function hapusPengadaan($id){
            $token= Session::get('token');
            $tokenDb = M_admin::where('token',$token)->count();
            if($tokenDb > 0){
                $pengadaan = M_Pengadaan::where('id_pengadaan',$id)->count();
                if($pengadaan > 0){
                    $dataPengadaan =  M_pengadaan::where('id_pengadaan',$id)->first();
                    if(Storage::delete($dataPengadaan->gambar)){
                        if(M_pengadaan::where('id_pengadaan',$id)->delete()){
                        return redirect('/listpengadaan')->with('berhasil','data Berhasil dihapus');

                    }else{
                        return redirect('/listpengadaan')->with('gagal','Data tidak ditemukan');

                    }
                }

            }else{
                return redirect('/listpengadaan')->with('gagal','data gagal dihapus');
            }

        }


}

public function listSuplier(){
    $key =  env( 'APP_KEY' );
    $token = Session::get('token');
    $tokenDb = M_Suplier::where('token',$token)->count();
    if ($tokenDb > 0){
        $data['sup'] = M_suplier::where('token',$token)->first();
        $data['pengadaan'] = M_Pengadaan::where('status','1')->paginate(15);

        return view('login_sup.pengadaan',$data);
    }else{
        return redirect('/login')->with('gagal','password tidak sama');
    }
    }




}
