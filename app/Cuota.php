<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuota extends Model
{
    protected $guarded = [];
    public $table = "cuotas";

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function especialidad()
    {
        return $this->belongsTo(Cliente::class, 'especialidad_id');
    }

    public function gimnasio()
    {
        return $this->belongsTo(Cliente::class, 'gimnasio_id');
    }
}
