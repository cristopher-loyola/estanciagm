namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Honorario extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'id_director', 'contraseña', 'asistencia', 'vacaciones', 'permisos'];

    protected $hidden = ['contraseña'];

    public function director()
    {
        return $this->belongsTo(Director::class, 'id_director');
    }
}
