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
    const RPP = 10;
    const ORDERBY = 'modulo.denominacion';
    const ORDERTYPE = 'asc';
    const PARAMS = [
        'rpp' => [
            self::RPP => self::RPP,
            5 => 0,
            25 => 0,
            50 => 0,
            100 => 0
        ],
        'orderBy' => [
            self::ORDERBY => self::ORDERBY,
            'formacion.denominacion' => 0,
            'modulo.id' => 0,
            'modulo.siglas' => 0,
            'modulo.curso' => 0,
            'modulo.horas' => 0,
            'modulo.especialidad' => 0,
        ],
        'orderType' => [
            self::ORDERTYPE => self::ORDERTYPE,
            'desc' => 0
        ]
    ];
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
        $rpp = self::getFromRequest($request, 'rpp', self::RPP);
        $orderBy = self::getFromRequest($request, 'orderBy', self::ORDERBY);
        $orderType = self::getFromRequest($request, 'orderType', self::ORDERTYPE);
        $q = $request->q;

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

        // Comprobamos la query (q)
        if ($q != null) {
            $moduloQuery = $moduloQuery->where('modulo.denominacion', 'like', '%' . $q . '%')
                ->orWhere('formacion.denominacion', 'like', '%' . $q . '%')
                ->orWhere('modulo.siglas', 'like', '%' . $q . '%')
                ->orWhere('modulo.curso', 'like', '%' . $q . '%')
                ->orWhere('modulo.horas', 'like', '%' . $q . '%')
                ->orWhere('modulo.especialidad', 'like', '%' . $q . '%');
        }

        $modulos = $moduloQuery->orderBy($orderBy, $orderType)
            ->orderBy(self::ORDERBY, self::ORDERTYPE)
            ->paginate($rpp);

        // Recuento total de modulos
        $count_query = DB::select('select count(*) as modulo_count from modulo');
        $modulo_count = $count_query[0]->modulo_count;

        // Recuento de modulos mostrados
        if($modulos->currentPage() === 1) {
            $init_mod = 1;
            $last_mod_page = $modulos->perPage();
        } else {
            $last_mod_page = $modulos->currentPage() * $modulos->perPage();
            if($modulo_count < $last_mod_page) {
                $last_mod_page = $modulo_count;
            }
            $init_mod = ($modulos->currentPage() * $modulos->perPage()) - $modulos->perPage();
        }
            
        return view('modulo.index', [
            'modulos' => $modulos,
            'orderBy' => $orderBy,
            'orderType' => $orderType,
            'q' => $q,
            'rpps' => self::getRpp(),
            'rpp' => $rpp,
            'modulo_count' => $modulo_count,
            'init_mod' => $init_mod,
            'last_mod_page' => $last_mod_page
        ]);
    }

    private static function getRpp()
    {
        return [5 => 5, 10 => 10, 25 => 25, 50 => 50, 100 => 100];
    }

    private static function getFromRequest($request, $name, $defaultValue)
    {
        $value = array_key_first(self::PARAMS[$name]);
        if ($request->$name != null) {
            $value = $request->$name;
        }
        if (!isset(self::PARAMS[$name][$value])) {
            $value = array_key_first(self::PARAMS[$name]);
        }
        return $value;
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
            // Obtenemos formacion antiua
            $old_formacion = $modulo->idformacion;
            // Actualizamos el módulo
            $result = $modulo->update($request->all());
            // Obtenermos el objeto de la tabla modulo formacion
            $affected = DB::table('modulo_formacion')
                ->where('idmodulo', $modulo->id)
                ->where('idformacion', $old_formacion)
                ->update(['idformacion' => $modulo->idformacion]);

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
