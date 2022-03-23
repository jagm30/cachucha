<?php

namespace App\Http\Controllers;

use App\Producto;
use Illuminate\Http\Request;
use Auth;
use Barryvdh\DomPDF\Facade as PDF;
use App\Exports\ProductoExport;
use Maatwebsite\Excel\Facades\Excel;

class ProductoController extends Controller
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
    public function index()
    {
        //
        $productos = Producto::all();
        return view("productos.index",compact('productos'));
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
        if (Auth::check())
        {
            $id_usuario = Auth::user()->id;
            // The user is logged in...
        }else{
            return "Error, excedio el tiempo de sesión";
        }
        $producto               = new Producto;        
        $producto->nombre_producto  = $request->nombre_producto;
        $producto->codigo_barras    = $request->codigo_barras;
        $producto->unidad_medida    = $request->unidad_medida;
        $producto->precio_costo     = $request->precio_costo;
        $producto->precio_venta     = $request->precio_venta;
        $producto->precio_mayoreo   = $request->precio_mayoreo;
        $producto->id_usuario       = $id_usuario;
        $producto->save();

        return redirect('/productos');        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $productos              = Producto::where('id',$id)->first();
        return $productos;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
         $producto= producto::findOrFail($id);
        return view('productos.edit',compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $productos=request()->except(['_token','_method']);
        producto::where('id','=',$id)->update($productos);

        $producto= producto::findOrFail($id);
        return redirect('productos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        producto::destroy($id);
        return redirect('productos');
    }
    public function edicion(Request $request){
        //return $request['precio_venta-e'];
        $id = $request['id'];
       // $producto=request()->except(['_token','id']);

       // return $id;
        if (Auth::check())
        {
            $id_usuario = Auth::user()->id;
            $producto = Producto::find($id);
            $producto->nombre_producto  = $request['nombre_producto-e'];
            $producto->codigo_barras    = $request['codigo_barras-e'];
            $producto->unidad_medida    = 'pieza';
            $producto->precio_costo     = $request['precio_costo-e'];
            $producto->precio_venta     = $request['precio_venta-e'];
            $producto->precio_mayoreo   = $request['precio_mayoreo-e'];
            $producto->id_usuario       = $id_usuario;
            $producto->save();
            // The user is logged in...
        }else{
            return "Error, excedio el tiempo de sesión";
        }
        
        $mensaje = 'Producto actualizado . . .';
        return Response()->json(['mensaje'=>$mensaje]);

    }
    public function descargarPDF(){
       /* $data = [
            'titulo' => 'Styde.net'
        ];
    
        $pdf = \PDF::loadView('vista-pdf', $data);
    
        return $pdf->download('archivo.pdf');
*/
        $invoice    = "2222";
        $view       =  \View::make('productos.descargaPDF')->render();
        $pdf        = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        //$pdf->setPaper('A4', 'landscape');
        $pdf->setPaper('landscape','mm',array(56,150));
        return $pdf->stream('invoice');

    }
    public function descargarExcel(){
        return Excel::download(new ProductoExport, 'users.xlsx');
    }
}
