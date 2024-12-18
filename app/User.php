<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Caffeinated\Shinobi\Concerns\HasRolesAndPermissions;
use Illuminate\Support\Str;
class User extends Authenticatable
{
    use Notifiable;
    use HasRolesAndPermissions;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Relaciones
    public function gimnasios(){
        return $this->hasMany(Gimnasio::class);
    }

    public function especialidades(){
        return $this->hasMany(Especialidad::class);
    }

    public function cuotas(){
        return $this->hasMany(CuotaUsuario::class);
    }

    public function pagos(){
        return $this->hasMany(PagoUsuario::class);
    }

    //Metodos
    public function slug(){
        return Str::slug($this->name)."-".Str::slug($this->apellido);
    }
}
