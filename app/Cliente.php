<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    protected $guarded = [];
    public $table = "clientes";


    public function especialidad(){
        return $this->belongsTo(Especialidad::class);
    }
    
    public function gimnasio(){
        return $this->belongsTo(Gimnasio::class, 'gimnasio_id');
    }

    public function estado(){
        return $this->belongsTo(Estado::class);
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }

    public function cuotas()
    {
        return $this->hasMany(Cuota::class);
    }



    public function getEdad(){
        return Carbon::parse($this->fecha_nacimiento)->age;
    }

}
