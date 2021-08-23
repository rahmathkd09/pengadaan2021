<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
//lib mode M_suplier
use App\M_Suplier;

//import model pengadaan
use App\M_Pengadaan;


class Home extends Controller
{
    //membuat fungsi index
    public function index() {
        //update session 290721
        $token = session ::get('token');
        $tokenDb = M_suplier::where('token',$token)->count();
        if($tokenDb>0){
            $data['token']=$token;

        }else{

            $data['token']='kosong';
        }
        //echo "Fungsi Index Home"; jika view di dalam folder
       // print_r ($data);
       $data['pengadaan'] = M_pengadaan::where('status','1')->paginate(15);
        return view('utama.home',$data);
       // return view('home'); jika view di root view session
       
    }
}
?>
