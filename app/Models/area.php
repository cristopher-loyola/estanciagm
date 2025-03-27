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

    public function show($id)
{
    $area = Area::findOrFail($id);
    $users = User::where('id_area', $area->id)->with('vacations')->get();

    return view('admin.areas.show', compact('area', 'users'));
}

}