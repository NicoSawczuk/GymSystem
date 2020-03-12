<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
