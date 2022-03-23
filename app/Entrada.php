<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    //
    protected $fillable = ["id","fecha","nfactura","id_sucursal","concepto","id_proveedor","observacion","id_usuario","status"];
}
