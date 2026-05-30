<?php
namespace App\empleados\Modelo;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados';

    protected $fillable = [
        'nombres',
        'apellidos',
        'documento',
        'correo',
        'telefono',
        'cargo',
        'area',
        'fecha_ingreso',
        'estado',
        'created_at',
        'updated_at',
    ];

    public $timestamps = false;
}
