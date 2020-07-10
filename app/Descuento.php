<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Descuento extends Model
{
    protected $guarded = [];
    public $table = "descuentos";

    //Relaciones
    public function cuota_usuario(){
        return $this->hasOne(CuotaUsuario::class);
    }
}
