<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permisos extends Model
{
    use HasFactory;
    protected $table="permisos";

    protected $fillable = [
        'permiso',
    ];

    public function permisos() {
        $this->belongsToMany(Roles::class, 'roles_permisos', 'permiso_id', 'role_id');
    }
}
