<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $guarded = [];
    public $table = "especialidades";

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
    public function getClientes(){
        return $this->clientes->count();
    }
}
