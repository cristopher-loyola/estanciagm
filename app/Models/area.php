namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    public function directores()
    {
        return $this->hasMany(Director::class, 'id_Area');
    }
}
