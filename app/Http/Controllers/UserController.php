<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('type', User::EMPLOYEE)->orderBy('id', 'desc')->get();
        return view('employees.index', ['employees' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('employees.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $selectedRoles = $request->input('selected_roles', []);

        $payload = $request->validated();
        $payload['type'] = User::EMPLOYEE;

        $user = User::create($payload);

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

        return redirect('users')->with('success', "User created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('employees.edit', ['employee' => $user, 'roles' => $roles]);   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = [
            'name' => $request->input('name', $user->name),
            'email' => $request->input('email', $user->email),
        ];

        if(!empty($request->password)) {
            $data['password'] = $request->password;
        }

        $user->update($data);

        $selectedRoles = $request->input('selected_roles', []);
        
        $user->roles()->sync($selectedRoles);

        return redirect('users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('users');
    }
}
