<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Area extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'id_area');
    }

    public function directores(): HasMany
    {
        return $this->hasMany(User::class, 'id_area')->where('role', 'director');
    }
}