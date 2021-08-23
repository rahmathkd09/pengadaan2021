<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class M_Laporan extends Model {
    //
    protected $table = 'tbl_laporan';
    protected $primarykey = 'id_laporan';
    protected $fillable = ['id_laporan', 'id_pengajuan', 'id_suplier', 'laporan'];
}
