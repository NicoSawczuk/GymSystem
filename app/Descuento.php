<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Descuento extends Model
{
    protected $guarded = [];
    public $table = "descuentos";

    //Relaciones
    public function cuota_usuario(){
        return $this->hasOne(CuotaUsuario::class);
    }


    //Metodos
    public function slug(){
        return Str::slug($this->codigo);
    }
}
