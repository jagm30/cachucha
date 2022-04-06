<?php

namespace App\Http\Controllers;

use App\Inventario;
use Illuminate\Http\Request;
use Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Producto;
use App\Exports\InventarioExport;

class InventarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function export(){
        return Excel::download(new InventarioExport, 'inventario.xlsx');
    }
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            // $data = Entradaproducto::all();
             return datatables()->of(DB::table('inventarios')
             ->select('inventarios.id','inventarios.id_entrada','inventarios.id_producto','inventarios.costo_unitario','inventarios.cantidad','inventarios.status','productos.nombre_producto','productos.codigo_barras', 'productos.precio_mayoreo')
             ->join('productos', 'inventarios.id_producto', '=', 'productos.id')
             //->join('entradas', 'inventarios.id_entrada', '=', 'entradas.id')
             ->get())
             ->addColumn('action', function($data){

                 $btn = ' <a href="javascript:void(0)"   data-id="'.$data->id_producto.'"  id="btn-movkardex"data-toggle="modal" data-target="#modal-success" class="btn btn-success btn-sm">Kardex de movimientos</a>';
                 return $btn;

 
             })
             ->rawColumns(['action'])
             ->make(true);
        }
        return view("inventarios.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function show(Inventario $inventario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventario $inventario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventario $inventario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventario $inventario)
    {
        //
    }
}
