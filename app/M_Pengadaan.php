<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use model admin


class M_Pengadaan extends Model
{
    //
     //
     protected $table='tbl_pengadaan';
     protected $primarykey='id_pengadaan';
     protected $fillable=['id_pengadaan','nama_pengadaan','deskripsi','gambar',
     'anggaran','status'];
}
