namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'puesto', 'status', 'contraseña', 'id_Area'];

    protected $hidden = ['contraseña'];

    public function area()
    {
        return $this->belongsTo(Area::class, 'id_Area');
    }

    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'id_director');
    }

    public function honorarios()
    {
        return $this->hasMany(Honorario::class, 'id_director');
    }
}
