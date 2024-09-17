<?php

namespace App\Models;
use App\Models\Articulo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\MarcaCreated;
use App\Events\MarcaUpdated;

class marca extends Model
{
    use HasFactory;

    /**
       * The attributes that are mass assignable.
       *
       * @var array
       */
  
      protected $fillable=[
          'id',
          'nombre',
          'creacion',
          'imagen',        
      ];
  
      protected static function boot()
    {
        parent::boot();

        static::created(function ($marca) {
            if (!app()->runningInConsole()) {
                event(new MarcaCreated($marca));
            }
        });

        static::updated(function ($marca) {
            if (!app()->runningInConsole()) {
                event(new MarcaUpdated($marca));
            }
        });
    }
        public function articulos()
        {
            return $this->hasMany(Articulo::class);
        }
}
