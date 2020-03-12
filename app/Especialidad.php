<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $guarded = [];
    public $table = "especialidades";
    public function gimnasios(){
        return $this->belongsToMany(Gimnasio::class, 'gimnasio_id');
    }
}
