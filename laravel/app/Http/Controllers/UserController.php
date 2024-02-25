<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Muestra el perfil del usuario que lo solicita
     */
    function profile(Request $request)
    {
        // Perfil del usuario
        return view('user.profile', ['user' => $request->user()]);
    }

    /**
     * Función para actualizar el perfil de usuario
     */
    function updateProfile(Request $request, User $user)
    {
        // Esta variable la pondremos a true si en algun if debemos guardar el modelo
        $save = false;

        // Actualización del perfil del usuario
        if ($request->hasFile('user_pic') && $request->file('user_pic')->isValid()) {
            $archivo = $request->file('user_pic');
            // Cotejamos el tipo de archivo que suben.
            // Es fundamental comprobar que sea los archivo que queremos permitir 
            // para que no tengamos problemas de seguridad ni de nada
            //$mime = $archivo->getMimeType();
            $path = $archivo->getRealPath();
            $imagen = file_get_contents($path);

            $user->user_pic = base64_encode($imagen);
            $save = true;
        }

        if (trim($request->name) != '') {
            // Validamos el nombre
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator->getMessageBag());
            }
            $user->name = trim($request->name);
            // Actualizamos el nombre
            $save = true;
        }
        if (trim($request->bio) != '') {
            // Validamos el nombre
            $validator = Validator::make($request->all(), [
                'bio' => ['required', 'string', 'max:1000'],
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator->getMessageBag());
            }
            $user->bio = trim($request->bio);
            // Actualizamos el nombre
            $save = true;
        }
        if (trim($request->email) != '') {
            // Validamos el email
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator->getMessageBag());
            }
            $user->email = trim($request->email);
            // Actualizamos el email
            $save = true;
        }
        if (trim($request->old_password) != '') {
            // Comprobamos que la contraseña antigua coincide
            if (password_verify($request->old_password, $user->password)) {
                // Ahora validamos la nueva contraseña
                $validator = Validator::make($request->all(), [
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]);
                if ($validator->fails()) {
                    return back()->withErrors($validator->getMessageBag());
                }
                $user->password = Hash::make($request->password);
                // Actualizamos la contraseña
                $save = true;
            } else
                return back()->withInput()->withErrors(['password' => 'Contraseña no actualizada. Contraseña actual errónea']);
        }

        if ($save) {
            try {
                $user->save();
                return redirect('profile')->with(['message' => 'Tu perfil ha sido actualizar exitosamente.']);
            } catch (\Exception $e) {
                return back()->withInput()->withErrors(['message' => 'No se ha podido actualizarl tu perfil.']);
            }
        }
    }
}
