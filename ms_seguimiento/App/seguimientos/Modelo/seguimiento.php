<?php
namespace App\seguimiento\Modelo;

use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    protected $table = 'seguimientos';

    protected $fillable = [
        'incapacidad_id',
        'fecha',
        'comentario',
        'estado',
        'usuario_responsable',
        'created_at',
        'updated_at',
    ];

    public $timestamps = false;
}
