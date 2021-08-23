<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class M_Admin extends Model
{
    //
    protected $table='tbl_admin';
    protected $primarykey='id_admin';
    protected $fillable=['id_admin','nama','email','alamat','password','status','token'];
}
