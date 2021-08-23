<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class M_Suplier extends Model
{
    protected $table='tbl_suplier';
    protected $primarykey='id_suplier';
    protected $fillable=['id_suplier','nama_suplier','email','alamat','no_npwp','password','status','token'];
        
}

//di setiap table yang dibuat harus ada column Created_at dan Updated_at denganisi otomatis dari sistem