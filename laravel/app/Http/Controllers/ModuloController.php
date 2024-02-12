<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModuloController extends Controller
{
    public function __construct() {
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
        return view('modulo.create');
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
    public function show(Modulo $modulo)
    {
        $modulo = DB::table('modulo')
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
                    ->where('modulo.id', '=', $modulo->id)->get();
        return view('modulo.show', ['modulo' => $modulo[0]]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Modulo $modulo)
    {
        return view('modulo.edit', ['modulo' => $modulo]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Modulo $modulo)
    {
        //
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
            return back()->withErrors(['message' => 'El módulo no ha sido borrado']);
        }
    }
}
