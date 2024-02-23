<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /** 
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Sacamos el total de modulos
        $mod['total'] = DB::select('select count(*) as total from modulo')[0]->total;
        // Sacamos el número de modulos los ultimos 7 días
        $mod['lastdays'] = DB::table('modulo')->where('created_at', '>=', Carbon::now()->subDays(7))->count();
        // Calculamos el porcentaje de los registrados los últimos 7 días
        if ($mod['lastdays'] <= 7) {
            $mod['porcentage'] = intval(($mod['lastdays'] / 7) * 100);
        } else {
            $mod['porcentage'] = 100;
        }
        // Sacamos el total de grupos
        $grp['total'] = DB::select('select count(*) as total from grupo')[0]->total;
        // Sacamos el número de grupos los últimos 7 días
        $grp['lastdays'] = DB::table('grupo')->where('created_at', '>=', Carbon::now()->subDays(7))->count();
        // Calculamos el porcentaje de los registrados los últimos 7 días
        if ($grp['lastdays'] <= 7) {
            $grp['porcentage'] = intval(($grp['lastdays'] / 7) * 100);
        } else {
            $grp['porcentage'] = 100;
        }
        // Sacamos el total de formaciones
        $form['total'] = DB::select('select count(*) as total from formacion')[0]->total;
        // Sacamos el número de formaciones los últimos 7 días
        $form['lastdays'] = DB::table('formacion')->where('created_at', '>=', Carbon::now()->subDays(7))->count();
        // Calculamos el porcentaje de los registrados los últimos 7 días
        if ($form['lastdays'] <= 7) {
            $form['porcentage'] = intval(($form['lastdays'] / 7) * 100);
        } else {
            $form['porcentage'] = 100;
        }
        // Sacamos el total de profesores
        $prof['total'] = DB::select('select count(*) as total from profesor')[0]->total;
        // Sacamos el número de profesores los últimos 7 días
        $prof['lastdays'] = DB::table('profesor')->where('created_at', '>=', Carbon::now()->subDays(7))->count();
        // Calculamos el porcentaje de los registrados los últimos 7 días        
        if ($prof['lastdays'] <= 7) {
            $prof['porcentage'] = intval(($prof['lastdays'] / 7) * 100);
        } else {
            $prof['porcentage'] = 100;
        }
        // Sacamos el total de lecciones
        $lec['total'] = DB::select('select count(*) as total from leccion')[0]->total;
        // Sacamos el total de usuarios
        $user['total'] = DB::select('select count(*) as total from users')[0]->total;

        // Total de registros general
        $resume['total'] = $prof['total'] + $mod['total'] + $grp['total'] + $form['total'] + $lec['total'] + $user['total'];

        // Porcentajes generales
        $resume['porcentajes']['mod'] = intval(($mod['total'] / $resume['total']) * 100);
        $resume['porcentajes']['grp'] = intval(($grp['total'] / $resume['total']) * 100);
        $resume['porcentajes']['prof'] = intval(($prof['total'] / $resume['total']) * 100);
        $resume['porcentajes']['form'] = intval(($form['total'] / $resume['total']) * 100);
        $resume['porcentajes']['lec'] = intval(($lec['total'] / $resume['total']) * 100);
        $resume['porcentajes']['user'] = intval(($user['total'] / $resume['total']) * 100);

        return view('home.home', [
            'mod' => $mod,
            'form' => $form,
            'grp' => $grp,
            'prof' => $prof,
            'lec' => $lec,
            'user' => $user,
            'resume' => $resume
        ]);
    }

    public function home()
    {
        return redirect('/');
    }

}
