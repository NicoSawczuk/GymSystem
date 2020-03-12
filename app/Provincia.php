<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    protected $guarded = [];
    public $table = "provincias";

    public function pais(){
        return $this->belongsTo('App\Pais', 'pais_id');
    }

    public function ciudades(){
        return $this->hasMany(Ciudad::class);
    }
}
