<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    function __construct() {
        $this->middleware('auth');
    }
    /**
     * Muestra el perfil del usuario que lo solicita
     */
    function profile(Request $request) {
        // Perfil del usuario
        return view('user.profile', ['user' => $request->user()]);
    }

    /**
     * Función para actualizar el perfil de usuario
     */
    function updateProfile(Request $request, User $user) {
        // Actualización del perfil del usuario
    }
}
