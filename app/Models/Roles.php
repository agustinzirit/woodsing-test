<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $table="roles";

    protected $fillable = [
        'nombre',
    ];

    public function rol() {
        $this->has Many(Usuarios::class, 'role_id');
    }

    public function permisos() {
        $this->belongsToMany(Permisos::class, 'roles_permisos', 'role_id', 'permiso_id');
    }

}
