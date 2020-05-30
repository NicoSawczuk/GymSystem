<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gimnasio extends Model
{
    protected $guarded = [];
    public $table = "gimnasios";

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function especialidades(){
        return $this->belongsToMany(Especialidad::class, 'gimnasios_especialidades');
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

    public function email_configuracion()
    {
        return $this->hasOne(EmailConfiguracion::class);
    }

    public function reporte_configuracion()
    {
        return $this->hasOne(ReporteConfiguracion::class);
    }

    public function bajaClientes(){
        return $this->hasMany(BajaCliente::class);
    }


    //Metodos
    public function slug(){
        return Str::slug($this->nombre);
    }

    public function getClientes(){
        return Cliente::where('gimnasio_id', $this->id)->count();
    }

    public function getNoInscriptos(){
        return Cliente::where(['gimnasio_id'=> $this->id, 'estado_id' => Estado::where('orden',1)->value('id')])->count();
    }

    public function getInscriptos(){
        return Cliente::where(['gimnasio_id'=> $this->id, 'estado_id' => Estado::where('orden',2)->value('id')])->count();
    }

    public function getEnRegla(){
        return Cliente::where(['gimnasio_id'=> $this->id, 'estado_id' => Estado::where('orden',3)->value('id')])->count();
    }

    public function getEnDeuda(){
        return Cliente::where(['gimnasio_id'=> $this->id, 'estado_id' => Estado::where('orden',4)->value('id')])->count();
    }

    public function getInscriptosPorMes($mes, $año=''){
        if ($año == ''){
            $año = date('Y');
        }
        $clientes = 0;
        foreach ($this->clientes as $cliente) {
            if ($cliente->created_at->format('m') == $mes && $cliente->created_at->format('Y') == $año){
                $clientes++;
            }
        }
        return $clientes;
    } 

    public function getPorcentajeEstados(){

        $data = array(
            round(($this->getNoInscriptos() * 100)/$this->getClientes()),
            round(($this->getInscriptos() * 100)/$this->getClientes()),
            round(($this->getEnRegla() * 100)/$this->getClientes()),
            round(($this->getEnDeuda() * 100)/$this->getClientes()),
        );

        return collect($data);
    }
}
