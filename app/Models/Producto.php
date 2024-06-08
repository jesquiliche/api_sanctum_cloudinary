<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'productos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'bodega',
        'descripcion',
        'maridaje',
        'precio',
        'graduacion',
        'ano',
        'sabor',
        'tipo_id',
        'imagen',
        'denominacion_id',
    ];

    /**
     * Get the tipo that owns the producto.
     */
    public function tipo()
    {
        return $this->belongsTo(Tipo::class);
    }

    /**
     * Get the denominacion that owns the producto.
     */
    public function denominacion()
    {
        return $this->belongsTo(Denominacion::class);
    }
}
