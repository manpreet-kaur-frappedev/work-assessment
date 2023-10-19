<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\UserRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = User::where('type', User::EMPLOYEE)->orderBy('id', 'desc')->get();

        return view('employees/index', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();

        return view('employees/create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $selectedRoles = $request->input('selected_roles', []);

        $user = User::create($request->validated());

        // get all permissions related to the roles
        $permissions = [];
        foreach ($user->roles as $role) {
            $permissions = array_merge($permissions, $role->permissions->pluck('id')->toArray());
        }

        // now remove the duplicate records from array
        $allPermissions = array_unique($permissions);

        foreach ($selectedRoles as $key => $role) {
            $user->roles()->attach($role);
        }

        foreach ($allPermissions as $key => $permission) {
            $user->permissions()->attach($permission);
        }

        return redirect('employee')->with('success', "Employee created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = User::find($id);

        $roles = Role::all();

        return view('employees/edit', ['employee' => $employee, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee = User::find($id);

        $data = [];
        if(!empty($request->name)) {
            $data['name'] = $request->name;
        }
        if(!empty($request->email)) {
            $data['email'] = $request->email;
        }
        if(!empty($request->password)) {
            $data['password'] = $request->password;
        }

        $employee->fill($data)->save();

        $selectedRoles = $request->input('selected_roles', []);

        if(count($selectedRoles) > 0) {
            $employee->roles()->detach();
            $employee->permissions()->detach();
        }

        foreach ($selectedRoles as $key => $role) {
            $employee->roles()->attach($role);
        }

        if(count($selectedRoles) > 0) {
            $permissions = [];
            foreach ($employee->roles as $role) {
                $permissions = array_merge($permissions, $role->permissions->pluck('id')->toArray());
            }

            // now remove the duplicate records from array
            $allPermissions = array_unique($permissions);

            foreach ($allPermissions as $key => $permission) {
                $employee->permissions()->attach($permission);
            }
        }

        return redirect('employee');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();

        return redirect('/employee');
    }
}