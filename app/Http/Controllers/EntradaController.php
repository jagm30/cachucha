<?php

namespace App\Http\Controllers;

use App\Entrada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Producto;
use App\Entradaproducto;
use APP\Providers\Auth;
class EntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {

            return datatables()->of(DB::table('entradas')
            ->select('id','fecha','nfactura','concepto','observacion','status')
            ->get())
            ->addColumn('action', function($data){
                $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" id="btn-reporte" name="btn-reporte" data-original-title="Reporte" class="btn btn-success btn-sm deleteItem" style="width:100px;">PDF</a>';
                if($data->status=='captura'){
                    $btn .= '<hr> <a href="/entradas/'.$data->id.'" data-toggle="tooltip" name="btn-reporte" data-original-title="Reporte" class="btn btn-warning btn-sm deleteItem" style="width:100px;">Continuar</a>';
                }
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        $productos    = Producto::all();
        $entradas       = Entrada::all();
        return view("entradas.index",compact('entradas','productos'));
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
        $entrada                    = new Entrada;        
        $entrada->fecha             = $request->fecha;
        $entrada->nfactura          = $request->nfactura;
        $entrada->id_sucursal       = $request->id_sucursal;
        $entrada->concepto          = $request->concepto;
        $entrada->id_proveedor      = $request->id_proveedor;
        $entrada->observacion       = $request->observacion;
        $entrada->status            = 'activo';
        $entrada->id_usuario        = auth()->id();
        //$entrada->id_usuario        = Auth::user()->id;
        $entrada->save();
        return redirect('/entradas/'.$entrada->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entrada  $entrada
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            // $data = Entradaproducto::all();
             return datatables()->of(DB::table('entradaproductos')
             ->select('entradaproductos.id','entradaproductos.id_entrada','entradaproductos.id_producto','entradaproductos.costo_unitario','entradaproductos.cantidad','entradaproductos.id_usuario','productos.nombre_producto')
             ->leftJoin('productos', 'entradaproductos.id_producto', '=', 'productos.id')
             ->where('entradaproductos.id_entrada',$id)
             ->get())
             ->addColumn('action', function($data){
                 $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" id="btn-eliminar" name="btn-eliminar" data-original-title="Delete" class="btn btn-danger btn-sm deleteItem">Eliminar</a>';
                 return $btn; 
             })
             ->rawColumns(['action'])
             ->make(true);
         }
         $entrada           = Entrada::findOrFail($id);
         $productos         = Producto::all();
         $entradaproductos  = Entradaproducto::all();
         return view("entradas.show",compact('entrada','productos','entradaproductos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entrada  $entrada
     * @return \Illuminate\Http\Response
     */
    public function edit(Entrada $entrada)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entrada  $entrada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entrada $entrada)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entrada  $entrada
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entrada $entrada)
    {
        //
    }
}
