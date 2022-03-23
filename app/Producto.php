<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //
    protected $fillable = ["nombre_producto","codigo_barras","unidad_medida","precio_costo","precio_venta","precio_mayoreo","id_usuario"];
}
