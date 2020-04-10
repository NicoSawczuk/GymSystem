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

    public function bajaClientes(){
        return $this->hasMany(BajaCliente::class);
    }

    //Metodos
    public function getEdad(){
        return Carbon::parse($this->fecha_nacimiento)->age;
    }

    public function getDeuda(){
        return Cuota::where('cliente_id', $this->id)->orderBy('fecha_pago_realizado', 'desc')->value('monto_deuda');
    }

    public function getCuotaVencida(){
        //Este metodo se usa para saber qué tipo de deuda tiene el cliente
        return Cuota::where('cliente_id', $this->id)->orderBy('fecha_pago_realizado', 'desc')->value('vencido');
    }

    public function getUltimasTresCuotas(){
        //Este metodo devuleve informacion sobre las ultimas tres cuotas que pago el cliente
        return Cuota::where('cliente_id', $this->id)->orderBy('fecha_pago', 'desc')->take(3)->get();
        
    }

    public function getUltimaInscripcion(){
        //Este metodo devuleve la ultima inscripcion del cliente
        return Inscripcion::where('cliente_id', $this->id)->orderBy('fecha_inscripcion', 'desc')->take(1)->first();
        
    }

}
