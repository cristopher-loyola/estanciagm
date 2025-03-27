<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vacation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'start_date', 'end_date', 'status'];
    
    // Añade esto para convertir automáticamente las fechas a Carbon
    protected $casts = [
        'start_date' => 'date:Y-m-d',
        'end_date' => 'date:Y-m-d',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}