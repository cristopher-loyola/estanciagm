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
        'role',
        'id_director',
        'id_area',
        'vacaciones',
        'permisos',
        'asistencia',
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

    // Relaciones
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'id_area')->withDefault([
            'nombre' => 'Sin área asignada'
        ]);
    }
    public function director(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_director');
    }

    public function empleados(): HasMany
    {
        return $this->hasMany(User::class, 'id_director')->where('role', 'empleado');
    }

    public function honorarios(): HasMany
    {
        return $this->hasMany(User::class, 'id_director')->where('role', 'honorario');
    }

    // Nuevo método para directores
    public function scopeDirectores($query)
    {
        return $query->where('role', 'director');
    }
    public function vacationRequests() {
        return $this->hasMany(VacationRequest::class);
    }

    public function vacations()
{
    return $this->hasMany(Vacation::class, 'user_id');
}



    
}

