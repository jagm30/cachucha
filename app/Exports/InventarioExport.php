<?php

namespace App\Exports;

use App\Inventario;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;

class InventarioExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
   /* public function collection()
    {
        return Inventario::all();
    }*/
    public function view(): View
    {
        $inventarios = DB::table('inventarios')
        ->select('inventarios.id','inventarios.id_entrada','inventarios.id_producto','inventarios.costo_unitario','inventarios.cantidad','inventarios.status','productos.nombre_producto','productos.codigo_barras', 'productos.precio_mayoreo')
        ->join('productos', 'inventarios.id_producto', '=', 'productos.id')
        ->join('entradas', 'inventarios.id_entrada', '=', 'entradas.id')
       // ->where('entradas.id_sucursal',session('sessionsucursal'))
        ->get(); 
        return view('exportar.inventario', [
            'inventarios' => $inventarios
        ]);

              
    }
}
