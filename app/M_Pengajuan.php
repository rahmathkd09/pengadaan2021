<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class M_Pengajuan extends Model
{
    //
    protected $table='tbl_pengajuan';
     protected $primarykey='id_pengajuan';
     protected $fillable=['id_pengajuan','id_pengadaan','id_suplier','proposal','anggaran','status'];
}
