<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{

    protected $guarded = [];
    public $table = "paises";
    
    public function provincias(){
        return $this->hasMany(Provincia::class);
    }
}
