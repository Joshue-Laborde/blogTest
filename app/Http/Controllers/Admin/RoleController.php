<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    public function index()
    {
        $roles= Role::all();

        return view('admin.roles.index', compact('roles'));
    }


    public function create()
    {
        $permissions= Permission::all();

        return view('admin.roles.create', compact('permissions'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);


        //se crea rol
        $role=Role::create($request->all());
        //se asigna distintos permisos al rol creado
        $role->permissions()->sync($request->permissions);

        /* $permission = $request->input("permission");
        $role=Role::create($request->all());
        $role->SyncPermissions($permission); */

        return redirect()->route('admin.roles.index')->with('info', 'El rol se creó exitosamente');
    }


    public function show(Role $role)
    {
        $roles= Role::all();
        return view('admin.roles.show', compact('roles'));
    }


    public function edit(Role $role)
    {
        $permissions= Permission::all();

        return view('admin.roles.edit', compact('role', 'permissions'));
    }


    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required'
        ]);


        $role->update($request->all());
        if($request->permissions)
            $role->permissions()->sync($request->permissions);

        return redirect()->route('admin.roles.index', $role)->with('info', 'El rol se actualizó exitosamente');
    }


    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('admin.roles.index')->with('info', 'El rol se eliminó exitosamente');
    }
}
