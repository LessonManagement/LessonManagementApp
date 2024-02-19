<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rpp = 4;
        $q = $request->q;

        $usuarios = DB::table('users')->select('*')->where('type', 'user');
        $admins = DB::table('users')->select('*')->where('type', '!=', 'user');

        if ($q != null) {
            $usuarios = $usuarios->where(function ($query) use ($q) {
                $query->where('name', 'like', '%' . $q . '%')->orWhere('email', 'like', '%' . $q . '%');
            });

            $admins = $admins->where(function ($query) use ($q) {
                $query->where('name', 'like', '%' . $q . '%')->orWhere('email', 'like', '%' . $q . '%');
            });
        }

        $usuarios = $usuarios->paginate($rpp);
        $admins = $admins->paginate($rpp);

        $total_users = DB::select('select count(*) as total_users from users');
        $total_users = $total_users[0]->total_users;
        return view('admin.index', [
            'usuarios' => $usuarios,
            'admins' => $admins,
            'rpp' => $rpp,
            'q' => $q,
            'total_users' => $total_users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::where('id', $id)->get();
        $user = $user[0];
        try {
            $user->delete();
            return redirect('admin')->with(['message' => 'El usuario ha sido borrado correctamente.']);
        } catch (\Exception $e) {
            return redirect('admin')->withErrors(['message' => 'El usuario no ha sido borrado correctamente.']);
        }
    }
}
