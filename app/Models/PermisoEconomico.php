<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermisoEconomico extends Model

{
    use HasFactory;
    protected $table = 'permisos_economicos';

    protected $fillable = [
        'user_id',
        'fecha_solicitud',
        'fecha_inicio',
        'fecha_fin',
        'motivo',
        'estado'
    ];

    protected $casts = [
        'fecha_solicitud' => 'datetime',
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);  // Relación con la tabla users
    }
}
