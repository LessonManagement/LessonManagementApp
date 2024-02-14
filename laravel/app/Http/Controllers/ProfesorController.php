<?php

namespace App\Http\Controllers;

use App\Models\profesor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Profesor\ProfesorCreateRequest;
use App\Http\Requests\Profesor\ProfesorEditRequest;

class ProfesorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // Para todas las rutas debes estar autenticado
        $this->middleware('verificado');
        // Para todas las rutas que no sean el listado de lecciones, se debe estar verificado
        // Para todas las rutas que no sean la index, se debe ser admin o root
        $this->middleware('admin')->except(['index']);
    }
    
    public function index()
    {
        $rpp = 3;
        $profesorQuery = DB::table('profesor')
        ->select('id', 'seneca_username', 'nombre', 'apellido1', 'apellido2', 'email', 'especialidad');
        $profesores = $profesorQuery->paginate($rpp);
        return view('profesor.index', ['profesores' => $profesores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profesor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfesorCreateRequest $request)
    {
        //1º generar el objeto
        $profesor = new Profesor($request->all());
        
        //2º 'intentar' guardar
        try {
            $result = $profesor->save();
            //3º si lo he guardado volver a 'algun sitio'
            $afterInsert = session('afterInsert', 'show profesores');
            $target = 'profesor';
            if ($afterInsert != 'show profesores') {
                $target = 'profesor/create';
            }
            return redirect($target)->with(['message'=>'El profesor se ha guardado correctamente']);
        } catch (\Exception $e) {
            //4º si no lo he  guardado volver a la pagina  anterior con sus datos para volver a rellenar el formulario
            return back()->withInput()->withErrors(['message' => 'El profesor no se ha guardado correctamente']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function show(profesor $profesor)
    {
        return view('profesor.show', ['profesor' => $profesor]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function edit(profesor $profesor)
    {
        return view('profesor.edit', ['profesor'=>$profesor]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function update(ProfesorEditRequest $request, profesor $profesor)
    {
        try{
            $result = $profesor->update($request->all());
            return redirect('profesor')->with(['message'=>'El profesor se ha actualizado correctamente']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'El profesor no se ha actualizado correctamente']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function destroy(profesor $profesor)
    {
        try {
            $profesor->delete();
            return redirect('profesor')->with(['message' => 'El profesor se ha eliminado correctamente']);
        } catch(\Exception $e) {
            return back()->withErrors(['message' => 'El profesor no se ha eliminado correctamente']);
        }
    }
}
