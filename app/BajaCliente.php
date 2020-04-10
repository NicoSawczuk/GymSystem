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
        return $this->belongsTo(Gimnasio::class, 'gimnasio_id');
    }

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'especialidad_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'especialidad_id');
    }

}
