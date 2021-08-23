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
//use model admin
use App\M_Admin;
use App\M_Pengajuan;
use App\M_Suplier;
use App\M_Pengadaan;
use App\M_Laporan;

class Pengajuan extends Controller {
    //

    public function pengajuan() {
        $key =  env( 'APP_KEY' );
        $token = Session::get( 'token' );
        $tokenDb = M_Admin::where( 'token', $token )->count();
        if ( $tokenDb > 0 ) {
            //user: admin@gmail.com
            $pengajuan = M_pengajuan::where( 'status', '1' )->paginate( 15 );
            $dataP = array();
            foreach ( $pengajuan as $p ) {
                $pengadaan = M_pengadaan::where( 'id_pengadaan', $p->id_pengadaan )->first();
                $sup = M_suplier::where( 'id_suplier', $p->id_suplier )->first();

                $dataP[] = array(

                    'id_pengajuan' => $p->id_pengajuan,
                    'nama_pengadaan' => $pengadaan->nama_pengadaan,
                    'gambar' => $pengadaan->gambar,
                    'anggaran' => $pengadaan->anggaran,
                    'proposal' => $p->proposal,
                    'anggaran_pengajuan' => $p->anggaran,
                    'status_pengajuan' =>$p->status,
                    'nama_suplier' => $sup->nama_suplier,
                    'email_suplier'=>$sup->email,
                    'alamat_suplier' =>$sup->alamat

                );

            }
            $data['adm'] = M_Admin::where( 'token', $token )->first();
            $data['pengajuan'] = $dataP;

            return view( 'pengajuan.list', $data );

        } else {
            return redirect( '/masukadmin' )->with( 'gagal', 'Anda Harus Login dahulu' );

        }

    }

    public function tambahPengajuan( Request $request ) {
        $key = env( 'APP_KEY' );
        $token = Session::get( 'token' );
        $tokenDb = M_Suplier::where( 'token', $token )->count();

        $decode = JWT::decode( $token, $key, array( 'HS256' ) );
        $decode_array = ( array ) $decode;

        if ( $tokenDb > 0 ) {
            $this->validate( $request,
            [
                'id_pengadaan'=>'required',
                'proposal' =>'required|mimes:pdf|max:10000',
                'anggaran' => 'required'
            ]
        );

        $cekPengajuan = M_Pengajuan::where( 'id_suplier', $decode_array['id_suplier'] )->where( 'id_pengadaan', $request->id_pengadaan )->count();
        if ( $cekPengajuan == 0 ) {
            $path = $request->file( 'proposal' )->store( 'public/proposal' );
            if ( M_Pengajuan::create(
                [
                    'id_pengadaan' => $request->id_pengadaan,
                    'id_suplier' => $decode_array['id_suplier'],
                    'proposal' => $path,
                    'anggaran' => $request->anggaran

                ] ) ) {
                    return redirect( '/listsuplier' )->with( 'berhasil', 'Pengajuan berhasil disimpan, Mohon ditunggu' );

                } else {

                    return redirect( '/listsuplier' )->with( 'gagal', 'Pengajuan Gagal, Mohon hubungi admin' );
                }

            } else {
                return redirect( '/listsuplier' )->with( 'gagal', 'Pengajuan pernah dilakukan' );

            }

        } else {
            return redirect( '/masukSuplier' )->with( 'gagal', 'Anda Sudah Log out' );

        }

    }

    public function terimaPengajuan( $id ) {
        $token = Session::get( 'token' );
        $tokenDb = M_Admin::where( 'token', $token )->count();
        if ( $tokenDb > 0 ) {
            if ( M_pengajuan::where( 'id_pengajuan', $id )->update(
                [
                    'status' => '2',
                ]
            ) ) {
                return redirect( '/pengajuan' )->with( 'berhasil', 'Status Pengajuan berhasil diubah' );

            } else {
                return redirect( '/pengajuan' )->with( 'gagal', 'Status Pengajuan gagal diubah' );
            }

        } else {
            return redirect( '/masukadmin' )->with( 'gagal', 'Anda Sudah Log out' );

        }

    }

    public function tolakPengajuan( $id ) {
        $token = Session::get( 'token' );
        $tokenDb = M_Admin::where( 'token', $token )->count();
        if ( $tokenDb > 0 ) {
            if ( M_pengajuan::where( 'id_pengajuan', $id )->update(
                [
                    'status' => '0',
                ]
            ) ) {
                return redirect( '/pengajuan' )->with( 'berhasil', 'Status Pengajuan berhasil diubah' );

            } else {
                return redirect( '/pengajuan' )->with( 'gagal', 'Status Pengajuan gagal diubah' );
            }

        } else {
            return redirect( '/masukadmin' )->with( 'gagal', 'Anda Sudah Log out' );

        }

    }

    public function riwayatku() {
        $key = env( 'APP_KEY' );
        $token = Session::get( 'token' );
        $tokenDb = M_Suplier::where( 'token', $token )->count();

        $decode = JWT::decode( $token, $key, array( 'HS256' ) );
        $decode_array = ( array ) $decode;

        if ( $tokenDb > 0 ) {
            $pengajuan = M_pengajuan::where( 'id_suplier', $decode_array['id_suplier'] )->where('status', '!=','3')->get();
            $dataArr = array();
            foreach ( $pengajuan as $p ) {
                $pengadaan = M_pengadaan::where( 'id_pengadaan', $p->id_pengadaan )->first();
                $sup = M_suplier::where( 'id_suplier',$decode_array['id_suplier'] )->first();

                $lapCount = M_Laporan::where( 'id_pengajuan', $p->id_pengajuan )->count();
                $lap = M_Laporan::where( 'id_pengajuan', $p->id_pengajuan )->first();

                if ( $lapCount  > 0 ) {
                    $lapLink = $lap->laporan;

                } else {
                    $lapLink = '-';

                }

                $dataArr[] = array(
                    'id_pengajuan' => $p->id_pengajuan,
                    'nama_pengadaan' => $pengadaan->nama_pengadaan,
                    'gambar' => $pengadaan->gambar,
                    'anggaran' => $pengadaan->anggaran,
                    'proposal' => $p->proposal,
                    'anggaran_pengajuan' => $p->anggaran,
                    'status_pengajuan' =>$p->status,
                    'nama_suplier' => $sup->nama_suplier,
                    'email_suplier'=>$sup->email,
                    'alamat_suplier' =>$sup->alamat,
                    'laporan' => $lapLink

                );
            }
                          $data['sup'] = M_suplier::where('token',$token)->first();
                            $data['pengajuan'] = $dataArr;
                            return view( 'login_sup.riwayat_pengajuan', $data );


        } else {
            return redirect( '/listsuplier' )->with( 'gagal', 'Pengajuan pernah dilakukan' );

        }

    }

    public function tambahLaporan( Request $request ) {
        $key = env( 'APP_KEY' );
        $token = Session::get( 'token' );
        $tokenDb = M_Suplier::where( 'token', $token )->count();

        $decode = JWT::decode( $token, $key, array( 'HS256' ) );
        $decode_array = ( array ) $decode;

        if ( $tokenDb > 0 ) {
            $this->validate( $request,
            [
                'id_pengajuan'=>'required',
                'laporan' =>'required|mimes:pdf|max:10000'

            ]
        );

        $cekLaporan = M_Laporan::where( 'id_suplier', $decode_array['id_suplier'] )->where( 'id_pengajuan', $request->id_pengajuan )->count();
        if ( $cekLaporan == 0 ) {
            $path = $request->file( 'laporan' )->store( 'public/laporan' );
            if ( M_Laporan::create(
                [
                    'id_pengajuan' => $request->id_pengajuan,
                    'id_suplier' => $decode_array['id_suplier'],
                    'laporan' => $path,

                ] ) ) {
                    return redirect( '/riwayatku' )->with( 'berhasil', 'Laporan berhasil disimpan' );

                } else {

                    return redirect( '/riwayatku' )->with( 'gagal', 'Laporan Gagal, Mohon hubungi admin' );
                }

            } else {
                return redirect( '/riwayatku' )->with( 'gagal', 'Laporan pernah dilakukan' );

            }

        } else {
            return redirect( '/masukSuplier' )->with( 'gagal', 'Anda Sudah Log out' );

        }

    }

    public function laporan() {
        $key =  env( 'APP_KEY' );
        $token = Session::get( 'token' );
        $tokenDb = M_Admin::where( 'token', $token )->count();
        if ( $tokenDb > 0 ) {
            //user: admin@gmail.com
            $pengajuan = M_pengajuan::where( 'status', '2' )->paginate( 15 );
            $dataP = array();
            foreach ( $pengajuan as $p ) {
                $pengadaan = M_pengadaan::where( 'id_pengadaan', $p->id_pengadaan )->first();
                $sup = M_suplier::where( 'id_suplier', $p->id_suplier )->first();

                $c_laporan = M_Laporan::where( 'id_pengajuan', $p->id_pengajuan )->count();
                $laporan = M_laporan::where( 'id_pengajuan', $p->id_pengajuan )->first();

                if ( $c_laporan>0 ) {
                    $dataP[] = array(
                        'id_pengajuan' => $p->id_pengajuan,
                        'nama_pengadaan' => $pengadaan->nama_pengadaan,
                        'gambar' => $pengadaan->gambar,
                        'anggaran' => $pengadaan->anggaran,
                        'proposal' => $p->proposal,
                        'anggaran_pengajuan' => $p->anggaran,
                        'status_pengajuan' =>$p->status,
                        'nama_suplier' => $sup->nama_suplier,
                        'email_suplier'=>$sup->email,
                        'alamat_suplier' =>$sup->alamat,
                        'laporan' =>$laporan->laporan,
                        'id_laporan' =>$laporan->id_laporan,
                        );

                }

            }
            $data['adm'] = M_Admin::where( 'token', $token )->first();
            $data['pengajuan'] = $dataP;
          //  print_r( $data );

          return view( 'admin.laporan', $data );

        } else {
            return redirect( '/masukadmin' )->with( 'gagal', 'Anda Harus Login dahulu' );

        }

    }

    public function selesaiPengajuan( $id ) {
        $token = Session::get( 'token' );
        $tokenDb = M_Admin::where( 'token', $token )->count();
        if ( $tokenDb > 0 ) {
            if ( M_pengajuan::where( 'id_pengajuan', $id )->update(
                [
                    'status' => '3',
                ]
            ) ) {
                return redirect( '/laporan' )->with( 'berhasil', 'Status Pengajuan berhasil diubah' );

            } else {
                return redirect( '/laporan' )->with( 'gagal', 'Status Pengajuan gagal diubah' );
            }

        } else {
            return redirect( '/masukadmin' )->with( 'gagal', 'Anda Sudah Log out' );

        }

    }

    public function pengajuanSelesai() {
        $key = env( 'APP_KEY' );
        $token = Session::get( 'token' );
        $tokenDb = M_Suplier::where( 'token', $token )->count();

        $decode = JWT::decode( $token, $key, array( 'HS256' ) );
        $decode_array = ( array ) $decode;

        if ( $tokenDb > 0 ) {
            $pengajuan = M_pengajuan::where( 'id_suplier', $decode_array['id_suplier'] )->where( 'status', '3' ) ->get();
            $dataArr = array();
            foreach ( $pengajuan as $p ) {
                $pengadaan = M_pengadaan::where( 'id_pengadaan', $p->id_pengadaan )->first();
                $sup = M_suplier::where( 'id_suplier', $p->id_suplier )->first();

                $lapCount = M_Laporan::where( 'id_pengajuan', $p->id_pengajuan )->count();
                $lap = M_Laporan::where( 'id_pengajuan', $p->id_pengajuan )->first();

                if ( $lapCount  > 0 ) {
                    $lapLink = $lap->laporan;

                } else {
                    $lapLink = '-';

                }

                $dataArr[] = array(
                    'id_pengajuan' => $p->id_pengajuan,
                    'nama_pengadaan' => $pengadaan->nama_pengadaan,
                    'gambar' => $pengadaan->gambar,
                    'anggaran' => $pengadaan->anggaran,
                    'proposal' => $p->proposal,
                    'anggaran_pengajuan' => $p->anggaran,
                    'status_pengajuan' =>$p->status,
                    'nama_suplier' => $sup->nama_suplier,
                    'email_suplier'=>$sup->email,
                    'alamat_suplier' =>$sup->alamat,
                    'laporan' => $lapLink

                );
                $data['sup'] = M_suplier::where('token',$token)->first();
                $data['pengajuan'] = $dataArr;
                return view( 'login_sup.pengajuanSelesai', $data );

            }

        } else {
            return redirect( '/listsuplier' )->with( 'gagal', 'Pengajuan pernah dilakukan' );

        }

    }

 public function tolakLaporan($id){
            $token= Session::get('token');
            $tokenDb = M_admin::where('token',$token)->count();
            if($tokenDb > 0){
                $laporan = M_Laporan::where('id_laporan',$id)->count();
                if($laporan > 0){
                    $dataLaporan =  M_Laporan::where('id_laporan',$id)->first();
                    if(Storage::delete($dataLaporan->laporan)
                    ){
                        if(M_Laporan::where('id_laporan',$id)->delete()){
                            return redirect('/laporan')->with('berhasil','Laporan Berhasil ditolak');


                    }else{
                        return redirect('/laporan')->with('gagal','Laporan Gagal ditolak');

                    }


            }else{
                return redirect('/laporan')->with('gagal','tidak tersedia');
            }

        }
      }
    }



}
