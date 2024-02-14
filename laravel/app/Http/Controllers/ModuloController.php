<?php

namespace App\Http\Controllers;

use App\Http\Requests\Modulo\ModuloCreateRequest;
use App\Http\Requests\Modulo\ModuloEditRequest;
use App\Models\Formacion;
use App\Models\Modulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ModuloController extends Controller
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
    public function index(Request $request)
    {
        $rpp = 5;
        // ['idformacion', 'denominacion', 'siglas', 'curso', 'horas', 'especialidad']
        $moduloQuery = DB::table('modulo')
            ->join('modulo_formacion', 'modulo.id', '=', 'modulo_formacion.idmodulo')
            ->join('formacion', 'modulo_formacion.idformacion', '=', 'formacion.id')
            ->select(
                'modulo.id AS id',
                'formacion.denominacion AS formacion',
                'modulo.denominacion AS denominacion',
                'modulo.siglas AS siglas',
                'modulo.curso AS curso',
                'modulo.horas AS horas',
                'modulo.especialidad AS especialidad'
            );

        $modulos = $moduloQuery->paginate($rpp);
        return view('modulo.index', ['modulos' => $modulos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $formaciones = Formacion::all();
        return view('modulo.create', ['formaciones' => $formaciones]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ModuloCreateRequest $request)
    {
        $object = new Modulo($request->all());

        try {
            $result = $object->save();
            // Guardamos la relacion entre formacion y modulo
            $object->formaciones()->attach($object->idformacion);
            // Donde redirigirá después de crear
            $target = 'modulo/' . $object->id;
            return redirect($target)->with(['message' => 'Módulo creado correctamente.']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'El módulo no ha sido creado correctamente.']);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Modulo $modulo)
    {
        $modulo_query = DB::table('modulo')
            ->join('modulo_formacion', 'modulo.id', '=', 'modulo_formacion.idmodulo')
            ->join('formacion', 'modulo_formacion.idformacion', '=', 'formacion.id')
            ->select(
                'modulo.id AS id',
                'formacion.denominacion AS formacion',
                'modulo.denominacion AS denominacion',
                'modulo.siglas AS siglas',
                'modulo.curso AS curso',
                'modulo.horas AS horas',
                'modulo.especialidad AS especialidad'
            )
            ->where('modulo.id', $modulo->id);
        $modulo_obj = $modulo_query->get();
        return view('modulo.show', ['modulo' => $modulo_obj[0]]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Modulo $modulo)
    {
        $formaciones = Formacion::all();
        return view('modulo.edit', [
            'modulo' => $modulo,
            'formaciones' => $formaciones
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ModuloEditRequest $request, Modulo $modulo)
    {
        try {
            $result = $modulo->update($request->all());
            return redirect('modulo')->with(['message' => 'El módulo se ha actualizado correctamente']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'El módulo no se ha actualizado correctamente']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Modulo $modulo)
    {
        try {
            $modulo->delete();
            return redirect('modulo')->with(['message' => 'El módulo ha sido borrado correctamente']);
        } catch (\Exception $e) {
            return redirect('modulo')->withErrors(['message' => 'El módulo no ha sido borrado']);
        }
    }
}
