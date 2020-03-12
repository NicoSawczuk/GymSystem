<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    protected $guarded = [];
    public $table = "ciudades";

    public function provincia(){
        return $this->belongsTo('App\Provincia', 'provincia_id');
    }
}
