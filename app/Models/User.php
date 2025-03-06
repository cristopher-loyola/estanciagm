<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',  // Para identificar si es admin, director, empleado u honorario
        'id_director', // Para empleados y honorarios
        'id_area', // Para directores
        'vacaciones',
        'permisos',
        'asistencia', // Solo para honorarios
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Un director pertenece a un área
     */
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'id_area');
    }

    /**
     * Un área tiene muchos directores
     */
    public function directores(): HasMany
    {
        return $this->hasMany(User::class, 'id_area')->where('role', 'director');
    }

    /**
     * Un empleado pertenece a un director
     */
    public function director(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_director')->where('role', 'director');
    }

    /**
     * Un director tiene muchos empleados
     */
    public function empleados(): HasMany
    {
        return $this->hasMany(User::class, 'id_director')->where('role', 'empleado');
    }

    /**
     * Un director tiene muchos empleados de honorarios
     */
    public function honorarios(): HasMany
    {
        return $this->hasMany(User::class, 'id_director')->where('role', 'honorario');
    }
}
