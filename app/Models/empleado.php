namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'id_director', 'contraseña', 'correo', 'vacaciones', 'permisos'];

    protected $hidden = ['contraseña'];

    public function director()
    {
        return $this->belongsTo(Director::class, 'id_director');
    }
}
