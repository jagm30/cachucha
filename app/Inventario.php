<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $fillable = ["id_entrada","id_producto","costo_unitario","cantidad","id_usuario","id_sucursal","status"];
}
