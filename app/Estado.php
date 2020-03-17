<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{

    protected $guarded = [];
    public $table = "estados";


    public function clientes(){
        return $this->hasMany(Cliente::class);
    }
}
