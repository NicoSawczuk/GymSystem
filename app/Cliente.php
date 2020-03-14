<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    protected $guarded = [];
    public $table = "clientes";


    public function especialidades(){
        return $this->hasMany(Especialidad::class);
    }
    
}
