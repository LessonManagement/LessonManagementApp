<?php

namespace App\Http\Controllers;

use App\Models\profesor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Profesor\ProfesorCreateRequest;
use App\Http\Requests\Profesor\ProfesorEditRequest;

class ProfesorController extends Controller
{
    const RPP = 10;
    const ORDERBY = 'profesor.nombre';
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
            'profesor.id' => 0,
            'profesor.seneca_username' => 0,
            'profesor.apellido1' => 0,
            'profesor.apellido2' => 0,
            'profesor.email' => 0,
            'profesor.especialidad' => 0,
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

    public function index(Request $request)
    {
        $rpp = self::getFromRequest($request, 'rpp', self::RPP);
        $orderBy = self::getFromRequest($request, 'orderBy', self::ORDERBY);
        $orderType = self::getFromRequest($request, 'orderType', self::ORDERTYPE);
        $q = $request->q;

        $profesorQuery = DB::table('profesor')
            ->select('id', 'seneca_username', 'nombre', 'apellido1', 'apellido2', 'email', 'especialidad');

        // Comprobamos la query (q)
        if ($q != null) {
            $profesorQuery = $profesorQuery->where('profesor.id', 'like', '%' . $q . '%')
                ->orWhere('profesor.seneca_username', 'like', '%' . $q . '%')
                ->orWhere('profesor.nombre', 'like', '%' . $q . '%')
                ->orWhere('profesor.apellido1', 'like', '%' . $q . '%')
                ->orWhere('profesor.apellido2', 'like', '%' . $q . '%')
                ->orWhere('profesor.email', 'like', '%' . $q . '%')
                ->orWhere('profesor.especialidad', 'like', '%' . $q . '%');
        }

        $profesores = $profesorQuery->orderBy($orderBy, $orderType)
            ->orderBy(self::ORDERBY, self::ORDERTYPE)->paginate($rpp);

        // Recuento total de modulos
        $count_query = DB::select('select count(*) as profesor_count from profesor');
        $profesores_count = $count_query[0]->profesor_count;

        // Recuento de profesores mostrados
        if ($profesores->currentPage() === 1) {
            $init_prof = 1;
            $last_prof_page = $profesores->perPage();
        } else {
            $last_prof_page = $profesores->currentPage() * $profesores->perPage();
            if ($profesores_count < $last_prof_page) {
                $last_prof_page = $profesores_count;
            }
            $init_prof = ($profesores->currentPage() * $profesores->perPage()) - $profesores->perPage();
        }
        return view('profesor.index', [
            'profesores' => $profesores,
            'orderBy' => $orderBy,
            'orderType' => $orderType,
            'q' => $q,
            'rpps' => self::getRpp(),
            'rpp' => $rpp,
            'profesores_count' => $profesores_count,
            'init_prof' => $init_prof,
            'last_prof_page' => $last_prof_page
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
            return redirect($target)->with(['message' => 'El profesor se ha guardado correctamente']);
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
        return view('profesor.edit', ['profesor' => $profesor]);
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
        try {
            $result = $profesor->update($request->all());
            return redirect('profesor')->with(['message' => 'El profesor se ha actualizado correctamente']);
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
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'El profesor no se ha eliminado correctamente']);
        }
    }
}
