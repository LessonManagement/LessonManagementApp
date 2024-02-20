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
    const RPP = 10;
    const ORDERBY = 'grupo.denominacion';
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
            'grupo.id' => 0,
            'grupo.denominacion' => 0,
            'grupo.curso' => 0,
            'grupo.curso_escolar' => 0,
            'grupo.turno' => 0,
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

        // Comprobamos la query (q)
        if ($q != null) {
            $grupoQuery = $grupoQuery->where('grupo.denominacion', 'like', '%' . $q . '%')
                ->orWhere('formacion.denominacion', 'like', '%' . $q . '%')
                ->orWhere('grupo.id', 'like', '%' . $q . '%')
                ->orWhere('grupo.curso_escolar', 'like', '%' . $q . '%')
                ->orWhere('grupo.turno', 'like', '%' . $q . '%')
                ->orWhere('grupo.curso', 'like', '%' . $q . '%');
        }

        $grupos = $grupoQuery->orderBy($orderBy, $orderType)
            ->orderBy(self::ORDERBY, self::ORDERTYPE)->paginate($rpp);

        // Recuento total de modulos
        $count_query = DB::select('select count(*) as grupo_count from grupo');
        $grupo_count = $count_query[0]->grupo_count;

        // Recuento de modulos mostrados
        if ($grupos->currentPage() === 1) {
            $init_grupo = 1;
            $last_grupo_page = $grupos->perPage();
        } else {
            $last_grupo_page = $grupos->currentPage() * $grupos->perPage();
            if ($grupo_count < $last_grupo_page) {
                $last_grupo_page = $grupo_count;
            }
            $init_grupo = ($grupos->currentPage() * $grupos->perPage()) - $grupos->perPage();
        }

        return view('grupo.index', [
            'grupos' => $grupos,
            'orderBy' => $orderBy,
            'orderType' => $orderType,
            'q' => $q,
            'rpps' => self::getRpp(),
            'rpp' => $rpp,
            'grupo_count' => $grupo_count,
            'init_grupo' => $init_grupo,
            'last_grupo_page' => $last_grupo_page
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
        $denomiFormacion = Formacion::all();
        return view('grupo.create', ['denomiFormacion' => $denomiFormacion,'turnos'=>$this->turnos]);
    }

    /**
     * Tiene que llegar por el request el id de formacion
     */
    public function store(GrupoCreateRequest $request)
    {
        $grupo = new Grupo($request->all());
        try {
            $grupo->save();
            $grupo->formaciones()->attach($grupo->idformacion);
            // $result = DB::table('grupo_formacion')->insert([
            //     'idgrupo' => $grupo->id,
            //     'idformacion' =>$request->idformacion]);

        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'EL grupo no se ha podido gruardar corractamente.']);
        }

        return redirect('grupo')->with(['message' => 'EL grupo se ha guardado correctamente']);
    }

    public function show(Grupo $grupo)
    {
        $formacion = Formacion::find($grupo->idformacion);
        return view('grupo.show', ['grupo' => $grupo, 'formacion' => $formacion]);
    }

    public function edit(Grupo $grupo)
    {
        $denomiFormacion = Formacion::all();
        return view('grupo.edit', ['grupo' => $grupo, 'denomiFormacion' => $denomiFormacion,'turnos' => $this->turnos]);
    }

    public function update(GrupoEditRequest $request, Grupo $grupo)
    {

        try {

            $grupo->update($request->all());

        } catch (\Exception $e) {

            return back()->withInput()->withErrors(['message' => 'No ha sido podible guardar los cambios']);
        }

        return redirect('grupo')->with(['message' => 'El grupo se ha actualizado corractamente.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grupo $grupo)
    {
        try {

            $grupo->delete();

            return redirect('grupo')->with(['message' => 'EL grupo se ha borrado correctamente.']);
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'El grupo no se ha podido borrar correctamente.']);
        }
    }
}
