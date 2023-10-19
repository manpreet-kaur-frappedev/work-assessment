<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::orderBy('id', 'desc')->get();

        return view('roles.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();

        return view('roles.create', ['permissions' => $permissions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $selectedPermissions = $request->input('selected_permissions', []);

        $role = new Role;
        $role->name = $request->role_name;
        $role->slug = $request->role_slug;
        $role->save();

        foreach ($selectedPermissions as $key => $permission) {
            $role->permissions()->attach($permission);
        }

        return redirect('/roles');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('roles.show', ['role' => $role]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('roles.edit', ['role' => $role, 'permissions' => $permissions]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $role->name = $request->role_name;
        $role->slug = $request->role_slug;
        $role->save();

        $selectedPermissions = $request->input('selected_permissions', []);

        if(count($selectedPermissions) > 0) {
            $role->permissions()->detach();
        }

        foreach ($selectedPermissions as $key => $permission) {
            $role->permissions()->attach($permission);
        }

        return redirect('/roles');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        $role->permissions()->detach();

        return response()->json(['success' => true, 'message' => 'Role deleted successfully']);
    }
}
