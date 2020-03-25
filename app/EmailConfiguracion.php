<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailConfiguracion extends Model
{
    protected $guarded = [];
    public $table = "email_configuracion";

    //Relaciones
    public function gimnasio(){
        return $this->belongsTo(Gimnasio::class);
    }
}
