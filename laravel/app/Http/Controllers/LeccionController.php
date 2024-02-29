<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Leccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeccionController extends Controller
{
    const RPP = 10;
    const ORDERBY = 'leccion.id';
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
            'leccion.id' => 0,
            'leccion.horas' => 0,
            'modulo.denominacion' => 0,
            'grupo.denominacion' => 0,
            'profesor.nombre'
        ],
        'orderType' => [
            self::ORDERTYPE => self::ORDERTYPE,
            'desc' => 0
        ]
    ];
    function __construct()
    {
        // Para todas las rutas debes estar autenticado
        $this->middleware('verificado')->except(['index']);
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

        $leccionQ = DB::table('leccion')
            ->join('modulo', 'leccion.idmodulo', '=', 'modulo.id')
            ->join('grupo', 'leccion.idgrupo', '=', 'grupo.id')
            ->join('profesor', 'leccion.idprofesor', '=', 'profesor.id')
            ->select(
                'leccion.id AS id',
                'modulo.denominacion AS modulo_denom',
                'grupo.denominacion AS grupo_denom',
                'leccion.horas AS horas',
                'profesor.nombre AS prof_nombre',
            );

        if ($q != null) {
            $leccionQ = $leccionQ->where('leccion.id', 'like', '%' . $q . '%')
                ->orWhere('grupo.denominacion', 'like', '%' . $q . '%')
                ->orWhere('modulo.denominacion', 'like', '%' . $q . '%')
                ->orWhere('leccion.horas', 'like', '%' . $q . '%')
                ->orWhere('profesor.nombre', 'like', '%' . $q . '%');
        }

        $lecciones = $leccionQ->orderBy($orderBy, $orderType)
            ->orderBy(self::ORDERBY, self::ORDERTYPE)
            ->paginate($rpp);

        // Recuento total de modulos
        $count_query = DB::select('select count(*) as leccion_count from leccion');
        $leccion_count = $count_query[0]->leccion_count;

        // Recuento de modulos mostrados
        if ($lecciones->currentPage() === 1) {
            $init_lecc = 1;
            $last_lecc_page = $lecciones->perPage();
        } else {
            $last_lecc_page = $lecciones->currentPage() * $lecciones->perPage();
            if ($leccion_count < $last_lecc_page) {
                $last_lecc_page = $leccion_count;
            }
            $init_lecc = ($lecciones->currentPage() * $lecciones->perPage()) - $lecciones->perPage();
        }

        return view('leccion.index', [
            'lecciones' => $lecciones,
            'orderBy' => $orderBy,
            'orderType' => $orderType,
            'q' => $q,
            'rpps' => self::getRpp(),
            'rpp' => $rpp,
            'leccion_count' => $leccion_count,
            'init_lecc' => $init_lecc,
            'last_lecc_page' => $last_lecc_page
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

    // Operaciones permitidas para generar lecciones
    const OP = [
        'REGEN' => 'regen',
        'GEN' => 'generate',
        'RECARGA' => 'recarga'
    ];

    public function create(Request $request)
    {
        switch ($request->op) {
            case self::OP['GEN']:
                return $this->generarLecciones();
            case self::OP['REGEN']:
                return $this->regenerarLecciones();
            case self::OP['RECARGA']:
                return $this->recargarLecciones();
            default:
                return back();
        }
    }

    private function generarLecciones()
    {
        // Función para generar lecciones
        try {
            // Recogemos todos los grupos
            $grupos = Grupo::all();
            // Recorremos la lista de grupos
            foreach ($grupos as $grupo) {
                foreach ($grupo->formacion->modulos as $mod) {
                    $this->newLeccion($grupo, $mod);
                }
            }
            return redirect('leccion')->with(['message' => 'Lecciones generadas exitosamente.']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'No se han podido generar las lecciones']);
        }
    }

    private function regenerarLecciones()
    {
        // Regenerar lecciones
        // Borramos base de datos de lecciones y creamos las nuevas
        try {
            // Borro la tabla de lecciones
            DB::table('leccion')->truncate();
            // Recogemos todos los grupos
            $grupos = Grupo::all();
            // Recorremos la lista de grupos
            foreach ($grupos as $grupo) {
                foreach ($grupo->formacion->modulos as $mod) {
                    $this->newLeccion($grupo, $mod);
                }
            }
            return redirect('leccion')->with(['message' => 'Lecciones regeneradas exitosamente.']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'No se han podido regenerar las lecciones']);
        }
    }

    private function recargarLecciones()
    {
        // Recargar lecciones
        // Comprobar las lecciones y si existen no hacer, si no existen se crean
        try {
            // Recogemos todos los grupos
            $grupos = Grupo::all();
            // Recorremos la lista de grupos
            foreach ($grupos as $grupo) {
                foreach ($grupo->formacion->modulos as $mod) {
                    // Comprobamos si existe
                    $lec = Leccion::where('idgrupo', $grupo->id)->where('idmodulo', $mod->id)->where('horas', $mod->horas)->get();
                    if (sizeof($lec) < 1) {
                        $this->newLeccion($grupo, $mod);
                    }
                }
            }
            return redirect('leccion')->with(['message' => 'Lecciones recargadas exitosamente.']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'No se han podido recargar las lecciones']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    private function newLeccion($grp, $mod)
    {
        $lecc = new Leccion();
        $lecc->idgrupo = $grp->id;
        $lecc->idmodulo = $mod->id;
        $lecc->idprofesor = 1;
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
            return redirect('leccion')->with(['message' => 'La lección se ha actualizado correctamente']);
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
            return redirect('leccion')->with(['message' => 'La lección ha sido borrada correctamente']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'La lección no ha sido borrada']);
        }
    }
}
