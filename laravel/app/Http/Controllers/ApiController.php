<?php

namespace App\Http\Controllers;

use App\Models\Leccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    function __construct()
    {
        $this->middleware('lmapi')->except(['get_emails']);
    }

    /**
     * Devuelve los emails de los profesores dados de alta en la base de datos
     * en formato JSON desde ruta API
     * 
     * @return json $emails
     */
    function get_emails(Request $request)
    {
        $emails = [];
        $emails_result = DB::select('select email from profesor');
        foreach ($emails_result as $entry) {
            array_push($emails, $entry->email);
        }
        return response()->json($emails);
    }

    function data_structure(Request $request) {
        $lecciones = Leccion::all();
        dd($lecciones);
    }
}
