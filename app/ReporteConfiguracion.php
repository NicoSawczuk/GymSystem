<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReporteConfiguracion extends Model
{
    
    protected $guarded = [];
    public $table = "reporte_configuracion";


    //Relaciones
    public function gimnasio(){
        return $this->belongsTo(Gimnasio::class);
    }
}
