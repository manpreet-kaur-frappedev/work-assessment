<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;

class UserController extends Controller
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

    public function register()
    {
        return view('users/register');
    }

    public function createUser(UserRequest $request)
    {
        $user = User::create($request->validated());

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
