<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    //metodo para proteger rutas
    public function __construct()
    {
        $this->middleware('can:admin.users.index')->only('index');
        $this->middleware('can:admin.users.edit')->only('edit', 'update');
    }

    public function index(){
        return view('admin.users.index');
    }

    public function edit(User $user)
    {
        $roles=Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }


    public function update(Request $request, User $user)
    {
        //agregar nuevos registros en la tabla intermedia, se envia lo que esta mandando desde el formulario
        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.index', $user)->with('info', 'Se asignó los roles exitosamente');
    }


    public function destroy($id)
    {
        //
    }
}
