<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagoUsuario extends Model
{
    protected $guarded = [];
    public $table = "pagos_usuarios";

    //Relaciones
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function cuota_usuario(){
        return $this->belongsTo(CuotaUsuario::class);
    }
}
