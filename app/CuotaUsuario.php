<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CuotaUsuario extends Model
{
    protected $guarded = [];
    public $table = "cuotas_usuarios";

    //Relaciones
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function descuento(){
        return $this->belongsTo(Descuento::class);
    }

    public function pago_usuario(){
        return $this->hasOne(PagoUsuario::class);
    }
}
