<?php
// Modelo de Usuario para la autenticación
namespace App\auth\Modelo;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'correo',
        'usuario',
        'contrasena',
        'rol',
        'token',
        'sesion_activa',
        'estado',
        'created_at',
        'updated_at',
    ];

    public $timestamps = false;
}
