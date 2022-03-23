<?php

namespace App\Exports;

use App\Producto;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductoExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Producto::all();
    }
}
