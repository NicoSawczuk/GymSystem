<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BajaCliente extends Model
{
    protected $guarded = [];
    public $table = "baja_clientes";

    //Relaciones
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
    
    public function gimnasio()
    {
        return $this->belongsTo(Cliente::class, 'gimnasio_id');
    }

    public function especialidad()
    {
        return $this->belongsTo(Cliente::class, 'especialidad_id');
    }

}
