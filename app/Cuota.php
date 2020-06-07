<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        return $this->belongsTo(Especialidad::class, 'especialidad_id');
    }

    public function gimnasio()
    {
        return $this->belongsTo(Gimnasio::class, 'gimnasio_id');
    }

    public function inscripcion()
    {
        return $this->belongsTo(Inscripcion::class, 'inscripcion_id');
    }

    //Metodos
    public function slug(){
        return Str::slug($this->nombre);
    }
}
