<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function logout()
    {
        \Auth::guard('web')->logout();

        return redirect('login');
    }

    public function login()
    {
        return view('users/login');
    }

    public function registerAdmin()
    {
        return view('users/register');
    }

    public function registerEmployee()
    {
        return view('users/register-employee');
    }

    public function createAdmin(UserRequest $request)
    {
        $payload = $request->validated();
        $payload['type'] = User::ADMIN;

        $user = User::create($payload);

        auth()->login($user);

        return redirect('/')->with('success', "Account successfully registered.");
    }

    public function createEmployee(UserRequest $request)
    {
        $payload = $request->validated();
        $payload['type'] = User::EMPLOYEE;

        $user = User::create($payload);

        auth()->login($user);

        return redirect('/')->with('success', "Account successfully registered.");
    }

    public function loginUser(UserLoginRequest $request)
    {
        if($request->validated()) {
            if(\Auth::attempt([
                'email' => $request->get('email'),
                'password' => $request->get('password')
            ])) {
                return redirect('/');
            } else {
                return redirect()->back()->with('error', 'Wrong credentials');
            }
        }
    }
}
