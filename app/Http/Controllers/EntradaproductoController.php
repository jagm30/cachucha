<?php

namespace App\Http\Controllers;

use App\Entradaproducto;
use App\Entrada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EntradaproductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return "Entradas";
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
        Entradaproducto::create($request->all());
        return json_encode(array(
            "Estado"=>"Agregado correctamente"
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entradaproducto  $entradaproducto
     * @return \Illuminate\Http\Response
     */
    public function show(Entradaproducto $entradaproducto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entradaproducto  $entradaproducto
     * @return \Illuminate\Http\Response
     */
    public function edit(Entradaproducto $entradaproducto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entradaproducto  $entradaproducto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entradaproducto $entradaproducto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entradaproducto  $entradaproducto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $entradaproducto = Entradaproducto::findOrFail($id);
        $entrada = Entrada::findOrFail($entradaproducto->id_entrada);    
        if($entrada->status=='finalizado'){
            $mensaje = 'La factura esta finalizada';
        }else{
            $entradaproducto->delete();
            $mensaje = 'Eliminado correctamente';
        }
       
        return Response()->json(['mensaje'=>$mensaje]);
    }
    public function finalizar(Request $request, $id){
        $entrada = Entrada::find($id);
        $entrada->status = 'finalizado';
        $entrada->save();

        DB::table('entradaproductos')->where('id_entrada',$id)->update(['status' => 'finalizado']);
       
        $mensaje = 'finalizado correctamente . . .';
        return Response()->json(['mensaje'=>$mensaje]);
    }
}
