<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginAuthRequest;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(LoginAuthRequest $request)
    {
        dd($request->only('email','password'));
        // \auth()->attempt();
        Auth::attempt($request->only('email','password'));
    }
}
