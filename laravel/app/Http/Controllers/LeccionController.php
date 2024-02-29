<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Leccion;
use Illuminate\Http\Request;

class LeccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('leccion.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Recogemos todos los grupos
        $grupos = Grupo::all();
        // Recorremos la lista de grupos
        foreach ($grupos as $grupo) {
            foreach ($grupo->formacion->modulos as $mod) {
                $this->newLeccion($grupo, $mod);
            }
        }
        return view('leccion.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Recogemos todos los grupos
        $grupos = Grupo::all();
        // Recorremos la lista de grupos
        $formaciones = [];
        foreach ($grupos as $grupo) {
            array_push($formaciones, $grupo->formacion);
        }
        dd($formaciones);
    }

    private function newLeccion($grp, $mod)
    {
        $lecc = new Leccion();
        $lecc->idgrupo = $grp->id;
        $lecc->idmodulo = $mod->id;
        $lecc->idprofesor = null;
        $lecc->horas = $mod->horas;
        $lecc->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Leccion $leccion)
    {
        return view('leccion.show', ['leccion' => $leccion]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leccion $leccion)
    {
        return view('leccion.edit', ['leccion' => $leccion]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Leccion $leccion)
    {
        try {
            // Actualizamos el módulo
            $result = $leccion->update($request->all());
            return redirect('modulo')->with(['message' => 'La lección se ha actualizado correctamente']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'La lección no se ha actualizado correctamente']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leccion $leccion)
    {
        try {
            $leccion->delete();
            return redirect('modulo')->with(['message' => 'La lección ha sido borrada correctamente']);
        } catch (\Exception $e) {
            return redirect('modulo')->withErrors(['message' => 'La lección no ha sido borrada']);
        }
    }
}
