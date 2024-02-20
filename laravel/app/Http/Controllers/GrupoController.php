<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Formacion;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\grupo\GrupoCreateRequest;
use App\Http\Requests\grupo\GrupoEditRequest;

class GrupoController extends Controller
{
    private $turnos = ['Mañana','Tarde','Semi-Presencial'];
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
        //$grupos = Grupo::all();
        return view('grupo.index',['grupos' => $grupos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $denomiFormacion = Formacion::all();
        return view('grupo.create', ['denomiFormacion' => $denomiFormacion,'turnos'=>$this->turnos]);
    }

    /**
     * Tiene que llegar por el request el id de formacion
     */
    public function store(GrupoCreateRequest $request)
    {
        $grupo = new Grupo($request->all());
        try{
            $grupo->save();
            $grupo->formaciones()->attach($grupo->idformacion);
            // $result = DB::table('grupo_formacion')->insert([
            //     'idgrupo' => $grupo->id,
            //     'idformacion' =>$request->idformacion]);
            
        }catch(\Exception $e){
            return back()->withInput()->withErrors(['message'=> 'EL grupo no se ha podido gruardar corractamente.']); 
        }
        
        return redirect('grupo')->with(['message'=>'EL grupo se ha guardado correctamente']);
    }

    public function show(Grupo $grupo)
    {
        $formacion = Formacion::find($grupo->idformacion);
        return view('grupo.show',['grupo' => $grupo,'formacion' => $formacion]);
    }

    public function edit(Grupo $grupo)
    {
        $denomiFormacion = Formacion::all();
        return view('grupo.edit',['grupo' => $grupo, 'denomiFormacion' => $denomiFormacion,'turnos' => $this->turnos]);
    }

    public function update(GrupoEditRequest $request, Grupo $grupo)
    {
        
        try{
            
            $grupo->update($request->all());
    
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
