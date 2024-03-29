<?php

namespace App\Http\Controllers;

use App\Models\Formacion;
use Illuminate\Http\Request;

class FormacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
        return view('formacion.index');
    }
    
    /**
     * Metodo para llamada ajax de la tabla formacion
     */
    public function indexAjax()
    {  
        $formaciones = Formacion::all();
        return response()->json(['formaciones' => $formaciones]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formacion = new Formacion($request->all());
        try {
            $formacion->save();
            return response()->json(['formaciones' => Formacion::all(), 'result' => true]);
        } catch(\Exception $e) {
            return response()->json(['prueba'=> 'mal mal', 'result' => false]);    
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Formacion $formacion)
    {
        try {
            $formacion->upadte($request->all());
            return response()->json(['formaciones' => Formacion::all(), 'result' => true]);
        } catch(\Exception $e) {
            return response()->json(['prueba'=> 'mal mal', 'result' => false]);    
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formacion $formacion)
    {
        try {
            $formacion->delete();
            return response()->json(['formaciones' => Formacion::all(), 'result' => true]);
        } catch(\Exception $e) {
            return response()->json(['prueba'=> 'mal mal', 'result' => true]);    
        }
    }
}
