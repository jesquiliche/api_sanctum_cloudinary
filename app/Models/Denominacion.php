<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denominacion extends Model
{
    use HasFactory;

    protected $table = "Denominaciones";

    protected $fillable = ['nombre', 'descripcion'];

    /**
     * Define la relación uno a muchos con el modelo Producto.
     */
    public function producto()
    {
        return $this->hasMany('App\Models\Producto');
    }
}
