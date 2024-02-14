<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use Illuminate\Support\Facades\DB;

class GrupoController extends Controller
{
    public function __construct()
    {
        // Para todas las rutas debes estar autenticado
        $this->middleware('verificado');
        // Para todas las rutas que no sean el listado de lecciones, se debe estar verificado
        // Para todas las rutas que no sean la index, se debe ser admin o root
        $this->middleware('admin')->except(['index']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rpp = 5;
        $grupoQuery = DB::table('grupo')
            ->join('grupo_formacion', 'grupo.id', '=', 'grupo_formacion.idgrupo')
            ->join('formacion', 'grupo_formacion.idformacion', '=', 'formacion.id')
            ->select(
                'grupo.id AS id',
                'formacion.denominacion AS formacion',
                'grupo.denominacion AS denominacion',
                'grupo.curso_escolar AS curso_escolar',
                'grupo.turno AS turno',
                'grupo.curso AS curso'
            );
        $grupos = $grupoQuery->paginate($rpp);
        return view('grupo.index',['grupos' => $grupos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('grupo.create');
    }

    /**
     * Tiene que llegar por el request el id de formacion
     */
    public function store(Request $request)
    {
        $grupo = new Grupo($request->all());
        
        try{
            $grupo->save();
        }catch(\Exception $e){
            return back()->withInput()->withErrors(['message'=> 'EL grupo no se ha podido gruardar corractamente.']); 
        }
        
        return redirect('question')->with(['message'=>'EL grupo se ha guardado correctamente']);
    }

    public function show(Grupo $grupo)
    {
        return view('grupo.show',['grupo' => $grupo]);
    }

    public function edit(Grupo $grupo)
    {
        
        return view('grupo.edit',['grupo' => $grupo]);
    }

    /**
     * En este metodo deberia llegar por el request el id de formacion
     */
    public function update(Request $request, Grupo $grupo)
    {
        
        try{
            
            $question->update($request->all());
    
        }catch(\Exception $e){
            
            return back()->withInput()-> withErrors(['message'=> 'No ha sido podible guardar los cambios']);
        }
        
        return redirect('grupo')->with(['message'=>'El grupo se ha actualizado corractamente.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grupo $grupo)
    {
        try {
            
            $grupo->delete();
            
            return redirect('grupo')->with(['message' => 'EL grupo se ha borrado correctamente.']);
        } catch(\Exception $e) {
            return back()->withErrors(['message' => 'El grupo no se ha podido borrar correctamente.']);
        }
    }
}
