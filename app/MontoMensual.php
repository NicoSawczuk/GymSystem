<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MontoMensual extends Model
{
    protected $guarded = [];
    public $table = "montos_mensuales";

    //Metodos
    public function slug(){
        return Str::slug($this->monto)."-".Str::slug($this->mes)."-".Str::slug($this->ano);
    }
}
