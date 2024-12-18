<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Especialidad extends Model
{
    protected $guarded = [];
    public $table = "especialidades";

    //Relaciones
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function gimnasios(){
        return $this->belongsToMany(Gimnasio::class, 'gimnasios_especialidades');
    }

    public function clientes(){
        return $this->hasMany(Cliente::class);
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }

    public function cuotas()
    {
        return $this->hasMany(Cuota::class);
    }

    public function bajaClientes(){
        return $this->hasMany(BajaCliente::class);
    }

    //Metodos
    public function slug(){
        return Str::slug($this->nombre);
    }
    public function getClientes(){
        return $this->clientes->count();
    }
    
}
