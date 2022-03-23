<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entradaproducto extends Model
{
    //
    protected $fillable = ["id_entrada","id_producto","costo_unitario","cantidad","id_usuario","status","id_sucursal"];
}
