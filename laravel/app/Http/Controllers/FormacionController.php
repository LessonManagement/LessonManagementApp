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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('formacion.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Formacion $formacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Formacion $formacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Formacion $formacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formacion $formacion)
    {
        try {
            $formacion->delete();
            return response()->json(['formaciones' => Formacion::all()]);

        } catch(\Exception $e) {
            return response()->json(['prueba'=> 'mal mal']);    
        }
    }
}
